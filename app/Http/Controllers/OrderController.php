<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $dishes = Dish::where('name','LIKE','%'. $search . '%')->orderBy('id','DESC')->get();
        $tables = Table::all();

        $orders = Order::whereIn('status',[3,4])->get();
        $statuses = config('res.order_status');
        $status = array_flip($statuses);

        return view('order_form',compact('dishes','tables','orders','status'));
    }

    public function submit(Request $request)
    {
        $data = array_filter($request->except('_token','table_id'));
        $orderID = rand();
        foreach ($data as $key => $value) {
            if($value > 1){
                for ($i=0; $i < $value; $i++) {
                    $this->saveOrder($orderID,$key,$request);
                }
            }else{
                $this->saveOrder($orderID,$key,$request);
            }
        }
        return redirect('/')->with('message','Order Submitted');
    }

    public function saveOrder($orderID,$dish_id,$request)
    {
        $order = new Order();
        $order->order_id = $orderID;
        $order->dish_id = $dish_id;
        $order->table_id = $request->table_id;
        $order->status = config('res.order_status.New');

        $order->save();
    }

    public function serve(Order $order)
    {
        $order->status = config('res.order_status.Done');
        $order->save();
        return redirect('/')->with('message','Order Served to customer');
    }

    public function delete(Order $order)
    {
        $order->delete();
        return redirect('/')->with('message','Order Deleted');
    }
}