<aside class="bg-primary-bgc d-md-block d-none text-nowrap w-100"
    style="height: 100vh; max-width: 300px; position:sticky !important; top: 0; left: 0;">
    {{-- logo --}}
    <div class="p-2 d-flex align-items-center gap-1">
        <img src="{{ asset('logos/seal-1.jpg') }}" alt="brgy logo" class="rounded-circle" style="width: 50px;">
        <span class="fw-medium primary-color">TIGBAO MIS</span>
    </div>

    {{-- nav --}}
    @guest
        <nav>
            <ul class="nav flex-column gap-2">
                <li class="nav-item px-3">
                    <a href="{{ route('home') }}"
                        class="nav-link text-nowrap {{ Route::currentRouteName() == 'home' ? 'text-white' : 'primary-color' }} text-uppercase"
                        style="font-size: 0.8rem; letter-spacing: 2px;">
                        <x-icon type="home" />
                        Home
                    </a>
                </li>
                {{-- <li class="nav-item px-3">
                    <a href=""
                        class="nav-link text-nowrap {{ Route::currentRouteName() == 'about' ? 'text-white' : 'primary-color' }} text-uppercase"
                        style="font-size: 0.8rem; letter-spacing: 2px;">
                        <x-icon type="info" />
                        About
                    </a>
                </li> --}}
                <li class="nav-item px-3">
                    <a href="{{ route('signin') }}"
                        class="nav-link text-nowrap {{ Route::currentRouteName() == 'signin' ? 'text-white' : 'primary-color' }} text-uppercase"
                        style="font-size: 0.8rem; letter-spacing: 2px;">
                        <x-icon type="sign-in" />
                        Sign In
                    </a>
                </li>
            </ul>
        </nav>
    @endguest

    @auth
        {{-- nav --}}
        <ul class="nav flex-column gap-2">

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

                {{-- notif --}}
                <li class="nav-item">
                    <a href="{{ route('notifications.index') }}"
                        class="nav-link text-uppercase d-flex justify-content-between align-items-center {{ str_contains(Route::currentRouteName(), 'notifications.index') == true ? 'text-white' : 'primary-color' }}"
                        style="font-size: 0.8rem; letter-spacing: 2px;">
                        <div class="">
                            <x-icon type="bell" />
                            Notification
                        </div>
                        <div class="d-flex justify-content-center align-items-center gap-2 p-2 rounded-circle bg-danger text-white text-center align-middle bg-primary-color"
                            style="height: 25px; width:25px;">
                            <small class="text-white fw-medium">
                                {{ Auth::user()->unreadNotifications->count() }}
                            </small>
                        </div>
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
            @elseif (Auth::user()->role == 2)
                <li class="nav-item">
                    <a href="{{ route('as.dashboard.index') }}"
                        class="nav-link text-uppercase {{ str_contains(Route::currentRouteName(), 'as.dashboard.index') == true ? 'text-white' : 'primary-color' }}"
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
                <li class="nav-item">
                    <a href="{{ route('request-documents-layouts') }}"
                        class="nav-link text-uppercase cursor-pointer {{ str_contains(Route::currentRouteName(), 'request') == true ? 'text-white' : 'primary-color' }}"
                        style="font-size: 0.8rem; letter-spacing: 2px;">
                        <x-icon type="file" />
                        Request Documents
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
                    <a href="{{ route('request-documents-layouts') }}"
                        class="nav-link text-uppercase cursor-pointer {{ str_contains(Route::currentRouteName(), 'request') == true ? 'text-white' : 'primary-color' }}"
                        style="font-size: 0.8rem; letter-spacing: 2px;">
                        <x-icon type="file" />
                        Request Documents
                    </a>
                </li>
                <!--
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

                                                                {{-- indigency request --}}
                                                                <li class="dropdown-item">
                                                                    <a href="{{ route('request.certificate-of-indigency.index') }}"
                                                                        class="nav-link text-uppercase primary-color"
                                                                        style="font-size: 0.8rem; letter-spacing: 2px;">
                                                                        <x-icon type="certificate" />
                                                                        Certificate of Indigency
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                -->
            @endif

            @if (Auth::user()->role == 1 || Auth::user()->role == 2)
                {{-- upload important files --}}
                <li class="nav-item">
                    <a href="{{ route('important-files.index') }}"
                        class="nav-link text-uppercase {{ str_contains(Route::currentRouteName(), 'important-files') == true ? 'text-white' : 'primary-color' }}"
                        style="font-size: 0.8rem; letter-spacing: 2px;">
                        <x-icon type="file" />
                        Important Files
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
            @endif


        </ul>
    @endauth
</aside>
