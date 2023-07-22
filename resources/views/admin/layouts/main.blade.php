<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | {{ $title }}</title>
    {{-- Bootsrap 5 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    {{-- Icon Bootstrap 5 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    {{-- Boxicons --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    {{-- Login CSS --}}
    <link rel="stylesheet" href="/admin/css/style.css">
    {{-- app css --}}
    <link rel="stylesheet" href="/asset/css/app.css">

</head>

<body>

    @if ($title != "Login")
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 d-none d-lg-block">
                {{-- Sidebar --}}
                @include('admin.partials.sidebar')
            </div>
            <div class="col p-0">
                {{-- Navbar --}}
                @include('admin.partials.navbar')
                {{-- Container --}}
                @yield('container')
            </div>
        </div>
    </div>

    @else
    <div class="container-fluid">
        @yield('container')
    </div>
    @endif


</body>

{{-- JS Bootstrap Popper --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>

{{-- JS Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

{{-- Jquery --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

</html>
