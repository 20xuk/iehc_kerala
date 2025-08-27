<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ThemeController extends Controller
{
    /**
     * Display the theme management page
     */
    public function index()
    {
        $themes = Theme::orderBy('sort_order')->get();
        $activeTheme = Theme::getActiveTheme();
        
        return view('admin.themes.index', compact('themes', 'activeTheme'));
    }

    /**
     * Show theme management modal
     */
    public function showModal()
    {
        $themes = Theme::orderBy('sort_order')->get();
        $activeTheme = Theme::getActiveTheme();
        
        return view('admin.themes.modal', compact('themes', 'activeTheme'));
    }

    /**
     * Apply a theme
     */
    public function apply(Request $request)
    {
        $request->validate([
            'theme_slug' => 'required|string|exists:themes,slug'
        ]);

        $theme = Theme::getBySlug($request->theme_slug);
        
        if (!$theme) {
            return response()->json([
                'success' => false,
                'message' => 'Theme not found'
            ], 404);
        }

        // Set theme as active
        $theme->setActive();

        // Clear cache
        Cache::forget('active_theme');
        Cache::forget('theme_css');

        // Generate and cache CSS
        $this->generateThemeCss($theme);

        return response()->json([
            'success' => true,
            'message' => "Theme '{$theme->name}' applied successfully",
            'theme' => $theme,
            'css_variables' => $theme->getCssVariables()
        ]);
    }

    /**
     * Preview a theme
     */
    public function preview(Request $request)
    {
        $request->validate([
            'theme_slug' => 'required|string|exists:themes,slug'
        ]);

        $theme = Theme::getBySlug($request->theme_slug);
        
        if (!$theme) {
            return response()->json([
                'success' => false,
                'message' => 'Theme not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'theme' => $theme,
            'css_variables' => $theme->getCssVariables(),
            'preview_css' => $theme->generateCss()
        ]);
    }

    /**
     * Reset to default theme
     */
    public function resetToDefault()
    {
        $defaultTheme = Theme::getDefaultTheme();
        
        if (!$defaultTheme) {
            return response()->json([
                'success' => false,
                'message' => 'Default theme not found'
            ], 404);
        }

        $defaultTheme->setActive();

        // Clear cache
        Cache::forget('active_theme');
        Cache::forget('theme_css');

        // Generate and cache CSS
        $this->generateThemeCss($defaultTheme);

        return response()->json([
            'success' => true,
            'message' => 'Theme reset to default successfully',
            'theme' => $defaultTheme,
            'css_variables' => $defaultTheme->getCssVariables()
        ]);
    }

    /**
     * Get theme CSS
     */
    public function getCss()
    {
        $theme = Cache::remember('active_theme', 3600, function () {
            return Theme::getActiveTheme();
        });

        if (!$theme) {
            return response('/* No theme found */', 200, ['Content-Type' => 'text/css']);
        }

        $css = Cache::remember("theme_css_{$theme->id}", 3600, function () use ($theme) {
            return $theme->generateCss();
        });

        return response($css, 200, ['Content-Type' => 'text/css']);
    }

    /**
     * Update custom colors
     */
    public function updateCustomColors(Request $request)
    {
        $request->validate([
            'colors' => 'required|array',
            'colors.primary' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'colors.secondary' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'colors.accent' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'colors.background' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
        ]);

        // Create or update custom theme
        $customTheme = Theme::updateOrCreate(
            ['slug' => 'custom'],
            [
                'name' => 'Custom',
                'description' => 'Custom theme with user-defined colors',
                'colors' => $request->colors,
                'is_active' => false,
                'is_default' => false,
                'sort_order' => 999
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Custom colors updated successfully',
            'theme' => $customTheme
        ]);
    }

    /**
     * Generate and cache theme CSS
     */
    protected function generateThemeCss($theme)
    {
        $css = $theme->generateCss();
        
        // Store CSS in cache
        Cache::put("theme_css_{$theme->id}", $css, 3600);
        
        // Optionally save to file for better performance
        $cssPath = "themes/theme-{$theme->id}.css";
        Storage::disk('public')->put($cssPath, $css);
        
        return $css;
    }

    /**
     * Get all themes for API
     */
    public function getThemes()
    {
        $themes = Theme::orderBy('sort_order')->get();
        $activeTheme = Theme::getActiveTheme();

        return response()->json([
            'success' => true,
            'themes' => $themes,
            'active_theme' => $activeTheme
        ]);
    }
}
