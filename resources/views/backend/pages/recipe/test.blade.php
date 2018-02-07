@extends('backend.layout.master')

@section('css')
    
    <link rel="stylesheet" href="{{url('bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
    <style type="text/css">
        .fake-shadow {
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }
        .fileUpload {
            position: relative;
            overflow: hidden;
        }
        .fileUpload #logo-id {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 33px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }
        .img-preview {
            max-width: 100%;
        }
        .container{
            margin-top:20px;
        }
        .image-preview-input {
            position: relative;
            overflow: hidden;
            margin: 0px;    
            color: #333;
            background-color: #fff;
            border-color: #ccc;    
        }
        .image-preview-input input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }
        .image-preview-input-title {
            margin-left:2px;
        }
        ul.wysihtml5-toolbar li a[title="Insert image"] { display: none; }
    </style>    
@endsection

@section('content')
    <div class="row">
       <div class="col-sm-12">
             <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Editing {{recipe->rcp_name}}</h3>
                    </div>
                <form action="{{url('/editrecipe/'.$recipe->id)}}"  id="recipeForm" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <!-- left part -->
                <div class="box-body">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <h4>Name <span class="text-red"></span></h4>
                                <input type="text" id="recipe-name" disabled value="{{$recipe->rcp_name}}"  name="rcp_name" class="form-control input-group-lg" >
                                @if ($errors->has('rcp_name'))
                                    <span class="help-block">
                                        <strong class="text-red">{{ $errors->first('rcp_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="box box-default">
                                    <h4 class="box-title">Description</h4>
                                    @if ($errors->has('rcp_dscp'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('rcp_dscp') }}</strong>
                                        </span>
                                    @endif
                                    <div class="box-body pad">
                                        <textarea id="recipeDscp" name="rcp_dscp" class="form-control" rows="15" >{!! $recipe->rcp_dscp !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-sm-4">
                            <div class="form-group">
                                <h4>Ingredients<span class="text-red">*</span></h4>
                                 @if ($errors->has('rscp_ingts'))
                                    <span class="help-block">
                                        <strong class="text-red">{{ $errors->first('rscp_ingts') }}</strong>
                                    </span>
                                @endif
                                <textarea name="rscp_ingts" id="" class="form-control" cols="" rows="10">{{$recipe->rscp_ingts}}</textarea>
                            </div>
                            <h4>Recipe Picture</h4>
                            <div class="input-group image-preview">
                                <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                                <span class="input-group-btn">
                                    <!-- image-preview-clear button -->
                                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                        <span class="glyphicon glyphicon-remove"></span> Clear
                                    </button>
                                    <!-- image-preview-input -->
                                    <div class="btn btn-default image-preview-input">
                                        <span class="glyphicon glyphicon-folder-open"></span>
                                        <span class="image-preview-input-title">Browse</span>
                                        <input type="file" disabled value="{{$recipe->recipeThumb}}" disabled accept="image/jpg" name="recipeThumb"/> <!-- rename it -->
                                    </div>
                                </span>
                            </div><!-- /input-group image-preview [TO HERE]--> 
                                 <div class="form-group">
                                    <h4>Cost Price <span class="text-red">*</span></h4>
                                    @if ($errors->has('rcp_cp'))
                                        <span class="help-block">
                                            <strong class="text-red">{{ $errors->first('rcp_cp') }}</strong>
                                        </span>
                                    @endif
                                    <input type="text" name="rcp_cp" value="{{$recipe->rcp_cp}}" class="form-control" >
                                </div>  
                                <div class="form-group">
                                    <h4>Category</h4>
                                    <select class="form-control" name="rcp_cat_id">
                                        @if($categories)
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->cat_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                           
                        </div> 
            
                <!-- left part -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <input type="submit"  class="btn btn-flat btn-primary" value="Add">
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
    $(document).on('click', '#close-preview', function(){ 
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
           $('.image-preview').popover('show');
        }, 
         function () {
           $('.image-preview').popover('hide');
        }
    );    
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });
    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse"); 
    }); 
    // Create the preview image
    $(".image-preview-input input:file").change(function (){     
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });      
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);            
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
        }        
        reader.readAsDataURL(file);
    });  
});
 </script>
@endpush