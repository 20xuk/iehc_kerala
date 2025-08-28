<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserThemePreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'theme_slug',
        'custom_colors',
        'use_system_theme'
    ];

    protected $casts = [
        'custom_colors' => 'array',
        'use_system_theme' => 'boolean',
    ];

    /**
     * Get the user that owns the theme preference
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the theme for this preference
     */
    public function theme()
    {
        return $this->belongsTo(Theme::class, 'theme_slug', 'slug');
    }

    /**
     * Get or create theme preference for a user
     */
    public static function getForUser(User $user)
    {
        return static::firstOrCreate(
            ['user_id' => $user->id],
            [
                'use_system_theme' => true,
                'theme_slug' => null,
                'custom_colors' => null
            ]
        );
    }

    /**
     * Get the effective theme for a user
     */
    public static function getEffectiveTheme(User $user)
    {
        $preference = static::getForUser($user);
        
        if ($preference->use_system_theme) {
            return Theme::getActiveTheme();
        }
        
        if ($preference->theme_slug) {
            return Theme::getBySlug($preference->theme_slug);
        }
        
        return Theme::getDefaultTheme();
    }

    /**
     * Get the effective colors for a user
     */
    public static function getEffectiveColors(User $user)
    {
        $preference = static::getForUser($user);
        
        if ($preference->use_system_theme) {
            $theme = Theme::getActiveTheme();
            return $theme ? $theme->colors : [];
        }
        
        if ($preference->custom_colors) {
            return $preference->custom_colors;
        }
        
        if ($preference->theme_slug) {
            $theme = Theme::getBySlug($preference->theme_slug);
            return $theme ? $theme->colors : [];
        }
        
        $defaultTheme = Theme::getDefaultTheme();
        return $defaultTheme ? $defaultTheme->colors : [];
    }

    /**
     * Update user theme preference
     */
    public static function updateForUser(User $user, array $data)
    {
        $preference = static::getForUser($user);

        // Enforce mutual exclusivity: system vs pre-built vs custom
        $updates = [];

        if (array_key_exists('use_system_theme', $data) && (bool)$data['use_system_theme'] === true) {
            $updates['use_system_theme'] = true;
            $updates['theme_slug'] = null;
            $updates['custom_colors'] = null;
        } elseif (!empty($data['theme_slug'])) {
            $updates['use_system_theme'] = false;
            $updates['theme_slug'] = $data['theme_slug'];
            $updates['custom_colors'] = null;
        } elseif (!empty($data['custom_colors']) && is_array($data['custom_colors'])) {
            $updates['use_system_theme'] = false;
            $updates['theme_slug'] = null;
            $updates['custom_colors'] = $data['custom_colors'];
        }

        // Apply updates only if something changed
        if (!empty($updates)) {
            $preference->update($updates);
        }

        return $preference->fresh();
    }

    /**
     * Reset user to system theme
     */
    public static function resetToSystemTheme(User $user)
    {
        $preference = static::getForUser($user);
        $preference->update([
            'use_system_theme' => true,
            'theme_slug' => null,
            'custom_colors' => null
        ]);
        return $preference;
    }
}
