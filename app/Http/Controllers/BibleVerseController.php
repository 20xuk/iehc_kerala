<?php

namespace App\Http\Controllers;

use App\Models\BibleVerse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BibleVerseController extends Controller
{
    public function index()
    {
        $verses = BibleVerse::orderBy('display_date', 'desc')
            ->paginate(20);

        return view('bible-verses.index', compact('verses'));
    }

    public function create()
    {
        return view('bible-verses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reference' => 'required|string|max:255',
            'verse_text_en' => 'required|string',
            'verse_text_ta' => 'nullable|string',
            'language' => ['required', Rule::in(['en', 'ta', 'both'])],
            'display_date' => 'nullable|date',
            'display_frequency' => ['required', Rule::in(['daily', 'weekly', 'monthly'])],
            'is_active' => 'boolean',
        ]);

        BibleVerse::create($validated);

        return redirect()->route('bible-verses.index')
                        ->with('success', 'Bible verse created successfully.');
    }

    public function show(BibleVerse $bibleVerse)
    {
        return view('bible-verses.show', compact('bibleVerse'));
    }

    public function edit(BibleVerse $bibleVerse)
    {
        return view('bible-verses.edit', compact('bibleVerse'));
    }

    public function update(Request $request, BibleVerse $bibleVerse)
    {
        $validated = $request->validate([
            'reference' => 'required|string|max:255',
            'verse_text_en' => 'required|string',
            'verse_text_ta' => 'nullable|string',
            'language' => ['required', Rule::in(['en', 'ta', 'both'])],
            'display_date' => 'nullable|date',
            'display_frequency' => ['required', Rule::in(['daily', 'weekly', 'monthly'])],
            'is_active' => 'boolean',
        ]);

        $bibleVerse->update($validated);

        return redirect()->route('bible-verses.show', $bibleVerse)
                        ->with('success', 'Bible verse updated successfully.');
    }

    public function destroy(BibleVerse $bibleVerse)
    {
        $bibleVerse->delete();

        return redirect()->route('bible-verses.index')
                        ->with('success', 'Bible verse deleted successfully.');
    }

    public function today(Request $request)
    {
        $language = $request->get('language', 'en');
        $verse = BibleVerse::getTodaysVerse($language);

        if (!$verse) {
            $verse = BibleVerse::getRandomVerse($language);
        }

        return view('bible-verses.today', compact('verse'));
    }

    public function apiToday(Request $request)
    {
        $language = $request->get('language', 'en');
        $verse = BibleVerse::getTodaysVerse($language);

        if (!$verse) {
            $verse = BibleVerse::getRandomVerse($language);
        }

        if (!$verse) {
            return response()->json(['error' => 'No Bible verse available'], 404);
        }

        return response()->json([
            'reference' => $verse->reference,
            'text' => $verse->display_text,
            'language' => $verse->language,
        ]);
    }

    public function random(Request $request)
    {
        $language = $request->get('language', 'en');
        $verse = BibleVerse::getRandomVerse($language);

        return view('bible-verses.random', compact('verse'));
    }

    public function schedule(Request $request)
    {
        $verses = BibleVerse::where('display_date', '>=', now()->toDateString())
            ->orderBy('display_date')
            ->paginate(20);

        return view('bible-verses.schedule', compact('verses'));
    }
}
