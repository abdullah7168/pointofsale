<div class="col-sm-4">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Top Favorite Recipes</h3>
        </div>
        <div class="box-body">
            <ul class="__fav_list">
                @foreach($__fav_recipes as $recipe)
                    <li><i class="fa fa-star" aria-hidden="true"></i> {{$recipe->name}} <span class="pull-right"><i><small>orders: {{$recipe->quantity}}</small></i></span></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>