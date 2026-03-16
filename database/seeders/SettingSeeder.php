<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $settings = [
        'site_name' => 'Community Blog',
        'site_tagline' => 'Share your ideas with the world',
        'contact_email' => 'info@example.com',
        'posts_per_page' => '9',
        'seo_meta_title' => 'Community Blog',
        'seo_meta_description' => 'A modern multi-author blog platform built with Laravel.',
        'footer_text' => '© Community Blog. All rights reserved.',
    ];

    foreach ($settings as $key => $value) {
        Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
    }
}