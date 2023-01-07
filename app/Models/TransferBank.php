<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferBank extends Model
{
    use HasFactory;

    protected $fillable = ['customer_from', 'account_from', 'customer_to', 'account_to', 'nominal'];

    public function customer_from_dtl()
    {
        return $this->BelongsTo(Customer::class, 'customer_from');
    }

    public function customer_to_dtl()
    {
        return $this->BelongsTo(Customer::class, 'customer_to');
    }

    public function account_from_dtl()
    {
        return $this->BelongsTo(BankAccount::class, 'account_from');
    }

    public function account_to_dtl()
    {
        return $this->BelongsTo(BankAccount::class, 'account_to');
    }
}
