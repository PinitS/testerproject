@extends('layouts.master')

@section('pagetitle' , 'Order')

@section('content')

    <div class="row">
        <div class="col-md-7 col-sm-12">

            <div class="card border-info">
                <div class="card-header">

                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <strong class=""> Order list</strong>
                    </div>


                    <div class="col-md-6 col-sm-6 ">
                      <a href="{{ route('order.CustomNewOrder', ['usid' => Auth::user()->id ]) }}">
                        <button class="btn btn-sm btn-info float-md-right float-sm-right" type="button">
                          <i class="fa fa-plus"></i> Add Order
                        </button>
                      </a>
                    </div>

                  </div>
                  
                </div>

                <div class="card-body">

                    <table class="table table-borderless table-striped text-center">
                      <thead>
                        <tr>
                          <th>date/time</th>
                          <th>Order</th>
                          <th>Queue</th>
                          <th>Status</th>
                        </tr>
                      </thead>

                      <tbody>
                        @php
                          $cnt = 0;
                        @endphp

                        @foreach($Orders as $Order)

                          @if($Order->status == 0)

                            @php
                              $cnt++;
                            @endphp

                            <tr>
                              <td> <strong> {{$Order->created_at}} </strong> </td>
                              <td> <strong> {{$Order->id}} </strong> </td>
                              <td> <strong class="text-success"> {{$cnt}} </strong> </td>
                              <td>
                                <form action="/cashier+{{$Order->id}}" method="get">

                                  <button type="submit"  class="btn btn-sm btn-success pnt-send-value">Serving</button>

                                </form>
                              </td>

                              <td>
                                
                                <a href="">

                                  <button class="btn btn-sm btn-warning float-md-left float-sm-left mr-md-3" type="button">
                                    <i class="fa fa-plus"></i> Order more
                                  </button>

                                </a>

                                @if($Order->orderSet->first()->orderDetail->isEmpty())

                                  <a href="">

                                    <button class="btn btn-sm btn-dark float-md-left float-sm-left  " type="button">
                                      <i class="fa fa-ban"></i> Close bill
                                    </button>
                                    
                                  </a>
                                @endif



                              </td>

                            </tr>

                          @endif

                        @endforeach
                      </tbody>

                    </table>

                </div>
            </div>
        </div>

        <div class="col-md-5 col-sm-12">
          <div class="card border-danger">
              <div class="card-header">Order list

              </div>
              <div class="card-body">

                @if($OrderDetails->isEmpty())

                asdasdasd

                @else

                <table class="table table-sm table-borderless text-center">

                  <thead>
                    <tr>
                      <th>Order</th>
                      <th>Quatity</th>
                      <th>Price/Unit</th>
                      <th>Price/SUM</th>
                      <th>Note</th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach($OrderDetails as $OrderDetail)
                      <tr>
                        <td> <strong>{{$OrderDetail->productname}}</strong></td>
                        <td> <strong>{{$OrderDetail->quatity}}</strong></td>
                        <td> <strong>{{$OrderDetail->price}}</strong></td>
                        <td> <strong>{{$OrderDetail->totalprice}}</strong></td>

                        @if(!$OrderDetail->orderDetailmaterial->isEmpty())
                        

                          @foreach($OrderDetail->orderDetailmaterial as $material)
                            <tr>
                              <td>
                                  <strong class ="text-warning">+ {{$material->Material->materialname}} </strong>
                              </td>

                              <td>
                                  <strong> {{$material->quatity}} </strong>
                              </td>

                              <td>
                                  <strong class ="text-warning">{{$material->price}}</strong>
                              </td>

                              <td>
                                  <strong class ="text-warning">{{$material->total_price}}</strong>
                              </td>

                              <td>

                              </td>

                            </tr>
                            
                          @endforeach

                          
                        @endif

                        <td> 

                          @if($OrderDetail->textpromotion != " ")
                            <span class="badge badge-pill badge-warning">Promotion</span>
                          @endif
                          
                        </td>


                        @php
                        $sumMate = 0;
                      @endphp

                      @foreach($OrderDetailmaterials as $materials)

                          @if($materials->order_detail_id == $OrderDetail->order_detail_id)

                              @php
                                  $sumMate += $materials->total_price;
                              @endphp

                          @endif
                              
                      @endforeach
                      <tr>
                          <td></td>
                          <td></td>
                          <td><strong class ="text-success">SUM</strong></td>
                          <td><strong class ="text-success">{{$OrderDetail->totalprice + $sumMate}}</strong></td>
                          <td></td>
                      </tr>

                      </tr>
                    @endforeach
                  </tbody>

                </table>
                
                  
                @endif



              </div>
          </div>
        </div>
        
    </div>

@endsection