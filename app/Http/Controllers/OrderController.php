<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Recipe;
use App\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redirect;
use App\Recipecount;
use DB;
class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('backend.pages.order.index',compact('orders')); 
    }
    public function makeOrder(){
        $recipes = Recipe::all();
        return view('backend.pages.order.order',compact('recipes'));
    }

    public function throwRecipes(){
        $term=Input::get("term");
        $recipe = Recipe::where('rcp_name','Like','%'. $term. '%')->get();

        $results=array();
        foreach ($recipe as $key) {

                $results[]=['id'=>$key["id"],'value'=>$key["rcp_name"]];

            }

        return response()->json($results);
    }

    public function grabRecipe(Request $request){

       $selected_recipe = Recipe::where('id','=',$request['_recipeid'])->first();
       $quantity = $request['_quantity'];
       $sub_total = $selected_recipe->rcp_sp * $quantity;

        //creating a cart
        Cart::add([
            ['id' => $selected_recipe->id, 'name' => $selected_recipe->rcp_name,'qty' => $quantity,'price' =>  $selected_recipe->rcp_sp ]
        ]);

        $html = view('backend.partials._tr')->render();
        $total = view('backend.partials._total')->render();
        return response()->json([
            'html' => $html,
            'total' => $total
            ]);
    }

    public function removeItem($key){
        $cartItem = Cart::remove($key);
        return back();
    }

    public function postOrder(){
        
        $order = new Order();
        $order->orderdetails = serialize(Cart::content());
        $order->totalbill = Cart::subtotal('2','.','');
        $order->save();

        foreach (Cart::content() as $item) {
            $__recipecount = Recipecount::where('id',$item->id)->first();
            if($__recipecount){
                $__recipecount->quantity += (int)$item->qty;
                $__recipecount->update();
                
            } else {
                $recipecount = new Recipecount;
                $recipecount->id = $item->id;
                $recipecount->name = $item->name;
                $recipecount->price = $item->price;
                $recipecount->quantity = $item->qty;
                $recipecount->save();
            }
        }

        //update quantity in stock of selected recipes
        foreach (Cart::content() as $recipe) {
            $_recipe = Recipe::where('id','=',$recipe->id)->first();
            $_recipe->qty_in_stock -= (int)$recipe->qty;
            
            $_recipe->update();
        }
        

        Cart::destroy();
        return redirect()->to('/orders')->with('message','Order Completed');
    }
}
