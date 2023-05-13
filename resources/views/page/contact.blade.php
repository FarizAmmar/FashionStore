@extends('layouts.app')

@section('content')
@if(session('success'))
<div class="alert alert-success mt-3 mx-5">
    {{ session('success') }}
</div>
@elseif (session('error'))
<div class="alert alert-danger mt-3 mx-5">
    {{ session('error') }}
</div>
@else
<div></div>

@endif
<div class="container-fluid d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="card" style="width: 50rem;">
        <div class=" card-body">
            <h5 class="card-title">Contact Us</h5>
            <form class="row g-3" action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="col-md-6">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name')
                        is-invalid
                    @enderror" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control @error('email')
                        is-invalid
                    @enderror" id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="address" class="form-label">Alamat</label>
                    <input type="text" class="form-control @error('address')
                        is-invalid
                    @enderror" id="address" name="address" placeholder="1234 Main St" value="{{ old('address') }}">
                    @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="message" class="form-label">Pesan</label>
                    <textarea class="form-control @error('message')
                        is-invalid
                    @enderror" name="message" id="message" cols="20" rows="4">{{ old('message') }}</textarea>
                    @error('message')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primer">Kirim Pesan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection