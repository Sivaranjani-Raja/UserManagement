<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetail;
use Carbon\Carbon;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')){
    		$user = UserDetail::search($request->get('search'))->get();	
    	}else{
    		$user = UserDetail::get();
    	}
        return view ('user.index')->with('user',$user);
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
        $request->validate([
            'email' => 'required|email|unique:user_details',
            'name' => 'required|string|max:191',
            'date_of_join' => 'required',
            'imagefile' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
        ],[
            'name.required' => 'Name is required',
            'email.email' => 'Please Enter Correct Email Format',
            'email.unique' => 'Email already exists',
            'date_of_join.required' => 'Date of Join is Required',
            
        ]);

        $user = new UserDetail;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->date_of_join =  Carbon::parse($request->date_of_join)->format('Y-m-d H:s:i');

        // if still_work check box is "on" date_of_leave field will be null on database or else it will store the date
        if($request->still_work == "on")
        {
            $user->date_of_leave = null;
        }else
        {
            $user->date_of_leave = Carbon::parse($request->date_of_leave)->format('Y-m-d H:s:i');
        }
       

        if ($image = $request->file('imagefile')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $user->imagefile = "$profileImage";
        }

       
        $user->save();


        return redirect('user')->with('flash_message', 'User Added Successfully!');  
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
        $user = UserDetail::find($id);
        return view('user.edit')->with('user', $user);
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
        $request->validate([
            'email' => 'email',
            'name' => 'string|max:191',
        ]);

        $user = UserDetail::find($id);
        $input = $request->all();
        $user->update($input);
        return redirect('user')->with('flash_message', 'User Details Updated!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserDetail::destroy($id);
        return redirect('user')->with('flash_message', 'User deleted!');  
    }
}
