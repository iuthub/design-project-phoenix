<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Order;
use App\First_meal;


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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = DB::table('orders')
                ->select('orders.order_id','orders.orderer_name','orders.order_date','orders.guest_number','orders.overall_payment','orders.prepayment_status','first_meals.first_name','category_list.cat_name')
                ->leftjoin('first_meals','first_meals.first_id','=','orders.first_meal_id')
                ->leftjoin('second_meals','second_meals.second_id','=','orders.second_meal_id')
                ->leftjoin('category_list','category_list.cat_id','=','first_meals.first_id')
                ->paginate(5);
        return view('home')->with('orders',$data);

       
    }

    public function getNoWeds()
    {
        $data['overall'] =  DB::table('orders')->count();
        $data['upcoming'] = Order::whereBetween('order_date', [now(),now()->addDays(30)])->count();


        return $data;
    }
}
