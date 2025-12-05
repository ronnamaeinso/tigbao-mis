{{-- nav wrapper --}}
<header class="w-100 p-0 m-0 d-flex align-items-center justify-content-between px-3"
    style="background-color:var(--third-color);">

    {{-- offcanva toggler --}}
    <x-icon type="bars primary-color mx-1 fs-5 d-block d-md-none" style="cursor: pointer;" data-bs-toggle="offcanvas"
        data-bs-target="#aside-nav" />

    {{-- user icon --}}
    <div class="container-fluid d-flex justify-content-end align-items-center p-0 py-2">

        {{-- dropdown logo --}}
        <div class="dropdown">

            {{-- toggler --}}
            <img src="{{ asset('logos/user.png') }}" alt="" class="rounded-circle cursor-pointer"
                style="width: 30px; height: 30px;" data-bs-toggle="dropdown">

            <ul class="dropdown-menu">
                @if (Auth::user()->role != 1)
                    <li class="dropdown-item">
                        <a href="{{ route('profile.index') }}" class="nav-link primary-color text-uppercase"
                            style="font-size: 0.8rem; letter-spacing: 2px;">
                            <x-icon type="user" />
                            Profile
                        </a>
                    </li>
                @endif
                <li class="dropdown-item">
                    <a href="{{ route('logout') }}" class="nav-link primary-color text-uppercase"
                        style="font-size: 0.8rem; letter-spacing: 2px;">
                        <x-icon type="sign-out" />
                        Sign Out
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>

{{-- offcanvas --}}
<aside class="offcanvas offcanvas-start bg-primary-bgc" id="aside-nav" style="width:fit-content;">
    <div class="offcanvas-header">
        {{-- logo --}}
        <div class="p-2 d-flex align-items-center gap-1">
            <img src="{{ asset('logos/seal-1.jpg') }}" alt="brgy logo" class="rounded-circle" style="width: 50px;">
            <span class="fw-medium primary-color">TIGBAO MIS</span>
        </div>
        <button class="btn btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanva-body">
        <nav>
            <ul class="nav flex-column">
                {{-- admin --}}
                @if (Auth::user()->role == 1)
                    {{-- dashboard --}}
                    <li class="nav-item">
                        <a href="{{ route('as.dashboard.index') }}"
                            class="nav-link text-uppercase {{ str_contains(Route::currentRouteName(), 'as.dashboard') == true ? 'text-white' : 'primary-color' }}"
                            style="font-size: 0.8rem; letter-spacing: 2px;">
                            <x-icon type="dashboard" />
                            Dashboard
                        </a>
                    </li>
                    {{-- users --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.manage.users') }}"
                            class="nav-link text-uppercase cursor-pointer {{ Route::currentRouteName() == 'admin.manage.users' ? 'text-white' : 'primary-color' }}"
                            style="font-size: 0.8rem; letter-spacing: 2px;">
                            <x-icon type="users" />
                            Users List
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.manage.users.pending') }}"
                            class="nav-link text-uppercase cursor-pointer position-relative d-flex justify-content-between align-items-center {{ Route::currentRouteName() == 'admin.manage.users.pending' ? 'text-white' : 'primary-color' }}"
                            style="font-size: 0.8rem; letter-spacing: 2px;">
                            <div class="">
                                <x-icon type="hourglass" />
                                Account Verification
                            </div>
                            {!! App\Models\User::getUnverifiedAccountCount() > 0
                                ? '<div class="d-flex justify-content-center align-items-center gap-2 p-2 rounded-circle bg-danger text-white text-center align-middle bg-primary-color" style="height: 25px; width:25px;">
                                                                <small class="text-white fw-medium">' .
                                    App\Models\User::getUnverifiedAccountCount() .
                                    '</small>
                                    </div>'
                                : '' !!}

                        </a>
                    </li>

                    {{-- request documents --}}
                    <li class="nav-item">
                        <a href="{{ route('request-documents-layouts') }}"
                            class="nav-link text-uppercase cursor-pointer {{ str_contains(Route::currentRouteName(), 'request') == true ? 'text-white' : 'primary-color' }}"
                            style="font-size: 0.8rem; letter-spacing: 2px;">
                            <x-icon type="file" />
                            Request Documents
                        </a>
                    </li>
                    {{-- announcments --}}
                    <li class="nav-item">
                        <a href="{{ route('announcements.index') }}"
                            class="nav-link text-uppercase cursor-pointer {{ str_contains(Route::currentRouteName(), 'announcements') == true ? 'text-white' : 'primary-color' }}"
                            style="font-size: 0.8rem; letter-spacing: 2px;">
                            <x-icon type="bell" />
                            Announcements
                        </a>
                    </li>
                    {{-- senior citizen records --}}
                    <li class="nav-item">
                        <a href="{{ route('senior-citizen.records.index') }}"
                            class="nav-link text-uppercase cursor-pointer {{ str_contains(Route::currentRouteName(), 'senior-citizen.records') == true ? 'text-white' : 'primary-color' }}"
                            style="font-size: 0.8rem; letter-spacing: 2px;">
                            <x-icon type="users" />
                            Senior Citizens Record
                        </a>
                    </li>
                @elseif (Auth::user()->role == 2)
                    <li class="nav-item">
                        <a href="{{ route('as.dashboard.index') }}"
                            class="nav-link text-uppercase {{ str_contains(Route::currentRouteName(), 'as.dashboard') == true ? 'text-white' : 'primary-color' }}"
                            style="font-size: 0.8rem; letter-spacing: 2px;">
                            <x-icon type="dashboard" />
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('staff.citizen.index') }}"
                            class="nav-link text-uppercase {{ str_contains(Route::currentRouteName(), 'staff.citizen') == true ? 'text-white' : 'primary-color' }}"
                            style="font-size: 0.8rem; letter-spacing: 2px;">
                            <x-icon type="users" />
                            Citizens
                        </a>
                    </li>
                    {{-- request documents --}}
                    <li class="nav-item">
                        <a href="{{ route('request-documents-layouts') }}"
                            class="nav-link text-uppercase cursor-pointer {{ str_contains(Route::currentRouteName(), 'request') == true ? 'text-white' : 'primary-color' }}"
                            style="font-size: 0.8rem; letter-spacing: 2px;">
                            <x-icon type="file" />
                            Request Documents
                        </a>
                    </li>
                    {{-- announcments --}}
                    <li class="nav-item">
                        <a href="{{ route('announcements.index') }}"
                            class="nav-link text-uppercase cursor-pointer {{ str_contains(Route::currentRouteName(), 'announcements') == true ? 'text-white' : 'primary-color' }}"
                            style="font-size: 0.8rem; letter-spacing: 2px;">
                            <x-icon type="bell" />
                            Announcements
                        </a>
                    </li>
                    {{-- senior citizen records --}}
                    <li class="nav-item">
                        <a href="{{ route('senior-citizen.records.index') }}"
                            class="nav-link text-uppercase cursor-pointer {{ str_contains(Route::currentRouteName(), 'senior-citizen.records') == true ? 'text-white' : 'primary-color' }}"
                            style="font-size: 0.8rem; letter-spacing: 2px;">
                            <x-icon type="users" />
                            Senior Citizens Record
                        </a>
                    </li>
                @elseif(Auth::user()->role == 3)
                    <li class="nav-item">
                        <a href="{{ route('dashboard.index') }}"
                            class="nav-link text-uppercase {{ str_contains(Route::currentRouteName(), 'dashboard.index') == true ? 'text-white' : 'primary-color' }}"
                            style="font-size: 0.8rem; letter-spacing: 2px;">
                            <x-icon type="dashboard" />
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <a href=""
                                class="nav-link text-uppercase cursor-pointer {{ str_contains(Route::currentRouteName(), 'request.documents') == true ? 'text-white' : 'primary-color' }}"
                                style="font-size: 0.8rem; letter-spacing: 2px;" data-bs-toggle="dropdown">
                                <x-icon type="file" />
                                Request Documents
                            </a>
                            <ul class="dropdown-menu">
                                {{-- cert of attestation --}}
                                <li class="dropdown-item">
                                    <a href="{{ route('request.documents.attestation.certificate.index') }}"
                                        class="nav-link text-uppercase primary-color"
                                        style="font-size: 0.8rem; letter-spacing: 2px;">
                                        <x-icon type="file" />
                                        Certificate of Attestation
                                    </a>
                                </li>
                                {{-- kp form no.9 --}}
                                <li class="dropdown-item">
                                    <a href="{{ route('request.documents.kp-form-no-9.index') }}"
                                        class="nav-link text-uppercase primary-color"
                                        style="font-size: 0.8rem; letter-spacing: 2px;">
                                        <x-icon type="file" />
                                        KP Form No. 9 (Summon)
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
