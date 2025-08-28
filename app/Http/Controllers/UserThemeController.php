<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\UserThemePreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserThemeController extends Controller
{
    /**
     * Get user's current theme preference
     */
    public function getCurrentTheme()
    {
        $user = Auth::user();
        $preference = UserThemePreference::getForUser($user);
        $effectiveTheme = UserThemePreference::getEffectiveTheme($user);
        $effectiveColors = UserThemePreference::getEffectiveColors($user);

        return response()->json([
            'success' => true,
            'preference' => $preference,
            'effective_theme' => $effectiveTheme,
            'effective_colors' => $effectiveColors,
            'css_variables' => $effectiveTheme ? $effectiveTheme->getCssVariables() : []
        ]);
    }

    /**
     * Update user's theme preference
     */
    public function updateTheme(Request $request)
    {
        $request->validate([
            'theme_slug' => 'nullable|string|exists:themes,slug',
            'use_system_theme' => 'boolean',
            'custom_colors' => 'nullable|array',
            'custom_colors.primary' => 'nullable|string|regex:/^#[0-9A-F]{6}$/i',
            'custom_colors.secondary' => 'nullable|string|regex:/^#[0-9A-F]{6}$/i',
            'custom_colors.accent' => 'nullable|string|regex:/^#[0-9A-F]{6}$/i',
            'custom_colors.background' => 'nullable|string|regex:/^#[0-9A-F]{6}$/i',
        ]);

        $user = Auth::user();
        $data = $request->only(['theme_slug', 'use_system_theme', 'custom_colors']);
        
        $preference = UserThemePreference::updateForUser($user, $data);
        $effectiveTheme = UserThemePreference::getEffectiveTheme($user);
        $effectiveColors = UserThemePreference::getEffectiveColors($user);

        // Clear user-specific cache
        Cache::forget("user_theme_{$user->id}");

        return response()->json([
            'success' => true,
            'message' => 'Theme preference updated successfully',
            'preference' => $preference,
            'effective_theme' => $effectiveTheme,
            'effective_colors' => $effectiveColors,
            'css_variables' => $effectiveTheme ? $effectiveTheme->getCssVariables() : []
        ]);
    }

    /**
     * Reset user to system theme
     */
    public function resetToSystemTheme()
    {
        $user = Auth::user();
        $preference = UserThemePreference::resetToSystemTheme($user);
        $effectiveTheme = UserThemePreference::getEffectiveTheme($user);

        // Clear user-specific cache
        Cache::forget("user_theme_{$user->id}");

        return response()->json([
            'success' => true,
            'message' => 'Theme reset to system default',
            'preference' => $preference,
            'effective_theme' => $effectiveTheme,
            'css_variables' => $effectiveTheme ? $effectiveTheme->getCssVariables() : []
        ]);
    }

    /**
     * Get available themes for user selection
     */
    public function getAvailableThemes()
    {
        $themes = Theme::orderBy('sort_order')->get();
        $user = Auth::user();
        $currentPreference = UserThemePreference::getForUser($user);

        return response()->json([
            'success' => true,
            'themes' => $themes,
            'current_preference' => $currentPreference
        ]);
    }

    /**
     * Preview a theme for the user
     */
    public function previewTheme(Request $request)
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
     * Get user's theme CSS
     */
    public function getUserCss()
    {
        $user = Auth::user();
        
        $css = Cache::remember("user_theme_{$user->id}", 3600, function () use ($user) {
            $effectiveTheme = UserThemePreference::getEffectiveTheme($user);
            $effectiveColors = UserThemePreference::getEffectiveColors($user);
            
            if (!$effectiveTheme) {
                return '/* No theme found */';
            }
            
            return $effectiveTheme->generateCss();
        });

        return response($css, 200, ['Content-Type' => 'text/css']);
    }
}
