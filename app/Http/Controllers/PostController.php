<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Storage;

//use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //    public function index()
    //    {
    //        return inertia('Posts/Index', [
    //            'posts' => PostResource::collection(Post::with('user')
    //                ->where('published_at', '<=', Carbon::now())
    //                ->latest()
    //                ->latest('id')
    //                ->paginate()),
    //        ]);
    //    }
    public function index(?Category $category = null)
    {
        $posts = Post::with(['user', 'category'])
            ->when($category, fn (Builder $query) => $query->whereBelongsTo($category))
            ->latest()
            ->latest('id')
            ->paginate();

        return inertia('Posts/Index', [
            'posts' => PostResource::collection($posts),
            'selectedCategory' => fn () => $category ? CategoryResource::make($category) : null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'title' => ['required', 'string', 'min:10', 'max:120'],
            'body' => ['required', 'string', 'min:100', 'max:10000'],
            'image' => ['nullable', 'image', 'max:2048'],
            'published_at' => ['nullable', 'date'],
            'featured' => ['boolean'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = Storage::disk('public')->put('/posts', $request->image);
        }

        $post = Post::create([
            ...$data,
            'user_id' => $request->user()->id,
        ]);

        return redirect($post->showRoute());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Post $post)
    {
        Gate::authorize('create', $post);

        return inertia('Posts/Create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Post $post)
    {
        if (! Str::contains($post->showRoute(), $request->path())) {
            return redirect($post->showRoute($request->query()), status: 301);
        }

        $post->load(['user', 'category']);

        return Inertia('Posts/Show', [
            'post' => fn () => PostResource::make($post),
            'comments' => fn () => CommentResource::collection($post->comments()
                ->with('user')
                ->latest()
                ->latest('id')
                ->paginate(10)),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
