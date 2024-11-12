<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $categories = Transaction::with('product', 'user')->orderBy('created_at', 'desc')->get();
        return response()->json([
            'status' => true,
            'message' => 'transaction retrieval successful',
            'data' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $data = new Transaction();
        $rules = [
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'shipping_address' => 'required',
            'total_price' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'transaction addition failed',
                'data' => $validator->errors()
            ], 401);
        }
        $data->order_id = $request->order_id;
        $data->user_id = $request->user_id;
        $data->product_id = $request->product_id;
        $data->quantity = $request->quantity;
        $data->shipping_address = $request->shipping_address;
        $data->status = 'pending';

        $data->save();
        return response()->json([
            'status' => true,
            'message' => 'transaction addition successful',
            'data' => $data
        ], 200);
    }

    

    public function getTransactionStoreById(Store $store)
    {
        $products = $store->products;
        $transactions = [];
        foreach ($products as $product) {
            $transaction = Transaction::where('product_id', $product->id)->with('user', 'product')->get();
          
            $transactions[] = (object)[
                'transaction' => $transaction,
                // 'user' => User::where('id', $transaction->userId)->first(),
            ];
        }

        $formatedTransactions = [];
        foreach ($transactions as $transaction) {
            foreach ($transaction->transaction as $transactionInner) {
                $formatedTransactions[] = $transactionInner;
            }
        }
        return response()->json([
            'status' => true,
            'message' => 'transaction data retrieval successful',
            'data' => $formatedTransactions
        ], 200);
    }

    public function deliverItems(Request $request, Transaction $transaction)
    {
        $transaction->status = "In Delivery";
        $transaction->save();
        return response()->json([
            'status' => true,
            'message' => 'deliver item successful',
            'data' => $transaction
        ], 200);
    }

    public function show(Transaction $transaction)
    {
        return response()->json([
            'status' => true,
            'message' => 'transaction data retrieval successful',
            'data' => $transaction->with('products')->find($transaction->id)
        ], 200);
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response()->json([
            'status' => true,
            'message' => 'transaction data deletion successful',
            'data' => $transaction
        ], 200);
    }

    public function getTransactionByUserId(User $user)
    {
        $transactions = Transaction::where('user_id', $user->id)->with('product')->get();$groupedTransactions = $transactions->groupBy('order_id')->map(function ($orderTransactions) {

            $total = $orderTransactions->sum(function ($transaction) {
                return $transaction->quantity * $transaction->product->price;
            });
    

            return [
                'id' => $orderTransactions->first()->order_id,
                'date' => $orderTransactions->first()->created_at->format('Y-m-d'), 
                'status' => $orderTransactions->first()->status,
                'items' => $orderTransactions->map(function ($transaction) {
                    return [
                        'name' => $transaction->product->name,
                        'quantity' => $transaction->quantity,
                        'price' => $transaction->product->price
                    ];
                }),
                'total' => $total
            ];
        });
    
        return response()->json([
            'status' => true,
            'message' => 'Transaction data retrieval successful',
            'data' => $groupedTransactions->values() 
        ], 200);
    }
}
