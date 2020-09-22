@extends('layouts.master')

@section('pagetitle' , 'Orderfood')

@section('content')


    <div class="row">
        <div class="col-md-12 text-center">
            <p class="btn btn-dark actived h5">Quatity : {{$Carts->sum('quatity')}}</p>
            <p class="btn btn-dark h5">Price : {{$Carts->sum('totalprice') + $cartDetails->sum('total_price')}}  </p>
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

    {{-- btn category --}}
        <div class="row">
            <div class="col-md-6 mt-2">

                <a href="{{route('cart.CustomShow' , ['cat_id' => 0 , 'usid' => Auth::user()->id])}}" style='text-decoration:none;'>
                    <button class="btn btn-danger mr-2" type="button">All</button>
                </a>

                @foreach ($categories as $category)
                    <a href="{{route('cart.CustomShow' , ['cat_id' => $category->id , 'usid' => Auth::user()->id])}}" style='text-decoration:none;'>
                        <button class="btn btn-danger mr-2" type="button">{{$category->categoryname}}</button>
                    </a>
                @endforeach


            </div>

            <div class="col-md-6 mt-2">
                <div class="input-group">
                    <input type="text" class="form-control col-md-3 col-sm-12 ml-auto" placeholder="Search for..." aria-label="Search for...">
                    <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button">Go!</button>
                    </span>
                </div>
            </div>

        </div>
    {{-- btn category --}}


    {{-- Catelog --}}

        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card card-accent-danger">
                    <div class="card-header">Card with accent</div>

                    <div class="card-body">
                        <div class="row">

                            @foreach($products as $product)
        
                                <div class="col-sm-6 col-md-3">
                                    <div class="card">
                                        <div class="card-header">

                                            <strong class="mt-1 float-left">{{$product->name}}</strong>
                                            
                                            @if($product->product_type == 1)
                                                {{-- <span class="badge badge-pill badge-secondary float-right h6">Genaral Product</span> --}}
                                            @elseif($product->product_type == 2)
                                                <span class="badge badge-pill badge-success float-right h6">New Product</span>
                                            @else
                                                <span class="badge badge-pill badge-danger float-right h6">Recommended Product</span>
                                            @endif

                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <img src= "https://via.placeholder.com/250" />                                            
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">

                                                @php
                                                    $price = 0;
                                                @endphp

                                                @if($product->promotion->isNotEmpty())

                                                    @foreach($product->promotion as $promotion)
                                                        @if(\Carbon\Carbon::today() >= $promotion->start && \Carbon\Carbon::today() <= $promotion->end)
                                                            <strong class="h4 ml-3"> {{$promotion->discount}} </strong>
                                                            <span class="badge badge-pill badge-warning h6 ml-2">Promotion</span>
                                                            @php
                                                                $price = $promotion->discount;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                        
                                                @else
                                                    <strong class="h4 ml-3">{{$product->price}} </strong>
                                                    @php
                                                        $price = $product->price;
                                                    @endphp

                                                @endif


                                                @if($product->count_quatity == 0 && $product->active_count == 1)

                                                <button disabled class=" btn btn-sm btn-danger text-white mr-2 ml-auto" type="submit" >
                                                    Out of stock
                                                    <i class="fas fa-shopping-cart"></i>
                                                </button>


                                                @else

                                                <a class="mr-2 ml-auto" href="{{route('cart.CustomStore' , ['pid' => $product->id , 'usid' => Auth::user()->id , 'price' => $price])}}" style='text-decoration:none;'>
                                                    <button class=" btn btn-sm btn-info text-white  " type="submit" >
                                                        Add to Cart
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </button>
                                                </a>
                                                    

                                                @endif


                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

        </div>
    {{-- Catelog --}}


<button type="button"  class="btn btn-danger pnt-btn-out-card" style="position: fixed; top: 89px; right: 30px;" >
    Order 
    <i class="fas fa-shopping-cart"></i>
</button>


<div class="card card-accent-danger pnt-fix" style="position: fixed; top: 89px; right: 30px; width: 34rem; display: none;">
    <div class="card-header">

        <button type="button"  class="btn btn-danger pnt-btn-in-card mb-1" >hide</button>
        <span class="h4 ml-2">Order list</span>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-12 col-sm-12" style="overflow-x: scroll; height: 50vh">

                <table class="table table-responsive-sm table-sm">
                    <thead>
                      <tr>
                        <th>Order</th>
                        <th>Quatity</th>
                        <th>Price/unit</th>
                        <th>Price/Sum</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($Carts as $Cart)
                            <tr>
                                <td>
                                <strong>{{$Cart->productinfo->name}} </strong>  <br>

                                    @if(!$Cart->cartDetail->isEmpty())
                                        <strong class ="text-warning">Material : <br>
                                            @foreach($Cart->cartDetail as $cartDetail)
                                                {{$cartDetail->Material->materialname}} 
                                                {{$cartDetail->price}}
                                                <br>
                                            @endforeach
                                        </strong>
                                    @endif

                                    @if($Cart->note != "")
                                        <strong class ="text-danger">Hashtag : <br> 
                                            {{$Cart->note}} 
                                        </strong>
                                    @endif

                                </td>
            
                                <td> 
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        @if($Cart->quatity <= 1)
                                        @php $des_minus ="disabled"; @endphp
                                        @else
                                        @php $des_minus =""; @endphp
                                        @endif
            
                                        @if($Cart->quatity >= $Cart->productinfo->count_quatity && $Cart->productinfo->active_count == 1)
                                            @php $des_plus ="disabled"; @endphp
                                        @else
                                            @php $des_plus =""; @endphp
                                        @endif

                                        <a href="">

                                        </a>

                                        <form action="{{ action('CartController@UpdateQuatity' , [$Cart->id] )}}" method="post">
                                            {{ csrf_field() }}

                                            <input type="hidden" name ="usid" value ="{{Auth::user()->id}}">

                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button {{$des_minus}} class="btn btn-warning btn-sm text-white" name = "Value" value = "0" type="submit" ><i class="fas fa-minus fa-1x"></i></button>
                                                <strong class="text-dark mr-3 ml-3 mt-1"> {{$Cart->quatity}} </strong>
                                                <button {{$des_plus}} class="btn btn-warning btn-sm text-white"  name = "Value" value = "1" type="submit" ><i class="fa fa-plus fa-1x"></i></button>
                                            </div>

                                        </form>
            

                                    </div>
                                </td>
                                <td> <strong> {{$Cart->price}} </strong> </td>

                                @php
                                    $sumMate = 0;
                                @endphp

                                @foreach($cartDetails as $cartDetail)

                                    @if($cartDetail->cart_id == $Cart->id)

                                        @php
                                            $sumMate += $cartDetail->total_price;
                                        @endphp

                                    @endif
                                        
                                @endforeach

                                <td> <strong> {{$Cart->totalprice+$sumMate}}</strong> </td>
                                {{-- --- --}}

                                <td>
                                    <div class="btn-group mr-1" role="group" aria-label="First group">
                                        <button class="btn btn-sm btn-secondary mb-1 mr-2 text-white" type="button" data-toggle="modal" data-target="#myModalmaterrial{{$Cart->id}}"> 
                                            <i class="fas fa-plus"></i>
                                        </button>
            
                                        <button class="btn btn-sm btn-info mb-1 mr-2 text-white" type="button" data-toggle="modal" data-target="#myModalhastag{{$Cart->id}}"> 
                                            <i class="fas fa-comment-alt"></i>
                                        </button>

                                        <a href="{{route('cart.CustomDelCart' , [ 'usid' => Auth::user()->id , 'cartid' => $Cart->id ])}}" style='text-decoration:none;'>
                                            <button class="btn btn-sm btn-danger mb-1 mr-2 text-white"> 
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </a>



                                    </div>
                                </td>
                                {{-- --- --}}
                            </tr>
                        @endforeach
                    </tbody>

        
                    @if($Carts->isEmpty())
                        <input type="hidden" class ="pnt-check-Cart" value="0">
                    @else
                        <input type="hidden" class ="pnt-check-Cart" value="1">        
                    @endif
        
                    <tbody>
                    </tbody>
                </table>

            </div>

        </div>


        <div class="row">
            <div class="col-md-9 col-sm-12 mt-2">

                <button class="btn btn-block btn-primary mr-2" type="button" data-toggle="modal" data-target="#largeModal">Confirm Order</button>

            </div>
            <div class="col-md-3 col-sm-12 mt-2">
                <a href="{{route('cart.CustomClear' , ['usid' => Auth::user()->id ])}}" style='text-decoration:none;'>
                    <button class="btn btn-block btn-danger mr-2" type="button">Clear</button>
                </a>
            </div>
        </div>

    </div>
</div>

{{-- modal Confirm --}}
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Confirm Order</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12 col-sm-12">

                        <table class="table table-responsive-sm text-center">
                            <thead>
                              <tr>
                                <th>Order</th>
                                <th>Quatity</th>
                                <th>Price / unit</th>
                                <th>Price / Sum</th>
                                <th>Note</th>
                              </tr>
                            </thead>

                            <tbody>
                                @foreach($Carts as $Cart)
                                    <tr>
                                        <td>
                                            <strong>{{$Cart->productinfo->name}} </strong> <br>
                                            @if($Cart->note != "")
                                                <strong class ="text-danger">{{$Cart->note}} </strong>
                                            @endif
            
                                        </td>
                    
                                        <td> 
                                            <strong> {{$Cart->quatity}} </strong>
                                        </td>

                                        <td> 
                                            <strong> {{$Cart->price}} </strong> 
                                        </td>
            
                                        <td> 
                                            <strong> {{$Cart->totalprice}}</strong> 
                                        </td>

                                        <td>
                                            @foreach($products as $product)
            
                                                @if($product->promotion->isNotEmpty() && $product->id == $Cart->productinfo_id)
            
                                                    @foreach($product->promotion as $promotion)
                                                        @if(\Carbon\Carbon::today() >= $promotion->start && \Carbon\Carbon::today() <= $promotion->end)
                                                            <span class="badge badge-pill badge-warning">Promotion</span>
                                                        @endif
                                                    @endforeach
                                                                    
                                                @endif
            
                                            @endforeach
                                        </td>

                                        @foreach($Cart->cartDetail as $cartDetail)

                                            <tr>
                                                <td>
                                                    <strong class ="text-warning">+ {{$cartDetail->Material->materialname}} </strong>
                                                </td>

                                                <td>
                                                    <strong> {{$Cart->quatity}} </strong>
                                                </td>

                                                <td>
                                                    <strong class ="text-warning">{{$cartDetail->price}}</strong>
                                                </td>

                                                <td>
                                                    <strong class ="text-warning">{{$cartDetail->total_price}}</strong>
                                                </td>

                                                <td>
 
                                                </td>

                                            </tr>

                                        @endforeach

                                        @php
                                            $sumMate = 0;
                                        @endphp
            
                                        @foreach($cartDetails as $cartDetail)
            
                                            @if($cartDetail->cart_id == $Cart->id)
            
                                                @php
                                                    $sumMate += $cartDetail->total_price;
                                                @endphp
            
                                            @endif
                                                
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td><strong class ="text-success">SUM</strong></td>
                                            <td><strong class ="text-success">{{$Cart->totalprice + $sumMate}}</strong></td>
                                            <td></td>
                                        </tr>
                                                
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>
                </div>

            </div>

            <div class="modal-footer">

                <button class="btn btn-primary" type="button">Confirm</button>  
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>

            </div>
        </div>
        <!-- /.modal-content-->
        </div>
        <!-- /.modal-dialog-->
    </div>
{{-- modal Confirm --}}

{{-- modal materrial --}}


    @foreach($Carts as $Cart)
        <form action="cartDetail" method="post">
        {{ csrf_field() }}
            <div class="modal fade" id="myModalmaterrial{{$Cart->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">Materrial</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                    </div>
                    <div class="modal-body">

                        <table class="table table-borderless text-center">

                            <thead>
                            <tr>
                                <th>material</th>
                                <th>Price</th>
                                <th>Check</th>
                            </tr>
                            </thead>
            
                            <tbody>
    
                                @foreach ($materials as $material)
        
                                    <tr>
                                        <td>{{$material->materialname}}</td>
                                        <td>{{$material->materialprice}}</td>
                                        <td>

                                            @php
                                                $chk = 'false';
                                            @endphp
                                            
                                            @foreach ($cartDetails as $cartDetail)
                                                
                                                @if ($material->id == $cartDetail->material_id && $cartDetail->cart_id == $Cart->id)
            
                                                    @php
                                                        $chk = 'true';
                                                    @endphp
            
                                                @endif
            
                                            @endforeach

                                            <input type="hidden" id="cart_id" name ="cart_id" value="{{$Cart->id}}">
                                            <input type="hidden" id="materialprice" name ="materialprice[{!! $material->id !!}]" value="{{$material->materialprice}}">

                                            <input type="hidden" id="user_id" name ="user_id" value="{{Auth::user()->id}}">
                                            <input type="hidden" class="material_id_value{!! $material->id !!}" name ="material_id_value[{!! $material->id !!}]" value="{!! $chk !!}">
                        
                                            <label class="c-switch c-switch-label c-switch-danger">
                                                <input {{ $chk == 'true' ? 'checked=""' : '' }} type="checkbox" class="c-switch-input pnt-chk" id="material_id" data-id="{!! $material->id !!}" "> <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                                            </label>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
            
                        </table>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                    
                </div>
                <!-- /.modal-content-->
                </div>
                <!-- /.modal-dialog-->
            </div>
        </form>
    @endforeach

{{-- modal materrial --}}


 {{-- modal hastag --}}
    @foreach($Carts as $Cart)
        <form action="/Updatehashtag+{{$Cart->id}}" method="get">
            <div class="modal fade" id="myModalhastag{{$Cart->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Hashtag</h4>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            @foreach($hashtags as $hashtag)
                                <button type="button"  class="btn btn-lg btn-danger mb-2 pnt-add-text{{$hashtag->id}}" data-id ="{{$hashtag->id}}" data-value="{{$hashtag->hashtagname}}" >#{{$hashtag->hashtagname}}</button>
                            @endforeach
                            <input type="hidden" id="user_id" name ="user_id" value="{{Auth::user()->id}}">
                            <input class="form-control pnt-input-text" id="hashtagname" name="hashtagname" type="text" placeholder="Enter Hashtag" required>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                    <!-- /.modal-content-->
                </div>
                <!-- /.modal-dialog-->
            </div>
        </form>
    @endforeach
 {{-- modal hastag --}}





@endsection


@section('script')
<script>
    let text = "";

    @foreach($hashtags as $hashtag)
        $('.pnt-add-text{{$hashtag->id}}').click(function(e)
            {
                text += "#";
                text += $(e.currentTarget).attr('data-value');
                $('.pnt-input-text').val(text);
                text += " ";
                console.log(text);
            } 
        );
    @endforeach
    
    if($('.pnt-check-Cart').val() == 1)
    {
        $('.pnt-fix').show(800);
        $('.pnt-btn-out-card').hide(400);
        $('.pnt-btn-in-card').show(800);
    }


    $('.pnt-btn-out-card').click(function()
        {
            $('.pnt-fix').show(500);
            $('.pnt-btn-out-card').hide(500);
            $('.pnt-btn-in-card').show(500);
        }
    );

    $('.pnt-btn-in-card').click(function()
        {
            $('.pnt-fix').hide(500);
            $('.pnt-btn-out-card').show(500);
            $('.pnt-btn-in-card').hide(500);
        }
    );

    $(document).off('change', '.pnt-chk').on('change', '.pnt-chk', e => {
    $('.material_id_value' + $(e.currentTarget).attr('data-id')).val($(e.currentTarget).is(":checked"));

  })

</script>
@endsection