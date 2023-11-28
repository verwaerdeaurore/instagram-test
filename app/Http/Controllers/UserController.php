<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function follow($userId)
    {
        $user = auth()->user();
        $isFollowing = Follow::where('follower_id', $user->id)->where('following_id', $userId)->exists();

        if (!$isFollowing) {
            // Si l'utilisateur ne suit pas encore, ajoutez le follow
            Follow::create([
                'follower_id' => $user->id,
                'following_id' => $userId,
            ]);
        } else {
            // Si l'utilisateur suit déjà, retirez le follow
            Follow::where('follower_id', $user->id)->where('following_id', $userId)->delete();
        }

        // Charger la relation pour mettre à jour le compteur
        $user->load('followers');

        return redirect()->back();
    }
}
