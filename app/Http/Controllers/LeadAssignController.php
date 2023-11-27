<?php

namespace App\Http\Controllers;

use App\Models\LeadAssign;
use Illuminate\Http\Request;

class LeadAssignController extends Controller
{
    protected $assign_lead = null;

    public function __construct()
    {
        $this->assign_lead = new LeadAssign();
    }

    public function assign(Request $request){
        $result = $this->assign_lead->assign($request);
        if($result){
            return back();
        }
    }
}
