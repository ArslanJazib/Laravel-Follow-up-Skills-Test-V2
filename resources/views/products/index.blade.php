@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Product Dashboard</h2>
    <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Add Product</a>

    <table class="table table-bordered" id="products-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total Value</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    $('#products-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('products.data') }}',
        columns: [
            { data: 'id' },
            { data: 'product_name' },
            { data: 'quantity' },
            { data: 'price' },
            { data: 'total_value', orderable: false, searchable: false },
            { data: 'created_at' },
            { data: 'actions', orderable: false, searchable: false }
        ]
    });
});
</script>
@endpush