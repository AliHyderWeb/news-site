<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
   public function boot(): void
    {
        // Sending data to the public sidebar view
        View::composer('partials.public-sidebar', function($view) {
            $request = app(Request::class);
            $search = $request->input('search');

            $latestPosts = Post::with('category')
                ->when($search, function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')    
                        ->orWhereHas('category', function ($q) use ($search) {
                            $q->where('category_name', 'like', '%' . $search . '%');
                        });
                })
                ->where('status', 'approved')
                ->latest()
                ->paginate(5);

            $view->with('latestPosts', $latestPosts);
        });



        //sending data to the public header view
        View::Composer('partials.public-header', function($view){
           $categories = Category::withCount(['posts' => function ($query) {
                $query->where('status', 'approved');
            }])
            ->having('posts_count', '>', 0)
            ->get();
            
            $category = Category::all();
            $view->with('categories', $categories , 'category', $category);
        });

    }
}
