<div class="col-sm-4">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Stocks</h3>
        </div>
        <div class="box-body">
            @if($stocks)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Recipe Name</th>
                            <th>Stock Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stocks as $recipe)
                            <tr>
                                <td>{{$recipe->rcp_name}}</td>
                                <td>@if($recipe->qty_in_stock <= 10) <a href="{{url('/recipe/edit/'.$recipe->id)}}"><i class="fa fa-exclamation-triangle" style="color:orange" aria-hidden="true"></i></a> @endif {{$recipe->qty_in_stock}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>