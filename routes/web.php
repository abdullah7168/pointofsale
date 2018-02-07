<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: Content-Type, application/json');
header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();
Route::get('/','HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');




Route::get('/recipes','RecipeController@index');
Route::get('/addrecipe','RecipeController@getAdd');
Route::post('/addrecipe','RecipeController@postRecipe');
Route::get('recipe/edit/{id}','RecipeController@getEdit');
Route::post('recipe/edit/{id}','RecipeController@postEdit');
//pricing policy
Route::get('policy-pricing','PolicyController@index');
Route::post('policy/update/{id}','PolicyController@update');


Route::get('/api/recipes',function(){
    $__fav_recipes = App\Recipecount::groupBy('id')
                                    ->orderBy('quantity', 'desc')
                                    ->take(1)
                                    ->first();

    $recipes = App\Recipe::all();
    if($__fav_recipes){
        return response()->json(['recipes' => $recipes, 'favorite_recipe_id' => $__fav_recipes->id]);
    }
    return response()->json(['recipes' => $recipes,]);
});


//adding tables
Route::get('/tables','TableController@index');
Route::get('/addtable','TableController@create');
Route::post('/addtable','TableController@postTable');
Route::get('table/show/{id}','TableController@show');




Route::get('/showrecipe/{id}','RecipeController@showRecipe');
Route::get('recipe-image/{filename}','RecipeController@getImage');
Route::post('recipe/delete/{id}','RecipeController@deleteRecipe');


Route::get('/categories','CategoryController@index');
Route::post('/categories','CategoryController@postCategory');
Route::post('/category/delete/{id}','CategoryController@deleteCategory');

Route::get('reservations','ReservationController@index');
Route::get('events/{id}','ReservationController@show');
Route::get('/api','ReservationController@returnEvents');

Route::get('reserve','ReservationController@createReservation');
Route::post('reserve','ReservationController@storeReservation');

Route::get('/orders','OrderController@index');
Route::get('order','OrderController@makeOrder');
Route::post('/order','OrderController@postOrder');

//api orders saving cart
Route::post('/api/order',function(Illuminate\Http\Request $request){
    Gloudemans\Shoppingcart\Facades\Cart::add($request->cart);
    $order = new App\Order;
    $order->orderdetails = serialize(Gloudemans\Shoppingcart\Facades\Cart::content());
    $order->totalbill = Gloudemans\Shoppingcart\Facades\Cart::subtotal('2','.','');
    $order->serve_on = (int)$request->tablenumber;
    $order->save();
    foreach (Cart::content() as $item) {
        $__recipecount = App\Recipecount::where('id',$item->id)->first();
        if($__recipecount){
            $__recipecount->quantity += (int)$item->qty;
            $__recipecount->update();
            
        } else {
            $recipecount = new App\Recipecount;
            $recipecount->id = $item->id;
            $recipecount->name = $item->name;
            $recipecount->price = $item->price;
            $recipecount->quantity = $item->qty;
            $recipecount->save();
        }
    }

    //update quantity in stock of selected recipes
    foreach (Cart::content() as $recipe) {
        $_recipe = App\Recipe::where('id','=',$recipe->id)->first();
        $_recipe->qty_in_stock -= (int)$recipe->qty;
        
        $_recipe->update();
    }
    
    Gloudemans\Shoppingcart\Facades\Cart::destroy();
    return response()->json(['message','Your order has been received, you will be served shortly']);
});
Route::get('/event',function(){

    event(new App\Events\OrderReceived());
    return 'Event has been sent';
});
Route::get('/gettingrecipes','OrderController@throwRecipes');
Route::get('/addinorder','OrderController@grabRecipe');

//cart routes
Route::post('cart/delete/{key}','OrderController@removeItem');

//reports
Route::get('/revenue','ReportController@getRevenue');

//checking table availability
Route::get('/check',function(Illuminate\Http\Request $request){

    
    $_from = $request->_from;
    $_to = $request->_to;
   
    $reservations = DB::table('reservations')
                             ->select('table_id')
                             ->where('end_time','>',$_from)
                             ->get();
    //echo $reservations;
                             //converting std object to array
     $array_reservations = json_decode(json_encode($reservations), True);

     $tables = DB::table('tables')
                      ->whereNotIn('id',$array_reservations)
                      ->get();
   
    //converting std object to array
     $array_tables = json_decode(json_encode($tables),True);

    $_form = view('backend.partials._form')->render();
    return response()->json([
                '_form' => $_form,
                'array_tables' => $array_tables,
                'from' => $_from,
                'to' => $_to
                ]);
});
//api to get request and throw tables
Route::get('/api/check',function(Illuminate\Http\Request $request){
    $_from = $request->__from;
    $reservations = DB::table('reservations')
                            ->select('table_id')
                            ->where('start_time',$_from)
                            ->get();
    $array_reservations = json_decode(json_encode($reservations), True);
    $tables = DB::table('tables')
                     ->whereNotIn('id',$array_reservations)
                     ->get();    
    return $tables;                   
});

//api to make a booking request
Route::post('api/book',function(Illuminate\Http\Request $request){
    $reservation = new App\Reservation;
    $reservation->title = $request->reservation_info['name'];
    $reservation->phone = $request->reservation_info['phone'];
    $reservation->email = $request->reservation_info['email'];
    $reservation->comment = $request->reservation_info['comment'];
    $reservation->start_time = $request->from;
    $reservation->table_id = $request->reservation_info['tablenumber'];
    $reservation->save();
    
    return response()->json(['message' => 'Reservation request has been approved']);
});
//getting tables
Route::get('tables/api','ReservationController@returnTables');



//testing
Route::get('charts/order/api', 'HomeController@getOrderApi');
Route::get('testing',function(){

   $today = Carbon\Carbon::today();
   echo $today->toDateString();
   if($today == $today->toDateString()){
       echo 'yahoo';
   } else {
       echo 'not equal';
   }

});

//datatable api
Route::get('/api/data/order',function(){
    $today = Carbon\Carbon::today();
    $todaydate = $today->toDateString();
    $order = App\Order::where('created_at','=',$todaydate)->get();
    return $order;

});

//reports
Route::get('reports','ReportController@index');
Route::get('totalsales','ReportController@totalSales');