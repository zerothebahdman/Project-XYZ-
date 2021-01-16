<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        // $posts = Post::all();
        $posts = Post::with('user')->latest()->published()->paginate(4);
        return view('blog.index', compact('posts'));
    }

    public function show($slug){
        $post = Post::published()->where('slug', $slug)->first();
        // $post = Post::published()->findOrFail($id);
        // return $post->title;
        return view('blog.show', ['post' => $post]);
    }
}