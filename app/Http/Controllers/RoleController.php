<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    private $user = null;
    private $payment = null;

    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);

         $this->user = new User();
         $this->payment = new Payment();
    }

    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(5);
        $month = $this->payment->month();
        $target = $this->user->target();
        return view('roles.index',compact('roles', 'month', 'target'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $month = $this->payment->month();
        $target = $this->user->target();
        $permission = Permission::get();
        return view('roles.create',compact('permission', 'target', 'month'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }

    public function show($id)
    {
        $month = $this->payment->month();
        $target = $this->user->target();
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return view('roles.show',compact('role','rolePermissions', 'target', 'month'));
    }

    public function edit($id)
    {
        $month = $this->payment->month();
        $target = $this->user->target();
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('roles.edit',compact('role','permission','rolePermissions', 'month', 'target'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }

    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }
}
