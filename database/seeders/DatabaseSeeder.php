<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DemoUserSeeder::class,
            DemoCategorySeeder::class,
            DemoTagSeeder::class,
            DemoSettingSeeder::class,
            DemoPostSeeder::class,
            DemoCommentSeeder::class,
        ]);
    }
}