@extends('backend.layout.master')
@section('css')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
@endsection
@section('content')
   <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Recipes</h3>
              <a href="{{url('/addrecipe')}}" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus pull-left" style="margin-right:5px;"></span> Add New Recipe</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(Session::has('message'))
               <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i>{{Session::get('message')}}</h4>
              </div>
            @endif
              <table id="recipe_datatable" class="display">
                  <thead>
                      <tr>
                          <th >Recipe Name</th>
                          <th >Description</th>
                          <th >Ingredients</th>
                          <th >Cost Price</th>
                          <th >Sale Price</th>
                          <th>Category</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                      </tr>
                  </thead>
                  <tbody>
                      @if($recipes)
                        @foreach($recipes as $recipe)
                            <tr role="row" class="odd">
                              <td class="sorting_1"><a href="{{url('/showrecipe/'.$recipe->id)}}">{{$recipe->rcp_name}}</a></td>
                              <td>{!! \Illuminate\Support\Str::words($recipe->rcp_dscp,10,'...') !!}</td>
                              <td>{!! \Illuminate\Support\Str::words($recipe->rscp_ingts,10,'...') !!}</td>
                              <td>Rs {{$recipe->rcp_cp}}</td>
                              <td>Rs {{$recipe->rcp_sp}}</td>
                              <td>{{$recipe->category['cat_name']}}</td>
                              <td><form action="{{url('/recipe/edit/'.$recipe->id)}}" method="get">{{csrf_field()}}<input type="submit" class="btn btn-default btn-flat" value="Edit"></form></td>
                              <td><form action="{{url('/recipe/delete/'.$recipe->id)}}" method="post">{{csrf_field()}}<input type="submit" class="btn btn-danger btn-flat" value="Delete"></form></td>
                            </tr>
                        @endforeach
                      @endif
                  </tbody>
              </table>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
@endsection
@section('script')
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
    <script>
      $(document).ready(function(){
        $("#recipe_datatable").DataTable();
      });
    </script>
@endsection