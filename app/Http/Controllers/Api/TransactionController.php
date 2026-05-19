<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // GET all transactions
    public function index()
    {
        $transactions = Transaction::with('order')->get();

        return response()->json([
            'message' => 'All transactions',
            'data' => $transactions
        ]);
    }

    // POST create transaction
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id_order',
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'payment_status' => 'required|in:pending,paid,failed'
        ]);

        $transaction = Transaction::create($validated);

        return response()->json([
            'message' => 'Transaction created successfully',
            'data' => $transaction
        ], 201);
    }

    // GET single transaction
    public function show($id)
    {
        $transaction = Transaction::with('order')->find($id);

        if (!$transaction) {
            return response()->json([
                'message' => 'Transaction not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Transaction detail',
            'data' => $transaction
        ]);
    }

    // UPDATE transaction
    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'message' => 'Transaction not found'
            ], 404);
        }

        $validated = $request->validate([
            'amount' => 'numeric',
            'payment_method' => 'string',
            'payment_status' => 'in:pending,paid,failed'
        ]);

        $transaction->update($validated);

        return response()->json([
            'message' => 'Transaction updated successfully',
            'data' => $transaction
        ]);
    }

    // DELETE transaction
    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'message' => 'Transaction not found'
            ], 404);
        }

        $transaction->delete();

        return response()->json([
            'message' => 'Transaction deleted successfully'
        ]);
    }
}