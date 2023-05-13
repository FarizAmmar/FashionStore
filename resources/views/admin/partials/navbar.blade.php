<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="dropdown ms-auto me-3">
        {{-- Dropdown --}}
        <button class="btn btn-dark" type="button" data-bs-toggle="dropdown">
            <i class='bx bx-menu'></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            {{-- <li><a class="dropdown-item" href="#">Profile</a></li> --}}
            {{-- <li>
                <hr class="dropdown-divider">
            </li> --}}
            <li>
                <form action="/logout" method="POST">
                    @csrf
                    <button class="dropdown-item" type="submit">
                        <div class="row">
                            <div class="col-6">Logout</div>
                            <div class="col-6 d-flex justify-content-end"><i class="bi bi-box-arrow-right"></i></div>
                        </div>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>