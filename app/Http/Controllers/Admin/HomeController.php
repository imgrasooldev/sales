<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\add_brand_request;
use App\Models\Brand;
use App\Models\Payment;
use App\Models\User;
use App\Models\UserBrand;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $this->user = new User();
        $this->brand = new Brand();
        $this->payment = new Payment();
        $this->user_brand = new UserBrand();
    }


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
        return view('admin.dashboard', compact('brands', 'UnPaid', 'month_upsale', 'month_sale', 'all_brands', 'users', 'all_users', 'payments', 'today', 'yesterday', 'month', 'last_month', 'year', 'un_paid_month', 'target'));
    }

    public function add_new_brand()
    {
        return view('admin.pages.brand.add');
    }

    public function insert_brand(add_brand_request $request)
    {
        //Validation
        $validated = $request->validated();
        $result = $this->brand->add($request);
        if ($result) {
            return back()->with('success', 'Brand Added Successfully.');
        } else {
            return back()->with('error', 'Brand Not Added!');
        }
    }

    public function edit_brand($id)
    {
        $brand = $this->brand->find_brand($id);
        return view('admin.pages.brand.edit', compact('brand'));
    }

    public function delete_brand($id)
    {
        $delete = $this->brand->delete_brand($id);
        return redirect('admin/dashboard');
    }

    public function update_brand(Request $request)
    {
        $result = $this->brand->update_brand($request);
        if ($result) {
            return back()->with('success', 'Brand Added Successfully.');
        } else {
            return back()->with('error', 'Brand Not Added!');
        }
    }









    public function add_new_user()
    {   $team = User::where('type', 0)->get();
        $leads = $this->user->leads();
        $brands = $this->brand->get_all_brands();

        // dd($team);
        return view('admin.pages.user.add', compact('team', 'leads', 'brands'));
    }

    public function insert_new_user(Request $request)
    {
        $result = $this->user->addUser($request);
        if ($result) {
            return back()->with('success', 'User Added Successfully.');
        } else {
            return back()->with('error', 'User Not Added!');
        }
    }

    public function edit_user($id)
    {
        $user = $this->user->find_user($id);
        return view('admin.pages.user.edit', compact('user'));
    }

    public function delete_user($id)
    {
        $delete = $this->user->delete_user($id);
        return redirect('admin/dashboard');
    }

    public function user_profile($id)
    {
        $user = $this->user->find_user($id);
        $today = $this->user->today($id);
        $month = $this->user->month($id);
        $un_paid = $this->user->un_paid($id);
        $year = $this->user->year($id);
        $user_brand = $this->user_brand->get_brands($id);
        $team = $this->user->team($id);
        $team_sale = $this->user->team_sale($id);
        // dd($team_sale);
        // dd($team);
        return view('admin.pages.user.profile', compact('user', 'today', 'month', 'un_paid', 'year', 'user_brand', 'team', 'team_sale'));
    }

    public function chart(Request $request)
    {
        $dates = $this->payment->dates($request->id);
        return response()->json($dates);
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
}
