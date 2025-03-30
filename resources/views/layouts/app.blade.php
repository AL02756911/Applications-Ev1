<!DOCTYPE html>
<html>

<head>
    <title>Halcon Web Application</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    @if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div style="color: red;">{{ session('error') }}</div>
    @endif
    <div class="container">
        @yield('content')
    </div>
</body>

</html>