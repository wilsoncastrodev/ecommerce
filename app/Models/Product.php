<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'vendor_id');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
}
