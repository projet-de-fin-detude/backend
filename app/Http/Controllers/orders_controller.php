<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class orders_controller extends Controller
{
    public function main()
    {
        $orders = DB::select('select * from medecines_orders order by date desc');
        foreach ($orders as $key => $value) {
            $value->user = DB::table('users')->where('id', $value->user_id)->first();
        }
        return ($orders);
    }
    public function edit_order(Request $request)
    {

        $order = DB::table('medecines_orders')->where('id', request()->input('id'))->update(array(
            'status' => request()->input('status'),
        ));
        if ($order) {
            $order = DB::table('medecines_orders')->find(request()->input('id'));
            return response()->json($order);
        } else {
            return (['product' => 'error']);
        }
    }
}
