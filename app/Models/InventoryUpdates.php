<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryUpdates extends Model
{
    use HasFactory;
    protected $guarded = [] ;

    public function orders()
    {
        return $this->hasMany(Order::class,'order_id','id');
    }
}
