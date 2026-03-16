<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class DemoTagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['name' => 'Laravel', 'slug' => 'laravel'],
            ['name' => 'PHP', 'slug' => 'php'],
            ['name' => 'SEO', 'slug' => 'seo'],
            ['name' => 'Branding', 'slug' => 'branding'],
            ['name' => 'Content', 'slug' => 'content'],
            ['name' => 'Startups', 'slug' => 'startups'],
            ['name' => 'Design', 'slug' => 'design'],
            ['name' => 'Productivity', 'slug' => 'productivity'],
            ['name' => 'Web Development', 'slug' => 'web-development'],
            ['name' => 'Community', 'slug' => 'community'],
        ];

        foreach ($tags as $tag) {
            Tag::updateOrCreate(
                ['slug' => $tag['slug']],
                $tag
            );
        }
    }
}