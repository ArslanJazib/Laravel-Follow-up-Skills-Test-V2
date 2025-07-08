@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Product Dashboard</h2>
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>

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
        <tfoot>
            <tr>
                <th colspan="4" style="text-align:right">Total:</th>
                <th id="total-sum"></th>
                <th colspan="2"></th>
            </tr>
        </tfoot>
    </table>
</div>

{{-- Modal Components --}}
<x-product.add-product-modal />
<x-product.edit-product-modal />
@endsection

@push('scripts')
<script>
$(function () {
    const table = $('#products-table').DataTable({
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
        ],
        footerCallback: function (row, data, start, end, display) {
            let api = this.api();

            let total = api
                .column(4, { search: 'applied' })
                .data()
                .reduce(function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0);

            $('#total-sum').html(total.toFixed(2));
        }
    });

    // Add Product Submit
    $('#add-product-form').on('submit', function (e) {
        e.preventDefault();
        $('#form-errors').empty();

        $.ajax({
            url: '{{ route('products.store') }}',
            type: 'POST',
            data: $(this).serialize(),
            success: function () {
                $('#addProductModal').modal('hide');
                $('#add-product-form')[0].reset();
                table.ajax.reload(null, false);
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errorHtml = '';
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        errorHtml += `<div>${value[0]}</div>`;
                    });
                    $('#form-errors').html(errorHtml);
                }
            }
        });
    });

    // Edit Product trigger
    $(document).on('click', '.edit-btn', function () {
        const row = table.row($(this).closest('tr')).data();
        $('#edit-id').val(row.id);
        $('#edit_product_name').val(row.product_name);
        $('#edit_quantity').val(row.quantity);
        $('#edit_price').val(row.price);
        $('#editProductModal').modal('show');
    });

    // Edit Product Submit
    $('#edit-product-form').on('submit', function (e) {
        e.preventDefault();
        const id = $('#edit-id').val();
        let baseUrl = "{{ url('products') }}";

        $.ajax({
            url: baseUrl + '/' + id,
            type: 'POST',
            data: $(this).serialize() + '&_method=PUT',
            success: function () {
                $('#editProductModal').modal('hide');
                table.ajax.reload(null, false);
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errorHtml = '';
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        errorHtml += `<div>${value[0]}</div>`;
                    });
                    $('#edit-form-errors').html(errorHtml);
                }
            }
        });
    });
});
</script>
@endpush