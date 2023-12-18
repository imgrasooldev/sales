<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index(Request $request)
    {

        if($request->ajax()) {

             $data = Comment::whereDate('date', '>=', $request->start)->where('user_id', Auth::user()->id)
                       ->get(['id', 'title', 'date']);

             return response()->json($data);
        }

        $customers = Payment::latest()->groupby('customeremail')->get();
        return view('calendar.index', compact('customers'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {
        switch ($request->type) {
           case 'add':
              $email = Payment::find($request->customer_id);
              $event = Comment::create([
                  'title' => $request->title,
                  'date' => $request->start,
                  'user_id' => Auth::user()->id,
                  'lead_id' => $email->customeremail,
                  'time' => $request->time,
                  'visibility' => $request->visibility
              ]);

              return response()->json($event);
             break;

           case 'update':
              $email = Payment::find($request->customer_id);
              $event = Comment::find($request->id)->update([
                  'title' => $request->title,
                  'date' => $request->start,
                  'user_id' => Auth::user()->id,
                  'lead_id' => $email->customeremail
              ]);

              return response()->json($event);
             break;

           case 'delete':
              $event = Comment::select('title')->where('id',$request->id)->first();

              return response()->json($event->title);
             break;

           default:
             # code...
             break;
        }
    }


    public function showAlert(){
        $time = date('H:i:s');
        $records = Comment::select('time', 'title', 'id', 'visibility', 'user_id')->where('date', Date('Y-m-d'))->where('seen', 0)->get();
        foreach($records as $record){
            if($record->time <= $time){
                return ['status' => true, 'message' => $record->title, 'id' => $record->id, 'visibility' => $record->visibility, 'user_id' => $record->user_id];
            }
        }
    }

    public function seen(Request $request){
        $id = $request->id;
        return Comment::where('id', $id)->update(['seen' => 1]);
    }
}
