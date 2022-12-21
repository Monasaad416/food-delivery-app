<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use Illuminate\Http\Request;
use DataTables;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.messages.index');
    }

    public function messagesList(Request $request)
    {
            $data = Message::latest()->get();
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
                ->addColumn('type', function($row){
                    return $row->label();
                })

                ->addColumn('show', function($row) use($user){
                    if($user->can('عرض-الرسالة')){
                        $show = '<a href="'. Route('message.show',$row->id) .'"  class="btn btn-secondary btn-sm"><i class="far fa-eye"></i></a>';
                        return $show;
                    }
                    return '<p class="text-muted">غير مسموح</p>';
                })

                ->addColumn('delete', function($row) use($user){
                    if($user->can('حذف-الرسالة')){
                        $delete ='<button type="button" class="btn btn-danger btn-sm" id="delete_btn" data-id = "'. $row->id .'" data-name = "'. $row->name .'" data-toggle="modal" data-target="#delete_msg_modal">
                                <i class="typcn typcn-document-delete"></i>
                                </button>';
                        return $delete;
                    }
                    return '<p class="text-muted">غير مسموح</p>';
                })

                ->rawColumns(['show','edit','delete'])

                ->make(true);

    }

    public function show($id)
    {
        $message = Message::findOrFail($id);

        return view('dashboard.pages.messages.show',[ 'message' => $message ]);
    }


    public function delete(Request $request)
    {
        $message = Message::findOrFail($request->id)->delete();
        $request->session()->flash("delete");
        return redirect()->route('messages.all');
    }



}

?>

