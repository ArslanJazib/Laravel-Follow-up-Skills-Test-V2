@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Product</h2>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="product_name" class="form-control">
        </div>
        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control">
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="number" step="0.01" name="price" class="form-control">
        </div>
        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection