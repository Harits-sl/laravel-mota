<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = [
            'title' => 'List Daftar produk',
            'products' => Product::all(),
        ];

        return view('products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Produk',
        ];

        return view('products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //upload image
        $image = $request->file('image');
        $image->storeAs('public/images', $image->hashName());

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $image->hashName(),
            'type' => $request->type,
        ]);

        return redirect('/admin/products')->with('success', 'Produk baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $id = $product->id;
        $data = [
            'title' => 'Detail Data Produk',
            'product' => Product::findOrFail($id)
        ];

        return view('products.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $id = $product->id;
        $data = [
            'title' => 'Detail Data Produk',
            'product' => Product::findOrFail($id)
        ];

        return view('products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //check if image is not empty
        if ($request->hasFile('image')) {
            //upload image
            $image = $request->file('image');
            $image->storeAs('public/images', $image->hashName());

            //delete old image
            Storage::delete('public/posts/' . basename($product->image));

            //update with new image
            Product::where('id', $product->id)
                ->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'image' => $image->hashName(),
                    'type' => $request->type,
                ]);
        } else {
            //update without image
            Product::where('id', $product->id)
                ->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'type' => $request->type,
                ]);
        }

        return redirect('/admin/products')->with('success', 'Produk berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Product::destroy($product->id);

        return redirect('/admin/products')->with('success', 'Produk berhasil dihapus');
    }
}
