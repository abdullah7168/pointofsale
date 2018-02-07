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
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border"><h3 class="box-title">Add Tables</h3></div>
                <div class="box-body">
                    <div>
                        <div class="row">
                               <div class="col-sm-8 col-sm-offset-2">
                                 @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                 <form action="{{url('/addtable')}}" method= "POST">
                                    {{csrf_field()}}
                                    <h4 class="text-left" style="margin-bottom:15px;padding-left:15px;">Add a new Table</h4>
                                    <div class="form-group">
                                        <label for="" class="pull-left col-xs-4">Table Number:</label>
                                        <div class="col-xs-8">
                                            <input type="number" name="tablenumber" class="form-control">
                                        </div>
                                        <div class="pull-right form-submit">
                                            <input type="submit"  value="Add" class="btn btn-success btn-flat ">
                                        </div>
                                    </div>
                                   </form>
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