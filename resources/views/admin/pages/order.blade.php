@extends('admin.layouts.main')

@section('container')
<div class="container-fluid">
    <div class="row mt-5">
        {{-- <div class="col-12 d-flex justify-content-end">
            <a href="/" class="btn btn-primer">New</a>
        </div> --}}
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Order</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col-2">View</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">E-Mail</th>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($orders) > 0)
                    @foreach ($orders as $order)
                    <tr>
                        {{-- Optional --}}
                        <td>
                            <button class="btn btn-primer" role="button" data-bs-toggle="modal"
                                data-bs-target="#view{{ $order->id }}">
                                <i class="bi bi-search"></i>
                            </button>
                        </td>
                        <td class="text-capitalize">{{ $order->fname .' ' . $order->lname }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->product->name }}</td>
                        <td class="text-center">{{ $order->qty }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6">
                            <div class="alert alert-info text-center">Anda belum memiliki orderan.</div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
            {{ $orders->links() }}
        </div>
    </div>
    @endsection


    <!-- Modal -->
    @foreach ($orders as $order)
    <div class="modal fade" id="view{{ $order->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Details Order</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <img class="img-fluid" src="{{ $order->product->image_path }}"
                                alt="{{ $order->product->short_name }}">
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-capitalize" id="name" name="name"
                                    value="{{ $order->fname . ' ' . $order->lname }}" readonly disabled
                                    style="background-color: rgb(213, 239, 247)">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-capitalize" id="phone" name="phone"
                                    value="{{ $order->phone}}" readonly disabled
                                    style="background-color: rgb(213, 239, 247)">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" value="{{ $order->email }}" readonly
                                    disabled style="background-color: rgb(213, 239, 247)">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="address" id="address" cols="15" rows="5" readonly
                                    disabled
                                    style="background-color: rgb(213, 239, 247)">{{ $order->address . ', '. $order->city .', '. $order->postcode}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="product-name" class="col-sm-2 col-form-label">Product</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="product-name" id="product-name" value="{{ $order->product->name
                                 }}" readonly disabled style="background-color: rgb(213, 239, 247)">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="type" class="col-sm-2 col-form-label">Bahan</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="type" id="type" value="{{ $order->product->category->name
                                 }}" readonly disabled style="background-color: rgb(213, 239, 247)">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="size" class="col-sm-2 col-form-label">Ukuran</label>
                            <div class="col-2">
                                <input class="form-control text-uppercase text-center" type="text" name="size" id="size"
                                    value="{{ $order->size}}" readonly disabled
                                    style="background-color: rgb(213, 239, 247)">
                            </div>
                            <label for="size" class="col-sm-2 col-form-label">Tipe</label>
                            <div class="col-6">
                                <input class="form-control text-capitalize" type="text" name="size" id="size" value="{{ $order->product->product_type
                                 }}" readonly disabled style="background-color: rgb(213, 239, 247)">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primer" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
    @endforeach