<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{
    use HasFactory;

    public function get_paid_payments(){
        return DB::table('payments as p')->select('p.id', 'p.comments', 'p.updated_at', 'p.amount', 'p.customeremail', 'p.customerphone', 'p.paymenttype', 'u.name as agent_name', 'b.name as brand_name')->join('brands as b', 'b.id', 'p.brand')->join('users as u', 'u.id', 'p.agent')->where('p.is_paid', 1)->whereRaw('MONTH(p.created_at) = ?', date('m'))->orderBy('p.created_at', 'desc')->get();
    }

    public function get_unpaid_payments(){
        return DB::table('payments as p')->select('p.link', 'p.comments', 'p.updated_at', 'p.amount', 'p.customeremail', 'p.customerphone', 'p.paymenttype', 'u.name as agent_name', 'b.name as brand_name')->join('brands as b', 'b.id', 'p.brand')->join('users as u', 'u.id', 'p.agent')->where('agent', Auth::user()->id)->where('p.is_paid', 0)->orderBy('p.created_at', 'desc')->get();
    }

public function get_unpaid_payments_all(){
        return DB::table('payments as p')->select('p.link', 'p.comments', 'p.updated_at', 'p.amount', 'p.customeremail', 'p.customerphone', 'p.paymenttype', 'u.name as agent_name', 'b.name as brand_name')->join('brands as b', 'b.id', 'p.brand')->join('users as u', 'u.id', 'p.agent')->where('p.is_paid', 0)->orderBy('p.created_at', 'desc')->get();
    }
    
    public function get_paid_payments_by_user(){
        return DB::table('payments as p')->select('p.id', 'p.comments', 'p.updated_at', 'p.amount', 'p.customeremail', 'p.customerphone', 'p.paymenttype', 'u.name as agent_name', 'b.name as brand_name')->join('brands as b', 'b.id', 'p.brand')->join('users as u', 'u.id', 'p.agent')->where('p.is_paid', 1)->where('u.id', Auth::user()->id)->orderBy('p.id', 'desc')->get();
    }

    public function today(){
        return DB::table('payments as p')->select(DB::raw('sum(p.amount) as amount'))->whereDate('created_at', Carbon::today())->where('is_paid', 1)->get();
    }

    public function yesterday(){
        return DB::table('payments as p')->select(DB::raw('sum(p.amount) as amount'))->whereDate('created_at', Carbon::yesterday())->where('is_paid', 1)->get();
    }

    public function month_sale(){
        return DB::table('payments as p')
        ->select(
            DB::raw('SUM(CASE WHEN p.paymenttype IN (?, ?) THEN p.amount ELSE 0 END) AS upsell_amount'),
            DB::raw('SUM(CASE WHEN p.paymenttype NOT IN (?, ?) THEN p.amount ELSE 0 END) AS front_sale_amount')
        )
        ->whereRaw('MONTH(p.created_at) = ?', [date('m')])
        ->where('p.is_paid', 1)
        ->setBindings(['Upsell', 'Upsell Partial', 'Upsell', 'Upsell Partial'], 'select')
        ->first();
    }

    public function month(){
        return DB::table('payments as p')->select(DB::raw('sum(p.amount) as amount'))->whereRaw('MONTH(p.created_at) = ?', date('m'))->where('p.is_paid', 1)->get();
    }

    public function last_month(){
        $month = Carbon::now()->subMonth()->month;
        return DB::table('payments as p')->select(DB::raw('sum(p.amount) as amount'))->whereRaw('MONTH(p.created_at) = ?', $month)->where('p.is_paid', 1)->get();
    }

     public function year(){

        return DB::table('payments as p')->select(DB::raw('sum(amount) as amount'))->where('created_at', 'like', '%' . date('Y') . '%')->where('is_paid', 1)->get();
        // return DB::table('payments as p')->select(DB::raw('sum(p.amount) as amount'))->whereRaw('YEAR(p.created_at) = ?', date('y'))->where('p.is_paid', 1)->get();
    }


    public function un_paid_month(){
        return DB::table('payments as p')->select(DB::raw('sum(p.amount) as amount'))->whereRaw('MONTH(p.created_at) = ?', date('m'))->where('p.is_paid', 0)->get();
    }

    public function dates($id){
        return DB::table('payments')->select('date', DB::raw('sum(amount) as amount'))->where('agent', $id)->where('is_paid', 1)->whereRaw('MONTH(created_at) = ?', date('m'))->groupBy('date')->orderBy('date', 'desc')->get();
    }
}
