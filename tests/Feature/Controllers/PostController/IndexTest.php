<?php

use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;

use function Pest\Laravel\get;

it('should return the correct component', function () {
    get(route('posts.index'))
        ->assertComponent('Posts/Index');
});

it('passes posts to the view', function () {
    $posts = Post::factory(3)->create();

    $posts->load(['user', 'category']);

    get(route('posts.index'))
        ->assertHasPaginatedResource('posts', PostResource::collection($posts->reverse()));
});

it('passes categories to the view', function () {
    $categories = Category::factory(3)->create();

    get(route('posts.index'))
        ->assertHasResource('categories', CategoryResource::collection($categories));
});

it('can filter by category', function () {
    $general = Category::factory()->create();
    $posts = Post::factory(2)->for($general)->create();
    $otherPosts = Post::factory(3)->create();

    $posts->load(['user', 'category']);

    get(route('posts.index', ['category' => $general]))
        ->assertHasPaginatedResource('posts', PostResource::collection($posts->reverse()));
});

it('it passes the selected to the view', function () {
    $category = Category::factory()->create();

    get(route('posts.index', ['category' => $category]))
        ->assertHasResource('selectedCategory', CategoryResource::make($category));
});
