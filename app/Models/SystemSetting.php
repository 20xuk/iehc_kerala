<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description',
        'options',
        'is_required',
        'sort_order'
    ];

    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean',
    ];

    /**
     * Get setting value by key
     */
    public static function getValue(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set setting value by key
     */
    public static function setValue(string $key, $value): bool
    {
        $setting = static::where('key', $key)->first();
        
        if ($setting) {
            $setting->update(['value' => $value]);
        } else {
            static::create([
                'key' => $key,
                'value' => $value,
                'label' => ucwords(str_replace('_', ' ', $key)),
                'type' => 'text',
                'group' => 'general'
            ]);
        }
        
        return true;
    }

    /**
     * Get settings by group
     */
    public static function getByGroup(string $group)
    {
        return static::where('group', $group)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Get all settings as key-value pairs
     */
    public static function getAllAsArray(): array
    {
        return static::pluck('value', 'key')->toArray();
    }
}
