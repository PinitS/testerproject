@extends('layouts.master')

@section('pagetitle' , 'roles')

@section('content')


<div class="card card-accent-info">

  <div class="card-body">
    
    <div class="row">
      <div class="col-md-6 col-md-6">
          #Role Information 
      </div>

      <div class="col-md-6">

        @if($keywords != null)
          <button class="btn btn-info mb-1 pnt-add-btn" type="button" data-toggle="modal" data-target="#largeModal"><i class="fa fa-plus"></i> Add Roles</button>
        @endif

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
          <th>keywords</th>
          <th>Roles name</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>

        @foreach($roles as $role)
        <form action="{{ route('role.destroy', [$role->id]) }}" method="POST">
          {{ method_field('DELETE') }}
          {{ csrf_field() }}
          <tr>
            <td>{{$role->id}}</td>
            <td>{{$role->keyword}}</td>
            <td>{{$role->rolename}}</td>
            <td>

              <button class="btn btn-sm btn-warning mb-1 text-white" type="button" data-toggle="modal" data-target="#largeModal{{$role->id}}">
                <i class="fas fa-edit"></i>
              </button>

              <button class="btn btn-sm btn-danger mb-1 text-white"> 
                <i class="fas fa-times fa-lg"></i>
              </button>
            </td>
          </tr>
        </form>
        @endforeach

      </tbody>
    </table>
    

  </div>

  <form action="role" method="post">

    {{ csrf_field() }}
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add Roles</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <!-- add form -->
            <p>Add Role</p>
            

            <select class="form-control mb-4" id= "keyword" name ="keyword">
              @foreach ($keywords as $keyword)

                <option value="{{$keyword}}">{{$keyword}}</option>
                
              @endforeach
            </select>

          
            <!-- add form -->

            <p>#Role Name...</p>
            <div class="input-group">
              {{-- <div class="input-group-prepend"><span class="input-group-text" id="btnGroupAddon">#</span></div> --}}
              <input class="form-control" type="text" id = "rolename" name = "rolename" required placeholder="Roles Name..." aria-label="Input group example" aria-describedby="btnGroupAddon">
            </div>

          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            <button class="btn btn-info" type="submit">Save</button>
          </div>
        </div>
                  <!-- /.modal-content-->
      </div>
    </div>

  </form>

  

  @foreach($roles as $role)



    <form action="{{ action('RoleController@update' , [$role->id] )}}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name = "_method" value = "PUT">

      <div class="modal fade" id="largeModal{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">edit</h4>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <!-- add form -->
              <p>#Role name</p>
              <div class="input-group">
                {{-- <div class="input-group-prepend"><span class="input-group-text" id="btnGroupAddon">#</span></div> --}}
                <input class="form-control" type="text" id = "rolenameupdate" name = "rolenameupdate" required value = "{{$role->rolename}}" aria-label="Input group example" aria-describedby="btnGroupAddon">
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


</div>

    
@endsection

@section('script')
  <script>

  </script>

@endsection