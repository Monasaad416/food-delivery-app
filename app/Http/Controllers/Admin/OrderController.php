<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DataTables;


class OrderController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.orders.index');
    }

    public function ordersList(Request $request)
    {
        $data = Order::latest()->get();
        $user = auth()->user();
        return DataTables::of($data)
                ->addIndexColumn()
                 ->addColumn('client_id', function($row){
                    return $row->client->name;
                })
                ->addColumn('restaurant_id', function($row){
                    return $row->restaurant->name;
                })
                ->addColumn('address', function($row){
                    return $row->address;
                })
                ->addColumn('payment_method_id', function($row){
                    return $row->payment_method->name;
                })
                ->addColumn('status', function($row){
                    return '<span class=" text-'. $row->style() .' " >'.$row->label().'</span>';
                })
                ->addColumn('total_price', function($row){
                    return $row->total_price;
                })

                ->addColumn('show', function($row) use($user){
                    if($user->can('حذف-الطلب')){
                        $show = '<a href="'. Route('order.show',$row->id) .'"  class="btn btn-secondary btn-sm"><i class="far fa-eye"></i></a>';
                        return $show;
                    }
                    return '<p class="text-muted">غير مسموح</p>';
                })
                ->addColumn('delete', function($row) use($user){
                    if($user->can('حذف-الطلب')){
                        $delete ='<button type="button" class="btn btn-danger btn-sm" id="delete_btn" data-id = "'. $row->id .'" data-name = "'. $row->name .'" data-toggle="modal" data-target="#delete_order_modal">
                                <i class="typcn typcn-document-delete"></i>
                                </button>';
                        return $delete;
                    }
                    return '<p class="text-muted">غير مسموح</p>';
                })
                ->rawColumns(['show','delete','status'])

                ->make(true);

    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('dashboard.pages.orders.show',[ 'order' => $order ]);
    }

    public function delete(Request $request)
    {
        City::findOrFail($request->id)->delete();
        $request->session()->flash("delete");
        return redirect()->route('cities.index');
    }
}
