
<nav class="d-flex flex-column flex-shrink-0 p-3 rounded-3 navbar-expand-sm bg-white" style="height: 100%" >
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
     <span class="bi me-2 me-4">
            <img src="{{asset('images/brand.png')}}" width="60" height="60" class="border rounded">
        </span>
        <span class=" fs-3 ml-3">
            Admin
        </span>
    </a>

    <ul class="nav nav-pills flex-column height-100 fs-4 p-1 small pt-5">
        <span>
            Menu
        </span>
        <li class="nav-item link-opacity-50-hover">
            <a href="{{route('dashboard.index')}}" class="fs-3 nav-link link-dark link-offset-1-hover bi bi-speedometer2 mx-3 mt-3
            {{ request()->routeIs('dashboard.index') ? 'bg-warning' : '' }}" aria-current="page">
                <span class="ms-3">Dashboard</span>
            </a>
        </li>
        <span class="my-sm-3">
            Manage
        </span>
        <li class="nav-item link-opacity-50-hover">
            <a href="{{route('admin.product')}}" class="fs-3 nav-link link-dark bi bi-box2 mx-3
            {{ request()->routeIs('admin.product', 'product.detail', 'product.create', 'product.edit') ? 'bg-warning' : '' }}">
                <span class="ms-3">Product</span>
            </a>
        </li>
        <li class="nav-item link-opacity-50-hover">
            <a href="{{route('category.index')}}" class="fs-3 nav-link link-dark bi bi-file-earmark-richtext mx-3
            {{ request()->routeIs('category.index', 'category.create', 'category.edit', 'category.detail') ? 'bg-warning' : '' }}">
                <span class="ms-3">Category</span>
            </a>
        </li>
        <li class="nav-item link-opacity-50-hover">
            <a href="{{route('brand.index')}}" class="fs-3 nav-link link-dark bi bi-windows mx-3
            {{ request()->routeIs('brand.index', 'brand.create', 'brand.edit') ? 'bg-warning' : '' }}">
                <span class="ms-3">Brand</span>
            </a>
        </li>
        <li class="nav-item link-opacity-50-hover">
            <a href="{{route('country.index')}}" class="fs-3 nav-link link-dark bi bi-globe-central-south-asia mx-3
            {{ request()->routeIs('country.index', 'country.create', 'country.edit') ? 'bg-warning' : '' }}">
                <span class="ms-3">Country</span>
            </a>
        </li>
        <li class="nav-item link-opacity-50-hover">
            <a href="{{route('order.index')}}" class="fs-3 nav-link link-dark bi bi-bag-dash mx-3
            {{ request()->routeIs('order.index', 'order.detail') ? 'bg-warning' : '' }}">
                <span class="ms-3">Order</span>
            </a>
        </li>
        <li class="nav-item link-opacity-50-hover">
            <a href="{{route('admin.customer')}}" class="fs-3 nav-link link-dark bi bi-person mx-3
            {{ request()->routeIs('admin.customer', 'customer.create', 'customer.edit', 'customer.editStatus') ? 'bg-warning' : '' }}">
                <span class="ms-3">Customer</span>
            </a>
        </li>
        <span class="my-sm-3">
            Other
        </span>
        <li class="nav-item link-opacity-50-hover">
            <a href="#" class="fs-3 nav-link link-dark bi bi-gear mx-3">
                <span class="ms-3">Settings</span>
            </a>
        </li>
        <li class="nav-item link-opacity-50-hover">
            <a href="" class="fs-3 nav-link link-dark bi bi-box-arrow-in-left mx-3 text-danger">
                <span class="ms-3">Sign out</span>
            </a>
        </li>
    </ul>
</nav>
