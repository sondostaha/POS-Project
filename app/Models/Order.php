<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function mainField()
    {
        return $this->belongsTo(MainField::class);
    }

    public function subField()
    {
        return $this->belongsTo(SubField::class);
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }


        public function newFranchise()
    {
        return $this->belongsTo(NewFranchise::class, 'new_franchise_id');
    }
    public function inventoryUpdate()
    {
        return $this->belongsTo(InventoryUpdates::class );
    }

}
