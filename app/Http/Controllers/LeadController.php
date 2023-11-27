<?php

namespace App\Http\Controllers;


use App\Models\Brand;
use App\Models\LeadAssign;
use App\Models\Payment;
use App\Models\User;
use App\Models\UserBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    private $user = null;
    private $brand = null;
    private $payment = null;
    private $user_brand = null;
    private $lead_assigned = null;

    public function __construct()
    {
        $this->user = new User();
        $this->brand = new Brand();
        $this->payment = new Payment();
        $this->user_brand = new UserBrand();
        $this->lead_assigned = new LeadAssign();

    }

    public function index()
    {
        $brands = $this->brand->get_brands();
        $all_brands = $this->brand->get_all_brands();
        $users = $this->user->lead_get_users();
        $payments = $this->payment->get_paid_payments();
        $today = $this->payment->today();
        $yesterday = $this->payment->yesterday();
        $month = $this->payment->month();
        $un_paid_month = $this->payment->un_paid_month();
        $all_users = $this->user->lead_all_users();
        $last_month = $this->payment->last_month();
        $year = $this->payment->year();
        $target = $this->user->target();
        return view('lead.index', compact('brands', 'all_brands', 'users', 'all_users', 'payments', 'last_month', 'today', 'yesterday', 'month', 'year', 'un_paid_month', 'target'));
    }

    public function profile($id)
    {
        $check = $this->user->check($id);
        if ($check->team_lead == Auth::user()->id || $id == Auth::user()->id) {
            $user = $this->user->find_user($id);
            $today = $this->user->today($id);
            $month = $this->user->month($id);
            $un_paid = $this->user->un_paid($id);
            $year = $this->user->year($id);
            $user_brand = $this->user_brand->get_brands($id);
            $payments = $this->payment->get_paid_payments_by_user($id);
            $team = $this->user->team($id);
            $team_sale = $this->user->team_sale($id);
            $unpad_leads = $this->payment->get_unpaid_payments();
            $lead_assigned = $this->lead_assigned->assigned_leads();
            // dd($unpad_leads);
            return view('lead.profile', compact('user', 'today', 'month', 'un_paid', 'year', 'user_brand', 'team', 'team_sale', 'payments', 'unpad_leads', 'lead_assigned'));
        }
        return back();
    }
}
