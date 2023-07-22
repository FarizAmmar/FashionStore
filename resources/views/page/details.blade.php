@extends('layouts.app')

@section('content')
<main class="mt-4 mb-5 px-4">
    <div class="row mt-2" style="width: 100%">
        <div class="col-4 p-4">
            <img src="{{ $product->image_path }}" class="rounded img-thumbnail p-5" alt="...">
        </div>
        <div class="col-4 p-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-5">{{ $product->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted ">{{"Harga : ". "Rp " .
                                number_format($product->price, 0,
                                ',', '.') }}
                            </h6>
                            <p class="card-text">{{ $product->description }}</p>
                            <span>
                                <b>Kategori :</b>
                                <a href="/category/{{ $product->category->short_name }}" class=" text-decoration-none">
                                    <b>{{ $product->category->name }}</b>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5 {{ $product->product_type == 'local' ? '' : 'd-none' }}">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title mb-5">Panduan Ukuran Baju</h5>
                                </div>
                                <div class="col-4">
                                    <span class="d-flex justify-content-end text-uppercase text-danger">{{
                                        $product->product_type
                                        }}</span>
                                </div>
                            </div>
                            <img class="img-fluid" src="/img/size/local.png" alt="local">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5 {{ $product->product_type == 'external' ? '' : 'd-none' }}">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title mb-5">Panduan Ukuran Baju</h5>
                                </div>
                                <div class="col-4">
                                    <span class="d-flex justify-content-end text-uppercase text-danger">{{
                                        $product->product_type
                                        }}</span>
                                </div>
                            </div>
                            <img class="img-fluid" src="/img/size/external.png" alt="external">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 p-4">
            <div class="card"">
                <div class=" card-body">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <h5 class="card-title">Pendaftaran Pre-Order</h5>
                <form class="row g-3" action="/details/order" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="col-md-6">
                        <label for="fname" class="form-label">Nama Depan</label>
                        <input type="text" name="user_id" id="user_id" value="{{ $user->id }}" hidden>
                        <input type="text" class="form-control @error('fname') is-invalid
                        @enderror" id="fname" name="fname" value="{{ old('fname') }}" maxlength="20">
                        @error('fname')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="lname" class="form-label">Nama Belakang</label>
                        <input type="text" class="form-control @error('lname')
                            is-invalid
                        @enderror" id="lname" name="lname" value="{{ @old('lname') }}" maxlength="20">
                        @error('lname')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="phone" class="form-label">No. Telp</label>
                        <input type="text" id="phone" name="phone"
                            class="form-control @error('phone') is-invalid @enderror" value="{{ @old('phone') }}"
                            placeholder="+62 0813-XXXX-XXXX">
                        @error('phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="mystore@store.com" value="{{ @old('email') }}" maxlength="50">
                        @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="stock" class="form-label">Jumlah</label>
                        <input type="number" class="form-control @error('stock') is-invalid
                        @enderror" id="stock" name="stock" placeholder="Stok : {{ $product->stock }}" maxlength="255"
                            value="1" value="{{ @old('stock') }}">
                        @error('stock')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-8 {{ $product->product_type == 'local' ? '' : 'd-none' }}">
                        <label for="size" class="form-label">Ukuran Baju</label>
                        <div>
                            <input type="radio" class="btn-check" name="size" value="s" id="s" autocomplete="off"
                                checked>
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
                    </div>
                    <div class="col-8 {{ $product->product_type == 'external' ? '' : 'd-none' }}">
                        <label for="size" class="form-label">Ukuran Baju</label>
                        <div>
                            <input type="radio" class="btn-check" name="size" value="s" id="s" autocomplete="off"
                                checked>
                            <label class="btn btn-danger" for="s">S</label>

                            <input type="radio" class="btn-check" name="size" value="m" id="m" autocomplete="off">
                            <label class="btn btn-danger" for="m">M</label>

                            <input type="radio" class="btn-check" name="size" value="l" id="l" autocomplete="off">
                            <label class="btn btn-danger" for="l">L</label>

                            <input type="radio" class="btn-check" name="size" value="xl" id="xl" autocomplete="off">
                            <label class="btn btn-danger" for="xl">XL</label>

                            <input type="radio" class="btn-check" name="size" value="2xl" id="2xl" autocomplete="off">
                            <label class="btn btn-danger" for="2xl">2XL</label>

                            <input type="radio" class="btn-check" name="size" value="3xl" id="3xl" autocomplete="off">
                            <label class="btn btn-danger" for="3xl">3XL</label>

                            <input type="radio" class="btn-check" name="size" value="4xl" id="4xl" autocomplete="off">
                            <label class="btn btn-danger" for="4xl">4XL</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control  @error('address') is-invalid
                        @enderror" name="address" id="address" cols="10" rows="3"></textarea>
                        @error('address')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="city" class="form-label">Kota</label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                            name="city" maxlength="50" value="{{ @old('city') }}">
                        @error('city')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="postcode" class="form-label">Kode Pos</label>
                        <input class="form-control @error('postcode') is-invalid @enderror" type="text" name="postcode"
                            id="postcode" placeholder="51232" maxlength="5" value="{{ @old('postcode') }}">
                        @error('postcode')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primer">Order Now</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    </div>
</main>
@endsection
