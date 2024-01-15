<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(500)->create();
        \App\Models\Page::factory(2)->create();
        \App\Models\Post::factory(2)->create();
        \App\Models\Category::factory(2)->create();
        \App\Models\Facility::factory(2)->create();
        \App\Models\Contact::factory(2)->create();
        \App\Models\Outdoor::factory(2)->create();
        \App\Models\Currency::factory(2)->create();
        // \App\Models\UserPurchasedPackage::factory(2)->create();
        // \App\Models\Property::factory(20)->create();
    }
}
