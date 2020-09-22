@extends('layouts.master')

@section('pagetitle' , 'Material Infomation')

@section('content')

  
<div class="card card-accent-info">

    <div class="card-body">
      
      <div class="row">
        <div class="col-md-6 col-md-6">
            Material information 
        </div>
  
        <div class="col-md-6">
          <button class="btn btn-info mb-1" type="button" data-toggle="modal" data-target="#largeModal"><i class="fa fa-plus"></i> Add Material</button>
        </div>
      </div>
  
      <div class="row mt-1">
        <div class="col-md-6">
            Show
        </div>
  
        <div class="col-md-6">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for..." aria-label="Search for...">
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
            <th>Material name</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
        </thead>
  
        <tbody>
  
          @foreach($materials as $material)
          <form action="{{ route('material.destroy', [$material->id]) }}" method="POST">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <tr>
              <td>{{$material->id}}</td>
              <td>{{$material->materialname}}</td>
              <td>{{$material->materialprice}}</td>
              <td>
  
                <button class="btn btn-sm btn-warning mb-1 text-white" type="button" data-toggle="modal" data-target="#largeModal{{$material->id}}">
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
  
    <form action="material" method="post">
  
      {{ csrf_field() }}
      <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Material</h4>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <!-- add form -->
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="name">Material Name</label>
                    <input class="form-control" id="materialname" name = "materialname" type="text" required placeholder="Enter Material Name..">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="name">Material Price</label>
                    <input class="form-control" id="materialprice" name = "materialprice" type="number" required placeholder="Enter Material Price..">
                  </div>
                </div>
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
  
    
  
    @foreach($materials as $material)
  
  
  
      <form action="{{ action('MaterialController@update' , [$material->id] )}}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name = "_method" value = "PUT">
  
        <div class="modal fade" id="largeModal{{$material->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">edit</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              </div>
              <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="name">Material Name</label>
                        <input class="form-control" id="materialname" name = "materialname" type="text" required value = "{{$material->materialname}}">
                      </div>
                    </div>
                    
                    </div>
        
                    <div class="row">
                        <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Material Price</label>
                            <input class="form-control" id="materialprice" name = "materialprice" type="number" required value = "{{$material->materialprice}}">
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
  
    
  
  
  </div>
  
      
  
  @endsection