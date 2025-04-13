<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_email',
        'invoice_date',
        'due_date',
        'product_description',
        'items',
        'subtotal',
        'tax',
        'total',
        'status'
    ];
}
