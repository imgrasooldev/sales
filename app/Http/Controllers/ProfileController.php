<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\User;
use App\Models\UserBrand;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    private $user = null;
    private $brand = null;
    private $payment = null;
    private $user_brand = null;

    function __construct()
    {
        $this->middleware('permission:profile-list|profile-create|profile-edit|profile-delete', ['only' => ['index', 'store', 'show']]);
        $this->middleware('permission:profile-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:profile-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:profile-delete', ['only' => ['destroy']]);
        $this->user = new User();
        $this->brand = new Brand();
        $this->payment = new Payment();
        $this->user_brand = new UserBrand();}

    public function index(Request $request)
    {
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
        $user = $this->user->find_user($id);
        $today = $this->user->today($id);
        $month = $this->user->month($id);
        $un_paid = $this->user->un_paid($id);
        $year = $this->user->year($id);
        $user_brand = $this->user_brand->get_brands($id);
        $team = $this->user->team($id);
        $team_sale = $this->user->team_sale($id);
        $payments = $this->payment->get_paid_payments_by_user();
        return view('profile.show', compact('user', 'payments', 'today', 'month', 'un_paid', 'year', 'user_brand', 'team', 'team_sale'));
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
