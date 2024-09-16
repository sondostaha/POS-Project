<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubField extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function mainField()
    {
        return $this->belongsTo(MainField::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function freelancers()
    {
        return $this->hasMany(Freelancer::class);
    }
        public function newFranchise()
    {
        return $this->belongsTo(NewFranchise::class, 'new_franchise_id');
    }

}
