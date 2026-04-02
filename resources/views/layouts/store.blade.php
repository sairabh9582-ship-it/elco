<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $meta_title ?? $siteSetting->home_meta_title ?? 'Electro - Electronics Website Template' }}</title>
    @if(isset($siteSetting) && $siteSetting->favicon)
        <link rel="icon" type="image/png" href="{{ asset($siteSetting->favicon) }}">
    @endif
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="{{ $meta_keywords ?? $siteSetting->home_meta_keywords ?? '' }}" name="keywords">
    <meta content="{{ $meta_description ?? $siteSetting->home_meta_description ?? '' }}" name="description">
    @if(isset($siteSetting) && $siteSetting->home_meta_image)
        <meta property="og:image" content="{{ asset($siteSetting->home_meta_image) }}">
        <meta name="twitter:image" content="{{ asset($siteSetting->home_meta_image) }}">
    @endif

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    
    @if(isset($siteSetting))
    <style>
        :root {
            --primary-color: {{ $siteSetting->primary_color ?? '#D10024' }};
            --secondary-color: {{ $siteSetting->secondary_color ?? '#333333' }};
            --bs-primary: var(--primary-color);
            --bs-secondary: var(--secondary-color);
        }
        
        /* Overrides for this specific template which might not use variables everywhere yet */
        /* Overrides for this specific template which might not use variables everywhere yet */
        .primary-color, .text-primary { color: var(--primary-color) !important; }
        .secondary-color, .text-secondary { color: var(--secondary-color) !important; }
        .bg-primary { background-color: var(--primary-color) !important; }
        .bg-secondary { background-color: var(--secondary-color) !important; }
        .btn-primary { background-color: var(--primary-color) !important; border-color: var(--primary-color) !important; }
        .btn-outline-primary { color: var(--primary-color) !important; border-color: var(--primary-color) !important; }
        .btn-outline-primary:hover { background-color: var(--primary-color) !important; color: #fff !important; }
        
        a { color: var(--primary-color); }
        a:hover, a:focus { color: var(--primary-color); opacity: 0.8; }
        
        /* Add specific template classes overrides here if needed */
        .header-search .search-btn { background-color: var(--primary-color) !important; }
        .newsletter-btn { background-color: var(--primary-color) !important; }
        .add-to-cart-btn { background-color: var(--primary-color) !important; }
        .product-btns > button:hover { background-color: var(--primary-color) !important; color: #fff !important; }
    </style>
    @endif
</head>

<body>

    @include('partials.header')

    @yield('content')

    @include('partials.footer')

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>   

    
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    
    <!-- Template Javascript -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'Cool'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: 'Error!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'Okay'
            });
        @endif
    </script>
    @yield('scripts')
</body>

</html>
