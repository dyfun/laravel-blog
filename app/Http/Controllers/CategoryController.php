<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Category::all();
        return view('cats.index', compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cats.add');
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
            'slug'  => 'required|unique:categories'
        ]);


        $slug = Str::slug($request->slug);

        Category::create(
            [
                'title' => $request->title,
                'slug'  => $slug,
            ]
        );

        return redirect()->route('categories.all')->with('success','İşlem başarıyla gerçekleştirildi.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $cat = Category::where('slug', $slug)->first();
        $post = $cat->getPost()->orderBy('id', 'desc')->paginate(5);
        return view('home.category', compact('post','cat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('cats.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required',
            'slug' => "required|alpha_dash|unique:categories,slug,$category->id",
        ]);


        $slug = Str::slug($request->slug);

        $category::where('id',$category->id)->update(
            [
                'title'      => $request->title,
                'slug'       => $slug
            ]
        );

        return redirect()->back()->with('success','İşlem başarıyla gerçekleştirildi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::where('id', $id)->delete();
        return redirect()->route('categories.all')->with('success','İşlem başarıyla gerçekleştirildi.');
    }
}
