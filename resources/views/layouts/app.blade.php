<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Halcon App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
    @stack('styles')
</head>

<body>
    @include('partials.nav') {{-- Your navbar --}}
    <div class="container py-4">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
    {!! Toastr::render() !!}
    @stack('scripts')
</body>

</html>