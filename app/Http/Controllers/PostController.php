<?php

namespace App\Http\Controllers;
use App\Http\Requests\Post\PostStoreRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::get();
        $subcategories =  SubCategory::get();
        $post =  Post::get();

        return view('posts.index', compact('categories', 'subcategories', 'post'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::get();
        $subcategories = $categories;


        // dd($subcategories);
        // //
        return view('posts.add', compact('categories', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        // for store image
        $imagePath =  request('image')->store('uploads', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        $post  =  new Post();
        $post->title = $request['title'];
        $post->description = $request['description'];
        $post->user_id = Auth::id();
        $post->category_id = $request['category_id'];
        $post->subcategory_id = $request['subcategory_id'];
        $post->image = $imagePath;
        $post->save();
        return redirect()->route('post.index')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //


        $category = Category::get();
        $subcategory = SubCategory::get();

        return view('posts.edit', compact('subcategory', 'category', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {


        // for store image

        if ($request->image != null) {
            $imagePath =  request('image')->store('uploads', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
            $image->save();



            Post::where('id', $post->id)->update(['title' => $request->title, 'description' => $request->description, 'image' => $imagePath]);
        } else {

            Post::where('id', $post->id)->update(['title' => $request->title, 'description' => $request->description]);
        }
        return redirect()->route('post.index')
            ->with('success', 'post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        //         $model = Contents::find( $id );
        // $model->delete();
        $post->delete();

        return redirect()->route('post.index')
            ->with('success', 'Post deleted successfully');
    }
}
