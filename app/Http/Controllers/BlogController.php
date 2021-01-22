<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        // $posts = Post::all();

         // In order to have less code in this controller to display the categories I created a ComposerServiceProvider in the Providers folder and registered it app.php in the config folder where they have the provider class.

        $posts = Post::with('user')->latest()->published()->paginate(3);

        return view('blog.index', compact('posts'));
    }

    public function category(Category $category){
        $categoryName = $category->title;

        // In order to have less code in this controller to display the categories I created a ComposerServiceProvider in the Providers folder and registered it app.php in the config folder where they have the provider class.

        // \DB::enableQueryLog();
        $posts = $category->posts()->with('user')->latest()->published()->paginate(3);

        return view("blog.index", compact('posts', 'categoryName'));//->render();

        //  dd(\DB::getQueryLog());
    }

    public function show($slug){
         // In order to have less code in this controller to display the categories I created a ComposerServiceProvider in the Providers folder and registered it app.php in the config folder where they have the provider class.

        $post = Post::published()->where('slug', $slug)->first();
        // $post = Post::published()->findOrFail($id);
        // return $post->title;
        return view('blog.show', ['post' => $post]);
    }

    public function author(User $user) {
        $authorName = $user->name;

        // In order to have less code in this controller to display the categories I created a ComposerServiceProvider in the Providers folder and registered it app.php in the config folder where they have the provider class.

        // \DB::enableQueryLog();
        $posts = $user->posts()->with('category')->latest()->published()->paginate(3);

        return view("blog.index", compact('posts', 'authorName'));//->render();

        //  dd(\DB::getQueryLog());
    }
}