<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Payment;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    private $user = null;
    private $payment = null;
    private $brand = null;

    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);

        $this->user = new User();
        $this->brand = new Brand();
        $this->payment = new Payment();
    }


    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->paginate(5);
        $month = $this->payment->month();
        $target = $this->user->target();
        return view('users.index', compact('data', 'month', 'target'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $team = User::where('type', 0)->get();
        $leads = $this->user->leads();
        $brands = $this->brand->get_all_brands();
        return view('users.create', compact('roles', 'team', 'leads', 'brands'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        // $result = $this->user->addUser($request);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $result = $user = User::create($input);
        $user->assignRole($request->input('roles'));

        if ($result) {
            return back()->with('success', 'User Added Successfully.');
        } else {
            return back()->with('error', 'User Not Added!');
        }


        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function show($id)
    {
        $user = User::find($id);
        $month = $this->payment->month();
        $target = $this->user->target();
        return view('users.show', compact('user', 'target', 'month'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $month = $this->payment->month();
        $target = $this->user->target();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole', 'month', 'target'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
