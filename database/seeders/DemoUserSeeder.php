<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@communityblog.com'],
            [
                'name' => 'Admin User',
                'username' => 'admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'status' => 'active',
                'bio' => 'Main administrator of the Community Blog platform.',
            ]
        );

        $authors = [
            [
                'name' => 'Hasan Writer',
                'username' => 'hasanwriter',
                'email' => 'hasan@example.com',
                'bio' => 'Writes about Laravel, startups, and digital products.',
            ],
            [
                'name' => 'Maya Content',
                'username' => 'mayacontent',
                'email' => 'maya@example.com',
                'bio' => 'Focused on branding, content strategy, and marketing.',
            ],
            [
                'name' => 'Omar Dev',
                'username' => 'omardev',
                'email' => 'omar@example.com',
                'bio' => 'Tech writer covering web development and product design.',
            ],
        ];

        foreach ($authors as $author) {
            User::updateOrCreate(
                ['email' => $author['email']],
                [
                    'name' => $author['name'],
                    'username' => $author['username'],
                    'password' => Hash::make('password123'),
                    'role' => 'author',
                    'status' => 'active',
                    'bio' => $author['bio'],
                ]
            );
        }
    }
}