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
                <div class="box-header with-border"><h3 class="box-title">Categories</h3></div>
                <div class="box-body">
                    <div>
                        <div class="row">
                               <div class="col-sm-6">
                                 @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                 <form action="{{url('/categories')}}" method= "POST">
                                 {{csrf_field()}}
                                  <h4 class="text-left" style="margin-bottom:15px;padding-left:15px;">Add a new Category</h4>
                                  <div class="form-group">
                                    <label for="" class="pull-left col-xs-4">Category Name:</label>
                                    <div class="col-xs-8">
                                        <input type="text" name="cat_name" class="form-control">
                                    </div>
                                    <div class="pull-right form-submit">
                                         <input type="submit"  value="Add" class="btn btn-success btn-flat ">
                                    </div>
                                  </div>
                                   </form>
                               </div>
                               <div class="col-sm-4 col-sm-offset-1">
                                    @if(Session::has('message'))
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h4><i class="icon fa fa-check"></i>{{Session::get('message')}}</h4>
                                        </div>
                                    @endif
                                    <h4 class="text-left" style="margin-bottom:15px;">Category List</h4>
                                    @if($categories)
                                        <ul class="list-group">
                                            @foreach($categories as $category)
                                                <li class="list-group-item clearfix">
                                                    <a class="pull-left" href="{{url('category/'.$category->id)}}">{{$category->cat_name}}</a>
                                                    <form action="{{url('category/delete/'.$category->id)}}" method="POST">{{csrf_field()}}<button type="submit" class="close pull-right" >×</button></form> 
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <div class="alert alert-warning alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                                            There is no data in the list.
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
   <script>
        $(document).ready(function(){
            $('.list-group > .list-group-item').hover(function(){
                $('.active').removeClass('active');
                $(this).addClass('active');
            });
            
        });
   </script>
@endsection