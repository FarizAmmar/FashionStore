<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Store | {{ $title }}</title>
    {{-- Bootsrap 5 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    {{-- Icon Bootstrap 5 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    {{-- Boxicons --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    {{-- Favicon --}}
    <link rel="shortcut icon" href="/img/Observer-None.png" type="image/x-icon">

    @if ($title === 'Login')
    {{-- Login CSS --}}
    <link rel="stylesheet" href="/asset/css/login.css">
    @elseif ($title === 'Report View')
    {{-- View Report CSS --}}
    <link rel="stylesheet" href="/asset/css/view.css">
    @endif
    {{-- Page CSS --}}
    <link rel="stylesheet" href="/asset/css/app.css">

</head>

<body>
    @if ($title == 'Login' )
    {{-- Content Login --}}
    @yield('content')

    @elseif ($title === 'My Orders')
    {{-- Navbar --}}
    @include('partials.nav')

    @yield('content')

    @elseif ($title === 'Details Product')
    {{-- Navbar --}}
    @include('partials.nav')

    @yield('content')

    @elseif ($title === 'Contact Us')
    {{-- Navbar --}}
    @include('partials.nav')

    @yield('content')

    @elseif ($title === 'FAQ')
    {{-- Navbar --}}
    @include('partials.nav')

    @yield('content')

    @else
    {{-- Navbar --}}
    @include('partials.nav')

    <div class="container-fluid">
        <div class="row">
            <div class="col-3 d-none d-lg-block">
                {{-- Sidebar --}}
                @include('partials.sidebar')
            </div>
            <div class="col">
                {{-- Container --}}
                @yield('content')
            </div>
        </div>
    </div>

    {{-- footer --}}
    @include('partials.footer')
    @endif

</body>

{{-- JS Bootstrap Popper --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>

{{-- JS Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>

{{-- JS Ajax jsPDF() --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>

{{-- Jquery --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

{{-- JS Custom --}}
<script src="/asset/js/app.js"></script>

<script>
    function submitFilterForm() {
        document.getElementById("filter-form").submit();
    }
</script>

</html>
