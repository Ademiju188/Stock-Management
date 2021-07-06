<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;



use Illuminate\Http\Request;

class UserController extends Controller
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
        $users = User::all();
        return view('user.index', ['users' => $users,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
           
            // 'address' => 'required',
            'is_admin' => 'required',
            'status' => 'required',
            'password' => 'required|min:8|max:10',
            'confirm_password' => 'required|same:password',
            'user_img' => 'image|nullable|max:2042',
        ]);
        

        if($request->hasFile('user_img')){
            //Get file name
            $fileNameWithExt = $request->file('user_img')->getClientOriginalName();
            //File name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('user_img')->getClientOriginalExtension();

            $fileNameToStore = $filename. '_' .time(). '.' .$extension;

            $path = $request->file('user_img')->storeAs('public/users', $fileNameToStore);
        }
        else{
            $fileNameToStore = 'user.png';
        }


        $result = DB::table('users')
            ->where('email', $request->input('email'))
            ->get();

        $res = json_decode($result, true);
        print_r($res);

        if (sizeof($res) == 0) {
        $data = $request->input();
        $user = new User;
        $user->name = ucwords($data['name']);
        $user->email = strtolower($data['email']);
        $user->password = Hash::make($request['password']);
        $user->confirm_password = Hash::make($request['confirm_password']);
        $user->mobile =$request->mobile;
        $user->status =$request->status;
        $user->is_admin = $request->is_admin;
        $user->user_img = $fileNameToStore;
        
        $user ->save();
        return redirect(route('user.index'))->with('success', 'User Created Successfully');
        }
        
        return redirect()->back()->with('error', 'User Registration Failed, Email Already Exists!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'mobile' => ['required', 'string', 'min:11', 'max:11'],
            'is_admin' => 'required',
            'status' => 'required',
            // 'password' => 'required|min:8|max:10',
            // 'confirm_password' => 'same:password',
            'user_img' => 'image|nullable|max:2042',
        ]);
        

        if($request->hasFile('user_img')){
            //Get file name
            $fileNameWithExt = $request->file('user_img')->getClientOriginalName();
            //File name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('user_img')->getClientOriginalExtension();

            $fileNameToStore = $filename. '_' .time(). '.' .$extension;

            $path = $request->file('user_img')->storeAs('public/users', $fileNameToStore);
        }


        $data = $request->input();
        $user = User::find($id);
        $user->name = ucwords($data['name']);
        $user->email = strtolower($data['email']);
        $user->mobile = $data['mobile'];
        $user->is_admin = $data['is_admin'];
        $user->status = $data['status'];
        if($data['password']) {
            if($data['password'] == $data['confirm_password']) {
                $user['password'] = Hash::make($data['password']);
                $user['confirm_password'] = Hash::make($data['confirm_password']);
            }
        }
        if($request->hasFile('user_img')){
            $user->user_img  = $fileNameToStore;
        }
        $user->save();
        return redirect()->back()->with('success', 'User Updated Successfully');
        if(!$user){
            return back()->with('error', 'User Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if(!$user){
            return back()->with('error', 'User Not Found');
        }
        if($user->user_img == 'user.png'){
            Storage::delete('public/users/'.$user->user_img);
        }
        $user->delete();
        return back()->with('success', 'User Deleted Successfully');
    }
}
