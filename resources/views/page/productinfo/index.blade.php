@extends('layouts.master')

@section('pagetitle' , 'productinfomation')

@section('content')


<div class="card card-accent-info">

  <div class="card-body">
    
    <div class="row">
      <div class="col-md-6 col-md-6">
          Product Information 
      </div>

      <div class="col-md-6">
        <button class="btn btn-info mb-1" type="button" data-toggle="modal" data-target="#largeModal"><i class="fa fa-plus"></i> Add Product</button>
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
        @elseif(Session::has('info'))
          <div class="alert alert-info"> <h5 class="alert-heading"> {{Session::get('info')}} </h5> </div>   
        @endif

      </div>
 
    </div>
    


    <table class="table table-responsive-md table-striped ">
      <thead>
        <tr>
          <th>#</th>
          <th>Category</th>
          <th>Name</th>
          <th>Quatity</th>
          <th>Cost</th>
          <th>Price</th>
          <th>Active</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>

        @foreach($products as $product)

          <tr>

            <td>{{$product->id}}</td>
            @if($product->category_id >0)
              <td>{{$product->category->categoryname}}</td>
            @else
              <td><span class="text-danger">No Category</span></td>
            @endif

            <td>{{$product->name}}</td>

            @if($product->active_count == 0)
              <td><span class="text-danger">Product doesn't count</span></td>
            @else
              <td>

                <div class="btn-group" role="group" aria-label="Basic example">
                  @if($product->count_quatity == 0)
                    @php $des ="disabled"; @endphp
                  @else
                    @php $des =""; @endphp
                  @endif
                  <button {{$des}} class="btn btn-warning btn-sm text-white" type="button" data-toggle="modal" data-target="#warningModaledit{{$product->id}}"><i class="fas fa-pencil-alt"></i></button>
                  <span class="text-dark mr-3 ml-3 mt-1"> {{$product->count_quatity}} </span>
                  <button class="btn btn-warning btn-sm text-white" type="button" data-toggle="modal" data-target="#warningModalplus{{$product->id}}"><i class="fa fa-plus fa-1x"></i></button>
                </div>

              </td>
            @endif

            <td>{{$product->cost}}</td>
            <td>{{$product->price}}</td>

            <td>
              @php
              $chk ="";
              @endphp
              @if($product->active == 1)
                @php
                  $chk ='checked =""';
                @endphp
              @endif

              <label class="c-switch c-switch-label c-switch-warning mr-2 mt-1">
                <input {{$chk}} onchange = "window.location.href='{{ route('productinfo.changeactive', ['active' => $product->active ,'pid'=> $product->id]) }}' " class="c-switch-input" type="checkbox"><span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
              </label>

            </td>

            <td>


              <form action="{{ route('productinfo.destroy', [$product->id]) }}" method="POST">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}

                <div class="row">

                  <button class="btn btn-sm btn-info mb-1 mr-2 text-white" type="button" data-toggle="modal" data-target="#largeModalCheckQuatity{{$product->id}}">
                    <i class="fas fa-book-open"></i>
                  </button>


                  @if($product->active == 1)
                  
                  <select class="form-control col-sm-4 col-md-4 mr-2 pnt-drop-down" data-id={!! $product->id !!} id="type" name ="type">
                    @foreach($product_types as $key => $value)
                      @if($key == $product->product_type)
                        <option selected value="{{$key}}">{{$value}}</option>
                      @else
                        <option  value="{{$key}}">{{$value}}</option>
                      @endif
    
                    @endforeach
                  </select>

                  <button class="btn btn-sm btn-warning mb-1 mr-2 text-white" type="button" data-toggle="modal" data-target="#largeModal{{$product->id}}">
                    <i class="fas fa-edit"></i>
                  </button>

                  <button class="btn btn-sm btn-info mb-1 mr-2 text-white" type="button" data-toggle="modal" data-target="#largeModalCheckPromotion{{$product->id}}">
                    <i class="fas fa-newspaper"></i>
                  </button>

                  @endif


                  <button class="btn btn-sm btn-danger mb-1 mr-2 text-white"  type="submit">
                    <i class="fas fa-times fa-lg fa-lg"></i>
                  </button>

                </div>

              </form>


                

              {{-- <button class="btn btn-sm btn-warning mb-1 text-white" type="button" data-toggle="modal" data-target="#largeModal{{$hashtag->id}}">
                <i class="fas fa-share-square fa-lg"></i>
              </button> --}}


            </td>
          </tr>

        @endforeach

      </tbody>
    </table>
    
  </div>

  {{-- modal addproduct --}}
    <form action="productinfo" method="post">

      {{ csrf_field() }}
      <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Product</h4>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <!-- add form -->
              <div class="row text-center">

                <div class="col-md-8 container mt-2">
                  <label for="category">Categories</label>
                  <select class="form-control" id="category" name ="category">
                    <option value="0">No job Category</option>
                    @foreach($categories as $category)
                      <option value="{{$category->id}}">{{$category->categoryname}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-8 container mt-3">
                  <label for="category">Type</label>
                  <select class="form-control" id="active_count" name ="active_count">
                    <option value="0">Product doesn't count</option>
                    <option value="1">Product count quantity</option>
                  </select>
                </div>

                <div class="col-md-12 mt-2">
                  <hr>
                </div>


                <div class="col-md-6 mt-2">
                  <p>Product name</p>
                  <input class="form-control" type="text" id = "productname" name = "productname" required value = ""  placeholder="productname">
                </div>

                <div class="col-md-6 mt-2">
                  <p>Cost</p>
                  <input class="form-control" type="number" id = "cost" name = "cost" required value = "" placeholder="cost">
                </div>

                <div class="col-md-6 mt-2">
                </div>

                <div class="col-md-6 mt-2">
                  <p>Price</p>
                  <input class="form-control" type="number" id = "price" name = "price" required value = "" placeholder="Price">
                </div>


              </div>


            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
              <button class="btn btn-info" type="submit">Save</button>
            </div>
          </div>

        </div>
      </div>

    </form>
  {{-- end modal addproduct --}}
    
    {{-- modal product-edit --}}
      @foreach($products as $product)

        <form action="{{ action('ProductinfoController@update' , [$product->id] )}}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name = "_method" value = "PUT">

          <div class="modal fade" id="largeModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">edit</h4>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">
                  <!-- add form -->
                  <div class="row text-center">

                    <div class="col-md-8 container mt-2">
                      <label for="category">Categories</label>
                      <select class="form-control" id="category" name ="category">
                        <option value="0">No job Category</option>
                        @foreach($categories as $category)    
                          @php $sel =""; @endphp

                          @if($product->category_id == $category->id)

                          @php $sel ="selected"; @endphp 

                          @endif

                          <option {{$sel}} value="{{$category->id}}">{{$category->categoryname}}</option>
                        @endforeach
                        
                      </select>
                    </div>
      
                    <div class="col-md-8 container mt-3">
                      <label for="category">Type</label>
                      <select class="form-control" id="active_count" name ="active_count">
                        @if($product->active_count == 0)
                          <option selected value="0">Product doesn't count</option>
                          <option value="1">Product count quantity</option>
                        @else
                          <option value="0">Product doesn't count</option>
                          <option selected value="1">Product count quantity</option>
                        @endif
                      </select>

                    </div>
      
                    <div class="col-md-12 mt-2">
                      <hr>
                    </div>
      
                    <div class="col-md-6 mt-2">
                      <p>Product name</p>
                    <input class="form-control" type="text" id = "productname" name = "productname" required placeholder="productname" value="{{$product->name}}">
                    </div>
      
                    <div class="col-md-6 mt-2">
                      <p>Cost</p>
                      <input class="form-control" type="number" id = "cost" name = "cost" required placeholder="cost" value="{{$product->cost}}">
                    </div>
      
                    <div class="col-md-6 mt-2">
                    </div>
      
                    <div class="col-md-6 mt-2">
                      <p>Price</p>
                      <input class="form-control" type="number" id = "price" name = "price" required placeholder="Price" value="{{$product->price}}">
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
    {{-- end modal product-edit --}}



    {{-- modal count_quatity --}}
      @foreach($products as $product)

        <form action="{{ action('ProductinfoController@updatecount_product' , [$product->id] )}}" method="get">
          {{ csrf_field() }}

          <div class="modal fade" id="warningModalplus{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-warning" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add Count Product</h4>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">

                  <div class="col-md-12 mt-2 mb-2 text-center">
                    <p>Quatity</p>

                    <input type="hidden" name ="typereport" value="0">

                    <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text" id="btnGroupAddon"><i class="fa fa-plus"></i></span></div>
                      <input  class="form-control" type="number" id = "count_quatity" name = "count_quatity" required value="0" placeholder="Input group example" aria-label="Input group example" aria-describedby="btnGroupAddon">
                    </div>

                  </div>
                  
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                  <button class="btn btn-warning" type="submit">Save</button>
                </div>
              </div>
              <!-- /.modal-content-->
            </div>
            <!-- /.modal-dialog-->
          </div>
        </form>

      @endforeach
    {{-- modal count_quatity --}} 


    {{--edit update modal count_quatity --}}
      @foreach($products as $product)

        <form action="{{ action('ProductinfoController@updatecount_product' , [$product->id] )}}" method="get">
          {{ csrf_field() }}

          <div class="modal fade" id="warningModaledit{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-warning" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Edit Count Product</h4>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">

                  <div class="col-md-12 mt-2 mb-2 text-center">
                    <p>Quatity</p>

                    <input type="hidden" name ="typereport" value="1">

                    <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text" id="btnGroupAddon"><i class="fas fa-pencil-alt"></i></span></div>
                      <input class="form-control" type="number" id = "count_quatity" name = "count_quatity" required value="{{$product->count_quatity}}" placeholder="Input group example" aria-label="Input group example" aria-describedby="btnGroupAddon">
                    </div>
                    
                  </div>
                  
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                  <button class="btn btn-warning" type="submit">Save</button>
                </div>
              </div>
              <!-- /.modal-content-->
            </div>
            <!-- /.modal-dialog-->
          </div>
        </form>

      @endforeach
    {{--edit update modal count_quatity --}} 


  {{-- modal Change Quatity --}}

    @foreach($products as $product)
      
        <div class="modal fade" id="largeModalCheckQuatity{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Report Change Quatity</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              </div>
              <div class="modal-body">
                <!-- add form -->

                <table class="table Striped Table">

                  <thead>
                    <tr>
                      <td>#</td>
                      <td>Old_Quatity</td>
                      <td>Quatity</td>
                      <td>Type</td>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach($product->quatityreport as $report)

                      <tr>
                        <td>{{$report->created_at->format('d M Y')}}</td>
                        <td>{{$report->old_quatity}}</td>
                        <td>{{$report->quatity}}</td>
                        @if($report->type == 0)
                        <td><span class ="text-info">Add</span></td>
                        @else
                        <td><span class ="text-warning">Edit</span></td>
                        @endif
                      </tr>

                    @endforeach
                  </tbody>
                </table>
            


              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>

    @endforeach
  {{-- end modal Change Quatity --}}

  {{-- modal Check Promotion --}}

    @foreach($products as $product)

    <form action="promotion" method="post">
      {{ csrf_field() }}
        
      <div class="modal fade" id="largeModalCheckPromotion{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Promotion</h4>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <!-- add form -->
              <div class="row">

                <div class="col-md-8 container-fluid text-center">
                  <input type="hidden" id ="product_id" name ="product_id" value="{{$product->id}}">
                  <input type="hidden" id ="sdate" name ="sdate" value="<?php echo date('Y-m-d') ?>">
                  <input type="hidden" id ="edate" name ="edate" value="<?php echo date('Y-m-d') ?>">

                  <div class="row">
                    <div class="col-md-8 ">
                      <label for="daterange">Select Date</label>
                      <input class="form-control" type="text" name="daterange" value="<?php echo date('Y-m-d') ?>" />
                    </div>
    
                    <div class="col-md-4 ">
    
                      <label for="promotionprice">Price</label>
                      <input class="form-control" id="promotionprice" type="number" name="promotionprice" placeholder="promotionprice" required value="">
    
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <button class=" btn btn-block btn-info mt-4" type="submit" ><i class="fa fa-plus"></i> Add Promotion</button>                  
                      </div>
                    </div>

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-md-12">

                  <table class="table table-responsive-sm">
                    <thead>
                      <tr>
                        <th>StartDate</th>
                        <th>EndDate</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach($product->promotion as $promotion)

                      <tr>
                        <td>{{\Carbon\Carbon::parse($promotion->start)->format('d/m/Y')}}</td>
                        <td>{{\Carbon\Carbon::parse($promotion->end)->format('d/m/Y')}}</td>
                        <td>{{$promotion->discount}}</td>

                        @if($promotion->active == 0)
                          <td><span class="badge badge-secondary">Inactive</span></td>                   
                        @else

                          @if(\Carbon\Carbon::today() > $promotion->end)
                            <td><span class="badge badge-danger">Banned</span></td>
                          @else

                            @if(\Carbon\Carbon::today() < $promotion->start)
                              <td>{{\Carbon\Carbon::parse($promotion->start)->diffForHumans()}}</td>
                            @else
                              <td><span class="badge badge-success">Active</span></td>
                            @endif

                          @endif
                          
                        @endif

                        <td>

                          @php
                            $chkpromotion ="";
                            $chkdel ="";
                          @endphp

                          @if($promotion->active == 1)
                            @php
                              $chkpromotion ='checked =""';
                              $chkdel = "disabled";
                            @endphp
                          @endif  

                          <div class="row">
                            <label class="c-switch c-switch-label c-switch-info mr-2">
                              <input {{$chkpromotion}} onchange = "window.location.href='{{ route('promotion.activepromotion', ['active' => $promotion->active ,'id'=> $promotion->id]) }}' " class="c-switch-input" type="checkbox"><span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                            </label>
        
                            <a href="{{ route('promotion.CustomDelPro', ['id' => $promotion->id , 'active' => $promotion->active] ) }}">
                              <button {{$chkdel}} type = "button" class = "btn btn-sm btn-danger mb-5">Delete</button>
                            </a>
                          </div>

                            
                          
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
            </div>
          </div>

        </div>
      </div>
    </form>

    @endforeach
  {{-- end modal Check Promotion --}}

  


</div>

    

@endsection

@section('script')

  <script>

    $('.pnt-drop-down').change(function(e)
      {
        let product_id = $(e.currentTarget).attr('data-id');
        let product_type_value = $(e.currentTarget).val();
        console.log("/productinfo+"+ product_type_value +"+" + product_id);
        window.location.href = "/productinfo+"+ product_type_value +"+" + product_id;
      }
    );

    $(function() {
    $('input[name="daterange"]').daterangepicker({
      opens: 'left'
    }, function(start, end, label) 
    {
      $('input[name="sdate"]').val(start.format('YYYY-MM-DD'));

      $('input[name="edate"]').val(end.format('YYYY-MM-DD'));

      console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
  });

  </script>

@endsection