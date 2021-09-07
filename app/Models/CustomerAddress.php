<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $table = 'customers_addresses';

    protected $fillable = [
        'customer_id',
        'zipcode',
        'address',
        'number',
        'complement',
        'neighbourhood',
        'city',
        'state',
        'reference',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
