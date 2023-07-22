@extends('layouts.app')

@section('content')
{{-- Notification Failed Login --}}
@if (session()->has('loginFailed'))
<div class="container-fluid" style="position: fixed; margin-top:20px;">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed to login!!</strong> {{ session('loginFailed') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif
<div class="container-fluid justify-content-center d-flex align-items-center" style="height: 100vh">
    <div class="row">
        <div class="col-12">
            <div class="card" style="width: 30rem">
                <div class="card-body">
                    <h5 class="card-title">Welcome back!</h5>
                    <form action="/" method="POST">
                        @csrf
                        <div class="row mt-5">
                            <div class="col-12">
                                <label class="form-label" for="username">Username</label>
                                <input class="form-control" type="text" name="username" id="username"
                                    value="{{ old('username') }}">
                            </div>
                            <div class="col-12 mt-3 mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input class="form-control" type="password" name="password" id="password">
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    Don't have an account? <a href="">Create Account!</a>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primer" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
