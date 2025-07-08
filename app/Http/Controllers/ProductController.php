<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function data()
    {
        return DataTables::of(Product::query())
            ->addColumn('total_value', fn($row) => $row->quantity * $row->price)
            ->addColumn('actions', function ($row) {
                return '<a href="'.route('products.edit', $row).'" class="btn btn-sm btn-primary">Edit</a>';
            })
            ->addColumn('created_at', fn($row) => \Carbon\Carbon::parse($row->created_at)->diffForHumans())
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        Product::create($request->validated());
        return redirect()->route('products.index')->with('success', 'Product added.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return redirect()->route('products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }
}