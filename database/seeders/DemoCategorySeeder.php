<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DemoCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Articles about software, tools, and digital innovation.',
            ],
            [
                'name' => 'Marketing',
                'slug' => 'marketing',
                'description' => 'Growth, branding, content, and marketing strategy.',
            ],
            [
                'name' => 'Education',
                'slug' => 'education',
                'description' => 'Learning resources, teaching, and educational ideas.',
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Entrepreneurship, startups, and operations.',
            ],
            [
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
                'description' => 'Personal growth, productivity, and lifestyle topics.',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}