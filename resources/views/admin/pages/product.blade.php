@extends('admin.layouts.main')

@section('container')
<div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
    @endif

    <div class="row mt-5">
        <div class="col-12 d-flex justify-content-end">
            <a href="/product/new" class="btn btn-primer">New</a>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Product</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Option</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Category</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($products) > 0)
                    @foreach ($products as $product)
                    <tr>
                        <td style="width: 200px">
                            <div class="row">
                                <div class="col-3">
                                    <form action="/product/{{ $product->short_name }}" method="POST">
                                        @csrf
                                        <button class="btn btn-warning" type="submit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-3">
                                    <form action="/product/{{ $product->short_name }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-primer"
                                            onclick="return confirm('Are you sure you want to delete this product?')">
                                            <i class=" bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->category->name }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5">
                            <div class="alert alert-info text-center">Tidak memiliki data product.</div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>
    @endsection
