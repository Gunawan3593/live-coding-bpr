<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $customers = Customer::get();

        return view('transactions.index', [
            'customers' => $customers
        ]);
    }

    public function getTransactionByAccount(Request $request)
    {
        $data = Transaction::where('account', $request->account_id)->get();
        return response()->json($data);
    }
}
