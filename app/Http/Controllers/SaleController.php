<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Payment;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:sale-list|sale-create|sale-edit|sale-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:sale-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:sale-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:sale-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $sales = DB::table('payments')
            ->select(
                'customeremail as email',
                DB::raw('SUM(amount) as sum'),
                DB::raw('MAX(id) as id'),
                DB::raw('MAX(customer_name) as customer_name'),
                DB::raw('MAX(date) as date'),
                DB::raw('MAX(customerphone) as phone_number'),
                DB::raw('MAX(bussiness_name) as bussiness_name')
            )
            ->groupBy('customeremail')
            ->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
        $email = Payment::find($id);
        $sales = DB::table('payments as c')->select('c.*', 'b.name', 'u.name as agent')->join('users as u', 'u.id', 'agent')->join('brands as b', 'b.id', 'c.brand')->where('customeremail', $email->customeremail)->orderBy('date', 'desc')->get();
        return view('sales.show', compact('sales'));
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }

    public function today()
    {
        $sales = DB::table('payments')
            ->select(
                'customeremail as email',
                'amount as sum',
                'id',
                'customer_name',
                'date',
                'customerphone as phone_number',
                'bussiness_name'
            )->where('is_paid', 1)
            ->whereDate('created_at', now()->toDateString())
            ->orderBy('id', 'desc')
            ->get();
        return view('sales.sales', compact('sales'));
    }

    public function upsale()
    {
        $sales = DB::table('payments')
            ->select(
                'customeremail as email',
                'amount as sum',
                'id',
                'customer_name',
                'date',
                'customerphone as phone_number',
                'bussiness_name'
            )
            ->where('is_paid', 1)
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->whereIn('paymenttype', ['Upsell', 'Upsell Partial'])
            ->orderBy('id', 'desc')
            ->get();
        return view('sales.sales', compact('sales'));
    }

    public function frontsale()
    {
        $sales = DB::table('payments')
            ->select(
                'customeremail as email',
                'amount as sum',
                'id',
                'customer_name',
                'date',
                'customerphone as phone_number',
                'bussiness_name'
            )
            ->where('is_paid', 1)
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->whereNotIn('paymenttype', ['Upsell', 'Upsell Partial'])
            ->orderBy('id', 'desc')
            ->get();
        return view('sales.sales', compact('sales'));
    }

    public function yesterday()
    {
        $sales = DB::table('payments')
            ->select(
                'customeremail as email',
                'amount as sum',
                'id',
                'customer_name',
                'date',
                'customerphone as phone_number',
                'bussiness_name'
            )->where('is_paid', 1)
            ->whereDate('created_at', now()->subDay()->toDateString())
            ->orderBy('id', 'desc')
            ->get();
        return view('sales.sales', compact('sales'));
    }

    public function thisMonth()
    {
        $sales = DB::table('payments')
            ->select(
                'customeremail as email',
                'amount as sum',
                'id',
                'customer_name',
                'date',
                'customerphone as phone_number',
                'bussiness_name'
            )->where('is_paid', 1)
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->orderBy('id', 'desc')
            ->get();
        return view('sales.sales', compact('sales'));
    }

    public function unPaidThisMonth()
    {
        $sales = DB::table('payments')
            ->select(
                'customeremail as email',
                'amount as sum',
                'id',
                'customer_name',
                'date',
                'customerphone as phone_number',
                'bussiness_name'
            )->where('is_paid', 0)
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->orderBy('id', 'desc')
            ->get();
        return view('sales.sales', compact('sales'));
    }

    public function year()
    {
        $sales = DB::table('payments')
            ->select(
                'customeremail as email',
                'amount as sum',
                'id',
                'customer_name',
                'date',
                'customerphone as phone_number',
                'bussiness_name'
            )->where('is_paid', 1)
            ->whereYear('created_at', now()->year)
            ->orderBy('id', 'desc')
            ->get();
        return view('sales.sales', compact('sales'));
    }

    public function lastMonth()
    {
        $startOfMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfMonth = Carbon::now()->subMonth()->endOfMonth();
        $sales = DB::table('payments')
            ->select(
                'customeremail as email',
                'amount as sum',
                'id',
                'customer_name',
                'date',
                'customerphone as phone_number',
                'bussiness_name'
            )
            ->where('is_paid', 1)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->orderBy('id', 'desc')
            ->get();
        return view('sales.sales', compact('sales'));
    }
}
