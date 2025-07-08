@php $prefix = $prefix ?? ''; @endphp

<div class="mb-3">
    <label for="{{ $prefix }}product_name" class="form-label">Product Name</label>
    <input type="text" name="product_name" id="{{ $prefix }}product_name" class="form-control" required>
</div>

<div class="mb-3">
    <label for="{{ $prefix }}quantity" class="form-label">Quantity</label>
    <input type="number" name="quantity" id="{{ $prefix }}quantity" class="form-control" required>
</div>

<div class="mb-3">
    <label for="{{ $prefix }}price" class="form-label">Price</label>
    <input type="number" step="0.01" name="price" id="{{ $prefix }}price" class="form-control" required>
</div>