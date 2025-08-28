<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'colors',
        'is_active',
        'is_default',
        'sort_order'
    ];

    protected $casts = [
        'colors' => 'array',
        'is_active' => 'boolean',
        'is_default' => 'boolean',
    ];

    /**
     * Get the current active theme
     */
    public static function getActiveTheme()
    {
        return static::where('is_active', true)->first() ?? static::getDefaultTheme();
    }

    /**
     * Get the default theme
     */
    public static function getDefaultTheme()
    {
        return static::where('is_default', true)->first() ?? static::first();
    }

    /**
     * Get theme by slug
     */
    public static function getBySlug($slug)
    {
        return static::where('slug', $slug)->first();
    }

    /**
     * Set theme as active
     */
    public function setActive()
    {
        // Deactivate all other themes
        static::where('is_active', true)->update(['is_active' => false]);
        
        // Activate this theme
        $this->update(['is_active' => true]);
    }

    /**
     * Get CSS variables for the theme
     */
    public function getCssVariables()
    {
        $colors = $this->colors ?? [];
        $primaryHex = $colors['primary'] ?? '#3b82f6';
        $primaryRgb = $this->hexToRgbString($primaryHex);
        
        return [
            '--primary-color' => $primaryHex,
            '--primary-rgb' => $primaryRgb,
            '--primary-dark' => $colors['primary_dark'] ?? '#1d4ed8',
            '--primary-light' => $colors['primary_light'] ?? '#60a5fa',
            '--secondary-color' => $colors['secondary'] ?? '#64748b',
            '--secondary-dark' => $colors['secondary_dark'] ?? '#475569',
            '--secondary-light' => $colors['secondary_light'] ?? '#94a3b8',
            '--accent-color' => $colors['accent'] ?? '#f59e0b',
            '--accent-dark' => $colors['accent_dark'] ?? '#d97706',
            '--accent-light' => $colors['accent_light'] ?? '#fbbf24',
            '--background-color' => $colors['background'] ?? '#ffffff',
            '--surface-color' => $colors['surface'] ?? '#f8fafc',
            '--text-primary' => $colors['text_primary'] ?? '#1e293b',
            '--text-secondary' => $colors['text_secondary'] ?? '#64748b',
            '--border-color' => $colors['border'] ?? '#e2e8f0',
            '--success-color' => $colors['success'] ?? '#10b981',
            '--success-dark' => $colors['success_dark'] ?? '#059669',
            '--success-light' => $colors['success_light'] ?? '#34d399',
            '--warning-color' => $colors['warning'] ?? '#f59e0b',
            '--warning-dark' => $colors['warning_dark'] ?? '#d97706',
            '--warning-light' => $colors['warning_light'] ?? '#fbbf24',
            '--error-color' => $colors['error'] ?? '#ef4444',
            '--error-dark' => $colors['error_dark'] ?? '#dc2626',
            '--error-light' => $colors['error_light'] ?? '#f87171',
            '--info-color' => $colors['info'] ?? '#3b82f6',
            '--info-dark' => $colors['info_dark'] ?? '#1d4ed8',
            '--info-light' => $colors['info_light'] ?? '#60a5fa',
        ];
    }

    /**
     * Convert a hex color (e.g. #3b82f6) to an RGB string "59, 130, 246".
     */
    private function hexToRgbString(string $hex): string
    {
        $hex = ltrim($hex, '#');
        if (strlen($hex) === 3) {
            $hex = preg_replace('/(.)/u', '$1$1', $hex);
        }
        $parts = sscanf('#' . $hex, '#%02x%02x%02x');
        if (!$parts || count($parts) !== 3) {
            return '59, 130, 246'; // fallback to Tailwind blue-500
        }
        return implode(', ', $parts);
    }

    /**
     * Generate CSS for the theme
     */
    public function generateCss()
    {
        $variables = $this->getCssVariables();
        $css = ":root {\n";
        
        foreach ($variables as $variable => $value) {
            $css .= "    {$variable}: {$value};\n";
        }
        
        $css .= "}\n\n";
        
        // Add theme-specific styles
        $css .= $this->getThemeSpecificCss();
        
        return $css;
    }

    /**
     * Get theme-specific CSS
     */
    protected function getThemeSpecificCss()
    {
        $colors = $this->colors ?? [];
        
        return "
/* Theme: {$this->name} */
.bg-primary { background-color: var(--primary-color) !important; }
.bg-primary-dark { background-color: var(--primary-dark) !important; }
.bg-primary-light { background-color: var(--primary-light) !important; }
.bg-secondary { background-color: var(--secondary-color) !important; }
.bg-accent { background-color: var(--accent-color) !important; }
.bg-success { background-color: var(--success-color) !important; }
.bg-success-dark { background-color: var(--success-dark) !important; }
.bg-success-light { background-color: var(--success-light) !important; }
.bg-error { background-color: var(--error-color) !important; }
.bg-error-dark { background-color: var(--error-dark) !important; }
.bg-error-light { background-color: var(--error-light) !important; }

.text-primary { color: var(--primary-color) !important; }
.text-primary-dark { color: var(--primary-dark) !important; }
.text-primary-light { color: var(--primary-light) !important; }
.text-secondary { color: var(--secondary-color) !important; }
.text-accent { color: var(--accent-color) !important; }
.text-accent-dark { color: var(--accent-dark) !important; }
.text-accent-light { color: var(--accent-light) !important; }
.text-success { color: var(--success-color) !important; }
.text-success-dark { color: var(--success-dark) !important; }
.text-success-light { color: var(--success-light) !important; }
.text-error { color: var(--error-color) !important; }
.text-error-dark { color: var(--error-dark) !important; }
.text-error-light { color: var(--error-light) !important; }

.border-primary { border-color: var(--primary-color) !important; }
.border-secondary { border-color: var(--secondary-color) !important; }
.border-accent { border-color: var(--accent-color) !important; }

.btn-primary {
    background-color: var(--primary-color) !important;
    border-color: var(--primary-color) !important;
}

.btn-primary:hover {
    background-color: var(--primary-dark) !important;
    border-color: var(--primary-dark) !important;
}

.btn-secondary {
    background-color: var(--secondary-color) !important;
    border-color: var(--secondary-color) !important;
}

.btn-accent {
    background-color: var(--accent-color) !important;
    border-color: var(--accent-color) !important;
}

.focus\\:ring-primary:focus {
    --tw-ring-color: var(--primary-color) !important;
}

.focus\\:border-primary:focus {
    border-color: var(--primary-color) !important;
}

/* Gradient backgrounds */
.from-primary { --tw-gradient-from: var(--primary-color) !important; }
.to-primary-dark { --tw-gradient-to: var(--primary-dark) !important; }
        ";
    }
}
