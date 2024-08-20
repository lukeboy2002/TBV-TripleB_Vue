<?php

use App\Http\Resources\CategoryResource;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;

use function Pest\Laravel\get;

it('can show a post', function () {
    $post = Post::factory()->create();

    get($post->showRoute())
        ->assertComponent('Posts/Show');
});

it('passes a post to the view', function () {
    $this->withoutExceptionHandling();
    $post = Post::factory()->has(Comment::factory(15))->create();

    $post->load('user', 'category');

    get($post->showRoute())
        ->assertHasResource('post', PostResource::make($post)->withLikePermission());
});

it('passes comments to the view', function () {
    $post = Post::factory()->create();
    $comments = Comment::factory(2)->for($post)->create();

    $comments->load('user');

    $expectedResource = CommentResource::collection($comments->reverse());
    $expectedResource->collection->transform(fn (CommentResource $resource) => $resource->withLikePermission());

    get($post->showRoute())
        ->assertHasPaginatedResource('comments', $expectedResource);

});

it('will redirect if the slug is incorrect', function (string $incorrectSlug) {
    $post = Post::factory()->create(['title' => 'Hello world']);

    get(route('posts.show', [$post, $incorrectSlug, 'page' => 2]))
        ->assertRedirect($post->showRoute(['page' => 2]));
})->with([
    'foo-bar',
    'hello',
]);

it('passes categories to the view', function () {
    $categories = Category::factory(3)->create();

    get(route('posts.index'))
        ->assertHasResource('categories', CategoryResource::collection($categories));
});
