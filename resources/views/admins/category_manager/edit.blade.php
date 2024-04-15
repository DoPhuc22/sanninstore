@vite(["resources/sass/app.scss", "resources/js/app.js"])
<title>Edit Category</title>
<body style="background-color: #303036">
<div id="content" class="">
    <div class="wrapper d-flex align-items-stretch">
        <div style="width: 620px"></div>
        <div class="position-fixed rounded-left" style="height: 100%">
            @include('layouts/navbar_adminMenu')
        </div>

        <!--  content  -->
        <div class="justify-content-center mt-5" style="width: 520px">
            <h4 class="fs-1 text-white text-center">Edit Category #{{$category->id}}</h4>
            <form method="post" action="{{ route('category.update', $category) }}" enctype="multipart/form-data">
                <div class="card-body bg-white rounded-4 p-5 shadow-lg m-5 w-100">
                    <form>
                        @csrf
                        @method('PUT')
                        <div class="row justify-content-between w-100 pl-5">
                            <div class="col-5 ">
                                <div class="input-group">
                                    <label class="col-form-label text-dark font-monospace m-lg-2">Category Name</label>
                                    <input class="rounded-3 px-3 " type="text" name="category_name"
                                           value="{{$category->category_name}}">
                                    @if($errors->has('category_name'))
                                        <small class="text-danger">{{ $errors->first('category_name') }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between w-100 pl-5">
                            <div class="col-5">
                                <div class="">
                                    <label class="col-form-label text-dark font-monospace m-lg-2">Image</label>
                                    <input class="rounded-3 px-3 input-group-text" type="file" name="image">
                                    <img src="{{ asset( $category->image) }}" width="100px" height="100px" class="border border-4">
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between w-75">
                            <div class="">
                                <div class="input-group">
                                    <label class="col-form-label text-dark font-monospace m-lg-2">Description</label>
                                    <textarea class="rounded-3 input--style-4 px-3" rows="4" type="text" name="description">
                                        {{$category->description}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row justify-content-between w-100 mt-4">
                        <div class="col-4">
                            <div class="d-flex">
                                <a class="btn btn-primary nice-box-shadow font-monospace"
                                   href="{{route('category.detail', $category)}}">Back</a>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="mr-5">
                                <button class="btn btn-primary nice-box-shadow font-monospace">UPDATE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

