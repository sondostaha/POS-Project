<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatingDetail extends Model
{

    protected $guarded=[];

    use HasFactory;

    public function operating()
    {
        return $this->belongsTo(Operating::class);
    }
}
