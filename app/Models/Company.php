<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'inn',
        'kpp',
        'director',
        'accountant',
        'bank_rs',
        'bank_bik',
        'bank_ks',
        'bank_name',
    ];
}
