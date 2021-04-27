<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Comment;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Category::all();
        $posts = Post::orderBy('id', 'desc')->paginate(5);;
        return view('home.index', compact('cats', 'posts'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comment_store(Request $request, Comment $comment)
    {
        $comment::create(
            [
                'post_id'       => $request->post_id,
                'comment'       => $request->comment,
                'user_id'       => $request->user_id
            ]
        );

        return redirect()->back()->with('success','İşlem başarıyla gerçekleştirildi.');
    }

    public function search(Request $request){
        $q = $request->input('q');
        $posts = Post::where('title', 'LIKE', "%{$q}%")->paginate(5);
        return view('home.search', compact('posts', 'q'));
    }


}
