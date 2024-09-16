<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestFreelancer extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    
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
}
