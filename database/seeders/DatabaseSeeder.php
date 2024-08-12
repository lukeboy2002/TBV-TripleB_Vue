<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        $posts = Post::factory(200)->recycle($users)->create();

        $posts = Post::factory(200)
            ->withFixture()
            ->has(Comment::factory(15)->recycle($users))
            ->recycle($users)
            ->create();

        //        $comments = Comment::factory(100)->recycle($users)->recycle($posts)->create();

        $admin = User::factory()
            ->has(Post::factory(45)->withFixture())
            ->has(Comment::factory(120)->recycle($posts))
            ->create([
                'username' => 'admin',
                'email' => 'admin@test.com',
                'email_verified_at' => now(),
                'password' => Hash::make('adminadmin'),
                'remember_token' => Str::random(10),
            ]);
    }
}
