<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Brand extends Model
{
    use HasFactory;
    public function add($data){
        $brand = new Brand();
        $brand->name = $data->name;
        if($data->hasFile('image')){
            $imageName = time().'.'.$data->image->extension();
            $data->image->move(public_path('images'), $imageName);
        }
        $brand->image = $imageName;
        $brand->url = $data->url;
        $brand->contact_no = $data->contact;
        return $brand->save();
    }

    public function get_brands(){
        // dd(date('Y-m-d'));
        return DB::table('brands as b')
            ->select('b.image', 'b.id as id', 'b.name', 'b.url', DB::raw('sum(p.amount) as amount'))
            ->leftJoin('payments as p', 'p.brand', 'b.id')
            ->where('b.status', '1')
            ->where('p.is_paid', 1)
            ->where('p.created_at', 'like', date('Y-m').'%')
            ->groupBy('b.id')
            ->get();
    }

    public function get_all_brands(){
        return DB::table('brands')->where('status', 1)->get();
    }

    public function find_brand($id){
        return Brand::find($id);
    }

    public function delete_brand($id){
        $brand = Brand::find($id);
        $brand->status = 0;
        return $brand->save();
    }

    public function update_brand($data){
        $brand = Brand::find($data->id);
        $brand->name = $data->name;
        $brand->url = $data->url;
        if($data->hasFile('image')){
            $imageName = time().'.'.$data->image->extension();
            $data->image->move(public_path('images'), $imageName);
            $brand->image = $imageName;
        }
        $brand->contact_no = $data->contact;
        return $brand->save();
    }
}
