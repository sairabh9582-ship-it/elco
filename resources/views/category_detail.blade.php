@extends('layouts.store')

@section('content')

<!-- Header Start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">{{ $category->name }}</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">{{ $category->name }}</li>
    </ol>
</div>
<!-- Header End -->

<!-- Fruits Shop Start-->
<div class="container-fluid product py-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Categories</h4>
                                    <ul class="list-unstyled fruite-categorie">
                                        @if(isset($headerCategories))
                                            @foreach($headerCategories as $cat)
                                            <li>
                                                <div class="d-flex justify-content-between fruite-name">
                                                    <a href="{{ route('category.detail', $cat) }}"><i class="fas fa-apple-alt me-2"></i>{{ $cat->name }}</a>
                                                    <span>({{ $cat->products()->count() }})</span>
                                                </div>
                                            </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row g-4 justify-content-center">
                            @forelse($products as $product)
                                @include('partials.product_card', ['product' => $product])
                            @empty
                                <div class="col-12 text-center">
                                    <h3>No products found in this category.</h3>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->
@endsection
