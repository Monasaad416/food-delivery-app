<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use DataTables;

class OfferController extends Controller
{

  public function index()
  {
      return view('dashboard.pages.offers.index');
  }

  public function offersList(Request $request)
  {
      $data = Offer::latest()->get();
      $user = auth()->user();
      return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('name', function($row){
          return $row->name;
          })
          ->addColumn('image', function($row){
            $imgUrl = asset('uploads/'.$row->image);
            $img = '<img src="'. $imgUrl .'"   alt=" '.$row->id.' "/>';
            return $img;
          })
          ->addColumn('name', function($row){
              return $row->name;
              })
          ->addColumn('description', function($row){
            return $row->description;
            })
          ->addColumn('from_date', function($row){
            return $row->from_date;
            })
          ->addColumn('to_date', function($row){
            return $row->to_date;
            })

          ->addColumn('delete', function($row) use($user){
            $delete ='<button type="button" class="btn btn-danger btn-sm" id="delete_btn" data-id = "'. $row->id .'" data-name = "'. $row->name .'" data-toggle="modal" data-target="#delete_offer_modal">
              <i class="typcn typcn-document-delete"></i>
              </button>';
            return $delete;
          })
          ->rawColumns(['image','delete'])
          ->make(true);
  }



  public function delete(Request $request)
  {
      Offer::findOrFail($request->id)->delete();
      $request->session()->flash("delete");
      return redirect()->route('offers.index');
  }

}

?>
