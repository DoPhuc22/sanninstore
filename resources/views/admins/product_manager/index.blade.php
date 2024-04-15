@vite(["resources/sass/app.scss", "resources/js/app.js"])
<title>Products Manager</title>
<body style="background-color: #f2f7fe">
<div id="content" class="">
    <div class="wrapper d-flex align-items-stretch">
        <div style="width: 360px"></div>
        <div class="position-fixed rounded-left" style="height: 100%">
            @include('layouts/navbar_adminMenu')
        </div>

        <!--  content  -->
        <div class="content-container mt-5 ">
            <div class="d-flex mx-auto mt-5">
                <h1 class="me-sm-5 ">Product list</h1>
                <nav style="width: 710px"></nav>

                <form class="d-flex search-form mb-0" action="{{route('admin.product')}}">
                    <div class="input-group input-group-sm">
                        <form action="/">
                            <button type="button" onclick="window.location.href='{{route('admin.product')}}'" class="btn btn-dark mx-3 rounded-4">
                                Reset
                            </button>
                            <input class="form-control float-right" name="keyword" type="text" placeholder="Type to search...">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                    </div>
                </form>
            </div>
            <section>
                <div class="h-100">
                    <div class="d-flex align-items-center h-100">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 row-gap-xxl-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-borderless mb-0 text-center table-striped align-middle">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">PRODUCT NAME</th>
                                                        <th scope="col">QUANTITY</th>
                                                        <th scope="col">PRICE</th>
                                                        <th scope="col">CATEGORY</th>
                                                        <th scope="col">AGE</th>
                                                        <th scope="col">DETAILS</th>
                                                        <th scope="col">ACTION</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($products->count() > 0)
                                                        @foreach ($products as $product)
                                                            <tr style="background-color: #000000">
                                                                <td> {{$product->id}} </td>
                                                                <td> {{$product->product_name}} </td>
                                                                <td> {{$product->quantity}} </td>
                                                                <td> ${{$product->price}} </td>
                                                                <td> {{$product->category->category_name}}</td>
                                                                <td> {{$product->age->age_name}}</td>
                                                                <td>
                                                                    <button type="button" class="btn btn-success">
                                                                        <a href="{{route('product.detail', $product)}}" class="nav-link">View</a>
                                                                    </button>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <button
                                                                            class="text-white btn bg-danger border-danger-subtle"
                                                                            data-bs-toggle="modal" wire:click="setDeleteId({{$product->id}})"
                                                                            data-bs-target="#deleteModal">
                                                                            Delete
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <!--                              end modal-->
                                                        @endforeach
                                                    @else
                                                    </tbody>
                                                </table>
                                                <p class="text-center fs-3 mt-5 ">
                                                    No Products found!
                                                </p>
                                                @endif
                                                <div style="display: flex" class="justify-content-between">
                                                    <button type="button"
                                                            class="btn btn-warning nice-box-shadow h-75 mt-3">
                                                        <a href="{{route('product.create')}}" class="link-dark"
                                                           style="text-decoration: none">Add a product</a>
                                                    </button>
                                                    <div class="pt-3">
                                                        {{$products->onEachSide(3)->links()}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        {{--        Delete Modal--}}
        {{--        Modal--}}
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Product ?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this product??
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <form method="post" action="{{route('product.destroy', $product)}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger border-danger-subtle">Yes, Delete!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--  js close button modal  -->
        @push('script')
            <script>
                window.addEventListener('hide:delete-modal', function () {
                    $('#deleteModal').modal('hide');
                });
            </script>
        @endpush
        <script src="//unpkg.com/alpinejs" defer></script>

</div>
</body>

<x-flash-message/>


