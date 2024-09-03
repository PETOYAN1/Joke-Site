<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Category;
use App\Models\Follow;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     *
     */
    public function show(Request $request, $id): View
    {
        $posts = Post::with('users', 'categories')->where('user_id',$id)->get();
        $follows = Follow::with('users', 'follows')->where('user_id', $id)->get();
        $user = $request->user()->find($id);
        return view('profile.show', compact('posts', 'user', 'follows'));
    }
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'gender' => 'required', 'in:Male,Female',
            'avatar' => ['required', 'image', 'mimes:jpg,jpeg,bmp,svg,png', 'max:5000'],
        ]);

        $user = request()->all();

        if($request->has('avatar')){
            $old_image = $request->user()->avatar;
            Storage::delete($old_image);
            $profileimage = request()->file('avatar');
            $file_path = Storage::disk('local')->put('data', $profileimage);
            $request->user()->avatar = $file_path;
        } else {
            unset($user['avatar']);
        }

        // $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        return Redirect::route('profile.edit')->with('status', 'Profile updated successfully');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
