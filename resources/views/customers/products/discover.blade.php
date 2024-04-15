@vite(["resources/sass/app.scss", "resources/js/app.js"])
<x-layout>
    @include('layouts/nav')
    <div class="d-flex justify-content-between mb-5">
        <div class="w-100 text-capitalize text-center fs-3 fw-bold bg-dark text-white py-4">
            Sannin Store Lego For All Ages
        </div>
    </div>

    <div class="container mb-5">
        <div class="d-flex w-100 justify-content-between align-items-center flex-wrap">

            @for($i = 0; $i < 6; $i++)
                <div class="w-30 bg-light border rounded h-30 mb-5 overflow-hidden">
                    <div class="d-flex justify-content-center align-items-center fs-4 bg-dark text-white">
                        6+
                    </div>
                    <div class="p-3">
                        <p>Lorem isum Lorem isum Lorem isum Lorem isumLorem isum Lorem isum Lorem isum Lorem isumLorem
                            isum Lorem isum Lorem isum Lorem isum
                        </p>
                    </div>
                </div>
            @endfor

        </div>

        <div class="d-flex justify-content-center">
            <a href="{{route('product')}}" class="btn btn-primary w-20 rounded-5">Shop now</a>
        </div>
    </div>

    <div class="d-flex justify-content-between mb-5">
        <div class="w-100 text-capitalize text-center fs-3 fw-bold bg-dark text-white py-4">
            Sannin Store All Lego Themes
        </div>
    </div>

    <div class="container mb-5">
        <div class="d-flex w-100 justify-content-between align-items-center flex-wrap">

            @for($i = 0; $i < 6; $i++)
                <div class="w-30 bg-light border rounded h-30 mb-5 overflow-hidden">
                    <div class="d-flex justify-content-center align-items-center fs-4 bg-dark text-white">
                        Minecraft
                    </div>
                    <div class="p-3">
                        <p>Lorem isum Lorem isum Lorem isum Lorem isumLorem isum Lorem isum Lorem isum Lorem isumLorem
                            isum Lorem isum Lorem isum Lorem isum
                        </p>
                    </div>
                </div>
            @endfor

        </div>

        <div class="d-flex justify-content-center">
            <a href="{{route('product')}}" class="btn btn-primary w-20 rounded-5">Shop now</a>
        </div>
    </div>
    @include('layouts/footer')
</x-layout>
<script src="{{asset('frontend/js/home.js')}}"></script>
