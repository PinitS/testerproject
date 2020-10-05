@extends('layouts.master')

@section('pagetitle' , 'Order')

@section('content')

<div class="row">


    {{-- order list --}}
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
                                    <input type="hidden" name="aa" value="{{$cnt}}">
                                    <button type="submit" class="btn btn-sm btn-success pnt-send-value">Serving</button>

                                </form>
                            </td>

                            <td>
                                <a href="{{route('cashier.CustomCheckcreate' , ['oid' => $Order->id , 'usid' => Auth::user()->id])}}"
                                    style='text-decoration:none;'>

                                    <button class="btn btn-sm btn-warning float-md-left float-sm-left mr-md-3"
                                        type="button">
                                        <i class="fa fa-plus"></i> Order more
                                    </button>
                                </a>

                                @if($Order->orderSet->last()->orderDetail->isEmpty())

                                <a href="{{route('cashier.CustomDelOrder' , ['oid' => $Order->id , 'usid' => Auth::user()->id ])}}"
                                    style='text-decoration:none;'>

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
    {{-- order list --}}


    {{-- order detail list --}}

    <div class="col-md-5 col-sm-12">
        <div class="card border-danger">
            <div class="card-header">
                <form action=""> //wait for submit
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <strong class=""> Order : {{$oid}} </strong>
                        </div>

                        <div class="col-md-6">
                            <button class="btn btn-sm btn-warning float-md-right float-sm-right" type="button">
                                <i class="fa fa-ban"></i> Check bill
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                @if(!$OrderDetails->isEmpty())


                <div class="nav-tabs-boxed">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home">{{__('ALL')}}</a></li>





                        @foreach ($getOrders->orderSet as $orderSet)
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#orderSet{{$orderSet->id}}" role="tab"
                                aria-controls="profile">{{__('OrderTimes')}} {{$orderSet->times}} </a></li>
                        @endforeach



                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <table class="table table-sm table-borderless text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order</th>
                                        <th>Quatity</th>
                                        <th>Price/Unit</th>
                                        <th>Price/SUM</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <button
                                        class="btn btn-sm btn-info mb-3 float-md-right float-sm-right pnt-open-modal"
                                        type="button" disabled data-toggle="modal" data-target="#myModal"><i
                                            class="fa fa-random mr-2"></i>Change Order</button>

                                    @foreach($OrderDetails as $OrderDetail)
                                    <tr>
                                        <td>
                                            <input class="checkbox-pnt-ch" id="order_id" type="checkbox"
                                                data-id="{{$OrderDetail->order_detail_id}}" />
                                        </td>

                                        <td><strong>{{$OrderDetail->productname}}</strong></td>
                                        <td><strong>{{$OrderDetail->quatity}}</strong></td>
                                        <td><strong>{{$OrderDetail->price}}</strong></td>
                                        <td><strong>{{$OrderDetail->totalprice}}</strong></td>
                                        <td>
                                            @if($OrderDetail->textpromotion != " ")
                                            <span class="badge badge-pill badge-warning">Promotion</span>
                                            @endif
                                        </td>

                                        @if($OrderDetail->note != "")
                                    <tr>
                                        <td></td>
                                        <td><strong class="text-danger">{{$OrderDetail->note}}</strong></td>
                                    </tr>
                                    @endif

                                    @if(!$OrderDetail->orderDetailmaterial->isEmpty())
                                    @foreach($OrderDetail->orderDetailmaterial as $material)
                                    <tr>
                                        <td></td>
                                        <td><strong class="text-warning">+ {{$material->materialName}} </strong></td>
                                        <td><strong> {{$material->quatity}} </strong></td>
                                        <td><strong class="text-warning">{{$material->price}}</strong></td>
                                        <td><strong class="text-warning">{{$material->total_price}}</strong></td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><strong class="text-danger">sum</strong></td>
                                        <td>
                                            <strong class="text-danger">
                                                {{$OrderDetails->sum('totalprice')+ $OrderDetailmaterials->sum('total_price') }}
                                            </strong>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        @foreach ($getOrders->orderSet as $orderSet)

                            <div class="tab-pane" id="orderSet{{$orderSet->id}}" role="tabpanel">
                                {{$orderSet->times}}
                                {{$orderSet->times}}
                                {{$orderSet->times}}
                                {{$orderSet->times}}
                                {{$orderSet->times}}
                                {{$orderSet->times}}
                                {{$orderSet->times}}
                                {{$orderSet->times}}
                                {{$orderSet->times}}
                                {{$orderSet->times}}
                            </div>

                        @endforeach
                    </div>
                </div>

                @endif
            </div>
        </div>
    </div>
    {{-- order detail list --}}


    {{-- change modal --}}
    <form action="{{ route('changeOrder') }}" method="POST">
        @csrf
        <input type="hidden" class="checkbox pnt-product-inform" name="product" value="false">
        <input type="hidden" class="pnt-user_id" name="user_id" value="{{Auth::user()->id}}">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Choose Order</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <select class="form-control col-sm-4 col-md-4 mr-2 pnt-drop-down" id="toOrderId"
                            name="toOrderId">

                            @foreach($forchangeOrder as $changeOrder)
                            <option value="{{$changeOrder->id}}">{{$changeOrder->id}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary pnt-submit" type="submit">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content-->
            </div>
            <!-- /.modal-dialog-->
        </div>
    </form>

    {{-- change modal --}}

</div>

@endsection


@section('script')
<script>
    let product_id = [];

    $('.checkbox-pnt-ch').change(function (e) {
        // console.log("key :" , $(e.currentTarget).attr('data-id'));
        //console.log("value :" , $(e.currentTarget).is(":checked"));
        let checked = $(e.currentTarget).is(":checked");
        if (checked == true) {
            product_id.push($(e.currentTarget).attr('data-id'));
        } else {
            product_id.pop($(e.currentTarget).attr('data-id'));
        }

        if (product_id == '') {
            $('.pnt-open-modal').attr("disabled", true);
        } else {
            $('.pnt-open-modal').attr("disabled", false);
        }

        $('.pnt-product-inform').val(product_id);
    });

</script>
@endsection
