@extends('backend.layout.master')

@section('css')
    
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Order Details</h3>
                        <a href="{{url('/order')}}" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus pull-left" style="margin-right:5px;"></span> Take Order</a>
                    </div>
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i>{{Session::get('message')}}</h4>
                        </div>
                    @endif
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table  class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Order Id<th>
                                    <th>Total Bill</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>
                                            @foreach(unserialize($order->orderdetails) as $item)
                                                {!!'Recipe name = '.$item->name .', Quantity = '.$item->qty.', Price = '.$item->price .'</br>' !!}
                                            @endforeach
                                        </td>
                                        <td>Rs {{$order->totalbill}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- /.col -->
            </div>

        </div>
    </div>
@endsection

@section('script')
    
@endsection