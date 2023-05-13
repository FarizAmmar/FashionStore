<nav class="navbar navbar-expand-lg bg-light navbar-light sticky-top">
    <div class="container-fluid">
        {{-- start Left Side OffCanvas --}}
        @if ($title != 'Home')
        <a class="btn btn-primer" href="/" role="button" title="Click here to back home.">
            <i class="bi bi-caret-left-fill"></i>
        </a>
        @else
        <a class="btn d-lg-none" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
            aria-controls="offcanvasExample">
            <i class="bi bi-sliders"></i>
        </a>
        @endif
        {{-- end Left Side OffCanvas --}}

        <div class="d-none d-lg-block">
            <a class="navbar-brand ms-3" href="/">
                {{-- Logo | Brand --}}
                <span>Store</span>
            </a>
        </div>

        <div class="d-lg-none">
            <a class="navbar-brand" href="#">
                {{-- Logo | Brand --}}
                <span>Store</span>
            </a>
        </div>

        {{-- Main Menu --}}
        <div class="d-flex justify-content-end align-items-center me-3">
            <a href="#" class="btn text-dark" role="button" data-bs-toggle="dropdown">
                <i class="bi bi-list"></i>
                <span class="text-uppercase" style="opacity:75%;">Menu</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item btn-primer-trans" href="/contact">
                        <div class="row">
                            <div class="col-sm-2">
                                <i class="bi bi-inbox"></i>
                            </div>
                            <div class="col">
                                Contact
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item btn-primer-trans" href="/faq/">
                        <div class="row">
                            <div class="col-sm-2">
                                <i class="bi bi-question"></i>
                            </div>
                            <div class="col">
                                FAQ
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Menu Browser --}}
<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasExample"
    aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Filter Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="/category/" method="GET">
            @csrf
            <div class="row py-4 mx-3 rounded" style="background: white">
                {{-- Kategori --}}
                <div class="col-12">
                    <div class="row mx-3">
                        <div class="col-6 sb-title-items">
                            <b>Kategori</b>
                        </div>
                        <div class="col-6 sb-title-items d-flex justify-content-end">
                            <span>
                                <i class="bi bi-dot"></i>
                            </span>
                        </div>
                        <div class="col-12 mt-3" id="jenis-kain-formal">
                            @foreach ($categories as $category)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{$category->short_name }}"
                                    id="{{$category->short_name }}">
                                <label class="form-check-label" for="{{$category->short_name }}">
                                    {{$category->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- Button Filter --}}
                <div class="col-12">
                    <div class="row mt-4 mx-3">
                        <div class="col-12">
                            <button class="btn btn-primer w-100" type="submit" name="filter" id="filter">
                                Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- Menu Browser --}}