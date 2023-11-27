<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\add_brand_request;
use App\Models\Brand;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class BrandController extends Controller
{
    private $brand = null;

    function __construct()
    {
         $this->middleware('permission:brand-list|brand-create|brand-edit|brand-delete', ['only' => ['index','store']]);
         $this->middleware('permission:brand-create', ['only' => ['create','store']]);
         $this->middleware('permission:brand-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:brand-delete', ['only' => ['destroy']]);
         $this->brand = new Brand();
    }

    public function index(Request $request)
    {

    }

    public function create()
    {
        return view('brand.add');
    }

    public function store(add_brand_request $request)
    {
        $validated = $request->validated();
        $result = $this->brand->add($request);
        if ($result) {
            return back()->with('success', 'Brand Added Successfully.');
        } else {
            return back()->with('error', 'Brand Not Added!');
        }

        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $brand = $this->brand->find_brand($id);
        return view('brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $result = $this->brand->update_brand($request);
        if ($result) {
            return back()->with('success', 'Brand Added Successfully.');
        } else {
            return back()->with('error', 'Brand Not Added!');
        }
    }

    public function destroy($id)
    {
        $delete = $this->brand->delete_brand($id);
        return redirect('dashboard');
    }
}
