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
        .__anchor{
            cursor:pointer
        }
        .__anchor:hover td{
            background:#d9d9d9;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border"><h3 class="box-title">Tables</h3> <div class="pull-right"><a href="{{url('addtable')}}" class="btn btn-primary btn-flat">Add Table</a></div></div>
                <div class="box-body">
                    <div>
                        <div class="row">
                             <div class="col-sm-8">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td>Table Number</td>
                                            <td>Qr Code</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($tables)
                                            @foreach($tables as $table)
                                            
                                                <tr>
                                                    <td>{{$table->tablenumber}}</td>
                                                    <td>
                                                        <img src="{{url('qrcodes/'.$table->tablenumber.'.png')}}" style="width:30px;" alt="">
                                                    </td>
                                                    <td><a href="{{url('table/show/'.$table->id)}}" class="__anchor">view</a></td>
                                                </tr>
                                            
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
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