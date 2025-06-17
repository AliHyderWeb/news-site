<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Actions\GetPosts;
use App\actions\StorePost;
use App\actions\UpdatePost;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request, GetPosts $getPosts)
    {
        $search = $request->input('search');
        $posts = $getPosts->handle($search);
       
        return view('admin.post', compact('posts'));
    }

    public function create()
    {
        $categorys = Category::all();
        return view('admin.add-post', compact('categorys') );
    }

   public function store(PostRequest $request, StorePost  $storePost)
    {
        $data = $request->validated();
        $data['post_image'] = $request->file('post_image');

        $storePost->handle($data);  

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        $posts = Post::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'admin' && $posts->user_id !== $user->id) {
            abort(403, 'Unauthorized access.');
        }

        $categorys = Category::all();
        return view('admin.add-post', compact('posts', 'categorys'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id, UpdatePost $updatePost)
    {
        $post = Post::findOrFail($id);
        $data = $request->validated();
       
        if ($request->hasFile('post_image')) {
            $data['post_image'] = $request->file('post_image');
        }  

        $updatePost->handle($post, $data);
        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        
        $post->delete();

        $imagePath = public_path('storage/' . $post->post_image);

        if (file_exists($imagePath)) {
            @unlink($imagePath);
        }

        Category::where('id', $post->category_id)->decrement('posts');

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
