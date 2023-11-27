<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Customer;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::select(
            'customers.id as id',
            'date',
            'b.name as brand',
            'customers.phone_number',
            'customers.customer_name',
            'customers.email',
            'customers.bussiness_name',
            'customers.package',
            'customers.amount',
            'customers.remaining',
            'customers.agent',
            'customers.assigned_to',
            'customers.welcome_email',
            'customers.assigned_pm',
            'customers.project_status',
            'customers.calling'
        )
            ->leftjoin('brands as b', 'b.id', 'customers.brand')
            ->orderBy('customers.id', 'desc')
            ->get();
        $brands = Brand::all();
        if (isset(Auth::user()->id)) {
            return view('lead.customers.index', compact('customers', 'brands'));
        } else {
            return view('admin.pages.customer.index', compact('customers', 'brands'));
        }
    }

    public function create()
    {
        $brands = Brand::all();
        if (isset(Auth::user()->id)) {
            return view('lead.customers.create', compact('brands'));
        } else {
            return view('admin.pages.customer.create', compact('brands'));
        }
    }

    public function insert_new_customer(Request $request)
    {
        $new = Customer::create($request->only([
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

    public function customer_edit($id)
    {
        $customer = Customer::find($id);
        $brands = Brand::all();
        if (isset(Auth::user()->id)) {
            return view('lead.customers.edit', compact('customer', 'brands'));
        } else {
            return view('admin.pages.customer.edit', compact('customer', 'brands'));
        }
    }

    public function customer_update(Request $request)
    {
        $customer = Customer::find($request->id)->update($request->all());
        if ($customer) {
            if (isset(Auth::user()->id)) {
                return redirect()->route('get_customers')->with('success', 'Customer Updated Successfully.');
            }
            return redirect()->route('admin.get_customers')->with('success', 'Customer Updated Successfully.');
        }
        return back()->with('error', 'There Was An Error Updating Customer Please Try Again Later!');
    }

    public function filter(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $brand = $request->brandFilter;
        $result = $to != '';
        $data = $request->all();
        $customers = DB::table('customers as c')
            ->leftjoin('brands as b', 'b.id', 'c.brand')
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

        return view('admin.pages.customer.index', compact('customers', 'brands', 'data'));
    }
}
