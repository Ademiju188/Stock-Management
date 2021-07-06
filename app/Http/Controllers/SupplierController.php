<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;



class SupplierController extends Controller
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
        $supplier = supplier::orderBy('created_at', 'desc')->get();
        return view('supplier.index', ['suppliers' => $supplier]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'mobile' => ['required', 'string', 'min:11', 'max:11'],
            'address' => 'required',
            'status' => 'required',
            'supplier_img' => 'image|nullable|max:2042',
        ]);


        if($request->hasFile('supplier_img')){
            //Get file name
            $fileNameWithExt = $request->file('supplier_img')->getClientOriginalName();
            //File name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('supplier_img')->getClientOriginalExtension();

            $fileNameToStore = $filename. '_' .time(). '.' .$extension;

            $path = $request->file('supplier_img')->storeAs('public/supplier', $fileNameToStore);
        }
        else{
            $fileNameToStore = 'supplier.png';
        }


        $result = DB::table('suppliers')->where('supplier_name', $request->input('name'))->get();
        $result = DB::table('suppliers')->where('email', $request->input('email'))->get();

        $res = json_decode($result, true);
        print_r($res);

        if (sizeof($res) == 0) {
        $data = $request->input();
        $supplier = new Supplier;

        $supplier->supplier_name = ucwords($data['name']);
        $supplier->email = strtolower($data['email']);
        $supplier->mobile =$request->mobile;
        $supplier->address = ucwords($data['address']);
        $supplier->status =$request->status;

        $supplier->supplier_img = $fileNameToStore;

        
        $supplier ->save();
        return redirect(route('supplier.index'))->with('success', 'Supplier Created Successfully');
        }
    
        return redirect()->back()->with('error', 'Supplier Name or Email Already Exists!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'mobile' => ['required', 'string', 'min:11', 'max:11'],
            'address' => 'required',
            'status' => 'required',
            'supplier_img' => 'image|nullable|max:2042',
        ]);


        if($request->hasFile('supplier_img')){
            //Get file name
            $fileNameWithExt = $request->file('supplier_img')->getClientOriginalName();
            //File name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('supplier_img')->getClientOriginalExtension();

            $fileNameToStore = $filename. '_' .time(). '.' .$extension;

            $path = $request->file('supplier_img')->storeAs('public/supplier', $fileNameToStore);
        }

        $data = $request->input();
        $supplier = Supplier::find($id);
        $supplier->supplier_name = ucwords($data['name']);
        $supplier->email = strtolower($data['email']);
        $supplier->mobile =$request->mobile;
        $supplier->address = ucwords($data['address']);
        $supplier->status =$request->status;

        if($request->hasFile('supplier_img')){
            $supplier->supplier_img  = $fileNameToStore;
        }
        
        $supplier ->save();
        return redirect()->back()->with('success', 'Supplier Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        if(!$supplier){
            return back()->with('error', 'Supplier Not Found');
        }
        if($supplier->supplier_img != 'supplier.png'){
            Storage::delete('public/supplier/'.$supplier->supplier_img );
        }
        $supplier->delete();
        return back()->with('success', 'Supplier Deleted Successfully');
    }
}
