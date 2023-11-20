<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(12);

        return view('posts.index', [
            'posts' => $posts, // Utiliser le pluriel ici
        ]);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', [
            'post' => $post,
        ]);
    }
    public function create()
    {
        return view('posts.create');
    }

    public function store(PostCreateRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('img_path') && $request->file('img_path')->isValid()) {
            $imgPath = $request->file('img_path')->store('images', 'public');
        } else {
            $imgPath = null;
        }

        $post = Post::make();
        $post->txt = $validatedData['txt'];
        $post->img_path = $imgPath;
        $post->save();

        return redirect()->route('posts.index');
    }
}
