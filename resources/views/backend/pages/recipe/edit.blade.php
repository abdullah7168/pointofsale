@extends('backend.layout.master')

@push('css')
    <link rel="stylesheet" href="{{url('bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
    <style>
         ul.wysihtml5-toolbar li a[title="Insert image"] { display: none; }
    </style>
@endpush

@section('content')
    <div class="row">
       <div class="col-sm-12">
             <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Editing - {{$recipe->rcp_name}}</h3>
                    </div>
                <form action="{{url('recipe/edit/'.$recipe->id)}}" method="POST">
                {{csrf_field()}}
                <!-- left part -->
                <div class="box-body">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <h4>Name</h4>
                                <input type="text" value="{{$recipe->rcp_name}}" disabled name="rcp_name" class="form-control input-group-lg" >
                            </div>
                            <div class="form-group">
                                <div class="box box-default">
                                    <h4 class="box-title">Description</h4>
                               
                                    <div class="box-body pad">
                                        <textarea id="recipeDscp"  name="rcp_dscp" class="form-control" rows="15" >{{$recipe->rcp_dscp}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-sm-4">
                            <div class="form-group">
                                <h4>Ingredients</h4>
                                @if ($errors->has('rscp_ingts'))
                                    <span class="help-block">
                                        <strong class="text-red">{{ $errors->first('rscp_ingts') }}</strong>
                                    </span>
                                @endif
                                <textarea name="rscp_ingts" value="" id="" class="form-control" cols="" rows="10">{{$recipe->rscp_ingts}}</textarea>
                            </div>
                                 <div class="form-group">
                                    <h4>Cost Price</h4>
                                     @if ($errors->has('rcp_cp'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('rcp_cp') }}</strong>
                                        </span>
                                    @endif
                                    <input type="text" value="{{$recipe->rcp_cp}}" name="rcp_cp" class="form-control" >
                                </div>  
                                <div class="form-group">
                                    <h4>Category</h4>
                                     <select class="form-control" name="rcp_cat_id">
                                        @if($categories)
                                            @foreach($categories as $oldcategory)
                                                <option @if($category['id'] == $oldcategory['id']) selected @endif; value="{{$oldcategory->id}}">{{$oldcategory->cat_name}}</option>
                                            @endforeach
                                        @endif
                                    </select> 
                                </div>
                            </div>
                           
                        </div> 
            
                <!-- left part -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <input type="submit" class="btn btn-flat btn-primary" value="Update">
                        </div>
                    </div>
                </form>
            </div>
       </div>
    </div>
@endsection
@push('scripts')
<script src="{{url('bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>
<script>
    //wysihtml5 description field
    $(function(){
        $('#recipeDscp').wysihtml5({
            "image":false
        });
    });
</script>
@endpush