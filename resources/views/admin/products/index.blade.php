@extends('layouts.admin')

@section('title', 'Products')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Products</h2>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add New Product</a>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Featured</th>
                                <th>New</th>
                                <th>Best</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                                <td>
                                    @if($product->image)
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="50">
                                    @else
                                    N/A
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>Rs {{ number_format($product->price, 2) }}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input toggle-status" type="checkbox" data-id="{{ $product->slug }}" data-field="is_featured" {{ $product->is_featured ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input toggle-status" type="checkbox" data-id="{{ $product->slug }}" data-field="is_new_arrival" {{ $product->is_new_arrival ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input toggle-status" type="checkbox" data-id="{{ $product->slug }}" data-field="is_best_selling" {{ $product->is_best_selling ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>{{ $product->category ? $product->category->name : 'Uncategorized' }}</td>
                                <td>
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.querySelectorAll('.toggle-status').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const productId = this.getAttribute('data-id');
        const field = this.getAttribute('data-field');
        
        fetch(`/admin/products/${productId}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ field: field })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (!data.success) {
                alert('Error: ' + (data.message || 'Could not update status.'));
                this.checked = !this.checked;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Request failed. Check console for details.');
            this.checked = !this.checked;
        });
    });
});
</script>
@endsection
