@extends('admin.layouts.main')

@section('container')
<div class="container-fluid mt-5 mb-5">
    <form class="row g-3" action="/product/update/{{ $product->short_name }}" enctype="multipart/form-data"
        method="POST">
        @csrf
        @method('PUT')
        <img src="{{ $product->image_path }}" class="rounded mx-auto d-block" style="width: 30rem"
            alt="{{ $product->short_name }}">
        <div class="col-md-12">
            <label for="image" class="form-label">Ganti Foto</label>
            <input class="form-control" type="file" name="image" id="image">
        </div>
        <div class="col-md-6">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ $product->name }}">
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
            @enderror" id="price" name="price" value="{{ $product->price }}">
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
                <option value="{{ $product->category->id }}" selected hidden>{{ $product->category->name }}</option>
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
                <input type="radio" class="btn-check" name="size" value="s" id="s" autocomplete="off" {{ $product->size
                === 's' ? 'checked' : '' }}>
                <label class="btn btn-danger" for="s">S</label>

                <input type="radio" class="btn-check" name="size" value="m" id="m" autocomplete="off" {{ $product->size
                === 'm' ? 'checked' : '' }}>
                <label class="btn btn-danger" for="m">M</label>

                <input type="radio" class="btn-check" name="size" value="l" id="l" autocomplete="off" {{ $product->size
                === 'l' ? 'checked' : '' }}>
                <label class="btn btn-danger" for="l">L</label>

                <input type="radio" class="btn-check" name="size" value="xl" id="xl" autocomplete="off" {{
                    $product->size
                === 'xl' ? 'checked' : '' }}>
                <label class="btn btn-danger" for="xl">XL</label>

                <input type="radio" class="btn-check" name="size" value="xxl" id="xxl" autocomplete="off" {{
                    $product->size
                === 'xxl' ? 'checked' : '' }}>
                <label class="btn btn-danger" for="xxl">XXL</label>
            </div>
        </div> --}}
        <div class="col-3">
            <label for="product_type" class="form-label">Tipe Produk</label>
            <div>
                <input type="radio" class="btn-check" name="product_type" value="local" id="local" autocomplete="off" {{
                    $product->product_type
                === 'local' ? 'checked' : '' }}>
                <label class="btn btn-success" for="local">Lokal</label>

                <input type="radio" class="btn-check" name="product_type" value="external" id="external"
                    autocomplete="off" {{ $product->product_type
                === 'external' ? 'checked' : '' }}>
                <label class="btn btn-success" for="external">Luar Negeri</label>
            </div>
            @error('product_type')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-12">
            <label for="description" class="form-label">Deskripsi Produk</label>
            <textarea class="form-control  @error('description')
            is-invalid @enderror" name="description" id="description" cols="15" rows="5">{{ $product->description }}
            </textarea>
            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-2">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" class="form-control @error('stock')
                is-invalid
            @enderror" id="stock" name="stock" value="{{ $product->stock }}">
            @error('stock')
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