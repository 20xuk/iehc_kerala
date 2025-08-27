<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BibleVerse extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'verse_text_en',
        'verse_text_ta',
        'language',
        'display_date',
        'display_frequency',
        'is_active',
    ];

    protected $casts = [
        'display_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByLanguage($query, $language)
    {
        return $query->whereIn('language', [$language, 'both']);
    }

    public function scopeForDate($query, $date = null)
    {
        $date = $date ?? now()->toDateString();
        return $query->where('display_date', $date);
    }

    public function getDisplayTextAttribute(): string
    {
        return match($this->language) {
            'ta' => $this->verse_text_ta,
            'both' => $this->verse_text_en . "\n\n" . $this->verse_text_ta,
            default => $this->verse_text_en
        };
    }

    public function getFormattedReferenceAttribute(): string
    {
        return "— {$this->reference}";
    }

    public static function getTodaysVerse($language = 'en'): ?self
    {
        return static::active()
            ->byLanguage($language)
            ->forDate()
            ->first();
    }

    public static function getRandomVerse($language = 'en'): ?self
    {
        return static::active()
            ->byLanguage($language)
            ->inRandomOrder()
            ->first();
    }
}
