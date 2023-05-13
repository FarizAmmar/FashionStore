@extends('admin.layouts.main')

@section('container')
<div class="container-fluid mt-5">
    <form class="row g-3" action="/product/stored" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name') }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="price" class="form-label">Harga Produk</label>
            <input type="number" class="form-control @error('price')
                is-invalid
            @enderror" id="price" name="price" value="{{ old('price') }}">
            @error('price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-6">
            <label for="category" class="form-label">Kategori Produk</label>
            <select class="form-control @error('category_id')
                is-invalid
                @enderror" name="category_id" id="category">
                <option value="" selected hidden>Pilih Kategori</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
                @error('category_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </select>
        </div>
        {{-- <div class="col-3">
            <label for="size" class="form-label">Ukuran Baju</label>
            <div>
                <input type="radio" class="btn-check" name="size" value="s" id="s" autocomplete="off" checked>
                <label class="btn btn-danger" for="s">S</label>

                <input type="radio" class="btn-check" name="size" value="m" id="m" autocomplete="off">
                <label class="btn btn-danger" for="m">M</label>

                <input type="radio" class="btn-check" name="size" value="l" id="l" autocomplete="off">
                <label class="btn btn-danger" for="l">L</label>

                <input type="radio" class="btn-check" name="size" value="xl" id="xl" autocomplete="off">
                <label class="btn btn-danger" for="xl">XL</label>

                <input type="radio" class="btn-check" name="size" value="xxl" id="xxl" autocomplete="off">
                <label class="btn btn-danger" for="xxl">XXL</label>
            </div>
        </div> --}}
        <div class="col-3">
            <label for="product_type" class="form-label">Tipe Produk</label>
            <div>
                <input type="radio" class="btn-check" name="product_type" value="local" id="local" autocomplete="off"
                    checked>
                <label class="btn btn-success" for="local">Lokal</label>

                <input type="radio" class="btn-check" name="product_type" value="external" id="external"
                    autocomplete="off">
                <label class="btn btn-success" for="external">Luar Negeri</label>
            </div>
            @error('product_type')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-10">
            <label for="image" class="form-label">Foto Produk</label>
            <input type="file" class="form-control @error('image')
                is-invalid
            @enderror" id="image" name="image">
            @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-2">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" class="form-control @error('stock')
                is-invalid
            @enderror" id="stock" name="stock" value="{{ old('stock') }}">
            @error('stock')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-12">
            <label for="description" class="form-label">Deskripsi Produk</label>
            <textarea class="form-control @error('description')
            is-invalid @enderror" id="description" name="description" cols="15"
                rows="5">{{ old('description') }}</textarea>
            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primer">Submit</button>
            <a class="btn btn-primary" role="button" href="/dashboard/product">
                Back
            </a>
        </div>
    </form>
</div>
@endsection