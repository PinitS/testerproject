@extends('layouts.master')

@section('pagetitle' , 'hashtag')

@section('content')


<div class="card card-accent-info">

  <div class="card-body">
    
    <div class="row">
      <div class="col-md-6 col-md-6">
          #Job Information 
      </div>

      <div class="col-md-6">
        <button class="btn btn-info mb-1" type="button" data-toggle="modal" data-target="#largeModal"><i class="fa fa-plus"></i> Add Job</button>
      </div>
    </div>

    <div class="row mt-1">
      <div class="col-md-6">
          #Show
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
        @endif

      </div>
 
    </div>
    


    <table class="table table-responsive-sm-12 table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Hashtag name</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>

        @foreach($hashtags as $hashtag)
        <form action="{{ route('hashtag.destroy', [$hashtag->id]) }}" method="POST">
          {{ method_field('DELETE') }}
          {{ csrf_field() }}
          <tr>
            <td>{{$hashtag->id}}</td>
            <td>{{$hashtag->hashtagname}}</td>
            <td>

              <button class="btn btn-sm btn-warning mb-1 text-white" type="button" data-toggle="modal" data-target="#largeModal{{$hashtag->id}}">
                <i class="fas fa-share-square"></i>
              </button>

              <button class="btn btn-sm btn-danger mb-1 text-white"> 
                <i class="fas fa-times"></i>
              </button>
            </td>
          </tr>
        </form>
        @endforeach

      </tbody>
    </table>
    
    <nav aria-label="...">
      <ul class="pagination">
        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item active"><a class="page-link" href="#">2<span class="sr-only">(current)</span></a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li>
      </ul>
    </nav>

  </div>

  <form action="hashtag" method="post">

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
              <input class="form-control" type="text" id = "hashtagname" name = "hashtagname" required placeholder="Hashtag Name..." aria-label="Input group example" aria-describedby="btnGroupAddon">
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

  

  @foreach($hashtags as $hashtag)



    <form action="{{ action('HashtagController@update' , [$hashtag->id] )}}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name = "_method" value = "PUT">

      <div class="modal fade" id="largeModal{{$hashtag->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">edit</h4>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <!-- add form -->
              <p>#hashtag name</p>
              <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text" id="btnGroupAddon">#</span></div>
                <input class="form-control" type="text" id = "hashtagname" name = "hashtagname" required value = "{{$hashtag->hashtagname}}" aria-label="Input group example" aria-describedby="btnGroupAddon">
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