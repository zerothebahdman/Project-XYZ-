<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        // $posts = Post::all();
        $posts = Post::with('user')->latest()->published()->paginate(4);
        return view('blog.index', compact('posts'));
    }

    public function show($id){
        $post = Post::findOrFail($id);
        return view('blog.show', compact('post'));
    }
}
