<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $posts = Post::with('author')->latest()->paginate(4)->get();
        return view('blog.index', compact('posts'));
    }
}