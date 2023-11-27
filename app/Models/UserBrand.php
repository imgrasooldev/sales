<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserBrand extends Model
{
    use HasFactory;

    public function get_brands($id){
        return DB::table('user_brands as ub')->select('name')->join('brands as b', 'b.id', 'ub.brand_id')->where('ub.status', 1)->where('ub.user_id', $id)->get();
    }
}
