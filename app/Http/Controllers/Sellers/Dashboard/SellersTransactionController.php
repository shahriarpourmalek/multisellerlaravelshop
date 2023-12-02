<?php

namespace App\Http\Controllers\Sellers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Datatable\Transaction\TransactionCollection;
use App\Models\Transaction;
use Illuminate\Http\Request;

class SellersTransactionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Transaction::class, 'transaction');
    }

    public function index()
    {
        return view('sellers.transactions.index');
    }

    public function apiIndex(Request $request)
    {
        $this->authorize('sellers.payments.transactions.index');

        $transactions = Transaction::filter($request);

        $transactions = datatable($request, $transactions);

        return new TransactionCollection($transactions);
    }

    public function show(Transaction $transaction)
    {
        return view('sellers.transactions.show', compact('transaction'))->render();
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return response('success');
    }

    public function multipleDestroy(Request $request)
    {
        $this->authorize('sellers.payments.transactions.delete');

        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'exists:transactions,id',
        ]);

        foreach ($request->ids as $id) {
            $transaction = Transaction::find($id);
            $this->destroy($transaction);
        }

        return response('success');
    }
}
