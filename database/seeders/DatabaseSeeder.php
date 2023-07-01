<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Post::create([
            'user_id'=>1,
            'title'=>'AI tools',
            'description'=>'You need to start using these tools',

         ]);
        
        
         Post::create([
            'user_id'=>2,
            'title'=>'New plugin',
            'description'=>'You should use this plugin',

         ]);

         Post::create([
            'user_id'=>2,
            'title'=>'Database management',
            'description'=>'Learn how to manage a database system',

         ]);

        Comment::create([
            'user_id'=>1,
            'post_id'=>2,
            'text'=> 'Amazing plugin'
        ]);

        Comment::create([
            'user_id'=>1,
            'post_id'=>3,
            'text'=> 'Very interesting post'
        ]);
    }
}
