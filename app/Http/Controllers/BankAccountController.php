<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class BankAccountController extends Controller
{
    public function index()
    {
        $bank_accounts = BankAccount::with('customer_dtl')->get();

        return view('bank-accounts.index', ['bank_accounts' => $bank_accounts]);
    }

    public function create()
    {
        $customers = Customer::get();
        return view('bank-accounts.create', ['customers' => $customers]); 
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'bank_name' => 'required|min:2|max:25',
            'account_number' => 'required|numeric|digits_between:10,16|unique:transfer_banks',
            'customer' => 'required'
        ]);

        try {
            $formFields['balance'] = 10000000;
            
            DB::beginTransaction();

            $data = BankAccount::create($formFields);

            $transaction = [
                'ref_id' => $data->id,
                'account' => $data->id,
                'nominal' => $formFields['balance'],
                'type' => 'Balance'
            ];

            Transaction::create($transaction);
            
            DB::commit();
            return redirect('/bank-accounts')->with('message', 'Bank Account created successfully!');
        } catch (\exception  $e) {
            DB::rollBack();
            return redirect('/bank-account/create')->with('message', 'Failed to Created Bank Account!');
        }
    }

    public function edit(BankAccount $bank_account) {
        $customers = Customer::get();
        return view('bank-accounts.edit', [
            'customers' => $customers,
            'bank_account' => $bank_account
        ]);
    }

    public function update(Request $request, BankAccount $bank_account)
    {
        $formFields = $request->validate([
            'bank_name' => 'required|min:2|max:25',
            'account_number' => 'required|numeric|digits_between:10,16|unique:bank_accounts,account_number,'.$bank_account->id,
            'customer' => 'required'
        ]);

        $bank_account->update($formFields);

        return redirect('/bank-accounts')->with('message', 'Bank Account updated successfully!');
    }

    public function destroy(BankAccount $bank_account) {
        $bank_account->delete();
        return redirect('/bank-accounts')->with('message', 'Bank Account deleted successfully!');
    }

    public function getBankAccountByCustomerID(Request $request)
    {
        $data = BankAccount::where('customer', $request->customer_id)->get();
        return response()->json($data);
    }
}
