<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use DataTables;

class ClientController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.clients.index');
    }

    public function clientsList(Request $request)
    {
        $data = Client::latest()->get();
        $user = auth()->user();
        return DataTables::of($data)
            ->addIndexColumn()
                ->addColumn('name', function($row){
                return $row->name;
            })
            ->addColumn('email', function($row){
                return $row->email;
            })
            ->addColumn('phone', function($row){
                return $row->phone;
            })
            ->addColumn('region_id', function($row){
                return $row->region_id;
            })
    
            ->addColumn('orders', function($row){
                $orders = '<a  href="'. Route('client.orders',$row->id) .'"  class="btn btn-info btn-sm"><i class="typcn typcn-folder-open"></i></a>';
                return $orders;
            })
            ->editColumn('change_status', function($row) use($user){
                if($user->can('تغيير-حالة-العميل')){
                    return ($row->status == 1) ? '<a href="javascript:void(0)" id="change_status_btn" data-id = "'. $row->id .'" data-toggle="modal" data-target="#change_status_modal" title="مفعل الان"><i class="fas fa-toggle-on fa-2x text-success" ></i></a>' 
                        : '<a href="javascript:void(0)" id="change_status_btn" data-id = "'. $row->id .'" data-name = "'. $row->name .'" data-toggle="modal" data-target="#change_status_modal" title="غير مفعل الان"><i class="fas fa-toggle-off fa-2x text-danger"></i></a>';
                    }
                    return '<p class="text-muted">غير مسموح</p>';
                })
            ->addColumn('delete', function($row) use($user){
                if($user->can('حذف-العميل')){
                    $delete ='<button type="button" class="btn btn-danger btn-sm" id="delete_btn" data-id = "'. $row->id .'" data-name = "'. $row->name .'" data-toggle="modal" data-target="#delete_client_modal">
                            <i class="typcn typcn-document-delete"></i>
                            </button>';
                    return $delete;
                }
                return '<p class="text-muted">غير مسموح</p>';
            })
            ->rawColumns(['change_status','delete','orders'])
            ->make(true);
    }



    public function changeStatus(Request $request)
    {
        $client = Client::where('id',$request->id)->first();
            // return dd($client);
        if( $client->status == 1 ){
            $client->update(['status' => 0]);
        }else {
            $client->update(['status' => 1]);
        }
        $request->session()->flash("update");
        return redirect()->back();
    }

    
    public function clientOrders($client_id)
    {
  
        $client = Client::findOrFail($client_id);
        $orders= $client->orders;
        return view('dashboard.pages.clients.client_orders',['client' => $client ,'orders' => $orders]);

    }

    // public function clientOrdersList(Request $request,$client_id)
    // {
    //     $client = Client::findOrFail($client_id);
    //     $data = $client->orders;
    //     return DataTables::of($data)
    //     ->addIndexColumn()
    //     ->addColumn('client_id', function($row){
    //        return $row->client->name;
    //    })
    //    ->addColumn('restaurant_id', function($row){
    //        return $row->restaurant->name;
    //    })
    //    ->addColumn('address', function($row){
    //        return $row->address;
    //    })
    //    ->addColumn('payment_method_id', function($row){
    //        return $row->payment_method->name;
    //    })
    //    ->addColumn('status', function($row){
    //        return $row->label();
    //    })
    //    ->addColumn('total_price', function($row){
    //        return $row->total_price;
    //    })

    //    ->addColumn('show', function($row){
    //        $show = '<a href="'. Route('order.show',$row->id) .'"  class="btn btn-secondary btn-sm"><i class="far fa-eye"></i></a>';
    //        return $show;
    //    })
    //    ->addColumn('delete', function($row){
    //        $delete ='<button type="button" class="btn btn-danger btn-sm" id="delete_btn" data-id = "'. $row->id .'" data-name = "'. $row->name .'" data-toggle="modal" data-target="#delete_client_modal">
    //                <i class="typcn typcn-document-delete"></i>
    //                </button>';
    //        return $delete;
    //    })
    //    ->rawColumns(['show','delete'])

    //    ->make(true);


    // }

    
    public function delete(Request $request)
    {
        $client = client::findOrFail($request->id);
        $client->categories()->detach();
        $client->delete();
        $request->session()->flash("delete");
        return redirect()->route('clients.index');
    }

}
