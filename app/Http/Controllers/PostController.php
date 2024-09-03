<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request) {
        $users = User::orderBy('created_at', 'desc')->get(['id', 'name', 'avatar', 'gender']);
        $posts = Post::with('users:id,name,avatar,gender','comments')->where('published', true)->orderBy('created_at', 'desc');
        $categories = Category::with(["posts" => function($query){
            $query->where('posts.published', true);
        }])->get();
        if($request->has('search') && !empty($request->search)) {
            $posts = $posts->where('title', 'like', "%$request->search%");
        }
        if($request->has('category') && !empty($request->category)) {
            $posts = $posts->where('category_id', $request->category);
        }
        $posts = $posts->paginate(3);
        return view('dashboard', compact('posts', 'categories', 'users'));
    }
    public function create(Request $request)
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required','string','max:255'],
            'description' => ['required','string','max:255'],
            'image' => ['image', 'mimes:jpg,jpeg,bmp,svg,png', 'max:5000'],
            'published' => 'sometimes'
        ]);

        if(!Storage::exists('data')){
            Storage::makeDirectory('data');
        }
        if(request()->has('image')){
            $profileimage = request()->file('image');
            $file_path = Storage::disk('local')->put('data', $profileimage);
        }
        Post::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $file_path ?? null,
            'published' => $request->published == true ? 1 : 0,
            'category_id' => $request->category,
            'created_at' => Carbon::now()
        ]);
        return redirect('dashboard')->with('success', 'Created Successfully');
    }
    public function edit(int $id) {
        $posts = Post::find($id);
        $categories = Category::all(['id','name']);
        return view('posts.update', compact('posts', 'categories'));
    }
    public function update(Request $request, int $id) {
        $request->validate([
            'title' => ['required','string','max:55'],
            'description' => ['required','string','max:255'],
            'image' => ['image', 'mimes:jpg,jpeg,bmp,svg,png', 'max:5000'],
            'published' => 'sometimes'
        ]);
        $old_image = Post::find($id)->image;
        if(request()->has('image')){
            $profileimage = request()->file('image');
            $file_path = Storage::disk('local')->put('data', $profileimage);

            // Delete old image
            Storage::delete($old_image);
        }
        Post::findOrFail($id)->update([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $file_path ?? $old_image,
            'published' => $request->published == true ? 1 : 0,
            'category_id' => $request->category,
            'updated_at' => Carbon::now()
        ]);
        return redirect()->route('profile.show', auth()->id())->with('success', 'Updated Successfully');
    }
    public function destroy(int $id) {
        $posts = Post::find($id);
        $posts->delete();
        return redirect()->route('profile.show', auth()->id())->with('success', 'Deleted Successfully');
    }
}
