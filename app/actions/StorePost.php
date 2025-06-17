<?php


   namespace App\Actions;
   
   use App\Models\Post;
   use App\Models\Category;
   use Illuminate\Support\Facades\Auth;


    class StorePost{
        public function handle(array $data){

            $image = $data['post_image'];
            $path =  $image->store('image', 'public');

            $data['post_image'] = $path;
            $data['user_id'] = Auth::id();

            Category::where('id', $data['category_id'])->increment('posts');

            Post::create($data);
        }
    }
?>