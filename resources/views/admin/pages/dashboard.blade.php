@extends('admin.layouts.main')

@section('container')
<main class="mt-5 mx-3">
    <div class="row ms-4">
        {{-- Product --}}
        <div class="col-4">
            <div class="card shadow" style="width:18rem;">
                <div class="card-body">
                    <div class="row d-flex align-items-center text-center">
                        <div class="col-6">
                            <i class="bi bi-box-seam" style="font-size: 40px"></i>
                        </div>
                        <div class="col-6">
                            Product
                            <br>
                            <b style="font-size: 40px">{{ $products->count() }}</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Category --}}
        <div class="col-4">
            <div class="card shadow" style="width:18rem;">
                <div class="card-body">
                    <div class="row d-flex align-items-center text-center">
                        <div class="col-6">
                            <i class="bi bi-tag" style="font-size: 40px"></i>
                        </div>
                        <div class="col-6">
                            Category
                            <br>
                            <b style="font-size: 40px">{{ $categories->count() }}</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Orders --}}
        <div class="col-4">
            <div class="card shadow" style="width:18rem;">
                <div class="card-body">
                    <div class="row d-flex align-items-center text-center">
                        <div class="col-6">
                            <i class="bi bi-truck" style="font-size: 40px"></i>
                        </div>
                        <div class="col-6">
                            Orders
                            <br>
                            <b style="font-size: 40px">{{ $orders->count() }}</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
