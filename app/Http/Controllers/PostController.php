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
        $posts = Post::paginate(5);
       return view('admin.post', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorys = Category::all();
        return view('admin.add-post', compact('categorys') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = $request->file('post_image');

        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|exists:categories,id',
            'post_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
         $path = $request->file('post_image')->store('image', 'public');
         
         $validate['post_image'] = $path; 
         $validate['author'] = Auth::user()->first_name;

         category::where('id', $validate['category'] )->increment('posts');

         Post::create($validate);
         return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $posts = Post::findOrFail($id);
       $categorys = Category::all();

       return view('admin.add-post', compact('posts','categorys'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|exists:categories,id',
            'post_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        $post = Post::findOrFail($id);
        $oldCategory = $post->category;
        $newCategory = $validate['category'];

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

        $validate['author'] = Auth::user()->first_name;
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

       $imagePath = public_path('storage/'.$post->post_image);
         
        if(file_exists($imagePath)){
            @unlink($imagePath);
        }
        category::where('id', $post['category'] )->decrement('posts');
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
