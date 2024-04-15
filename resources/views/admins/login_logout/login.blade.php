@vite(["resources/sass/app.scss", "resources/js/app.js"])
<title>Login</title>
<body class="justify-content-center align-items-center d-flex min-vh-100"
style='background-size: cover; background-image: url("https://img.pikbest.com/back_our/20210908/bg/47797e76223b4.jpg!w700wp")'>
<div class="wrapper rounded-4 p-5 bg-white shadow-lg border-3"
     style="width: 420px; border: 2px solid rgba(255,255,255,.2)">
    <form action="{{route('admin.loginProcess')}}" method="post">
        @csrf
        <h1 class="text-center font-weight-bold">Login</h1>
        <div class="w-100 position-relative"
        style="margin: 30px 0; height: 50px">
            <input class="w-100 h-100 border rounded-5 bg-transparent" style="padding: 20px 45px 20px 20px" placeholder="Email" required
                   type="email" id="email" name="email" value="{{old('email')}}">
            <i class="bi bi-person-fill position-absolute fs-2 mt-2" style="right: 20px"></i>

        </div>
        <div class="w-100 position-relative"
             style="margin: 30px 0; height: 50px">
            <input class="w-100 h-100 border rounded-5 bg-transparent" style="padding: 20px 45px 20px 20px" placeholder="Password" required
                   type="password" id="password" name="password">
            <i class="bi bi-lock-fill position-absolute fs-2 mt-2" style="right: 20px"></i>
        </div>

        <button class="btn w-100 btn-secondary border-0 nice-box-shadow fs-3" type="submit">Login</button>

    </form>
</div>

</body>


