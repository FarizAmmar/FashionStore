@extends('admin.layouts.main')

@section('container')
<div class="container-fluid">
    {{-- Success Message --}}
    @if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
    @endif

    <div class="row mt-5">
        <div class="col-12 d-flex justify-content-end">
            <a href="#new-category" class="btn btn-primer" role="button" data-bs-toggle="modal">New</a>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Category</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col-2">Option</th>
                        <th scope="col">Name</th>
                        <th scope="col">Short Name</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($categories) > 0)
                    @foreach ($categories as $category)
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-2">
                                    <a href="#edit-category-{{ $category->short_name }}" class="btn btn-warning"
                                        data-bs-toggle="modal" role="button">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </div>
                                <div class="col-2">
                                    <form action="/category/{{ $category->short_name }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-primer">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->short_name }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="2">
                            <div class="alert alert-info text-center">Tidak memiliki data category.</div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
            {{ $categories->links() }}
        </div>
    </div>
    @endsection


    {{-- New Modal --}}
    <div class="modal fade" id="new-category" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tambah Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('category.stored') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <label class="form-label" for="name">Nama Kategori</label>
                            <div class="col">
                                <input type="text" class="form-control" name="name" id="name" maxlength="25">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primer">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    @foreach ($categories as $category)
    <div class="modal fade" id="edit-category-{{ $category->short_name }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tambah Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('category.update', $category->short_name) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <label class="form-label" for="name">Nama Kategori</label>
                            <div class="col">
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $category->name }}" maxlength="30">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primer">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach