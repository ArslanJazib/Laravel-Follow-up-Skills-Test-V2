<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    private string $file = 'products.json';

    public function index()
    {
        return view('products.index');
    }

    public function data()
    {
        $data = $this->readData();

        // return DataTables::of(Product::query()) FOR DB Based Flow
        return DataTables::of($data)
            ->addColumn('total_value', fn($row) => $row['quantity'] * $row['price'])
            ->addColumn('created_at', fn($row) => \Carbon\Carbon::parse($row['submitted_at'])->diffForHumans())
            ->addColumn('actions', function ($row) {
                return '<button class="btn btn-sm btn-primary edit-btn" data-id="'.$row['id'].'">Edit</button>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        // FOR DB Based Flow
        /* Product::create($request->validated());
        return redirect()->route('products.index')->with('success', 'Product added.'); */
        
        $data = $this->readData();

        // Manual Auto Increment
        $maxId = collect($data)->max('id') ?? 0;

        $data[] = [
            'id'            => $maxId + 1,
            'product_name'  => $request->product_name,
            'quantity'      => (int) $request->quantity,
            'price'         => (float) $request->price,
            'submitted_at'  => now()->toDateTimeString(),
        ];

        $this->writeData($data);

        return response()->json(['success' => true]);

    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        // FOR DB Based Flow
        /* $product->update($request->validated());
        return redirect()->route('products.index')->with('success', 'Product updated.'); */

        $data = $this->readData();

        $updated = false;

        foreach ($data as &$item) {
            if ($item['id'] == $request->id) {
                $item['product_name'] = $request->product_name;
                $item['quantity']     = (int) $request->quantity;
                $item['price']        = (float) $request->price;
                $updated = true;
                break;
            }
        }

        if ($updated) {
            $this->writeData($data);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Product not found.'], 404);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }

    // Getters & Setters Method to Handle Files
    private function readData(): array
    {
        if (!Storage::exists($this->file)) {
            return [];
        }

        return json_decode(Storage::get($this->file), true) ?? [];
    }

    private function writeData(array $data): void
    {
        Storage::put($this->file, json_encode($data, JSON_PRETTY_PRINT));
    }
}