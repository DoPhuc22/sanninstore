@vite(["resources/sass/app.scss", "resources/js/app.js"])
<title>Orders Manager</title>
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
                <h1 class="me-sm-5 ">Order list</h1>
                <nav style="width: 710px"></nav>
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
                                                        <th scope="col">ORDER DATE</th>
                                                        <th scope="col">ADDRESS</th>
                                                        <th scope="col">CUSTOMER</th>
                                                        <th scope="col">STATUS</th>
                                                        <th scope="col">ACTION</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($orders->count() > 0)
                                                        @foreach ($orders as $order)
                                                            <tr style="background-color: #000000">
                                                                <td> {{$order->id}} </td>
                                                                <td> {{$order->order_date}} </td>
                                                                <td> {{$order->customer->address}} </td>
                                                                <td> {{$order->customer->first_name}} {{$order->customer->last_name}} </td>
                                                                <td>
                                                                    @switch($order->order_status)
                                                                        @case(0)
                                                                            <div class="text-danger">
                                                                                Pending
                                                                            </div>
                                                                            @break
                                                                        @case(1)
                                                                            <div class="text-success">
                                                                                Confirmed
                                                                            </div>
                                                                            @break
                                                                        @case(2)
                                                                            <div class="text-primary">
                                                                                Delivering
                                                                            </div>
                                                                            @break
                                                                        @case(3)
                                                                            <div class="text-success">
                                                                                Complete
                                                                            </div>
                                                                            @break
                                                                        @case(4)
                                                                            <div class="text-danger">
                                                                                Cancelled
                                                                            </div>
                                                                            @break
                                                                    @endswitch
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-warning">
                                                                        <a href="{{route('order.detail', $order)}}" class="nav-link bi bi-eye-fill"></a>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <!--                              end modal-->
                                                        @endforeach
                                                    @else
                                                    </tbody>
                                                </table>
                                                <p class="text-center fs-3 mt-5 ">
                                                    No Orders found!
                                                </p>
                                                @endif
                                                <div style="display: flex" class="justify-content-between">
                                                    <div></div>
                                                    <div class="pt-3">
                                                        {{$orders->onEachSide(3)->links()}}
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


