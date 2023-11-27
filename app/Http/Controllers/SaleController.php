<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
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
        $sales = DB::table('customers')
            ->select(
                'email',
                DB::raw('SUM(amount) as sum'),
                DB::raw('MAX(id) as id'),
                DB::raw('MAX(customer_name) as customer_name'),
                DB::raw('MAX(date) as date'),
                DB::raw('MAX(phone_number) as phone_number'),
                DB::raw('MAX(bussiness_name) as bussiness_name')
            )
            ->groupBy('email')
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
        $email = Customer::find($id);
        $sales = DB::table('customers')->where('email', $email->email)->orderBy('date', 'desc')->get();
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
}
