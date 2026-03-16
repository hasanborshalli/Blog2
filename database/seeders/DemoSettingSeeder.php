<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class DemoSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'Community Blog',
            'site_tagline' => 'A modern multi-author publishing platform built with Laravel.',
            'contact_email' => 'hello@communityblog.com',
            'posts_per_page' => '9',
            'seo_meta_title' => 'Community Blog',
            'seo_meta_description' => 'A reusable Laravel Blade community blog template for creators, brands, and publishers.',
            'footer_text' => 'Built for creators, publishers, and modern brands.',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}