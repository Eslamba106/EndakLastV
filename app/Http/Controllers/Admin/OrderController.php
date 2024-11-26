<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request  $request){
        

        $ids = $request->bulk_ids;
        $now = Carbon::now()->toDateTimeString();
        if ($request->bulk_action_btn === 'delete' &&  is_array($ids) && count($ids)) {
            Product::whereIn('id', $ids)->delete();
            return back()->with('success', __('general.deleted_successfully'));
        }
        $orders = Order::orderBy("created_at","desc")->paginate(10);

        return view("admin.orders.index", compact("orders"));
    }
    public function destroy($id)
    {

        $order = Order::where('id',$id)->first() ;
        $order->delete();

        return redirect()->route('admin.orders')->with('success' , "Deleted Successfully");
    }
}