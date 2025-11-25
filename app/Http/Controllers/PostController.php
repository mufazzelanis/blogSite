<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'user'])->latest()->get();

        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create', [
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'content' => 'required',
        ]);

        $post = Post::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
        ]);

        $post->tags()->sync($request->tags);

        return redirect()->route('posts.index');
    }
}
