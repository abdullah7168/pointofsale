<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Recipe;
use DB;
class ReportController extends Controller
{
    
    public function index(){
        $__revenue = DB::table('orders')->sum('totalbill');
        $recipes_sold = \App\Recipecount::all();
        // foreach ($recipes_sold as $good) {
        //     $cost_price_of_goods_sold = DB::table('recipes')
        //                                 ->where('id','=',$good->id)
        //                                 ->sum('rcp_cp');
        // }
        foreach ($recipes_sold as $good){
            $cost_price_of_goods_sold = ($good->price * 0.35) * $good->quantity;
        }
        $total_sales = DB::table('orders')->count('id');
        if($cost_price_of_goods_sold > $__revenue){
            $loss = $cost_price_of_goods_sold - $__revenue;
            return view('backend.pages.reports.index',compact('__revenue','loss','total_sales'));
        } elseif ($cost_price_of_goods_sold == $__revenue ){

        } else {
            $profit = $__revenue - $cost_price_of_goods_sold;
            return view('backend.pages.reports.index',compact('__revenue','profit','total_sales'));
        }
        
    }
    public function totalSales(){
        $totalsales = Order::all();
        return $totalsales;
    }

}
