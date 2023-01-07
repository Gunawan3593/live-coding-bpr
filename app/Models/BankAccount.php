<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = ['bank_name', 'account_number', 'balance', 'customer'];

    public function customer_dtl()
    {
        return $this->BelongsTo(Customer::class, 'customer');
    }
}
