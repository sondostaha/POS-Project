<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function new_franchise()
    {
        return $this->belongsTo(NewFranchise::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mainField()
    {
        return $this->belongsTo(MainField::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function ClientAttribution()
    {
        return $this->belongsTo(ClientAttribution::class);
    }
    
    public function newFranchise()
    {
        return $this->belongsTo(NewFranchise::class, 'new_franchise_id');
    }
    
    
        public function previousAttributions()
    {
        return $this->hasMany(ClientAttribution::class, 'previous_client_id');
    }

    public function existingAttributions()
    {
        return $this->hasMany(ClientAttribution::class, 'existing_client_id');
    }
    
    public function transfers()
{
    return $this->hasMany(TransferData::class);
}

    
}
