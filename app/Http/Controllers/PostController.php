<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Category::all();
        return view('posts.add', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'detail' => 'required',
            'slug'  => 'required|unique:posts'
        ]);


        $slug = Str::slug($request->slug);


        if($request->hasFile('thumbnail')) {
            $imageName = time() . '.' . $request->thumbnail->getClientOriginalName();
            $path = Storage::putFileAs(
                'public/images', $request->thumbnail, $imageName
            );

            Post::create(
                [
                    'title'         => $request->title,
                    'slug'          => $slug,
                    'detail'        => $request->detail,
                    'category_id'   => $request->cat_id,
                    'tags'          => $request->tags,
                    'thumbnail'     => 'storage/images/' . $imageName,
                ]
            );
        }else {
            Post::create(
                [
                    'title'         => $request->title,
                    'slug'          => $slug,
                    'detail'        => $request->detail,
                    'category_id'   => $request->cat_id,
                    'tags'          => $request->tags,
                ]
            );
        }

        return redirect()->route('posts.all')->with('success','İşlem başarıyla gerçekleştirildi.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $comments = Comment::where('post_id', $post->id)->get();
        return view('home.single', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $cats = Category::all();
        return view('posts.edit', compact('post', 'cats'));
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
        $request->validate([
            'title' => 'required',
            'detail' => 'required',
            'slug' => "required|alpha_dash|unique:posts,slug,$post->id",
        ]);


        $slug = Str::slug($request->slug);

        if($request->hasFile('thumbnail')){
            $imageName = time() . '.' . $request->thumbnail->getClientOriginalName();
            $path = Storage::putFileAs(
                'public/images', $request->thumbnail, $imageName
            );
            $post::where('id',$post->id)->update(
                [
                    'title'         => $request->title,
                    'slug'          => $slug,
                    'detail'        => $request->detail,
                    'category_id'   => $request->cat_id,
                    'tags'          => $request->tags,
                    'thumbnail'     => 'storage/images/' . $imageName,
                ]
            );
        }else {
            $post::where('id',$post->id)->update(
                [
                    'title'         => $request->title,
                    'slug'          => $slug,
                    'detail'        => $request->detail,
                    'category_id'   => $request->cat_id,
                    'tags'          => $request->tags,
                ]
            );
        }



        return redirect()->back()->with('success','İşlem başarıyla gerçekleştirildi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        return redirect()->route('posts.all')->with('success','İşlem başarıyla gerçekleştirildi.');
    }
}
