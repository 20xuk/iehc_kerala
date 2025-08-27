<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $themes = [
            [
                'name' => 'Default',
                'slug' => 'default',
                'description' => 'Default theme with blue and orange accents',
                'colors' => [
                    'primary' => '#3b82f6',
                    'primary_dark' => '#1d4ed8',
                    'primary_light' => '#60a5fa',
                    'secondary' => '#f59e0b',
                    'secondary_dark' => '#d97706',
                    'secondary_light' => '#fbbf24',
                    'accent' => '#f59e0b',
                    'accent_dark' => '#d97706',
                    'accent_light' => '#fbbf24',
                    'background' => '#ffffff',
                    'surface' => '#f8fafc',
                    'text_primary' => '#1e293b',
                    'text_secondary' => '#64748b',
                    'border' => '#e2e8f0',
                    'success' => '#10b981',
                    'warning' => '#f59e0b',
                    'error' => '#ef4444',
                    'info' => '#3b82f6',
                ],
                'is_active' => true,
                'is_default' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Blue',
                'slug' => 'blue',
                'description' => 'Professional blue theme',
                'colors' => [
                    'primary' => '#2563eb',
                    'primary_dark' => '#1d4ed8',
                    'primary_light' => '#3b82f6',
                    'secondary' => '#0891b2',
                    'secondary_dark' => '#0e7490',
                    'secondary_light' => '#06b6d4',
                    'accent' => '#0891b2',
                    'accent_dark' => '#0e7490',
                    'accent_light' => '#06b6d4',
                    'background' => '#ffffff',
                    'surface' => '#f0f9ff',
                    'text_primary' => '#1e293b',
                    'text_secondary' => '#64748b',
                    'border' => '#e2e8f0',
                    'success' => '#10b981',
                    'warning' => '#f59e0b',
                    'error' => '#ef4444',
                    'info' => '#2563eb',
                ],
                'is_active' => false,
                'is_default' => false,
                'sort_order' => 2
            ],
            [
                'name' => 'Green',
                'slug' => 'green',
                'description' => 'Fresh green theme',
                'colors' => [
                    'primary' => '#059669',
                    'primary_dark' => '#047857',
                    'primary_light' => '#10b981',
                    'secondary' => '#16a34a',
                    'secondary_dark' => '#15803d',
                    'secondary_light' => '#22c55e',
                    'accent' => '#16a34a',
                    'accent_dark' => '#15803d',
                    'accent_light' => '#22c55e',
                    'background' => '#ffffff',
                    'surface' => '#f0fdf4',
                    'text_primary' => '#1e293b',
                    'text_secondary' => '#64748b',
                    'border' => '#e2e8f0',
                    'success' => '#059669',
                    'warning' => '#f59e0b',
                    'error' => '#ef4444',
                    'info' => '#2563eb',
                ],
                'is_active' => false,
                'is_default' => false,
                'sort_order' => 3
            ],
            [
                'name' => 'Purple',
                'slug' => 'purple',
                'description' => 'Elegant purple theme',
                'colors' => [
                    'primary' => '#7c3aed',
                    'primary_dark' => '#6d28d9',
                    'primary_light' => '#8b5cf6',
                    'secondary' => '#a855f7',
                    'secondary_dark' => '#9333ea',
                    'secondary_light' => '#c084fc',
                    'accent' => '#a855f7',
                    'accent_dark' => '#9333ea',
                    'accent_light' => '#c084fc',
                    'background' => '#ffffff',
                    'surface' => '#faf5ff',
                    'text_primary' => '#1e293b',
                    'text_secondary' => '#64748b',
                    'border' => '#e2e8f0',
                    'success' => '#10b981',
                    'warning' => '#f59e0b',
                    'error' => '#ef4444',
                    'info' => '#7c3aed',
                ],
                'is_active' => false,
                'is_default' => false,
                'sort_order' => 4
            ],
            [
                'name' => 'Orange',
                'slug' => 'orange',
                'description' => 'Warm orange theme',
                'colors' => [
                    'primary' => '#ea580c',
                    'primary_dark' => '#c2410c',
                    'primary_light' => '#fb923c',
                    'secondary' => '#f59e0b',
                    'secondary_dark' => '#d97706',
                    'secondary_light' => '#fbbf24',
                    'accent' => '#f59e0b',
                    'accent_dark' => '#d97706',
                    'accent_light' => '#fbbf24',
                    'background' => '#ffffff',
                    'surface' => '#fff7ed',
                    'text_primary' => '#1e293b',
                    'text_secondary' => '#64748b',
                    'border' => '#e2e8f0',
                    'success' => '#10b981',
                    'warning' => '#ea580c',
                    'error' => '#ef4444',
                    'info' => '#2563eb',
                ],
                'is_active' => false,
                'is_default' => false,
                'sort_order' => 5
            ],
            [
                'name' => 'Dark',
                'slug' => 'dark',
                'description' => 'Modern dark theme',
                'colors' => [
                    'primary' => '#3b82f6',
                    'primary_dark' => '#1d4ed8',
                    'primary_light' => '#60a5fa',
                    'secondary' => '#f59e0b',
                    'secondary_dark' => '#d97706',
                    'secondary_light' => '#fbbf24',
                    'accent' => '#f59e0b',
                    'accent_dark' => '#d97706',
                    'accent_light' => '#fbbf24',
                    'background' => '#0f172a',
                    'surface' => '#1e293b',
                    'text_primary' => '#f8fafc',
                    'text_secondary' => '#cbd5e1',
                    'border' => '#334155',
                    'success' => '#10b981',
                    'warning' => '#f59e0b',
                    'error' => '#ef4444',
                    'info' => '#3b82f6',
                ],
                'is_active' => false,
                'is_default' => false,
                'sort_order' => 6
            ],
        ];

        foreach ($themes as $theme) {
            Theme::updateOrCreate(
                ['slug' => $theme['slug']],
                $theme
            );
        }
    }
}
