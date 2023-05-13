<nav class="col-md-3 col-lg-2 pt-2 ps-3 pe-3 sidebar bg-dark text-danger">
    <div class="ms-3 pt-1">
        <span><i class="bi bi-person-circle me-3" style="font-size: 20px"></i></span>
        {{ auth()->user()->name }}
    </div>
    <ul class="nav nav-pills flex-column pt-2 d-md-none d-lg-block">
        <li class="nav-item">
            <a href="/dashboard"
                class="nav-link d-flex align-items-center text-white {{ $title === 'Dashboard' ? 'active' : '' }}">
                <i class="bi bi-house-fill me-3"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="/dashboard/product"
                class="nav-link d-flex align-items-center text-white {{ $title === 'Product' ? 'active' : '' }}">
                <i class="bi bi-box-seam-fill me-3"></i>
                Product
            </a>
        </li>
        <li class="nav-item">
            <a href="/dashboard/category"
                class="nav-link d-flex align-items-center text-white {{ $title === 'Category' ? 'active' : '' }}">
                <i class="bi bi-tag-fill me-3"></i>
                Categories
            </a>
        </li>
        <li class="nav-item">
            <a href="/dashboard/order"
                class="nav-link d-flex align-items-center text-white {{ $title === 'Order' ? 'active' : '' }}">
                <i class="bi bi-truck me-3"></i>
                Orders
            </a>
        </li>
    </ul>
</nav>
