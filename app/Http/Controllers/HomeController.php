<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Order;
use DB;
use App\Recipecount;
use Illuminate\Support\Facades\Input;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $order_count = DB::table('orders')->count();
        $__fav_recipes = Recipecount::groupBy('id')
                                    ->orderBy('quantity', 'desc')
                                    ->take(3)
                                    ->get();
        $__revenue = DB::table('orders')->sum('totalbill');
        $stocks = DB::table('recipes')->select('id','rcp_name','qty_in_stock')->get();
        return view('backend.pages.home',compact('order_count','__fav_recipes','__revenue','stocks'));
        //var_dump($__revenue);
    }

    public function getOrderApi(){
        
        $days = Input::get('days', 7);
        $range = \Carbon\Carbon::now()->subDays($days);
        
        $stats = Order::where('created_at', '>=', $range)
        ->groupBy('date')
        ->orderBy('date', 'DESC')
        ->get([
            DB::raw('Date(created_at) as date'),
            DB::raw('COUNT(*) as value')
        ])
        ->toJSON();
        
        return $stats;
    }
    
}
