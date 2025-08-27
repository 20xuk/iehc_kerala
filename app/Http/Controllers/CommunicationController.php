<?php

namespace App\Http\Controllers;

use App\Models\Communication;
use App\Models\Donor;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommunicationController extends Controller
{
    public function index()
    {
        $communications = Communication::with('createdBy')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('communications.index', compact('communications'));
    }

    public function create()
    {
        $donors = Donor::active()->named()->orderBy('name')->get();
        $collections = Collection::with('donor')
            ->where('status', 'active')
            ->orderBy('collection_date', 'desc')
            ->limit(100)
            ->get();

        return view('communications.create', compact('donors', 'collections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => ['required', Rule::in(['letter', 'receipt', 'newsletter'])],
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'delivery_method' => ['required', Rule::in(['email', 'whatsapp', 'print', 'post'])],
            'recipients' => 'nullable|array',
            'recipients.*' => 'exists:donors,id',
        ]);

        $validated['created_by'] = auth()->id();
        $validated['recipients'] = $validated['recipients'] ?? ['all'];

        Communication::create($validated);

        return redirect()->route('communications.index')
                        ->with('success', 'Communication created successfully.');
    }

    public function show(Communication $communication)
    {
        $communication->load('createdBy');
        
        return view('communications.show', compact('communication'));
    }

    public function edit(Communication $communication)
    {
        if ($communication->status === 'sent') {
            return back()->withErrors(['error' => 'Cannot edit sent communication.']);
        }

        $donors = Donor::active()->named()->orderBy('name')->get();
        $collections = Collection::with('donor')
            ->where('status', 'active')
            ->orderBy('collection_date', 'desc')
            ->limit(100)
            ->get();

        return view('communications.edit', compact('communication', 'donors', 'collections'));
    }

    public function update(Request $request, Communication $communication)
    {
        if ($communication->status === 'sent') {
            return back()->withErrors(['error' => 'Cannot edit sent communication.']);
        }

        $validated = $request->validate([
            'type' => ['required', Rule::in(['letter', 'receipt', 'newsletter'])],
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'delivery_method' => ['required', Rule::in(['email', 'whatsapp', 'print', 'post'])],
            'recipients' => 'nullable|array',
            'recipients.*' => 'exists:donors,id',
        ]);

        $validated['recipients'] = $validated['recipients'] ?? ['all'];

        $communication->update($validated);

        return redirect()->route('communications.show', $communication)
                        ->with('success', 'Communication updated successfully.');
    }

    public function destroy(Communication $communication)
    {
        if ($communication->status === 'sent') {
            return back()->withErrors(['error' => 'Cannot delete sent communication.']);
        }

        $communication->delete();

        return redirect()->route('communications.index')
                        ->with('success', 'Communication deleted successfully.');
    }

    public function send(Request $request, Communication $communication)
    {
        if ($communication->status === 'sent') {
            return back()->withErrors(['error' => 'Communication already sent.']);
        }

        try {
            $recipients = $this->getRecipients($communication);
            
            foreach ($recipients as $donor) {
                $this->sendToDonor($communication, $donor);
            }

            $communication->update([
                'status' => 'sent',
                'sent_at' => now(),
            ]);

            return back()->with('success', 'Communication sent successfully to ' . count($recipients) . ' recipients.');

        } catch (\Exception $e) {
            $communication->update(['status' => 'failed']);
            
            return back()->withErrors(['error' => 'Failed to send communication: ' . $e->getMessage()]);
        }
    }

    public function sendReceipt(Request $request, Collection $collection)
    {
        $validated = $request->validate([
            'delivery_method' => ['required', Rule::in(['email', 'whatsapp', 'print'])],
        ]);

        $communication = Communication::create([
            'type' => 'receipt',
            'subject' => 'Receipt for Collection #' . $collection->receipt_number,
            'content' => $this->generateReceiptContent($collection),
            'delivery_method' => $validated['delivery_method'],
            'recipients' => [$collection->donor_id],
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('communications.send', $communication)
                        ->with('success', 'Receipt communication created. Ready to send.');
    }

    public function preview(Communication $communication)
    {
        $communication->load('createdBy');
        
        return view('communications.preview', compact('communication'));
    }

    private function getRecipients(Communication $communication): array
    {
        if (in_array('all', $communication->recipients)) {
            return Donor::active()->named()->get()->toArray();
        }

        return Donor::whereIn('id', $communication->recipients)->get()->toArray();
    }

    private function sendToDonor(Communication $communication, $donor): void
    {
        switch ($communication->delivery_method) {
            case 'email':
                $this->sendEmail($communication, $donor);
                break;
            case 'whatsapp':
                $this->sendWhatsApp($communication, $donor);
                break;
            case 'print':
                $this->generatePrint($communication, $donor);
                break;
            case 'post':
                $this->generatePost($communication, $donor);
                break;
        }
    }

    private function sendEmail(Communication $communication, $donor): void
    {
        // Implementation for sending email
        // This would integrate with Laravel's mail system
    }

    private function sendWhatsApp(Communication $communication, $donor): void
    {
        // Implementation for sending WhatsApp message
        // This would integrate with WhatsApp Business API
    }

    private function generatePrint(Communication $communication, $donor): void
    {
        // Implementation for generating print-ready document
    }

    private function generatePost(Communication $communication, $donor): void
    {
        // Implementation for generating postal mail
    }

    private function generateReceiptContent(Collection $collection): string
    {
        $collection->load(['donor', 'payments']);
        
        $content = "Dear {$collection->donor->name},\n\n";
        $content .= "Thank you for your donation.\n\n";
        $content .= "Receipt Number: {$collection->receipt_number}\n";
        $content .= "Date: " . $collection->collection_date->format('d/m/Y') . "\n";
        $content .= "Amount: ₹" . number_format($collection->total_amount, 2) . "\n";
        $content .= "Donation Type: " . ucfirst(str_replace('_', ' ', $collection->donation_type)) . "\n\n";
        
        if ($collection->payments->count() > 1) {
            $content .= "Payment Breakdown:\n";
            foreach ($collection->payments as $payment) {
                $content .= "- " . ucfirst($payment->payment_mode) . ": ₹" . number_format($payment->amount, 2) . "\n";
            }
            $content .= "\n";
        }
        
        $content .= "Thank you for your support.\n";
        $content .= "God bless you.\n\n";
        $content .= "ICC Kerala";
        
        return $content;
    }
}
