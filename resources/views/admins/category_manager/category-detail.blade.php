@vite(["resources/sass/app.scss", "resources/js/app.js"])
<title>Categories Manager</title>
<body style="background-color: #f2f7fe">
<div id="content" class="">
    <div class="wrapper d-flex align-items-stretch">
        <div style="width: 360px"></div>
        <div class="position-fixed rounded-left" style="height: 100%">
            @include('layouts/navbar_adminMenu')
        </div>

        <div class="content-container mt-5 w-100">
            <h1 class="me-sm-5 text-center">Category Detail</h1>
        <!--  content  -->
            <div class="container bg-white mt-5 rounded-5 d-flex justify-content-center align-items-center w-50" style="height: 500px">
                {{--       IMG--}}
                <div class="w-10 d-flex align-items-center justify-content-center h-50 overflow-hidden me-5">
                    <img src="{{asset($category->image)}}" alt="category_image"
                         class="h-75 border border-4 w-75 rounded-4">
                </div>
                {{--        MAIN--}}
                <div class="w-50">
                    {{--            HEADING--}}
                    <div class="w-100 d-flex justify-content-between align-items-center mb-3">
                        <div class="fs-3 fw-bold text-capitalize w-50">{{$category->category_name}}</div>
                    </div>
                    {{--            BODY--}}
                    <div class="my-3">
                        <p class="text-justify">
                            {{$category->description}}
                        </p>
                    </div>

                    {{--BUTTON--}}
                    <form action="" class="d-flex justify-content-between align-items-center w-100">
                        <div class="d-flex align-items-center w-25">
                            <a href="{{route('category.index')}}" class="text-decoration-none d-flex align-items-center">
                                <i class="bi bi-arrow-left me-2"></i>
                                Back
                            </a>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary h-100">
                                <a href="{{route('category.edit', $category) }}"
                                   class="text-white nav-link"
                                   style="text-decoration: none">Edit Product</a>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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


