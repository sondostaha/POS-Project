<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAttribution extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function clients(){
        return $this->hasMany(Client::class);
    }
    
    
    
        public function previousClient()
    {
        return $this->belongsTo(Client::class, 'previous_client_id');
    }

    public function existingClient()
    {
        return $this->belongsTo(Client::class, 'existing_client_id');
    }

    public function newFranchise()
    {
        return $this->belongsTo(Franchise::class, 'new_franchise_id');
    }
}
