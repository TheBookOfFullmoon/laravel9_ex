<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'address'];

    public function setNameAttribute($value){
        $this->attributes['name'] = strtolower($value);
    }

    public function getNameAttribute($value): string
    {
        return strtoupper($value);
    }

    public function setAddressAttribute($value){
        $this->attributes['address'] = strtolower($value);
    }

    public function getAddressAttribute($value): string{
        return strtoupper($value);
    }
}
