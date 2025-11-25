<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // Show all posts with form
    public function index()
    {
        $posts = Post::with(['category', 'tags'])->latest()->paginate(8);

        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.index', compact('posts', 'categories', 'tags'));
    }

    // Store new post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'tags' => 'required|array',
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->content = $request->content;
        $post->user_id = auth()->id() ?? 1;
        $post->slug = Str::slug($request->title);
        $post->save();

        if ($request->tags) {
            $post->tags()->sync($request->tags); // attach selected tags
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');

    }
}
