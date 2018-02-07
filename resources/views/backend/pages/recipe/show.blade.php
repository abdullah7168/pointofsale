@extends('backend.layout.master')

@push('css')
    <style>
        .flex{
            display:flex;
        }
        .flex--parent{
            flex-direction:row;
            align-items:space-around;
        }
        .flex--child{
            flex-direction:column;
            flex:1;
        }
        .flex--child--two{
            flex:2;
            flex-direction:column;
            padding: 20px;
        }
        .lead--children > *{
            margin-bottom: 20px;
            font-size: 21px;
            font-weight: 300;
            line-height: 1.4;
        }
        .heading--recipe-single{
            font-size:24px !important;
            
        }
        .cat-bg{
           
        }
        .has--bg{
            padding: 20px;
            
            color: #333;
            border: 1px solid rgba(0,0,0,0.3);
            border-radius:3px;
        }
        .bold{
            font-weight:bold;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$recipe->rcp_name}}</h3>
                </div>
                <div class="box-body">
                    <div class="flex flex--parent">
                        <div class="flex flex--child">
                            <div class="">
                                @if(Storage::disk('local')->has($fname))
                                    <img src="{{url('recipe-image/'.$fname)}}" alt="" class="img-responsive">
                                @else
                                    <img src="{{url('/images/bg-recipe.jpg')}}" alt="" class="img-responsive">
                                @endif
                            </div>
                            <div class="">
                                <h3>Ingredients</h3>
                                <p class="lead">{{$recipe->rscp_ingts}}</p>
                            </div>
                            <div class="has--bg">
                                <p class="lead">Category <span class="pull-right bold">{{$recipe->category['cat_name']}}</span></p>
                                <p class="lead">Cost Price:  <span class="pull-right bold">Rs {{$recipe->rcp_cp}}</span></p>
                                <p class="lead">Sale Price:  <span class="pull-right bold">Rs {{$recipe->rcp_sp}}</span></p>
                            </div>
                        </div>
                        <div class="flex flex--child--two lead--children">
                            <h3 class="heading--recipe-single">Description</h3>
                            {!! $recipe->rcp_dscp !!}
                        </div>
                    </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-8 col-sm-offset-4">
                        <form action="{{url('recipe/edit/'.$recipe->id)}}" method="">
                            <button type="submit" class="btn btn-primary pull-left btn-flat">Edit</button>
                        </form>
                        <form action="{{url('recipe/delete/'.$recipe->id)}}" method="" >
                            <button type="submit" style="margin-left:15px;" class="btn btn-danger pull-left btn-flat">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    
@endsection