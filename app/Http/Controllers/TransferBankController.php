<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\TransferBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferBankController extends Controller
{
    public function index()
    {
        $transfer_banks = TransferBank::with(['customer_from_dtl', 'customer_to_dtl', 'account_from_dtl', 'account_to_dtl'])->get();

        return view('transfer-banks.index', ['transfer_banks' => $transfer_banks]);
    }

    public function create()
    {
        $customers = Customer::get();
        return view('transfer-banks.create', ['customers' => $customers]); 
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'customer_from' => 'required',
            'account_from' => 'required',
            'customer_to' => 'required',
            'account_to' => 'required|different:account_from',
            'nominal' => 'required|numeric'
        ]);

        try {

            DB::beginTransaction();

            $data = TransferBank::create($formFields);
            
            $transaction1 = [
                'ref_id' => $data->id,
                'account' => $data->account_from,
                'nominal' => $formFields['nominal'] * -1,
                'type' => 'Transfer'
            ];

            Transaction::create($transaction1);

            $transaction2 = [
                'ref_id' => $data->id,
                'account' => $data->account_to,
                'nominal' => $formFields['nominal'],
                'type' => 'Transfer'
            ];

            Transaction::create($transaction2);

            $bank1 = BankAccount::find($data->account_from);
            $bank1->increment('balance', $formFields['nominal'] * -1);

            $bank2 = BankAccount::find($data->account_to);
            $bank2->increment('balance', $formFields['nominal']);

            DB::commit();
            return redirect('/transfer-banks')->with('message', 'Transfer Bank created successfully!');
        } catch (\exception  $e) {
            DB::rollBack();
            return redirect('/transfer-bank/create')->with('message', 'Failed to Transfer Bank Account!');
        }
    }

    public function edit(TransferBank $transfer_bank) {
        $customers = Customer::get();
        return view('transfer-banks.edit', [
            'customers' => $customers,
            'transfer_bank' => $transfer_bank
        ]);
    }

    public function update(Request $request, TransferBank $transfer_bank)
    {
        $formFields = $request->validate([
            'customer_from' => 'required',
            'account_from' => 'required',
            'customer_to' => 'required',
            'account_to' => 'required|different:account_from',
            'nominal' => 'required|numeric'
        ]);

        try {

            DB::beginTransaction();

            $rb_bank1 = BankAccount::find($transfer_bank->account_from);
            $rb_bank1->increment('balance', $transfer_bank->nominal);

            $rb_bank2 = BankAccount::find($transfer_bank->account_to);
            $rb_bank2->increment('balance', $transfer_bank->nominal * -1);

            Transaction::where('ref_id', $transfer_bank->id)->where('type', 'Transfer')->delete();

            $transfer_bank->update($formFields);
            
            $transaction1 = [
                'ref_id' => $transfer_bank->id,
                'account' => $formFields['account_from'],
                'nominal' => $formFields['nominal'] * -1,
                'type' => 'Transfer'
            ];

            Transaction::create($transaction1);

            $transaction2 = [
                'ref_id' => $transfer_bank->id,
                'account' => $formFields['account_to'],
                'nominal' => $formFields['nominal'],
                'type' => 'Transfer'
            ];

            Transaction::create($transaction2);

            $bank1 = BankAccount::find($formFields['account_from']);
            $bank1->increment('balance', $formFields['nominal'] * -1);

            $bank2 = BankAccount::find($formFields['account_to']);
            $bank2->increment('balance', $formFields['nominal']);

            DB::commit();
            return redirect('/transfer-banks')->with('message', 'Transfer Bank created successfully!');
        } catch (\exception  $e) {
            DB::rollBack();
            return redirect('/transfer-bank/'.$transfer_bank->id.'/edit')->with('message', 'Failed to Transfer Bank Account!');
        }
    }

    public function destroy(TransferBank $transfer_bank) {
        $transfer_bank->delete();
        return redirect('/transfer-banks')->with('message', 'Transfer Bank deleted successfully!');
    }
}
