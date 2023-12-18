<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:customer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:customer-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Payment::select('payments.*', 'b.name as brand')->join('brands as b', 'b.id', 'payments.brand')->orderBy('payments.id', 'desc')->get();
        $brands = Brand::all();
        return view('customers.index', compact('customers', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        return view('customers.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new = Payment::create($request->only([
            'date',
            'brand',
            'customer_name',
            'phone_number',
            'email',
            'bussiness_name',
            'package',
            'amount',
            'remaining',
            'agent',
            'assigned_to',
            'welcome_email',
            'assigned_pm',
            'project_status',
            'calling'
        ]));
        if ($new) {
            return back()->with('success', 'New Customer Created Successfully.');
        }
    return back()->with('error', 'There Was An Error Creating New Customer Please Try Again Later!');
    }

    public function filter(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $brand = $request->brandFilter;
        $result = $to != '';
        $customers = DB::table('customers as c')
            ->when($brand != '', function ($query) use ($brand) {
                $query->where('brand', $brand);
            })
            ->when($from != '', function ($query) use ($from) {
                $query->where('DATE', '>=', $from);
            })
            ->when($to != '', function ($query) use ($to) {
                $query->where('DATE', '<=', $to);
            })
            ->get();

        $brands = Brand::all();

        return view('customers.index', compact('customers', 'brands'));
    }
}
