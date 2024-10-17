<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreelancerOrders extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function order()
    {
        return $this->belongsToMany(Order::class,'freelancer_orders','id','order_id');
    }
    public function freelancers()
    {
        return $this->belongsToMany(Freelancer::class,'freelancer_orders','id','freelancer_id');
    }
}
