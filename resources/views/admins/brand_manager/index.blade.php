@vite(["resources/sass/app.scss", "resources/js/app.js"])
<title>Brands Manager</title>
<body style="background-color: #f2f7fe">
<div id="content" class="">
    <div class="wrapper d-flex align-items-stretch">
        <div style="width: 420px"></div>
        <div class="position-fixed rounded-left" style="height: 100%">
            @include('layouts.navbar_adminMenu')
        </div>

        <!--  content  -->

        <div class="content-container mt-5 ">
            <div class="d-flex mx-auto mt-5">
                <h1 class="me-sm-5">Brand list</h1>
                <nav style="width: 520px"></nav>

                <form class="d-flex search-form mb-0" action="{{route('brand.index')}}">
                    <div class="input-group input-group-sm">
                        <button type="button" onclick="window.location.href='{{route('brand.index')}}'" class="btn btn-dark mx-3 rounded-4">
                            Reset
                        </button>
                        <input class="form-control" name="keyword" type="text" placeholder="Type to search...">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
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
                                                        <th scope="col">BRAND NAME</th>
                                                        <th scope="col">ACTION</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($brands->count() > 0)
                                                        @foreach ($brands as $brand)
                                                            <tr style="background-color: #000000">
                                                                <td> {{$brand->id}} </td>
                                                                <td> {{$brand->brand_name}} </td>

                                                                <td class="d-flex justify-content-center pt-2">
                                                                    <div>
                                                                        <button type="button" class="btn btn-primary">
                                                                            <a href="{{route('brand.edit', $brand) }}"
                                                                               class="text-white nav-link bi-pencil"
                                                                               style="text-decoration: none">Edit</a>
                                                                        </button>
                                                                    </div>

                                                                    <div>
                                                                        <button
                                                                            class="text-white btn bg-danger border-danger-subtle"
                                                                            data-bs-toggle="modal" wire:click="setDeleteId({{$brand->id}})"
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
                                                    No Brands found!
                                                </p>
                                                @endif
                                                <div style="display: flex" class="justify-content-between">
                                                    <button type="button"
                                                            class="btn btn-warning nice-box-shadow h-75 mt-3">
                                                        <a href="{{route('brand.create')}}" class="link-dark"
                                                           style="text-decoration: none">
                                                            Add a brand</a>
                                                    </button>
                                                    <div class="pt-3">
                                                        {{$brands->onEachSide(3)->links()}}
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
                        <h5 class="modal-title" id="deleteModalLabel">Delete Brand ?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this brand??
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <form method="post" action="{{route('brand.destroy', $brand)}}">
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


