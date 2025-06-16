<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $posts = Post::with(['user','category'])->latest()->paginate(5);
        } else {
            $posts = Post::with(['user','category'])
                        ->where('user_id', $user->id)
                        ->latest()
                        ->paginate(5);
        }

        return view('admin.post', compact('posts'));
    }

    public function create()
    {
        $categorys = Category::all();
        return view('admin.add-post', compact('categorys') );
    }

   public function store(Request $request)
    {
        $image = $request->file('post_image');

        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'post_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $path = $image->store('image', 'public');
        
        $validate['post_image'] = $path; 
        $validate['user_id'] = Auth::id();

        Category::where('id', $validate['category_id'])->increment('posts');

        Post::create($validate);

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
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'post_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        $post = Post::findOrFail($id);
        $oldCategory = $post->category_id;
        $newCategory = $validate['category_id'];

        if($oldCategory != $newCategory){
            category::where('id', $oldCategory)->decrement('posts');
            category::where('id', $newCategory)->increment('posts');
        }
        
        if ($request->hasFile('post_image')) {

            $imagePath = public_path('storage/'.$post->post_image);
            @unlink($imagePath);
            
            $path = $request->file('post_image')->store('image', 'public');
            $validate['post_image'] = $path; 
        
        } else {
            $validate['post_image'] = $post->post_image; 
        }
   
        $post->update($validate);

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
