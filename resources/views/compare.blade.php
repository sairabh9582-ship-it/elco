@extends('layouts.store')

@section('content')
<!-- Header Start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Compare Products</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Compare</li>
    </ol>
</div>
<!-- Header End -->

<div class="container-fluid py-5">
    <div class="container py-5">
        @if($products->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="bg-light">
                    <tr>
                        <th class="text-start">Features</th>
                        @foreach($products as $product)
                            <th>
                                <div class="position-relative">
                                    <h6 class="mb-0">{{ $product->name }}</h6>
                                    <a href="{{ route('compare.remove', $product->id) }}" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="text-start">Image</th>
                        @foreach($products as $product)
                            <td>
                                <img src="{{ asset($product->image) }}" class="img-fluid rounded" style="width: 150px;" alt="">
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <th class="text-start">Price</th>
                        @foreach($products as $product)
                            <td>Rs {{ number_format($product->price, 2) }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th class="text-start">Description</th>
                        @foreach($products as $product)
                            <td>{{ Str::limit($product->description, 100) }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th class="text-start">Action</th>
                        @foreach($products as $product)
                            <td>
                                <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-primary rounded-pill py-2 px-4">Add to Cart</a>
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
        @else
            <div class="text-center">
                <h3>No products in compare list.</h3>
                <a href="{{ route('shop') }}" class="btn btn-primary rounded-pill py-3 px-5 mt-3">Browse Products</a>
            </div>
        @endif
    </div>
</div>
@endsection
