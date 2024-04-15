@vite(["resources/sass/app.scss", "resources/js/app.js"])
<title>Create</title>
<body style="background-color: #303036">
<div id="content" class="">
    <div class="wrapper d-flex align-items-stretch">
        <div style="width: 550px"></div>
        <div class="position-fixed" style="height: 100%">

            @include("layouts/navbar_adminMenu");

        </div>

        <!--  content  -->
        <div class="justify-content-center mt-5" style="width: 720px">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-5">
                        <div class="card-header">
                            <h3>Add Product
                                <a href="{{route('admin.product')}}" class="btn btn-danger btn-sm text-white float-end">BACK</a>
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="tab-content" >
                                    <div class="">
                                        <div class="mb-3 mt-3 mx-auto d-flex w-100">
                                            <label class="fs-5 d-block w-50 me-5">Product Name
                                                <input type="text" name="product_name" class="form-control" required></label>

                                            <label class="fs-5 w-50">Price
                                                <input type="text" name="price" class="form-control" required></label>

                                        </div>
                                        <div class="mb-3 mt-3 d-flex w-100">
                                            <label class="fs-5 d-block w-50 me-5">Quantity
                                                <input type="text" name="quantity" class="form-control" required></label>

                                            <label class="fs-5 w-50">Description
                                                <input type="text" name="description" class="form-control" required></label>

                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="mb-3 mt-3 d-flex">
                                            <label class="fs-5 me-5">Brand</label>
                                            <select name="brand_id" class="form-select ms-5">
                                                <option value="brand">Choose a brand</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 mt-3 d-flex">
                                            <label class="fs-5 me-5">Category</label>
                                            <select name="category_id" class="form-select ms-2">
                                                <option value="category">Choose a category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 mt-3 d-flex">
                                            <label class="fs-5 me-5">Age</label>
                                            <select name="age_id" class="form-select ms-5">
                                                <option value="age">Choose an age</option>
                                                @foreach($ages as $age)
                                                    <option value="{{$age->id}}">{{$age->age_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 mt-3 d-flex">
                                            <label class="fs-5 me-5">Country</label>
                                            <select name="country_id" class="form-select ms-3">
                                                <option value="country">Choose a country</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->country_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label class="fs-4">Upload Product Image</label>
                                            <input type="file" name="image" multiple class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

