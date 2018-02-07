@extends('backend.layout.master')

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Order</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                   
                    <div class="box-body">
                      <div class="col-sm-6">
                        <form class="form-horizontal">
                       
                            <div class="form-group">
                                <label for="recipe" class="col-sm-2 control-label">Recipe</label>
                                <div class="col-sm-10">
                                   <input type="text" class="form-control" id="tags">
                                   <input type="hidden" id="recipeid">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="quantity-box"  class="col-sm-2 control-label">Quantity</label>

                                <div class="col-sm-10">
                                   <input type="number" min="1"  id="quantity-box" value="1"class="input-lg form-control" >
                                </div>
                            </div>
                            <div class="pull-right">
                                <a href="" id="btn-add-order" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus pull-left" style="margin-right:5px;"></span> Add Another</a>
                            </div>
                        </form>  
                      </div>
                      <div class="col-sm-6">
                      <table class="table table-bordered">
                            <thead>
                                    <tr>
                                    <th>Recipe</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="parent-data">
                                @include('backend.partials._tr')
                            </tbody>

                        </table>
                        <!-- includes table parital -->
                      </div>
                    </div>
                    <!-- /.box-body -->
                    
                    <div class="box-footer">
                        <div class="row">
                            <div class="pull-right" style="padding-left:28px;padding-right:28px;">
                                <p class="lead">Grand Total: $ 
                                    <span id="_total--hook" style="text-decoration:underline;font-weight:700;">
                                        @include('backend.partials._total')
                                    <span>
                                </p>    
                            </div>
                        </div>
                        <button type="button" class="btn btn-default">Cancel</button>
                        <form action="{{url('/order')}}" method="POST">
                            {{csrf_field()}}
                            <button type="submit" id="btn-order" class="btn btn-danger pull-right">Order</button>
                        </form>
                    </div>
                    <!-- /.box-footer -->
                    
                </div>
            </div>
        </div>
    </div>
   
@endsection

@push('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        
        $(document).ready(function(){
            url = '{{url("/addinorder")}}';
            base_url = '{{url("/")}}'
            $( "#tags" ).autocomplete({
                   source: base_url + '/gettingrecipes',
                   minlength: 1,
                   autoFocus: true,
                   select: function (e, ui)
                   {      
                       $('#recipeid').val(ui.item.id);
                       console.log(ui.item.id);        
                   }
            });

            //ajax request on click event for add item to order
            $('#btn-add-order').on('click',function(e){

                e.preventDefault();
                var _quantity = $('#quantity-box').val();
                var _recipeid = $('#recipeid').val();
                console.log(_quantity);    
                 $.ajax({
                    method: "GET",
                    url:url,
                    data: {_recipeid,_quantity}
                    })
                    .done(function (msg) {
                        $('#parent-data').empty();
                        $('#parent-data').append(msg['html']);
                        $('#_total--hook').empty();
                        $('#_total--hook').append(msg['total']);
                    });

            });
       
        });
    </script>
@endpush