<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;


class NewFranchise extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function users()
    {
        return $this->hasMany(User::class, 'new_franchise_id');
    }
    public function clients()
    {
        return $this->hasMany(Client::class, 'new_franchise_id');
    }
    public function main_fields()
    {
        return $this->hasMany(MainField::class, 'new_franchise_id');
    }
    public function sub_fields()
    {
        return $this->hasMany(SubField::class, 'new_franchise_id');
    }
    public function freelancers()
    {
        return $this->hasMany(Freelancer::class, 'new_franchise_id');
    }
    public function request_freelancers()
    {
        return $this->hasMany(RequestFreelancer::class, 'new_franchise_id');
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'new_franchise_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'new_franchise_id');
    }
    public function transfers()
    {
        return $this->hasMany(Transfer::class, 'new_franchise_id');
    }
        public function holidays()
    {
        return $this->hasMany(Holiday::class, 'new_franchise_id');
    }
        public function transfersD()
    {
        return $this->hasMany(TransferData::class, 'new_franchise_id');
    }
    
    public function getDecryptedPasswordAttribute()
{
    return Crypt::decryptString($this->password);
}
}
