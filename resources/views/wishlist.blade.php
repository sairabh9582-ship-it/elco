@extends('layouts.store')

@section('content')
<!-- Header Start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Wishlist</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Wishlist</li>
    </ol>
</div>
<!-- Header End -->

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Products</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($wishlistItems as $item)
                    <tr>
                        <th scope="row">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset($item->product->image) }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                            </div>
                        </th>
                        <td>
                            <p class="mb-0 mt-4"><a href="{{ route('product.detail', $item->product) }}">{{ $item->product->name }}</a></p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4">Rs {{ number_format($item->product->price, 2) }}</p>
                        </td>
                        <td>
                            <form action="{{ route('wishlist.remove', $item->product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-md rounded-circle bg-light border mt-4" >
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                            </form>
                            <a href="{{ route('add.to.cart', $item->product->id) }}" class="btn btn-md rounded-circle bg-light border mt-4" >
                                <i class="fa fa-shopping-cart text-primary"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Your wishlist is empty.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
