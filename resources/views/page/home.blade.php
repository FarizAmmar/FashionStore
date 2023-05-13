@extends('layouts.app')

@section('content')
<main class="mt-4 mb-5 px-4">
    <div class="row">
        <div class="title my-3">
            <h2>Catalog</h2>
        </div>
        <div class="col-7">
            {{-- Search --}}
            <form action="/" method="GET">
                <div class="input-group mb-3">
                    <span class="input-group-text" style="background: white;">
                        <i class='bx bx-search'></i>
                    </span>
                    <input type="search" class="form-control" id="search" name="search" value="{{ request('search') }}"
                        placeholder="Search among 100+ product">
                </div>
            </form>
        </div>
        <div class="col-5">
            {{-- Filter --}}
            <form action="{{ route('home') }}" id="filter-form">
                <div class="input-group mb-3">
                    <label class="input-group-text" style="background: white;">
                        <i class="bi bi-filter-right"></i>
                    </label>
                    <select class="form-select" name="filter" id="filter" onchange="submitFilterForm()">
                        <option value="popular" {{ request('filter')=='popular' ? 'selected' : '' }}>Popular</option>
                        <option value="termurah" {{ request('filter')=='termurah' ? 'selected' : '' }}>Barang Termurah
                        </option>
                        <option value="termahal" {{ request('filter')=='termahal' ? 'selected' : '' }}>Barang Termahal
                        </option>
                    </select>
                </div>
            </form>
        </div>
    </div>


    {{-- Main Content --}}
    <div class="row my-5">
        @if (count($products) > 0)
        @foreach ($products as $product)
        <div class="col-3 mb-4">
            <div class="card">
                <img src="{{ $product->image_path }}" class="card-img-top img-thumbnail" alt="Gambar Produk">
                <div class="card-body">
                    <h5 class="card-title text-truncate" style="max-width: 100%;">{{ $product->name}}</h5>
                    <span> Kategori :
                        <a href="/category/{{ $product->category->short_name }}" class="text-decoration-none">
                            <b>{{ $product->category->name }}</b>
                        </a>
                    </span>
                    <div class="row">
                        <div class="col">
                            <p class="card-text">
                                <small class="text-muted">{{ "Rp " . number_format($product->price, 0, ',', '.')
                                    }}</small>
                            </p>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <!-- Details Button -->
                            <a href="/details/{{ $product->short_name }}" class="btn btn-primer" title="Order Here">
                                <i class="bi bi-bag-fill"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="text-center">No Product Found</div>
        @endif
        {{ $products->links() }}
    </div>
</main>
@endsection