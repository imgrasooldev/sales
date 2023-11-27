<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LeadAssign extends Model
{
    use HasFactory;
    public function assign($data){
        $new = new LeadAssign();
        $new->user_id = $data->user_id;
        $new->lead_id = $data->lead_id;
        $new->assigned_by = Auth::user()->id;
        $new->status = 1;
        return $new->save();
    }

    public function assigned_leads(){
        return DB::table('lead_assigns as ls')->join('leads as l', 'l.id', 'ls.lead_id')->join('users as u', 'u.id', 'ls.assigned_by')->where('ls.user_id', Auth::user()->id)->where('ls.status', 1)->get();
    }
}
