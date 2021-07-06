<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;



class StockController extends Controller
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
        $stocks = stock::orderBy('created_at', 'desc')->get();
        $category = category::all();
        
        return view('stock.index', ['stocks' => $stocks, 'categories' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('stock.create', ['categories' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable',
            // 'brand' => 'nullable',
            // 'price' => 'required',
            // 'quantity' => 'required',
            'supplierprice' => 'required',
            'category_id' => 'required',
            // 'form'  =>  'required',
            'expiredate' => 'nullable',
            'stock_alert' => 'required',
            'stock_img' => 'image|nullable|max:2042',
        ]);
        if($request->hasFile('stock_img')){
            //Get file name
            $fileNameWithExt = $request->file('stock_img')->getClientOriginalName();
            //File name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('stock_img')->getClientOriginalExtension();

            $fileNameToStore = $filename. '_' .time(). '.' .$extension;

            $path = $request->file('stock_img')->storeAs('public/stock', $fileNameToStore);
        }
        else{
            $fileNameToStore = 'stock.png';
        }


        $result = DB::table('stocks')->where('name', $request->input('name'))->get();
        $res = json_decode($result, true);
        print_r($res);

        

        if (sizeof($res) == 0) {
        $data = $request->input();
        $stock = new Stock;
        $stock->name = ucwords($data['name']);
        $stock->description = $data['description'];
        // $stock->brand = $data['brand'];
        // $stock->price = $data['price'];
        
        $stock->supplierprice = $data['supplierprice'];
        $stock->stock_alert = $data['stock_alert'];
        $stock->category_id = $data['category_id'];
        $stock->expiredate = $data['expiredate'];
        

        $stock->stock_img = $fileNameToStore;
        
        $stock ->save();

        }
        // if($products->expiredate < date('d')){
        //     return redirect()->back()->with('error', 'Product is Expired');
        // }

        else{
            return redirect()->back()->with('error', 'Product already exist!');
        }

        return redirect('stock')->with('success', 'Product Added to Stock Successfully');
        return redirect()->back()->with('error', 'Product Registration Failed!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->hasFile('stock_img')){
            //Get file name
            $fileNameWithExt = $request->file('stock_img')->getClientOriginalName();
            //File name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('stock_img')->getClientOriginalExtension();

            $fileNameToStore = $filename. '_' .time(). '.' .$extension;

            $path = $request->file('stock_img')->storeAs('public/stock', $fileNameToStore);
        }
       
        $data = $request->input();
        $stock = Stock::find($id);
        $stock->name = ucwords($data['name']);
        $stock->description = $data['description'];
        // $stock->brand = $data['brand'];
        // $stock->price = $data['price'];
        
        $stock->supplierprice = $data['supplierprice'];
        $stock->stock_alert = $data['stock_alert'];
        $stock->category_id = $data['category_id'];
        $stock->expiredate = $data['expiredate'];
        $stock->comments = $data['comments'];
        if($request->hasFile('stock_img')){
            $stock->stock_img  = $fileNameToStore;
        }
        
        $stock ->save();

        return redirect()->back()->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(stock $stock)
    {
        if($stock->stock_img != 'stock.png'){
            Storage::delete('public/stock/'.$stock->stock_img );
        }
        $stock->delete();
        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }
}
