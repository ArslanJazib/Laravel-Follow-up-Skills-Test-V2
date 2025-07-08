@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Product</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input 
                type="text" 
                name="product_name" 
                id="product_name" 
                class="form-control @error('product_name') is-invalid @enderror"
                value="{{ old('product_name', $product->product_name) }}"
                required
            >
            @error('product_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input 
                type="number" 
                name="quantity" 
                id="quantity" 
                class="form-control @error('quantity') is-invalid @enderror"
                value="{{ old('quantity', $product->quantity) }}"
                required
            >
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input 
                type="number" 
                step="0.01" 
                name="price" 
                id="price" 
                class="form-control @error('price') is-invalid @enderror"
                value="{{ old('price', $product->price) }}"
                required
            >
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary">Update Product</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection