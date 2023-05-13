<nav class="col-md-4 col-lg-3 ps-3 pe-3 sidebar bg-light overflow-auto">
    <form action="/" method="GET">
        <div class="row py-4 mx-3 rounded" style="background: white">
            {{-- Kategori --}}
            <div class="col-12">
                <div class="row mx-3">
                    <div class="col-6 sb-title-items">
                        <b>Kategori</b>
                    </div>
                    <div class="col-6 sb-title-items d-flex justify-content-end">
                        <span>
                            <i class="bi bi-dot"></i>
                        </span>
                    </div>
                    <div class="col-12 mt-3" id="jenis-kain-formal">
                        @foreach ($categories as $category)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="{{$category->short_name }}"
                                name="category" id="{{ request('category') }}" {{
                                request('category')==$category->short_name
                            ? 'checked' : '' }}>
                            <label class="form-check-label" for="{{$category->short_name }}">
                                {{$category->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- Button Filter --}}
            <div class="col-12">
                <div class="row mt-4 mx-3">
                    <div class="col-12">
                        <button class="btn btn-primer w-100" type="submit">
                            Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</nav>