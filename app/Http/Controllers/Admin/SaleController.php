<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $sales = DB::table('customers')->select('id', 'customer_name', 'email', DB::raw('max(date) as date'), 'phone_number', 'bussiness_name', DB::raw('sum(amount) as sum'))->groupBy('email')->orderby('date', 'desc')->get();
        return view('admin.pages.sale.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $email = Customer::find($id);
        $sales = DB::table('customers')->leftJoin('brands as b', 'customers.brand', 'b.id')->where('email', $email->email)->orderBy('date', 'desc')->get();
        return view('admin.pages.sale.show', compact('sales'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
