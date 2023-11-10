<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;


class TransactionController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // get data transactions dan customers dari id_customer
        $transaction = Transaction::join('customers', 'transactions.id_customer', '=', 'customers.id')
            ->select('transactions.*', 'customers.username')
            ->orderBy('created_at', $request->input('sort') != null ? 'desc' : 'asc') // jika request ada
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

        $data = [
            'title' => 'Daftar Order',
            'orders' => $transaction,
            'isSearch' => false,
        ];

        return view('transactions.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        // get data transactions dan customers dari id_customer
        $transaction = Transaction::join('customers', 'transactions.id_customer', '=', 'customers.id')
            ->where('transactions.id', $transaction->id)
            ->select('transactions.*', 'customers.username')
            ->first();


        $products = [];
        // perulangan dari data order_product di decode terlebih dahulu 
        // karena data dalam bentuk json
        foreach (json_decode($transaction['order_product']) as $order_product) {
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
        $transaction['order_product'] = $products;

        $data = [
            'title' => 'Detail Pembayaran',
            'order' => $transaction,
        ];
        return view('transactions.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function success($id)
    {
        Transaction::where('id', $id)->update(['status' => 'Sukses']);

        return redirect()->to('admin/transactions');
    }

    public function savePayment($id, Request $request)
    {
        Transaction::where('id', $id)->update([
            'pay' => $request->bayar,
            'change' => $request->kembalian,
            'status' => 'Di Proses'
        ]);
        return redirect()->to('admin/transactions');
    }

    public function search(Request $request)
    {
        $dateFrom = date("Y-m-d H:i:s", strtotime($request['tanggal-1']));
        $dateTo = date("Y-m-d H:i:s", strtotime($request['tanggal-2']));

        // get data transactions dan customers dari id_customer
        $transaction = Transaction::join('customers', 'transactions.id_customer', '=', 'customers.id')
            ->select('transactions.*', 'customers.username')
            ->whereBetween('transactions.created_at', [$dateFrom, $dateTo])
            ->orderBy('created_at', $request->input('sort') != null ? 'desc' : 'asc') // jika request ada
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

        $data = [
            'title' => 'Daftar Order',
            'orders' => $transaction,
            'isSearch' => true,
            'dateFrom' => $request['tanggal-1'],
            'dateTo' => $request['tanggal-2'],
        ];

        return view('transactions.index', $data);
    }
}
