<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class FollowerController extends Controller
{
    public function follow(User $user) {
        $follower = auth()->user();
        $follower->followings()->attach($user);
         return back();
    }
    public function unFollow(User $user) {
        $follower = auth()->user();
        $follower->followings()->detach($user);
        return back();
    }
    public function like(User $user) {
        $like = auth()->user();
        $like->likes()->attach($user);
         return back();
    }
    public function unlike(User $user) {
        $like = auth()->user();
        $like->likes()->detach($user);
        return back();
    }

}
