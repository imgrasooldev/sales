<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Lead extends Model
{
    use HasFactory;

    public function insert($data){
        try{
            //add lead
            $insert = new Lead();
            $insert->firstName = $data->first_name;
            $insert->lastName = $data->last_name;
            $insert->leadTitle = $data->lead_title;
            $insert->description = $data->description;
            $insert->email = $data->email;
            $insert->telephone = $data-> phone;
            $insert->leadValue = $data->lead_value;
            $insert->status = $data->status;
            $insert->user_id = Auth::user()->id;
            $insert->save();

            //get last id of inserted lead
            $id = $insert->id;

            //add comment
            $comment = new Comment();
            $comment->comment = $data->comment;
            $comment->lead_id = $id;
            $comment->user_id = Auth::user()->id;
            return $comment->save();


        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function filter_leads(){
        return DB::table('leads as l')->get();
    }
    
    public function all_leads(){
        return DB::table('leads as l')
        ->select('l.id as lead_id', 'u.name', 'u.last_name', 'l.firstName as lead_name', 'l.lastName as lead_last_name', 'l.leadTitle', 'description', 'l.email as lead_email', 'telephone as lead_phone', 'l.leadValue', 'l.status as lead_status', 'c.comment as lead_comment', 'l.created_at', 'l.updated_at')
        ->join('comments as c', 'c.lead_id', 'l.id')
        ->join('users as u', 'c.user_id', 'u.id')
        ->get();
    }

    public function show_lead($id){
        return DB::table('leads as l')
        ->select('l.id as lead_id', 'u.name', 'u.last_name', 'l.firstName as lead_name', 'l.lastName as lead_last_name', 'l.leadTitle', 'description', 'l.email as lead_email', 'telephone as lead_phone', 'l.leadValue', 'l.status as lead_status', 'c.comment as lead_comment', 'l.created_at', 'l.updated_at')
        ->join('comments as c', 'c.lead_id', 'l.id')
        ->join('users as u', 'c.user_id', 'u.id')
        ->where('l.id', $id)
        ->get();
    }

    public function update_lead($data){
        $update = Lead::find($data->id);
        $update->firstName = $data->first_name;
        $update->lastName = $data->last_name;
        $update->leadTitle = $data->lead_title;
        $update->description = $data->description;
        $update->email = $data->email;
        $update->telephone = $data->phone;
        $update->status = $data->status;
        $update->leadValue = $data->lead_value;
        $update->status = $data->status;
        return $update->save();
    }

    // public function show_comment($id){
    //     return Comment::where('lead_id', $id)
    //             ->limit(1)
    //             ->get();
    // }
}
