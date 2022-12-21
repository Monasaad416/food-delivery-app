<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use DataTables;

class RegionController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.regions.index');
    }

    public function regionsList(Request $request)
    {
            $data = Region::latest()->get();
            $user = auth()->user();
            return DataTables::of($data)
                ->addIndexColumn()
                 ->addColumn('name', function($row){
                    return $row->name;
                })

                ->addColumn('city_id', function($row){
                    return $row->city->name;
                })
                ->addColumn('edit', function($row) use($user){
                    if($user->can('تعديل-المنطقة')){
                        $edit = '<a  href="'. Route('regions.edit',$row->id) .'"  class="btn btn-success btn-sm"><i class="typcn typcn-edit"></i></a>';
                        return $edit;
                    }
                    return '<p class="text-muted">غير مسموح</p>';   
                })
                ->addColumn('delete', function($row) use($user){
                    if($user->can('حذف-المنطقة')){
                        $delete ='<button type="button" class="btn btn-danger btn-sm" id="delete_btn" data-id = "'. $row->id .'" data-name = "'. $row->name .'" data-toggle="modal" data-target="#delete_region_modal">
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
        return view('dashboard.pages.regions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city_id'=> 'required|exists:cities,id',
        ]);

        $region = Region::create([
            'name' => $request->name,
            'city_id' => $request->city_id,
        ]);

        $request->session()->flash("success");
        return redirect()->route('regions.index');
    }


    public function edit($id)
    {
        $region = Region::findOrFail($id);
        return view('dashboard.pages.regions.edit',['region'=>$region]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'city_id'=> 'nullable|exists:cities,id',

        ]);

        $region = region::findOrFail($id);

        $region->update([
            'name' => $request->name,
            'city_id' => $request->city_id,
        ]);

        $request->session()->flash("update");
        return redirect()->route('regions.index');
    }

    public function delete(Request $request)
    {
        $region = region::findOrFail($request->id)->delete();
        $request->session()->flash("delete");
        return redirect()->route('regions.index');
    }
}
