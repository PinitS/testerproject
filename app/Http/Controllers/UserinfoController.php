<?php

namespace App\Http\Controllers;

use App\User;
use App\job;
use App\role;
use App\UserRole;


use Illuminate\Http\Request;

class UserinfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Users = User::with('Job')
                    ->get();

        $jobs = job::all();
        
        $roles = role::all();
        
        $UserRoles = UserRole::all();

        if($UserRoles->isEmpty())
        {
            //return "empty";

        }
        else
        {
            //return "not empty";
        }

        

        return view('page.userinfo.index' , ['Users' => $Users , 'jobs' => $jobs , 'UserRoles' => $UserRoles , 'roles' => $roles]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "create";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->password != $request->cfpassword)
        {
            $request->session()->flash('warning' , 'PassWord And Confirm PassWord is not match');
            return redirect()->action('UserinfoController@index'); 
        }
        else
        {

            User::create([  
                            'username'=> $request->username,
                            'password'=> bcrypt($request->hashtagname),
                            'name'=> $request->name,
                            'contact'=> $request->contact,
                            'active'=> 1,
                            'job_id'=> $request->job,
                            'status'=> $request->status
                        ]);

            $request->session()->flash('success' , 'Add Member Success Fully');
            return redirect()->action('UserinfoController@index'); 
        }

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

    public function changeMemberPassword(Request $request)
    {
        //return $request;

        if($request->npass == $request->cpass)
        {
            User::where('id' , $request->usid)
            ->update([  'password'=> bcrypt($request->npass)]);
            $request->session()->flash('success' , 'Reset Password User Success fully');
            return redirect()->action('UserinfoController@index'); 
        }
        else
        {
            $request->session()->flash('danger' , 'NewPassword Or ConfirmPassword not match');
            return redirect()->action('UserinfoController@index'); 
        }


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
        User::where('id' , $id)
            ->update([  
                        'status'=> $request->status,
                        'job_id'=> $request->job,
                        'name'=> $request->name,
                        'contact'=> $request->contact,
                    ]);

        $request->session()->flash('info' , 'Update User Success fully');
        return redirect()->action('UserinfoController@index'); 
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteuser = User::where('id' , $id);
        $deleteuser->delete();
        session()->flash('success' , 'Delete user Success fully');
        return redirect()->action('UserinfoController@index'); 
        //
    }

    public function activeupdate($Ative, $Usid)
    {

        User::where('id' , $Usid)
            ->update(['active'=> abs($Ative-1)]);

        session()->flash('info' , 'Update User Success fully');
        return redirect()->action('UserinfoController@index'); 
        
    }


}
