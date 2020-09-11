<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserRole;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        foreach($request->role_id_value as $rolekey => $rolevalue)
        {
            
            if($rolevalue == "true")
            {
                $userRolesCheckcreate = UserRole::where('user_id' , $request->user_id)
                                            ->where('role_id' , $rolekey)
                                            ->get();

                if($userRolesCheckcreate->isempty())
                {
                    UserRole::create([
                                        'user_id'=> $request->user_id,
                                        'role_id'=> $rolekey
                                    ]);
                }

            }
            else if($rolevalue == "false")
            {
                $userRolesCheckdel = UserRole::where('user_id' , $request->user_id)
                                    ->where('role_id' , $rolekey)
                                    ->first();

                                    //return $userRolesCheckdel;

                if($userRolesCheckdel != null)
                {
                    $userRolesCheckdel->delete();
                }
            }
       
        }

        $request->session()->flash('success' , 'Update UserRoles Success fully');
        return redirect()->action('UserinfoController@index'); 

        //
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
        //
    }
}
