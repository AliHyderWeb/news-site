<?php 
namespace App\Actions;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class GetPosts
{
     public function handle(?string $search)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return Post::with(['user', 'category'])
                ->when($search, function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('title', 'like', '%' . $search . '%')
                          ->orWhereHas('category', function ($q2) use ($search) {
                              $q2->where('category_name', 'like', '%' . $search . '%');
                          });
                    });
                })->latest()->paginate(5);
        } else {
            return Post::with(['user', 'category'])
                ->where('user_id', $user->id)
                ->when($search, function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('title', 'like', '%' . $search . '%')
                          ->orWhereHas('category', function ($q2) use ($search) {
                              $q2->where('category_name', 'like', '%' . $search . '%');
                          });
                    });
                }) ->latest()->paginate(5);
        }
    }
}


?>