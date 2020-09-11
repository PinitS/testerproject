<?php

namespace App\Http\Controllers;

use App\job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = job::all();
        return view('page.job.index' , ['jobs' => $jobs]);
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
        $jobCheck = job::where('jobname' , $request->jobname)->first();

        if($jobCheck == null)
        {
            job::create(['jobname'=> $request->jobname,]);
            $request->session()->flash('success' , 'add job success fully');
            return redirect()->action('JobController@index'); 
        }
        else
        {
            $request->session()->flash('danger' , 'job has already exit');
            return redirect()->action('JobController@index'); 
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, job $job)
    {

        $jobCheck = job::where('jobname' , $request->jobname)->first();

        if($jobCheck == null)
        {
            job::where('id' , $job->id)
                    ->update(['jobname'=> $request->jobname]);

            $request->session()->flash('info' , 'Update Job Success fully');
            return redirect()->action('JobController@index'); 
        }
        else
        {
            if($jobCheck->id == $job->id)
            {
                job::where('id' , $job->id)
                        ->update(['jobname'=> $request->jobname]);

                $request->session()->flash('info' , 'Update Job Success fully');
                return redirect()->action('JobController@index'); 

            }
            $request->session()->flash('danger' , 'Job has already exit');
            return redirect()->action('JobController@index'); 
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(job $job)
    {

        $deletejob = job::where('id' , $job->id);
        $deletejob->delete();
        session()->flash('success' , 'Delete job Success fully');
        return redirect()->action('JobController@index'); 
        //
    }
}
