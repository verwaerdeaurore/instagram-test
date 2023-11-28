<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{

    public function  store(PostStoreRequest $request)
    {
        $post = Post::make();
        $post->txt = $request->validated()['txt'];
        $post->published_at = now();
        $post->user_id = Auth::id();
        $post->save();
        if ($request->hasFile('img_path')) {
            $path = $request->file('img_path')->store('images', 'public');
            $post->img_path = $path;
            $post->save();
        }

        return redirect()->route('posts.index');
    }
    // public function index(Request $request)
    // {

    //     $posts = Post::where('published_at', '<', now())
    //         ->where('txt', 'LIKE', '%' . $request->query('search') . '%')
    //         ->orWhereHas('user', function ($query) use ($request) {
    //             $query->where('name', 'LIKE', '%' . $request->query('search') . '%');
    //         })
    //         ->orderByDesc('published_at')
    //         ->paginate(12);

    //     return view('posts.index', [
    //         'posts' => $posts, // Utiliser le pluriel ici
    //     ]);
    // }
    public function index(Request $request)
    {
        // Récupérer les ID des utilisateurs suivis
        $followingIds = auth()->user()->followings()->pluck('following_id')->toArray();


        // Requête pour les posts des utilisateurs suivis
        $postsFromFollowing = Post::whereIn('user_id', $followingIds)
            ->where('created_at', '<', now())
            ->where(function ($query) use ($request) {
                $query->where('txt', 'LIKE', '%' . $request->query('search') . '%')
                    ->orWhereHas('user', function ($subQuery) use ($request) {
                        $subQuery->where('name', 'LIKE', '%' . $request->query('search') . '%');
                    });
            })
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->orderByDesc('created_at');

        // Requête pour les autres posts
        $otherPosts = Post::whereNotIn('user_id', $followingIds)
            ->where('created_at', '<', now())
            ->where(function ($query) use ($request) {
                $query->where('txt', 'LIKE', '%' . $request->query('search') . '%')
                    ->orWhereHas('user', function ($subQuery) use ($request) {
                        $subQuery->where('name', 'LIKE', '%' . $request->query('search') . '%');
                    });
            })
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->orderByDesc('created_at');
        // Combiner les deux requêtes
        $posts = $postsFromFollowing->union($otherPosts)->paginate(12);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        $comment = $post
            ->comments()
            ->with('user')
            ->orderBy('created_at')
            ->get();
        return view('posts.show', [
            'post' => $post,
            'comment' => $comment,
        ]);
    }
    public function create()
    {
        return view('posts.create');
    }
    public function addComment(Request $request, Post $post)
    {
        // On vérifie que l'utilisateur est authentifié
        $request->validate([
            'body' => 'required|string|max:500',
        ]);

        $comment = $post->comments()->make();
        $comment->comment = $request->input('body');
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return redirect()->back();
    }

    public function likePost($postId)
    {
        $user = auth()->user();
        $like = Like::where('user_id', $user->id)->where('post_id', $postId)->first();

        if (!$like) {
            Like::create([
                'user_id' => $user->id,
                'post_id' => $postId,
            ]);
        } else {
            $like->delete();
        }

        return redirect()->back();
    }
}
