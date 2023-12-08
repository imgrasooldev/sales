<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_name',
        'phone',
        'address',
        'pseudo_name',
        'position',
        'join_date',
        'country',
        'profile_image',
        'target',
        'status',
        'type',
        'team_lead',
        'stripe_id',
        'pm_type',
        'pm_last_four',
        'trial_ends_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function get_users()
    {
        return DB::table('users as u')->select('u.id', 'u.name', 'last_name', 'target', 'profile_image', DB::raw('sum(p.amount) as achieved'))
            ->leftJoin('payments as p', 'p.agent', 'u.id')->where('u.status', '1')
            ->where('p.is_paid', 1)
            // ->where('u.team_lead', Auth::user()->id)
            ->whereRaw('MONTH(p.created_at) = ?', date('m'))
            ->groupBy('u.id')
            ->get();
    }

    public function all_users()
    {
        return DB::table('users')
            // ->where('team_lead', Auth::user()->id)
            ->where('status', 1)
            ->get();
    }

    public function addUser($data)
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $data->first_name;
            $user->last_name = $data->last_name;
            $user->email = $data->email;
            $user->phone = $data->phone;
            $user->address = $data->address;
            $user->pseudo_name = $data->pseudo_name;
            $user->position = $data->position;
            $user->password = Hash::make($data->password);
            $user->join_date = $data->join_date;
            $user->country = $data->country;
            if (isset($data->lead)) {
                $user->team_lead = $data->lead;
            } else {
                $user->team_lead = 0;
            }
            if ($data->hasFile('image')) {
                $imageName = time() . '.' . $data->image->extension();
                $data->image->move(public_path('profiles'), $imageName);
            }
            $user->profile_image = $imageName;
            $user->target = $data->target;
            $user->type = $data->type;
            if (isset($data->lead)) {
                $user->save();
                foreach ($data->brands as $brand) {
                    $new = new UserBrand();
                    $new->user_id = $user->id;
                    $new->brand_id = $brand;
                    $new->save();
                }
                DB::commit();
                return $user;
            } else {
                $user->save();
                foreach ($data->brands as $brand) {
                    $new = new UserBrand();
                    $new->user_id = $user->id;
                    $new->brand_id = $brand;
                    $new->save();
                }
                foreach ($data->team as $team) {
                    $lead = User::find($team);
                    $lead->team_lead = $user->id;
                    $lead->save();
                }
                DB::commit();
                return true;
            }
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function leads()
    {
        return User::where('type', 1)->where('status', 1)->get();
    }

    public function find_user($id)
    {
        return User::find($id);
    }

    public function delete_user($id)
    {
        $user = User::find($id);
        $user->status = 0;
        return $user->save();
    }

    public function target()
    {
        return DB::table('users')->select(DB::raw('sum(target) as target'))->where('status', 1)->get();
    }

    public function today($id)
    {
        return DB::table('payments')->select(DB::raw('sum(amount) as amount'))->where('agent', $id)->where('created_at', 'like', '%' . today()->toDateString() . '%')->where('is_paid', 1)->get();
    }

    public function month($id)
    {
        return DB::table('payments as p')->select(DB::raw('sum(p.amount) as amount'))->whereRaw('MONTH(p.created_at) = ?', date('m'))->where('agent', $id)->where('p.is_paid', 1)->get();
    }

    public function un_paid($id)
    {
        return DB::table('payments as p')->select(DB::raw('sum(amount) as amount'))->where('created_at', 'like', '%' . date('Y') . '%')->where('agent', $id)->where('is_paid', 0)->get();
    }

    public function year($id)
    {
        return DB::table('payments as p')->select(DB::raw('sum(amount) as amount'))->where('created_at', 'like', '%' . date('Y') . '%')->where('agent', $id)->where('is_paid', 1)->get();
    }

    public function team($id)
    {
        return DB::table('users as u')
            ->select('u.name', 'u.last_name', 'u.id', 'u.position', DB::raw('sum(amount) as amount'))
            ->join('payments as p', 'p.agent', 'u.id')
            ->where('u.team_lead', $id)
            ->where('p.date', 'LIKE', '%-'.date('m').'-%')
            ->where('p.is_paid', 1)
            ->groupBy('agent')
            ->get();
    }

    public function team_sale($id)
    {
        return DB::table('users as u')
        ->select(DB::raw('sum(amount) as amount'))
        ->join('payments as p', 'p.agent', 'u.id')
        ->whereRaw('MONTH(p.created_at) = ?', date('m'))
        ->where('p.is_paid', 1)
        ->where('u.team_lead', $id)
        ->get();
    }







    //Lead
    public function check($id)
    {
        return User::find($id);
    }

    public function lead_get_users()
    {
        return DB::table('users as u')->select('u.id', 'u.name', 'last_name', 'target', 'profile_image', DB::raw('sum(p.amount) as achieved'))
            ->leftJoin('payments as p', 'p.agent', 'u.id')->where('u.status', '1')
            ->where('p.is_paid', 1)
            ->where('u.team_lead', Auth::user()->id)
            ->whereRaw('MONTH(p.created_at) = ?', date('m'))
            ->groupBy('u.id')
            ->get();
    }

    public function lead_all_users()
    {
        return DB::table('users')
            ->where('team_lead', Auth::user()->id)
            ->where('status', 1)
            ->get();
    }


    //assign lead to user
    public function users_without_team_lead(){
        return User::where('status', 1)->where('type', 0)->get();
    }
}
