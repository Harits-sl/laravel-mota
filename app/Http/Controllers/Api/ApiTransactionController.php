<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Product;
use App\Models\Transaction;

class ApiTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $transaction = null;

        // jika pembayaran menggunakan bca
        if ($request->paymentMethod == 'BCA') {
            //upload image
            $image = $request->file('transferReceipt');
            $image->storeAs('public/images', $image->hashName());

            $transaction = Transaction::create([
                'id_customer' => $request->idCustomer,
                'order_product' => $request->orderProduct,
                'total' => $request->total,
                'status' => $request->status,
                'payment_method' => $request->paymentMethod,
                'pay' => $request->pay,
                'transfer_receipt' => $image->hashName(),
            ]);
        } else {
            $transaction = Transaction::create([
                'id_customer' => $request->idCustomer,
                'order_product' => $request->orderProduct,
                'total' => $request->total,
                'status' => $request->status,
                'payment_method' => $request->paymentMethod,
            ]);
        }

        return new TransactionResource(201, true, 'Success Add Transaction', [$transaction]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $idCustomer)
    {
        // get data transactions dan customers dari id_customer
        $transaction = Transaction::join('customers', 'transactions.id_customer', '=', 'customers.id')
            ->where('id_customer', $idCustomer)
            ->select('transactions.*', 'customers.username')
            ->orderBy('created_at', 'desc')
            ->get();

        // perulangan dari transaction
        foreach ($transaction as $t) {
            $products = [];
            // perulangan dari data order_product di decode terlebih dahulu 
            // karena data dalam bentuk json
            foreach (json_decode($t['order_product']) as $order_product) {
                // get data product dari id order_product
                $product = Product::where('id', $order_product->id_product)
                    ->first();

                // array untuk dikirim ke API
                $arr = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $order_product->quantity
                ];
                array_push($products, $arr);
            }
            // ubah data order_product dari json menjadi array data product
            $t['order_product'] = $products;
        }

        return new TransactionResource(200, true, 'List Data Transaction', $transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
