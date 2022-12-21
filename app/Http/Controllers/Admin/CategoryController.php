<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.categories.index');
    }

    public function categoriesList(Request $request)
    {
        $data = Category::latest()->get();
        $user = auth()->user();
        return DataTables::of($data)
            ->addIndexColumn()
                ->addColumn('name', function($row){
                return $row->name;
            })
            ->addColumn('edit', function($row) use($user){
                if($user->can('تعديل-التصنيف')){
                    $edit = '<a  href="'. Route('categories.edit',$row->id) .'"  class="btn btn-success btn-sm"><i class="typcn typcn-edit"></i></a>';
                    return $edit;
                }
                return '<p class="text-muted">غير مسموح</p>';
            })
            ->addColumn('delete', function($row) use($user){
                if($user->can('حذف-التصنيف')){
                    $delete ='<button type="button" class="btn btn-danger btn-sm" id="delete_btn" data-id = "'. $row->id .'" data-name = "'. $row->name .'" data-toggle="modal" data-target="#delete_category_modal">
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
        return view('dashboard.pages.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Category::create([
            'name' => $request->name,
        ]);

        $request->session()->flash("success");
        return redirect()->route('categories.index');
    }

   public function edit($id)
    {
        $category = category::find($id);
        return view('dashboard.pages.categories.edit',['category'=>$category]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
        ]);

        $category = category::find($id);
    
        $category->update([
            'name' => $request->name,
        ]);

        $request->session()->flash("update");
        return redirect()->route('categories.index');
    }

    public function delete(Request $request)
    {
        $category = category::findOrFail($request->id)->delete();
        $request->session()->flash("delete");
        return redirect()->route('categories.index');
    }
}
