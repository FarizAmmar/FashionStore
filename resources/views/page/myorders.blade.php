@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if (session('success'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session('delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('delete') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Order</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center" scope="col-2">Details</th>
                        <th scope="col">Account</th>
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
                        <td class="text-center">
                            <button class="btn btn-primer btn-sm" role="button" data-bs-toggle="modal"
                                data-bs-target="#edit-{{ $order->id }}">
                                <i class='bx bxs-edit'></i>
                            </button>
                            <button class=" btn btn-outline-danger btn-sm" role="button" data-bs-toggle="modal"
                                data-bs-target="#delete-{{ $order->id }}">
                                <i class='bx bxs-trash-alt'></i>
                            </button>
                        </td>
                        <td>{{ $order->user->username }}</td>
                        <td class="text-capitalize">{{ $order->fname . ' ' . $order->lname }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->product->name }}</td>
                        <td>{{ $order->qty }}</td>
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
            {{-- {{ $orders->links() }} --}}
        </div>
    </div>
</div>
@endsection

<!-- Modal -->
@foreach ($orders as $order)
<div class="modal fade" id="edit-{{ $order->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Details Order</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('myorder.update', ['id' => $order->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <img class="img-fluid" src="{{ $order->product->image_path }}"
                            alt="{{ $order->product->short_name }}">
                    </div>
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-capitalize" id="name" name="name"
                                value="{{ $order->fname . ' ' . $order->lname }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-capitalize" id="phone" name="phone"
                                value="{{ $order->phone}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" id="email"
                                value="{{ $order->email }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="address" id="address" cols="15"
                                rows="5">{{ $order->address . ', '. $order->city .', '. $order->postcode}}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="product-name" class="col-sm-2 col-form-label">Product</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="product-name" id="product-name"
                                value="{{ $order->product->name}}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="type" class="col-sm-2 col-form-label">Bahan</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="type" id="type"
                                value="{{ $order->product->category->name }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="size" class="col-sm-2 col-form-label">Ukuran</label>
                        <div class="col-2">
                            <input class="form-control text-uppercase text-center" type="text" name="size" id="size"
                                value="{{ $order->size}}" readonly>
                        </div>
                        <label for="size" class="col-sm-2 col-form-label">Tipe</label>
                        <div class="col-6">
                            <input class="form-control text-capitalize" type="text" name="size" id="size"
                                value="{{ $order->product->product_type }}" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-12 text-end ">
                            <button type="submit" class="btn btn-outline-success">Save Changes</button>
                            <button type="button" class="btn btn-primer" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


{{-- Delete Modal --}}
@foreach ($orders as $order)
<div class="modal fade" id="delete-{{ $order->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin membatalkan pesanan ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <form action="{{ route('myorder.delete', ['id' => $order->id ]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primer">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
