<?php 
namespace App\Actions;

use App\Models\Post;
use App\Models\Category;


    class UpdatePost{
        public function handle(Post $post, array $data){

            $odlCategory = $post->category_id;
            $newCategory = $data['category_id'];

            if($odlCategory != $newCategory){

                 Category::where('id', $odlCategory)->decrement('posts');
                 Category::where('id', $newCategory)->increment('posts');
            }

            if(isset($data['post_image']) && $data['post_image']){
             
                $imagePath = public_path('storage/' . $post->post_image); //Old image deltee when user change images
                @unlink($imagePath);

                $path = $data['post_image']->store('image', 'public');
                $data['post_image'] = $path;
            }else{
                $data['post_image'] = $post->post_image;
            }

            $post->update($data);
        }
    }

?>