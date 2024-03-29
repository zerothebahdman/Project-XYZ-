<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Post;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // this brings the categories from the database and drops into the controllers with the help of ServiceProvider.
        view()->composer('layouts.sidebar', function($view) {
            $categories = Category::with(['posts' => function($query) {
                $query->published();
            }])->orderBy('title', 'asc')->get();

            return $view->with('categories', $categories);
        });

        view()->composer('layouts.sidebar', function($view) {
            $popularPosts = Post::published()->popular()->take(4)->get();

            return $view->with('popularPosts', $popularPosts);
        });
    }
}
