<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address_Street',
        'address_PostalCode',
        'address_City',
        'address_Country',
        'contact_Phone',
        'contact_Email',
    ];
}
