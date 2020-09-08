<?php

namespace App\Http\Controllers;

use App\role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = role::all();

        $keywords = [];
        if (Role::where('keyword', 'Cashier')->count() == 0) 
        {
            $keywords['cashier'] = 'Cashier';
        }
        if (Role::where('keyword', 'Serviceman')->count() == 0) 
        {
            $keywords['serviceMan'] = 'Serviceman';
        }
        if (Role::where('keyword', 'CEO')->count() == 0) 
        {
            $keywords['CEO'] = 'CEO';
        }

        // if($keywords == null)
        // {
        //     return "null";
        // }
        // else
        // {
        //     return "aaa";
        // }
        return view('page.role.index' , ['roles' => $roles , 'keywords' => $keywords]);
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

        role::create([
                        'keyword'=> $request->keyword,
                        'rolename'=> $request->rolename,
                    ]);
        $request->session()->flash('success' , 'Add Role success fully');
        return redirect()->action('RoleController@index'); 


        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, role $role)
    {
        role::where('id' , $role->id)
                ->update(['rolename'=> $request->rolenameupdate]);

        $request->session()->flash('info' , 'Update Role Success fully');
        return redirect()->action('RoleController@index'); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(role $role)
    {
        $deleterole = role::where('id' , $role->id);
        $deleterole->delete();
        session()->flash('success' , 'Delete role Success fully');
        return redirect()->action('RoleController@index'); 
        //
    }
}
