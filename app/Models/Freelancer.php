<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Freelancer extends Model
{
    use HasFactory;

    protected $guarded = [];

public static function getAllFreelancer(){
    $result = DB::table('freelancers')->select('*')->get()->toArray();
    return $result;
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class,'freelancer_id','id');
    }

    public function holidays()
    {
        return $this->hasMany(Holiday::class);
    }

    public function main_field()
    {
        return $this->belongsTo(MainField::class);
    }

    public function sub_field()
    {
        return $this->belongsTo(SubField::class);
    }

    public function newFranchise()
    {
        return $this->belongsTo(NewFranchise::class, 'new_franchise_id');
    }

    public function freelancerOrder()
    {
        return $this->hasMany(FreelancerOrders::class,'freelancer_id','id');
    }
}
