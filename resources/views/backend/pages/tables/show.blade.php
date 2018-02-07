@extends('backend.layout.master')

@section('css')
   
    <style>
        .form-submit{
            padding-left: 15px;
            padding-right: 15px;
            margin-top: 15px;
        }
        .active > a{
            color:#fff !important;
        }
        .__flex{
            color:#333;
            justify-content:center;
            align-items:center;
            flex-direction:column;
            display:flex;
            font-weight:bold;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border"><h3 class="box-title">Table</h3> <div class="pull-right"><a href="{{url('tables')}}" class="btn btn-primary btn-flat">View all Tables</a></div></div>
                <div class="box-body">
                    <div>
                        <div class="row">
                             <div class="col-sm-8 col-sm-offset-2" style="padding:40px;">
                               @if($table)
                                   <div class="col-sm-12 __flex">
                                        <h3>Table number : {{$table->tablenumber}}</h3>
                                        <img src="{{url('qrcodes/'.$table->tablenumber.'.png')}}" alt="">
                                    </div>
                               @endif
                             </div>  
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection