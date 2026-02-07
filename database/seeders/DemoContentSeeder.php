<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(['email' => 'demo@forum.local'], [
            'name' => 'Demo User',
            'username' => 'demo',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $category = Category::firstOrCreate(['slug' => 'general'], ['name' => 'General', 'position' => 1]);

        Thread::firstOrCreate(['slug' => 'welcome-demo'], [
            'category_id' => $category->id,
            'user_id' => $user->id,
            'title' => 'Welcome to ForumOS',
            'body_markdown' => 'This is demo content.',
            'body_html' => '<p>This is demo content.</p>',
        ]);
    }
}
