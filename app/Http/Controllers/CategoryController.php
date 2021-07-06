<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class CategoryController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('created_at', 'desc')->paginate(5);
        return view('category.index',['categories' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'categoryName'  =>  'required|max::255'
        ]);

        $result = DB::table('categories')
        ->where('categoryName', $request->input('categoryName'))
        ->get();

    $res = json_decode($result, true);
    print_r($res);

    if (sizeof($res) == 0) {
        $data = $request->input();
        $category = new Category();
        $category->categoryName = ucwords($data['categoryName']);
        $category->slug = \Str::slug($data['categoryName']);
        $slugs = Category::whereRaw("slug RLIKE '^{$category->slug}(-[0-9]+)?$'")->latest('id')->value('slug');
        if($slugs){
            $piece = explode('-', $slugs);
            $num = intval(end($piece));
            $category->slug .= '-' .($num + 1); 
        }
        $category->save();

        return redirect()->back()->with('success', 'Category added successfully');
        }
        return redirect()->back()->with('error', 'Category Already Exists!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result = DB::table('categories')
        ->where('categoryName', $request->input('categoryName'))
        ->get();

    $res = json_decode($result, true);
    print_r($res);

    if (sizeof($res) == 0) {
        $data = $request->input();
        $category = Category::find($id);
        $category->categoryName = ucwords($data['categoryName']);
        $category->slug = \Str::slug($data['categoryName']);
        $slugs = Category::whereRaw("slug RLIKE '^{$category->slug}(-[0-9]+)?$'")->latest('id')->value('slug');
        if($slugs){
            $piece = explode('-', $slugs);
            $num = intval(end($piece));
            $category->slug .= '-' .($num + 1); 
        }
        $category->save();
        return redirect()->back()->with('success', 'Category updated successfully
        ');
    }
        return redirect()->back()->with('error', 'Category Already Exists!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}
