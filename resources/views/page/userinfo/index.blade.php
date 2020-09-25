@extends('layouts.master')

@section('pagetitle' , 'UserInfomation')

@section('content')


  <div class="card card-accent-info">

    <div class="card-body">
      
      <div class="row">
        <div class="col-md-6 col-sm-6">
            #Member Information 
        </div>

        <div class="col-md-6 col-sm-6">
          <button class="btn btn-info mb-1 float-md-right float-sm-right" type="button" data-toggle="modal" data-target="#largeModal"><i class="fa fa-plus"></i> Add User</button>
        </div>
      </div>

      <div class="row mt-1">
        <div class="col-md-6">
            #Show
        </div>

        <div class="col-md-6">
          <div class="input-group">
            <input type="text" class="form-control col-md-5 ml-auto" placeholder="Search for..." aria-label="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="button">Go!</button>
            </span>
          </div>
        </div>

      </div>

      <div class="row mt-3">

        <div class="col-md-12 text-center">

          @if(Session::has('success'))
          <div class="alert alert-success"> <h5 class="alert-heading"> {{Session::get('success')}} </h5> </div>
          @elseif(Session::has('danger'))
            <div class="alert alert-danger"> <h5 class="alert-heading"> {{Session::get('danger')}} </h5> </div>
          @elseif(Session::has('warning'))
            <div class="alert alert-warning"> <h5 class="alert-heading"> {{Session::get('warning')}} </h5> </div> 
          @elseif(Session::has('info'))
            <div class="alert alert-info"> <h5 class="alert-heading"> {{Session::get('info')}} </h5> </div>   
          @endif

        </div>
  
      </div>
      


      <table class="table table-responsive-sm-12 table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>User name</th>
            <th>name</th>
            <th>Job</th>
            <th>Active</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>

          @foreach($Users as $User)
            <form action="{{ route('userinfo.destroy', [$User->id]) }}" method="POST">
              {{ method_field('DELETE') }}
              {{ csrf_field() }}
                <tr>
                  
                  @if($User->id >1 && $User->id != Auth::user()->id)
                    <td>{{$User->id-1}}</td>
                    <td>{{$User->username}}</td>
                    <td>{{$User->name}}</td>
                    @if($User->job == null && $User->job_id == 0)
                      <td class ="text-danger"><strong> No job information..</strong></td>
                    @elseif($User->job == null)
                      <td class ="text-danger"><strong> Something Wrong !!</strong></td>
                    @else
                      <td>{{$User->job->jobname}}</td>
                    @endif
                    @php
                      $achk ="";
                    @endphp
                    @if($User->active == 1)
                      @php
                        $achk ='checked =""';
                      @endphp
                    @endif

                      <td>
                        <label class="c-switch c-switch-label c-switch-danger">
                          <input {{$achk}} onchange = "window.location.href='{{ route('userinfo.activeupdate', ['Ative' => $User->active ,'Usid'=> $User->id]) }}' " class="c-switch-input" type="checkbox"><span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                        </label>
                      </td>

                    <td>

                      <i class="btn btn-danger mb-1 fas fa-address-book fa-lg" type="button" data-container="body" data-toggle="popover" data-placement="left" data-content="{{$User->contact}}" data-original-title="" title="" aria-describedby=""></i>

                      @if($User->active == 1)
                        <button class="btn btn-sm btn-warning mb-1 text-white" type="button" data-toggle="modal" data-target="#largeModal{{$User->id}}">
                          <i class="fas fa-edit"></i>
                        </button>

                        <button class="btn btn-sm btn-danger mb-1 text-white"> 
                          <i class="fas fa-times fa-lg"></i>
                        </button>

                        <button class="btn btn-sm btn-info mb-1 text-white" type="button" data-toggle="modal" data-target="#largeModalrole{{$User->id}}">
                          <i class="fas fa-child"></i>
                          <span>Add Roles</span>
                        </button>


                        <button class="btn btn-sm btn-warning mb-1 text-white" type="button" data-toggle="modal" data-target="#myModalLabelresetpass{{$User->id}}">
                          <i class="fas fa-lock-open lg"></i>
                        </button>



                      @endif

                    </td>

                  @endif
                </tr>
            </form>
          @endforeach
          
        </tbody>
      </table>
      

    </div>

    <form action="userinfo" method="post">

      {{ csrf_field() }}
      <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header ">
              <h4 class="modal-title">Add Member</h4>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <!-- add form -->

              <div class="row">
                <div class="form-group col-md-5">

                    <label for="Status">Status</label>
                    <select class="form-control" id="status" name ="status">
                      <option value="0">Admin</option>
                      <option value="1" selected>Member</option>
                    </select>
                      
                    <br>
                    <label for="name">Username</label>
                    <input class="form-control" id="username" name ="username" type="text" placeholder="username..." required>

                    <br>
                    <label for="name">Password</label>
                    <input class="form-control" id="password" name ="password" type="password" placeholder="password..." required>

                    <br>
                    <label for="name">Confirm Password</label>
                    <input class="form-control" id="password" name ="cfpassword" type="cfpassword" placeholder="password..." required>

                </div>       

                <div class="col-md-7 border-left">

                  <label for="ccyear">Job</label>
                  <select class="form-control" id="job" name ="job">
                    <option value="0">No job information</option>
                    @foreach ($jobs as $job)
                        <option value="{{$job->id}}">{{$job->jobname}}</option>
                    @endforeach
                  </select>

                  <br>
                  <label for="name">Fullname</label>
                  <input class="form-control" id="name" name ="name" type="text" placeholder="fullname..." required>

                  <br>

                  <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" rows="3" name="contact" cols="50" required></textarea>
                  </div>

                </div>

              </div>

            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal" required>Close</button>
              <button class="btn btn-info" type="submit">Save</button>
            </div>
          </div>
                    <!-- /.modal-content-->
        </div>
      </div>

    </form>


    @foreach($Users as $User)

      <form action="{{ action('UserinfoController@update' , [$User->id] )}}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name = "_method" value = "PUT">

        <div class="modal fade" id="largeModal{{$User->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">edit</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              </div>
              <div class="modal-body">

                <div class="row">
                    <div class="col-md-10 container">
    
                      <label for="Status">Status</label>
                      <select class="form-control" id="status" name ="status">
                        @if($User->status == 0)
                        
                          <option selected value="0">Admin</option>
                          <option value="1" >Member</option>
                        @else
                          <option value="0">Admin</option>
                          <option selected value="1">Member</option>

                        @endif

                      </select>

                      <br>
                    

                      <label for="job">Job</label>
                      <select class="form-control" id="job" name ="job">
                        <option value="0">No job information</option>
                        @foreach ($jobs as $job)
                          @if($job->id == $User->job_id)
                            <option selected value="{{$job->id}}">{{$job->jobname}}</option>
                          @else
                            <option value="{{$job->id}}">{{$job->jobname}}</option>
                          @endif

                        @endforeach
                      </select>
      
                      <br>
                      <label for="name">Fullname</label>
                      <input class="form-control" id="name" name ="name" type="text" placeholder="fullname..." value="{{$User->name}}" required>
      
                      <br>
      
                      <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" rows="3" name="contact" cols="50" required>{{$User->contact}}</textarea>
                      </div>
    
                    </div>
                </div>

              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-warning" type="submit">edit</button>
              </div>
            </div>
                      <!-- /.modal-content-->
          </div>
        </div>
      </form>
    @endforeach



    @foreach($Users as $User)

      <form action="cartDetail" method="post">

        {{ csrf_field() }}

        <div class="modal fade" id="largeModalrole{{$User->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add Roles</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              </div>
              <div class="modal-body">

                <div class="row">
                  <div class="col-md-10 container text-center">
                    <table class="table table-borderless">

                      <thead>
                        <tr>
                          <th>Role</th>
                          <th>Status</th>
                        </tr>
                      </thead>
        
                      <tbody>

                        @foreach ($roles as $role)

                          <tr>
                              <td>{{$role->rolename}}</td>
                              <td>
                                @php
                                  $chk = 'false';
                                @endphp
                                
                                @foreach ($UserRoles as $UserRole)
                                  
                                  @if ($role->id == $UserRole->role_id && $UserRole->user_id == $User->id)

                                    @php
                                      $chk = 'true';
                                    @endphp

                                  @endif

                                @endforeach

                                <label class="c-switch c-switch-label c-switch-danger">
                 
                                  <input type="hidden" id="user_id" name ="user_id" value="{{$User->id}}">
                                  <input type="hidden" class="role_id_value{!! $role->id !!}" name ="role_id_value[{!! $role->id !!}]" value="{!! $chk !!}">
                                  <input type="checkbox" {{ $chk == 'true' ? 'checked=""' : '' }} class="c-switch-input pnt-chk"  id="role_id" data-id="{!! $role->id !!}" "><span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                                </label>
                              </td>
                          </tr>
                        @endforeach
                      </tbody>
        
                    </table>
                  </div>

                </div>

              </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                @if($roles->isNotEmpty())
                  <button class="btn btn-warning" type="submit">edit</button>
                @endif
              </div>
            </div>
                      <!-- /.modal-content-->
          </div>
        </div>
      </form>
    @endforeach


    @foreach($Users as $User)
      <form action="/userinfo-Member" method="post">
        {{ csrf_field() }}

        <input type="hidden" name ="usid" id ="usid" value="{{$User->id}}">
        {{-- modal header reset password  --}}
        <div class="modal fade" id="myModalLabelresetpass{{$User->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Change Password</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              </div>
              <div class="modal-body">

                <div class="col-md-10 container">

                  <label for="name">New password</label>
                  <input class="form-control" id="npass" name ="npass" type="password" placeholder="New password..." value="" required>
                  <br>

                  <label for="name">Confirm New Password</label>
                  <input class="form-control" id="cpass" name ="cpass" type="password" placeholder="Confirm New Password..." value="" required>
                  <br>

                </div>

              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content-->
          </div>
          <!-- /.modal-dialog-->
        </div>
      </form>
    @endforeach

  </div>

      
@endsection

@section('script')
<script>
  $(document).off('change', '.pnt-chk').on('change', '.pnt-chk', e => {
    $('.role_id_value' + $(e.currentTarget).attr('data-id')).val($(e.currentTarget).is(":checked"));
    console.log($('.role_id_value' + $(e.currentTarget).attr('data-id')).val());
  })
</script>
@endsection












