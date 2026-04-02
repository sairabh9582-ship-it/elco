<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $siteSetting->site_name ?? 'Admin Panel' }} - @yield('title')</title>
    @if(isset($siteSetting) && $siteSetting->favicon)
        <link rel="icon" type="image/png" href="{{ asset($siteSetting->favicon) }}">
    @endif
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
            color: #fff;
            overflow-y: auto;
            overflow-x: hidden;
        }
        .sidebar a {
            padding: 15px 25px;
            text-decoration: none;
            font-size: 18px;
            color: #ccc;
            display: block;
        }
        .sidebar a:hover {
            color: #fff;
            background-color: #495057;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
    @yield('styles')
</head>

<body>
    <div class="sidebar">
        <h3 class="text-center mb-4">Admin Panel</h3>
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
        <a href="#ecommerceSubmenu" data-bs-toggle="collapse" class="dropdown-toggle"><i class="fas fa-shopping-cart me-2"></i>Ecommerce</a>
        <ul class="collapse list-unstyled" id="ecommerceSubmenu" style="background-color: #2c3034; padding-left: 20px;">
            <li>
                <a href="{{ route('admin.categories.index') }}"><i class="fas fa-list me-2"></i>Categories</a>
            </li>
            <li>
                 <a href="{{ route('admin.products.index') }}"><i class="fas fa-box me-2"></i>Products</a>
            </li>
            <li>
                 <a href="{{ route('admin.brands.index') }}"><i class="fas fa-tag me-2"></i>Brands</a>
            </li>
            <li>
                 <a href="{{ route('admin.orders.index') }}"><i class="fas fa-shopping-bag me-2"></i>Orders</a>
            </li>
            @if(\App\Models\Addon::where('unique_identifier', 'wholesale')->where('status', true)->exists())
            <li>
                 <a href="{{ route('admin.wholesale.index') }}"><i class="fas fa-warehouse me-2"></i>Wholesale</a>
            </li>
            @endif
            @if(\App\Models\Addon::where('unique_identifier', 'coupon')->where('status', true)->exists())
            <li>
                 <a href="{{ route('admin.coupons.index') }}"><i class="fas fa-ticket-alt me-2"></i>Coupons</a>
            </li>
            @endif
        </ul>
        
        @if(\App\Models\Addon::where('unique_identifier', 'currency')->where('status', true)->exists())
        <a href="{{ route('admin.currency.index') }}"><i class="fas fa-money-bill-wave me-2"></i>Currencies</a>
        @endif

        <a href="{{ route('admin.payments.index') }}"><i class="fas fa-credit-card me-2"></i>Payments</a>
        
        <a href="{{ route('admin.media.index') }}"><i class="fas fa-photo-video me-2"></i>Media Manager</a>

        <a href="#homepageSubmenu" data-bs-toggle="collapse" class="dropdown-toggle"><i class="fas fa-home me-2"></i>Homepage</a>
        <ul class="collapse list-unstyled" id="homepageSubmenu" style="background-color: #2c3034; padding-left: 20px;">
            <li>
                <a href="{{ route('admin.sliders.index') }}"><i class="fas fa-images me-2"></i>Sliders</a>
            </li>
            <li>
                <a href="{{ route('admin.banners.index') }}"><i class="fas fa-ad me-2"></i>Banners</a>
            </li>
            <li>
                <a href="{{ route('admin.services.index') }}"><i class="fas fa-concierge-bell me-2"></i>Services</a>
            </li>
            <li>
        </ul>
        
        <a href="{{ route('admin.addons.index') }}"><i class="fas fa-puzzle-piece me-2"></i>Addons</a>

        <a href="#settingsSubmenu" data-bs-toggle="collapse" class="dropdown-toggle"><i class="fas fa-cogs me-2"></i>Settings</a>
        <ul class="collapse list-unstyled" id="settingsSubmenu" style="background-color: #2c3034; padding-left: 20px;">
            <li>
                <a href="{{ route('admin.settings.header') }}"><i class="fas fa-heading me-2"></i>Header</a>
            </li>
             <li>
                <a href="{{ route('admin.settings.footer') }}"><i class="fas fa-shoe-prints me-2"></i>Footer</a>
            </li>
             <li>
                <a href="{{ route('admin.settings.shipping') }}"><i class="fas fa-truck me-2"></i>Shipping</a>
            </li>
             <li>
                <a href="{{ route('admin.settings.appearance') }}"><i class="fas fa-paint-brush me-2"></i>Appearance</a>
            </li>
        </ul>
        <a href="{{ route('home') }}" target="_blank"><i class="fas fa-home me-2"></i>Visit Site</a>
        <form method="POST" action="{{ route('logout') }}" class="mt-5 px-3">
            @csrf
            <button type="submit" class="btn btn-danger w-100">Logout</button>
        </form>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>
