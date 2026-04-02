@extends('layouts.store')

@section('content')
<style>
    .header-carousel-item img {
        height: 500px;
        object-fit: cover;
    }
    @media (max-width: 991.98px) {
        .header-carousel-item img {
            height: 320px;
        }
    }
    .bestseller-section .product-item img {
        background-color: #f5f5f5 !important;
    }
</style>
<!-- Carousel Start -->
<div class="container-fluid carousel px-0">
    <div class="row g-0 justify-content-end">
        <div class="col-12">
            <div class="header-carousel owl-carousel p-0">
                @foreach($sliders as $slider)
                <div class="row g-0 header-carousel-item align-items-center">
                    <div class="col-12 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                        <img src="{{ asset($slider->image) }}" class="img-fluid w-100" alt="Image">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->

<!-- Searvices Start -->
<div class="container-fluid px-0">
    <div class="row g-0">
        @foreach($services as $service)
        <div class="col-6 col-md-4 col-lg-2 {{ $loop->first ? 'border-start' : '' }} border-end wow fadeInUp" data-wow-delay="0.1s">
            <div class="p-4">
                <div class="d-flex align-items-center">
                    <i class="{{ $service->icon }} fa-2x text-primary"></i>
                    <div class="ms-4">
                        <h6 class="text-uppercase mb-2">{{ $service->title }}</h6>
                        <p class="mb-0">{{ $service->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Searvices End -->

<!-- Our Products Start -->
<div class="container-fluid product py-5">
    <div class="container py-5">
        <div class="tab-class">
            <div class="row g-4">
                <div class="col-lg-4 text-start" data-wow-delay="0.1s">
                    <h1>Our Products</h1>
                </div>
                <div class="col-lg-8 text-end" data-wow-delay="0.1s">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                        <li class="nav-item mb-4">
                            <a class="d-flex mx-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-2">
                                <span class="text-dark" style="width: 130px;">New Arrivals</span>
                            </a>
                        </li>
                        <li class="nav-item mb-4">
                            <a class="d-flex mx-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                <span class="text-dark" style="width: 130px;">Featured</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div id="tab-2" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        @foreach($newArrivals as $product)
                        @include('partials.product_card', ['product' => $product])
                        @endforeach
                   </div>
                </div>
                <div id="tab-3" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        @foreach($featuredProducts as $product)
                        @include('partials.product_card', ['product' => $product])
                        @endforeach
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Our Products End -->

<!-- Products Offer Start -->
<div class="container-fluid bg-light py-5">
    <div class="container">
        <div class="row g-4">
            @foreach($offerBanners as $banner)
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                <a href="{{ $banner->link }}" class="d-flex align-items-center justify-content-between border bg-white rounded p-4">
                    <div>
                        <p class="text-muted mb-3">{{ $banner->title }}</p>
                        <h3 class="text-primary">{{ $banner->title }}</h3>
                        <h1 class="display-3 text-secondary mb-0">{{ $banner->offer_text }}</h1>
                    </div>
                    <img src="{{ asset($banner->image) }}" class="img-fluid" alt="">
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Products Offer End -->
 
<!-- Product List Start -->
<div class="container-fluid product py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h4 class="text-primary border-bottom border-primary border-2 d-inline-block p-2 title-border-radius" data-wow-delay="0.1s">Products</h4>
            <h1 class="mb-0 display-3" data-wow-delay="0.3s">All Product Items</h1>
        </div>
        <div class="row g-4" data-wow-delay="0.3s">
            @foreach($products as $product)
                @include('partials.product_card', ['product' => $product])
            @endforeach
        </div>
        <div class="col-12 text-center mt-5">
            <a class="btn btn-primary rounded-pill py-3 px-5" href="{{ route('shop') }}">View All Products</a>
        </div>
    </div>
</div>
<!-- Product List End -->

<!-- Product Banner Start -->
<div class="container-fluid py-5" style=background-color: #f5f5f5 !important>
    <div class="container">
        <div class="row g-4">
            @foreach($bottomBanners as $banner)
            <div class="col-lg-6" data-wow-delay="0.1s">
                <a href="#">
                    <div class="bg-primary rounded position-relative">
                        <img src="{{ asset($banner->image) }}" class="img-fluid w-100 rounded" alt="">
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4" style="background: rgba(255, 255, 255, 0.5);">
                            <h3 class="display-5 text-primary">{{ $banner->title }}</h3>
                            <p class="fs-4 text-muted">{{ $banner->offer_text }}</p>
                            <a href="#" class="btn btn-primary rounded-pill align-self-start py-2 px-4">Shop Now</a>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Product Banner End -->

<!-- Bestseller Products Start -->
<div class="container-fluid product pb-5 bestseller-section">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 700px;">
            <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius" data-wow-delay="0.1s">Bestseller Products</h4>
            <p class="mb-0" data-wow-delay="0.2s">Check out our top selling products for this week.</p>
        </div>
        <div class="row g-4">
            @foreach($topSellingProducts as $product)
                @include('partials.product_card', ['product' => $product])
            @endforeach
        </div>
    </div>
</div>
<!-- Bestseller Products End -->



@endsection
