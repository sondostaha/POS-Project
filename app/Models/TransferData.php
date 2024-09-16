<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferData extends Model
{
    use HasFactory;
    
    
    protected $fillable = ['client_id', 'file_path','new_franchise_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    
        public function newFranchise()
    {
        return $this->belongsTo(NewFranchise::class, 'new_franchise_id');
    }
}
