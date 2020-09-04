@extends('layouts.master')

@section('pagetitle' , 'hashtag')

@section('content')


<div class="card card-accent-info">

  <div class="card-body">
    <div class="float-left h2"># Hashtag information 
      <p class ="mt-3 h2"> Show
    </div>
    <div class="float-right">  

      <button class="btn btn-info mb-1" type="button" data-toggle="modal" data-target="#largeModal"><i class="fa fa-plus"></i> Add Hashtag</button>
      <br>

      <div class="input-group mt-3">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search for...">
        <span class="input-group-btn">
          <button class="btn btn-secondary" type="button">Go!</button>
        </span>
      </div>
      
    </div>

    <table class="table table-responsive-sm table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Hashtag information </th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>

        <tr>
          <td>1</td>
          <td>2012/01/01</td>
          <td><span class="badge badge-success">Active</span></td>
        </tr>

      </tbody>
    </table>

  </div>

  <form action="/member" method="post">

    {{ csrf_field() }}
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add Hashtag</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <!-- add form -->
            <p>#Hashtag Name...</p>
            <div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text" id="btnGroupAddon">#</span></div>
              <input class="form-control" type="text" placeholder="Hashtag Name..." aria-label="Input group example" aria-describedby="btnGroupAddon">
            </div>

          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            <button class="btn btn-info" type="button">Save</button>
          </div>
        </div>
                  <!-- /.modal-content-->
      </div>
                <!-- /.modal-dialog-->
    </div>
    
  </form>


</div>

    

@endsection