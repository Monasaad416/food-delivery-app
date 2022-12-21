<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Bank;

class BankController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.banks.index');
    }

    public function banksList(Request $request)
    {
        $data = Bank::latest()->get();
        $user = auth()->user();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function($row){
            return $row->name;
            })
            ->addColumn('account_no', function($row){
                return $row->account_no;
                })

            ->addColumn('edit', function($row) use($user){
          
                    $edit = '<a  href="'. Route('banks.edit',$row->id) .'"  class="btn btn-success btn-sm"><i class="typcn typcn-edit"></i></a>';
                    return $edit;

            })
            ->addColumn('delete', function($row) use($user){

                    $delete ='<button type="button" class="btn btn-danger btn-sm" id="delete_btn" data-id = "'. $row->id .'" data-name = "'. $row->name .'" data-toggle="modal" data-target="#delete_bank_modal">
                            <i class="typcn typcn-document-delete"></i>
                            </button>';
                    return $delete;
            
            })



            ->rawColumns(['edit','delete'])
            ->make(true);
    }

    public function create()
    {
        return view('dashboard.pages.banks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'account_no' => 'required|string',
        ]);

        $bank = Bank::create([
            'name' => $request->name,
            'account_no' => $request->account_no,
        ]);

        $request->session()->flash("success");
        return redirect()->route('banks.index');
    }


    public function edit($id)
    {
        $bank = Bank::findOrFail($id);
        return view('dashboard.pages.banks.edit',['bank'=>$bank]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'account_no' => 'nullable|string',
        ]);

        $bank = Bank::findOrFail($id);
        $path = $bank->image;

        $bank->update([
            'name' => $request->name,
            'account_no' => $request->account_no,
        ]);

        $request->session()->flash("update");
        return redirect()->route('banks.index');
    }

    public function delete(Request $request)
    {
        Bank::findOrFail($request->id)->delete();
        $request->session()->flash("delete");
        return redirect()->route('banks.index');
    }
}
