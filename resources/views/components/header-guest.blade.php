<header class="p-3 position-sticky py-md-4" style="background-color:var(--third-color);">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between justify-content-sm-start">
            <x-icon type="bars primary-color fs-5 d-block d-md-none"
                style="cursor: pointer; margin-right: 0.8em;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNav" />
        </div>
    </div>
</header>

<aside class="offcanvas offcanvas-start bg-primary-bgc text-nowrap" id="offcanvasNav" style="width: 90%; max-width: 300px;">
    <div class="offcanvas-header py-2">
        <d class="d-flex justify-content-between align-items-center w-100">
            {{-- logo --}}
            <div class="p-2 d-flex align-items-center gap-1">
                <img src="{{ asset('logos/seal-1.jpg') }}" alt="brgy logo" class="rounded-circle" style="width: 50px;">
                <span class="fw-medium primary-color">TIGBAO MIS</span>
            </div>

            <button class="btn btn-close" type="button" data-bs-dismiss="offcanvas"></button>
        </d>

    </div>
    <div class="offcanvas-body p-0">
        <nav class="d-flex align-items-center justify-content-between w-100">
            <ul class="nav flex-column w-100">
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link {{ Route::currentRouteName() == 'home' ? 'text-white' : 'primary-color' }} text-uppercase"
                        style="font-size: 0.8rem; letter-spacing: 2px;">
                        <x-icon type="home" />
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('signin') }}"
                        class="nav-link {{ Route::currentRouteName() == 'signin' ? 'text-white' : 'primary-color' }} text-uppercase"
                        style="font-size: 0.8rem; letter-spacing: 2px;">
                        <x-icon type="sign-in" />
                        Sign In
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
