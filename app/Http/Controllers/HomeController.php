<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\add_brand_request;
use App\Models\Brand;
use App\Models\Payment;
use App\Models\User;
use App\Models\UserBrand;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PDF;

class HomeController extends Controller
{

    private $user = null;
    private $brand = null;
    private $payment = null;
    private $user_brand = null;

    public function __construct()
    {
        $this->middleware('auth');
        $this->user = new User();
        $this->brand = new Brand();
        $this->payment = new Payment();
        $this->user_brand = new UserBrand();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $brands = $this->brand->get_brands();
        $all_brands = $this->brand->get_all_brands();
        $users = $this->user->get_users();
        $all_users = $this->user->all_users();
        $payments = $this->payment->get_paid_payments();
        $today = $this->payment->today();
        $yesterday = $this->payment->yesterday();
        $month = $this->payment->month();
        $un_paid_month = $this->payment->un_paid_month();
        $last_month = $this->payment->last_month();
        $year = $this->payment->year();
        $target = $this->user->target();
        $result =  $this->payment->month_sale();
        $month_upsale = $result->upsell_amount;
        $month_sale = $result->front_sale_amount;
        $UnPaid = $this->payment->get_unpaid_payments_all();
        return view('home', compact('brands', 'UnPaid', 'month_upsale', 'month_sale', 'all_brands', 'users', 'all_users', 'payments', 'today', 'yesterday', 'month', 'last_month', 'year', 'un_paid_month', 'target'));
    }

    public function generatePdf($id){
        $record = Payment::find($id);
        $array = [
            'email' => $record->customeremail,
            'name' => $record->customerphone,
            'amount' => $record->amount,
            'description' => $record->comments,
            'date' => $record->date,
            'invoice' => $record->transactionkey,
            'name' => $record->name,
        ];
        if($record->brand == 3){
            $pdf = PDF::loadView('myPDF', $array);
            return $pdf->download('Invoice.pdf');
        }else if($record->brand == 8){
            $pdf = PDF::loadView('amazeweb', $array);
            return $pdf->download('Invoice.pdf');
        }else if($record->brand == 1){
            $pdf = PDF::loadView('amazelogo', $array);
            return $pdf->download('Invoice.pdf');

        }
    }

    public function chart(Request $request)
    {
        $dates = $this->payment->dates($request->id);
        return response()->json($dates);
    }

}
