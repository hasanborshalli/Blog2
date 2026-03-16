<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoPostSeeder extends Seeder
{
    public function run(): void
    {
        $authors = User::where('role', 'author')->get();
        $admin = User::where('role', 'admin')->first();
        $categories = Category::all();
        $tags = Tag::all();

        if ($authors->isEmpty() || $categories->isEmpty() || $tags->isEmpty() || !$admin) {
            return;
        }

        $publishedTitles = [
            'How Laravel Makes Blog Platforms Easier to Scale',
            '10 Practical Content Marketing Ideas for Small Brands',
            'Why Community Blogs Build Better Audience Trust',
            'The Essentials of Writing Better Long-Form Articles',
            'Modern Website Content Strategy for Local Businesses',
            'How to Build an Editorial Workflow That Actually Works',
            'Why SEO Structure Matters More Than Most Teams Think',
            'Creating Content That Feels Human and Professional',
            'How Brand Voice Improves Publishing Consistency',
            'Designing Better Author Profiles for Trust and Credibility',
            'Simple Productivity Habits for Writers and Editors',
            'What Makes a Multi-Author Platform Feel Premium',
        ];

        foreach ($publishedTitles as $index => $title) {
            $author = $authors[$index % $authors->count()];
            $category = $categories[$index % $categories->count()];
            $slug = Str::slug($title);

            $post = Post::updateOrCreate(
                ['slug' => $slug],
                [
                    'user_id' => $author->id,
                    'category_id' => $category->id,
                    'approved_by' => $admin->id,
                    'title' => $title,
                    'excerpt' => 'This is a demo excerpt for the article titled "' . $title . '".',
                    'content' => $this->demoContent($title),
                    'status' => 'published',
                    'published_at' => now()->subDays(rand(1, 40)),
                    'approved_at' => now()->subDays(rand(1, 40)),
                    'meta_title' => $title,
                    'meta_description' => 'Read this article about ' . Str::lower($title) . '.',
                    'views_count' => rand(40, 800),
                ]
            );

            $post->tags()->sync($tags->random(rand(2, 4))->pluck('id')->toArray());
        }

        $pendingTitles = [
            'Pending Post About Brand Storytelling',
            'Pending Guide to Writing Stronger Headlines',
            'Pending Article on Better Blog Structure',
            'Pending Thoughts on Editorial Planning',
        ];

        foreach ($pendingTitles as $index => $title) {
            $author = $authors[$index % $authors->count()];
            $category = $categories[$index % $categories->count()];
            $slug = Str::slug($title);

            $post = Post::updateOrCreate(
                ['slug' => $slug],
                [
                    'user_id' => $author->id,
                    'category_id' => $category->id,
                    'approved_by' => null,
                    'title' => $title,
                    'excerpt' => 'This is a pending demo article.',
                    'content' => $this->demoContent($title),
                    'status' => 'pending',
                    'published_at' => null,
                    'approved_at' => null,
                    'meta_title' => $title,
                    'meta_description' => 'Pending article for moderation workflow testing.',
                    'views_count' => rand(0, 20),
                ]
            );

            $post->tags()->sync($tags->random(rand(2, 4))->pluck('id')->toArray());
        }

        $draftTitles = [
            'Draft Article About Editorial Operations',
            'Draft Piece on Author Branding',
            'Draft Post for Community Growth',
        ];

        foreach ($draftTitles as $index => $title) {
            $author = $authors[$index % $authors->count()];
            $category = $categories[$index % $categories->count()];
            $slug = Str::slug($title);

            $post = Post::updateOrCreate(
                ['slug' => $slug],
                [
                    'user_id' => $author->id,
                    'category_id' => $category->id,
                    'approved_by' => null,
                    'title' => $title,
                    'excerpt' => 'This is a draft demo article.',
                    'content' => $this->demoContent($title),
                    'status' => 'draft',
                    'published_at' => null,
                    'approved_at' => null,
                    'meta_title' => $title,
                    'meta_description' => 'Draft article for author dashboard testing.',
                    'views_count' => 0,
                ]
            );

            $post->tags()->sync($tags->random(rand(1, 3))->pluck('id')->toArray());
        }
    }

    private function demoContent(string $title): string
    {
        return "## {$title}\n\n"
            . "This is demo content generated for the Blog Template #2 seed data.\n\n"
            . "The purpose of this article is to help the template look complete immediately after installation.\n\n"
            . "It demonstrates how published articles appear on the homepage, category pages, author pages, and single post pages.\n\n"
            . "You can replace this content with real client content later, but for demo purposes it gives the platform a polished starting point.\n\n"
            . "A good sellable template should always feel alive on first install, and demo content helps communicate that value clearly.";
    }
}