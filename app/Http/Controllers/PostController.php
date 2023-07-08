<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->orderByDesc('created_at')->paginate(10);
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function show()
    {
        return redirect()->route('post.index');
    }

    public function store(PostStoreRequest $request)
    {
        $request->user()->posts()->create($request->validated());
        
        return redirect()->route('post.index')->with('status', 'post-added');

    }

    public function edit(Post $post)
    {
        $this->authorize('edit', $post);
        return view('post.edit', compact('post'));
    }

    public function update(PostUpdateRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->update($request->validated());
        return redirect()->route('post.index')->with('status', 'post-updated');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('post.index')->with('status', 'post-deleted');
    }
}