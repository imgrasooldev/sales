<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Lead;
use App\Models\Comment;
use App\Models\LeadAssign;
use App\Models\Payment;
use App\Models\User;
use App\Models\UserBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use PDF;
use Illuminate\Support\Facades\DB as FacadesDB;

use function GuzzleHttp\Promise\all;

class HomeController extends Controller
{
    private $user = null;
    private $brand = null;
    private $payment = null;
    private $user_brand = null;
    private $lead = null;
    private $lead_assigned = null;

    public function __construct()
    {
        $this->user = new User();
        $this->brand = new Brand();
        $this->payment = new Payment();
        $this->user_brand = new UserBrand();
        $this->lead = new Lead();
        $this->lead_assigned = new LeadAssign();
    }

    public function index()
    {
        $id = Auth::user()->id;
        $user = $this->user->find_user($id);
        $today = $this->user->today($id);
        $month = $this->user->month($id);
        $un_paid = $this->user->un_paid($id);
        $year = $this->user->year($id);
        $user_brand = $this->user_brand->get_brands($id);
        $team = $this->user->team($id);
        $team_sale = $this->user->team_sale($id);
        $payments = $this->payment->get_paid_payments_by_user();
        $unpad_leads = $this->payment->get_unpaid_payments();
        $lead_assigned = $this->lead_assigned->assigned_leads();
        $paid_leads = $this->payment->get_paid_payments();
        return view('lead.profile', compact('user', 'paid_leads', 'today', 'month', 'un_paid', 'year', 'user_brand', 'team', 'team_sale', 'payments', 'unpad_leads', 'lead_assigned'));
    }

    public function chart(Request $request)
    {
        $dates = $this->payment->dates($request->id);
        return response()->json($dates);
    }


    public function add_lead()
    {
        $filter = $this->lead->filter_leads();
        $leads = $this->lead->all_leads();
        $users = $this->user->users_without_team_lead();
        return view('lead.lead.add_lead', compact('leads', 'filter', 'users'));
    }

    public function add_new_lead()
    {
        return view('lead.lead.add_new_lead');
    }

    public function create_lead(Request $request)
    {
        $result = $this->lead->insert($request);
        if ($result) {
            return back()->with('success', 'Lead Has Been Added Succesfully');
        } else {
            return back()->with('error', 'Lead Has Failed To Be Added.');
        }
    }

    public function edit_lead($id)
    {
        $lead = $this->lead->show_lead($id);
        return view('lead.lead.edit_lead', compact('lead'));
    }


    public function update_lead(Request $request)
    {
        $result = $this->lead->update_lead($request);
        if ($result) {
            return back()->with('success', 'Lead Has Been Updated Succesfully');
        } else {
            return back()->with('error', 'Lead Has Failed To Be Update.');
        }
    }

    public function add_comment(Request $request){
        // dd($request->all());
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->comment = $request->comment;
        $comment->lead_id = $request->lead_id;
        $comment->save();
        return back();
    }

    public function comments(Request $request){
        $comments = FacadesDB::table('comments as c')->select('c.comment', 'c.created_at', 'u.name', 'u.last_name')->join('users as u', 'c.user_id', 'u.id')->where('lead_id', $request->id)->take(5)->orderBy('c.id', 'desc')->get();
        return response()->json($comments);
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
