<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use DataTables;

class CityController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.cities.index');
    }

    public function citiesList(Request $request)
    {
        $data = City::latest()->get();
        $user = auth()->user();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function($row){
            return $row->name;
            })
            ->addColumn('edit', function($row) use($user){
                if($user->can('تعديل-المحافظة')){
                    $edit = '<a  href="'. Route('cities.edit',$row->id) .'"  class="btn btn-success btn-sm"><i class="typcn typcn-edit"></i></a>';
                    return $edit;
                }
                return '<p class="text-muted">غير مسموح</p>';
            })
            ->addColumn('delete', function($row) use($user){
                if($user->can('حذف-المحافظة')){
                    $delete ='<button type="button" class="btn btn-danger btn-sm" id="delete_btn" data-id = "'. $row->id .'" data-name = "'. $row->name .'" data-toggle="modal" data-target="#delete_city_modal">
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
        return view('dashboard.pages.cities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $city = City::create([
            'name' => $request->name,
        ]);

        $request->session()->flash("success");
        return redirect()->route('cities.index');
    }


    public function edit($id)
    {
        $city = city::findOrFail($id);
        return view('dashboard.pages.cities.edit',['city'=>$city]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
        ]);

        $city = city::findOrFail($id);
        $path = $city->image;

        $city->update([
            'name' => $request->name,
        ]);

        $request->session()->flash("update");
        return redirect()->route('cities.index');
    }

    public function delete(Request $request)
    {
        City::findOrFail($request->id)->delete();
        $request->session()->flash("delete");
        return redirect()->route('cities.index');
    }
}
