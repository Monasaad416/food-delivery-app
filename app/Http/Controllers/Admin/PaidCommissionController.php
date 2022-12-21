<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\PaidCommission;

class PaidCommissionController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.commissions.index');
    }

    public function commissionsList(Request $request)
    {
            $data = PaidCommission::latest()->get();
            $user = auth()->user();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('restaurant_id', function($row){
                    return $row->restaurant->name;
                })
                 ->addColumn('paid', function($row){
                    return $row->paid;
                })
                ->addColumn('payment_date', function($row){
                    return $row->payment_date;
                })
                ->addColumn('bank_id', function($row){
                    return $row->bank->name;
                })
                ->addColumn('notes', function($row){
                    return $row->notes;
                })
                ->addColumn('edit', function($row) use($user){
                    if($user->can('تعديل-العمولة')){
                        $edit = '<a  href="'. Route('dashboard.commissions.edit',$row->id) .'"  class="btn btn-success btn-sm"><i class="typcn typcn-edit"></i></a>';
                        return $edit;
                    }
                    return '<p class="text-muted">غير مسموح</p>';   
                })
                ->addColumn('delete', function($row) use($user){
                    if($user->can('حذف-العمولة')){
                        $delete ='<button type="button" class="btn btn-danger btn-sm" id="delete_btn" data-id = "'. $row->id .'" data-name = "'. $row->name .'" data-toggle="modal" data-target="#delete_commission_modal">
                                    <i class="typcn typcn-document-delete"></i>
                                </button>';      
                        return $delete;
                    }
                    return '<p class="text-muted">غير مسموح</p>';    
                })
                ->rawColumns(['edit','delete'])
                ->make(true);

    }

    public function create()
    {
        return view('dashboard.pages.commissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'paid' => 'required|numeric',
            'payment_date' => 'required|date',
            'notes'=> 'required|string',
            'bank_id'=> 'required|exists:banks,id',
        ]);


        $commission = PaidCommission::create([
            'restaurant_id' => $request->restaurant_id,
            'paid' => $request->paid,
            'payment_date' => $request->payment_date,
            'notes' => $request->notes,
            'bank_id' => $request->bank_id,
        ]);

        $request->session()->flash("success");
        return redirect()->route('commissions.index');
    }


    public function edit($id)
    {
        $commission = PaidCommission::findOrFail($id);
        return view('dashboard.pages.commissions.edit',['commission'=>$commission]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'restaurant_id' => 'nullable|exists:restaurants,id',
            'paid' => 'nullable|numeric',
            'payment_date' => 'nullable|date',
            'notes'=> 'nullable|string',
            'bank_id'=> 'nullable|exists:banks,id',
        ]);

        $commission = PaidCommission::findOrFail($id);

        $commission->update([
            'restaurant_id' => $request->commission_id,
            'paid' => $request->paid,
            'payment_date' => $request->payment_date,
            'notes' => $request->notes,
            'bank_id' => $request->bank_id,
        ]);
        
        $request->session()->flash("update");
        return redirect()->route('commissions.index');
    }

    public function delete(Request $request)
    {
        $commission = PaidCommission::findOrFail($request->id);
        $commission->categories()->detach();
        $commission->delete();
        $request->session()->flash("delete");
        return redirect()->route('commissions.index');
    }
}
