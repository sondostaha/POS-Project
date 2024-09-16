<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function freelancer()
    {
        return $this->belongsTo(Freelancer::class);
    }

        public function newFranchise()
    {
        return $this->belongsTo(NewFranchise::class, 'new_franchise_id');
    }
}
