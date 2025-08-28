<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DonorController extends Controller
{
    public function index(Request $request)
    {
        $query = User::donors()->with(['collections' => function ($query) {
            $query->where('status', 'active');
        }]);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('postal_code', 'like', "%{$search}%");
            });
        }

        // Filter by donor type
        if ($request->filled('donor_type')) {
            $query->where('donor_type', $request->donor_type);
        }

        // Filter by status - default to active if no status specified
        if ($request->filled('status')) {
            if ($request->status === 'all') {
                // Show all donors regardless of status
            } else {
                $query->where('status', $request->status);
            }
        } else {
            // Default to showing only active donors
            $query->where('status', 'active');
        }

        // Sort by postal code
        if ($request->filled('sort_by') && $request->sort_by === 'postal_code') {
            $query->orderBy('postal_code', $request->get('sort_order', 'asc'));
        } else {
            $query->orderBy('name');
        }

        $donors = $query->paginate(20);

        // Data for Add Donor modal
        $countries = \App\Models\Country::getForSelect();
        $regions = \App\Models\Region::getForSelect();
        $secretaries = \App\Models\User::where('role', \App\Models\User::ROLE_SECRETARY)
            ->active()
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('donors.index', compact('donors', 'countries', 'regions', 'secretaries'));
    }

    public function create()
    {
        $countries = \App\Models\Country::getForSelect();
        $regions = \App\Models\Region::getForSelect();
        $secretaries = \App\Models\User::where('role', \App\Models\User::ROLE_SECRETARY)
            ->active()
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('donors.create', compact('countries', 'regions', 'secretaries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'pan_number' => 'nullable|string|max:10|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
            'promotional_secretary' => 'nullable|string|max:255',
            'phone' => 'required|string|max:15',
            'phone_alt1' => 'nullable|string|max:15',
            'phone_alt2' => 'nullable|string|max:15',
            'date_of_birth' => 'nullable|date',
            'wedding_date' => 'nullable|date|required_if:marital_status,married',
            'gender' => 'nullable|in:male,female,other',
            'marital_status' => 'nullable|in:single,married,divorced,widowed',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'country_id' => 'nullable|exists:countries,id',
            'region_id' => 'nullable|exists:regions,id',
            'occupation' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'donor_type' => ['required', Rule::in(['individual', 'corporate', 'foundation', 'church', 'anonymous'])],
            'donation_frequency' => 'nullable|in:weekly,bi_monthly,monthly,quarterly,half_yearly,yearly,one_time,on_demand,special_occasion,festival,anniversary,birthday,other',
            'notes' => 'nullable|string',
            'amount_promised' => 'nullable|numeric|min:0',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $filename = time() . '_' . $profilePicture->getClientOriginalName();
            $path = $profilePicture->storeAs('profile-pictures', $filename, 'public');
            $validated['profile_picture'] = $path;
        }

        // Create full name
        $validated['name'] = $validated['first_name'] . ' ' . $validated['last_name'];
        
        // Set role and status
        $validated['role'] = 'donor';
        $validated['status'] = 'active';
        $validated['is_anonymous'] = $validated['donor_type'] === 'anonymous';
        
        // Generate a default password
        $validated['password'] = bcrypt('password123'); // Should be changed on first login

        // Check for duplicates
        $duplicate = User::where('first_name', $validated['first_name'])
            ->where('last_name', $validated['last_name'])
            ->where('address_line_1', $validated['address_line_1'])
            ->first();

        if ($duplicate) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'A donor with this name and address already exists.'
                ], 422);
            }
            return back()->withErrors(['duplicate' => 'A donor with this name and address already exists.'])
                        ->withInput();
        }

        $donor = User::create($validated);
        AuditLog::record('donor.created', $request->user(), $donor, [
            'description' => "Donor '{$donor->name}' was created",
            'new' => $donor->only(['name','email','phone','address_line_1'])
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Donor created successfully.',
                'donor' => $donor->only(['id', 'name', 'email', 'phone', 'donor_type', 'status'])
            ]);
        }

        if ($request->input('redirect_to') === 'index') {
            return redirect()->route('donors.index')->with('success', 'Donor created successfully.');
        }

        return redirect()->route('donors.show', $donor)
                        ->with('success', 'Donor created successfully.');
    }

    public function show(User $donor)
    {
        // Ensure this is a donor
        if ($donor->role !== 'donor') {
            abort(404);
        }

        $donor->load(['collections' => function ($query) {
            $query->where('status', 'active')->orderBy('collection_date', 'desc');
        }, 'magazineSubscriptions']);

        $lastDonation = $donor->lastDonation;
        $totalDonations = $donor->totalDonations;

        return view('donors.show', compact('donor', 'lastDonation', 'totalDonations'));
    }

    public function edit(User $donor)
    {
        // Ensure this is a donor
        if ($donor->role !== 'donor') {
            abort(404);
        }

        $countries = \App\Models\Country::getForSelect();
        $regions = \App\Models\Region::getForSelect();
        $secretaries = \App\Models\User::where('role', \App\Models\User::ROLE_SECRETARY)
            ->active()
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('donors.edit', compact('donor', 'countries', 'regions', 'secretaries'));
    }

    public function update(Request $request, User $donor)
    {
        // Ensure this is a donor
        if ($donor->role !== 'donor') {
            abort(404);
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $donor->id,
            'pan_number' => 'nullable|string|max:10|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
            'promotional_secretary' => 'nullable|string|max:255',
            'phone' => 'required|string|max:15',
            'phone_alt1' => 'nullable|string|max:15',
            'phone_alt2' => 'nullable|string|max:15',
            'date_of_birth' => 'nullable|date',
            'wedding_date' => 'nullable|date|required_if:marital_status,married',
            'gender' => 'nullable|in:male,female,other',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'country_id' => 'nullable|exists:countries,id',
            'region_id' => 'nullable|exists:regions,id',
            'occupation' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'donor_type' => ['required', Rule::in(['individual', 'corporate', 'foundation', 'church', 'anonymous'])],
            'donation_frequency' => 'nullable|in:weekly,bi_monthly,monthly,quarterly,half_yearly,yearly,one_time,on_demand,special_occasion,festival,anniversary,birthday,other',
            'marital_status' => 'nullable|in:single,married,divorced,widowed',
            'amount_promised' => 'nullable|numeric|min:0',
            'status' => ['required', Rule::in(['active', 'inactive', 'blocked', 'deceased'])],
            'notes' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create full name
        $validated['name'] = $validated['first_name'] . ' ' . $validated['last_name'];
        $validated['is_anonymous'] = $validated['donor_type'] === 'anonymous';

        // Check for duplicates (excluding current donor)
        $duplicate = User::where('first_name', $validated['first_name'])
            ->where('last_name', $validated['last_name'])
            ->where('address_line_1', $validated['address_line_1'])
            ->where('id', '!=', $donor->id)
            ->first();

        if ($duplicate) {
            return back()->withErrors(['duplicate' => 'A donor with this name and address already exists.'])
                        ->withInput();
        }

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($donor->profile_picture) {
                \Storage::disk('public')->delete($donor->profile_picture);
            }
            
            $profilePicture = $request->file('profile_picture');
            $filename = time() . '_' . $profilePicture->getClientOriginalName();
            $path = $profilePicture->storeAs('profile-pictures', $filename, 'public');
            $validated['profile_picture'] = $path;
        }

        $original = $donor->only(array_keys($validated));
        $donor->update($validated);
        $changes = [
            'description' => "Donor '{$donor->name}' was updated",
            'old' => $original,
            'new' => $donor->only(array_keys($validated)),
        ];
        AuditLog::record('donor.updated', $request->user(), $donor, $changes);

        return redirect()->route('donors.show', $donor)
                        ->with('success', 'Donor updated successfully.');
    }

    public function destroy(User $donor)
    {
        // Ensure this is a donor
        if ($donor->role !== 'donor') {
            abort(404);
        }

        // Check if donor has any active collections
        if ($donor->collections()->where('status', 'active')->exists()) {
            return back()->withErrors(['delete' => 'Cannot delete donor with active collections.']);
        }

        $snapshot = $donor->only(['name','email','phone','address_line_1']);
        $donor->delete();
        AuditLog::record('donor.deleted', $request->user(), $donor, [
            'description' => "Donor '{$snapshot['name']}' was deleted",
            'old' => $snapshot
        ]);

        return redirect()->route('donors.index')
                        ->with('success', 'Donor deleted successfully.');
    }

    public function blocked(Request $request)
    {
        $query = User::donors()->whereNotIn('status', ['active']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('postal_code', 'like', "%{$search}%");
            });
        }

        // Filter by donor type
        if ($request->filled('donor_type')) {
            $query->where('donor_type', $request->donor_type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $donors = $query->orderBy('name')->paginate(20);

        return view('donors.blocked', compact('donors'));
    }

    public function updateStatus(Request $request, User $donor)
    {
        // Ensure this is a donor
        if ($donor->role !== 'donor') {
            abort(404);
        }

        $validated = $request->validate([
            'status' => ['required', Rule::in(['active', 'inactive', 'blocked', 'deceased'])],
        ]);

        $oldStatus = $donor->status;
        $donor->update($validated);

        // Record audit log
        AuditLog::record('donor.status_updated', $request->user(), $donor, [
            'description' => "Donor '{$donor->name}' status changed from '{$oldStatus}' to '{$validated['status']}'",
            'old' => ['status' => $oldStatus],
            'new' => ['status' => $validated['status']]
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Donor status updated successfully.',
                'new_status' => $validated['status']
            ]);
        }

        return back()->with('success', 'Donor status updated successfully.');
    }

    public function auditLogs(User $donor)
    {
        // Ensure this is a donor
        if ($donor->role !== 'donor') {
            abort(404);
        }

        $logs = AuditLog::where('model_type', User::class)
            ->where('model_id', $donor->id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'logs' => $logs
        ]);
    }

    public function uploadAvatar(Request $request, User $donor)
    {
        // Ensure this is a donor
        if ($donor->role !== 'donor') {
            return response()->json(['success' => false, 'message' => 'Invalid donor'], 404);
        }

        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            // Delete old profile picture if exists
            if ($donor->profile_picture) {
                \Storage::disk('public')->delete($donor->profile_picture);
            }

            // Upload new profile picture
            $profilePicture = $request->file('profile_picture');
            $filename = 'donor_' . $donor->id . '_' . time() . '.' . $profilePicture->getClientOriginalExtension();
            $path = $profilePicture->storeAs('profile-pictures', $filename, 'public');

            // Update donor record
            $donor->update(['profile_picture' => $path]);

            // Record audit log
            AuditLog::record('donor.avatar_updated', $request->user(), $donor, [
                'description' => "Profile picture updated for donor '{$donor->name}'",
                'new' => ['profile_picture' => $path]
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Profile picture updated successfully',
                'avatar_url' => \Storage::url($path),
                'donor_name' => $donor->name
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error uploading image: ' . $e->getMessage()
            ], 500);
        }
    }
}
