<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category; // Add this line
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PostRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function index(): View
    {
        $posts = Post::get();

        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        $categories = Category::get();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(PostRequest $request): RedirectResponse
    {
        if ($request->validated()) {
            $banner = $request->file('banner')->store('assets/post', 'public');
            $slug = Str::slug($request->title, '-');
            Post::create($request->except('banner') + ['banner' => $banner, 'slug' => $slug]);
        }

        return redirect()->route('admin.posts.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show(Post $post): View
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post): View
    {
        $categories = Category::get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        if ($request->validated()) {
            $slug = Str::slug($request->title, '-');
            if ($request->banner) {
                File::delete('storage/' . $post->banner);
                $banner = $request->file('banner')->store('assets/post', 'public');
                $post->update($request->except('banner') + ['banner' => $banner, 'slug' => $slug]);
            } else {
                $post->update($request->validated() + ['slug' => $slug]);
            }
        }

        return redirect()->route('admin.posts.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Post $post): RedirectResponse
    {
        File::delete('storage/' . $post->banner);
        $post->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
