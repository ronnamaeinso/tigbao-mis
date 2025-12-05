<aside class="bg-primary-bgc d-md-block d-none text-nowrap"
    style="height: 100vh; width: 220px; position:sticky !important; top: 0; left: 0; overflow-y: auto; border-right: 1px solid rgba(0,0,0,0.1);">
    {{-- logo --}}
    <div class="p-3 d-flex align-items-center gap-2" style="border-bottom: 1px solid rgba(0,0,0,0.1);">
        <img src="{{ asset('logos/seal-1.jpg') }}" alt="brgy logo" class="rounded-circle" style="width: 45px; height: 45px; object-fit: cover;">
        <div>
            <span class="fw-bold primary-color" style="font-size: 1rem; letter-spacing: 0.5px;">TIGBAO MIS</span>
            <small class="d-block text-muted" style="font-size: 0.7rem; margin-top: -2px;">Barangay System</small>
        </div>
    </div>

    {{-- nav --}}
    @guest
        <nav class="mt-3 px-2">
            <ul class="nav flex-column gap-1">
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link text-nowrap d-flex align-items-center gap-3 py-3 px-3 rounded {{ Route::currentRouteName() == 'home' ? 'text-white bg-primary-color' : 'primary-color' }}"
                        style="font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px;">
                        <x-icon type="home" style="width: 18px; height: 18px;" />
                        <span>Home</span>
                    </a>
                </li>

{{-- For dedicated FAQ page --}}
<li class="nav-item">
    <a href="{{ route('faqs') }}"
        class="nav-link text-nowrap d-flex align-items-center gap-3 py-3 px-3 rounded {{ Route::currentRouteName() == 'faqs' ? 'text-white bg-primary-color' : 'primary-color' }}"
        style="font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px;">
        <x-icon type="question-circle" style="width: 18px; height: 18px;" />
        <span>FAQs</span>
    </a>
</li>

                <li class="nav-item">
                    <a href="{{ route('signin') }}"
                        class="nav-link text-nowrap d-flex align-items-center gap-3 py-3 px-3 rounded {{ Route::currentRouteName() == 'signin' ? 'text-white bg-primary-color' : 'primary-color' }}"
                        style="font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px;">
                        <x-icon type="sign-in" style="width: 18px; height: 18px;" />
                        <span>Sign In</span>
                    </a>
                </li>

                {{-- Optional: Contact Link --}}
                <li class="nav-item">
                    <a href="{{ route('home') }}#contact"
                        class="nav-link text-nowrap d-flex align-items-center gap-3 py-3 px-3 rounded primary-color"
                        style="font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px;">
                        <x-icon type="phone" style="width: 18px; height: 18px;" />
                        <span>Contact</span>
                    </a>
                </li>
            </ul>
        </nav>
    @endguest

    @auth
        {{-- User info --}}
        <div class="px-3 py-3 border-bottom border-top" style="border-color: rgba(0,0,0,0.1) !important;">
            <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                     style="width: 40px; height: 40px; background: rgba(var(--primary-color-rgb), 0.1) !important;">
                    <x-icon type="user" class="primary-color" style="width: 18px; height: 18px;" />
                </div>
                <div>
                    <h6 class="mb-0 fw-bold" style="font-size: 0.9rem;">{{ Auth::user()->name }}</h6>
                    <small class="text-muted">
                        @if(Auth::user()->role == 1)
                            <span class="badge bg-primary-color rounded-pill px-2 py-1" style="font-size: 0.7rem;">Admin</span>
                        @elseif(Auth::user()->role == 2)
                            <span class="badge bg-success rounded-pill px-2 py-1" style="font-size: 0.7rem;">Staff</span>
                        @else
                            <span class="badge bg-info rounded-pill px-2 py-1" style="font-size: 0.7rem;">Resident</span>
                        @endif
                    </small>
                </div>
            </div>
        </div>

        {{-- nav --}}
        <nav class="mt-2 px-2">
            <ul class="nav flex-column gap-1">

                {{-- admin --}}
                @if (Auth::user()->role == 1)
                    {{-- dashboard --}}
                    <li class="nav-item">
                        <a href="{{ route('as.dashboard.index') }}"
                            class="nav-link d-flex align-items-center gap-3 py-3 px-3 rounded {{ str_contains(Route::currentRouteName(), 'as.dashboard') == true ? 'text-white bg-primary-color' : 'primary-color' }}"
                            style="font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px;">
                            <x-icon type="dashboard" style="width: 18px; height: 18px;" />
                            <span>Dashboard</span>
                        </a>
                    </li>

                    {{-- notif --}}
                    <li class="nav-item">
                        <a href="{{ route('notifications.index') }}"
                            class="nav-link d-flex align-items-center justify-content-between py-3 px-3 rounded {{ str_contains(Route::currentRouteName(), 'notifications.index') == true ? 'text-white bg-primary-color' : 'primary-color' }}"
                            style="font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px;">
                            <div class="d-flex align-items-center gap-3">
                                <x-icon type="bell" style="width: 18px; height: 18px;" />
                                <span>Notifications</span>
                            </div>
                            @if(Auth::user()->unreadNotifications->count() > 0)
                                <span class="badge bg-danger rounded-pill" style="font-size: 0.7rem; min-width: 20px;">
                                    {{ Auth::user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </a>
                    </li>

                    {{-- users --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.manage.users') }}"
                            class="nav-link d-flex align-items-center gap-3 py-3 px-3 rounded {{ Route::currentRouteName() == 'admin.manage.users' ? 'text-white bg-primary-color' : 'primary-color' }}"
                            style="font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px;">
                            <x-icon type="users" style="width: 18px; height: 18px;" />
                            <span>Users List</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.manage.users.pending') }}"
                            class="nav-link d-flex align-items-center justify-content-between py-3 px-3 rounded {{ Route::currentRouteName() == 'admin.manage.users.pending' ? 'text-white bg-primary-color' : 'primary-color' }}"
                            style="font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px;">
                            <div class="d-flex align-items-center gap-3">
                                <x-icon type="hourglass" style="width: 18px; height: 18px;" />
                                <span>Account Verification</span>
                            </div>
                            @if(App\Models\User::getUnverifiedAccountCount() > 0)
                                <span class="badge bg-warning rounded-pill" style="font-size: 0.7rem; min-width: 20px;">
                                    {{ App\Models\User::getUnverifiedAccountCount() }}
                                </span>
                            @endif
                        </a>
                    </li>

                    {{-- request documents --}}
                    <li class="nav-item">
                        <a href="{{ route('request-documents-layouts') }}"
                            class="nav-link d-flex align-items-center gap-3 py-3 px-3 rounded {{ str_contains(Route::currentRouteName(), 'request') == true ? 'text-white bg-primary-color' : 'primary-color' }}"
                            style="font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px;">
                            <x-icon type="file" style="width: 18px; height: 18px;" />
                            <span>Request Documents</span>
                        </a>
                    </li>

                    {{-- FAQ Link for Admin --}}
                    <li class="nav-item mt-2" style="border-top: 1px solid rgba(0,0,0,0.1); padding-top: 0.5rem;">
                        <a href="{{ route('home') }}#faq"
                            class="nav-link d-flex align-items-center gap-3 py-3 px-3 rounded primary-color"
                            style="font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px;">
                            <x-icon type="question-circle" style="width: 18px; height: 18px;" />
                            <span>FAQs</span>
                        </a>
                    </li>
                @elseif (Auth::user()->role == 2)
                    <li class="nav-item">
                        <a href="{{ route('as.dashboard.index') }}"
                            class="nav-link d-flex align-items-center gap-3 py-3 px-3 rounded {{ str_contains(Route::currentRouteName(), 'as.dashboard.index') == true ? 'text-white bg-primary-color' : 'primary-color' }}"
                            style="font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px;">
                            <x-icon type="dashboard" style="width: 18px; height: 18px;" />
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('staff.citizen.index') }}"
                            class="nav-link d-flex align-items-center gap-3 py-3 px-3 rounded {{ str_contains(Route::currentRouteName(), 'staff.citizen') == true ? 'text-white bg-primary-color' : 'primary-color' }}"
                            style="font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px;">
                            <x-icon type="users" style="width: 18px; height: 18px;" />
                            <span>Citizens</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('request-documents-layouts') }}"
                            class="nav-link d-flex align-items-center gap-3 py-3 px-3 rounded {{ str_contains(Route::currentRouteName(), 'request') == true ? 'text-white bg-primary-color' : 'primary-color' }}"
                            style="font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px;">
                            <x-icon type="file" style="width: 18px; height: 18px;" />
                            <span>Request Documents</span>
                        </a>
                    </li>

                    {{-- FAQ Link for Staff --}}
                    <li class="nav-item mt-2" style="border-top: 1px solid rgba(0,0,0,0.1); padding-top: 0.5rem;">
                        <a href="{{ route('home') }}#faq"
                            class="nav-link d-flex align-items-center gap-3 py-3 px-3 rounded primary-color"
                            style="font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px;">
                            <x-icon type="question-circle" style="width: 18px; height: 18px;" />
                            <span>FAQs</span>
                        </a>
                    </li>
                @elseif(Auth::user()->role == 3)
                    <li class="nav-item">
                        <a href="{{ route('dashboard.index') }}"
                            class="nav-link d-flex align-items-center gap-3 py-3 px-3 rounded {{ str_contains(Route::currentRouteName(), 'dashboard.index') == true ? 'text-white bg-primary-color' : 'primary-color' }}"
                            style="font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px;">
                            <x-icon type="dashboard" style="width: 18px; height: 18px;" />
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('request-documents-layouts') }}"
                            class="nav-link d-flex align-items-center gap-3 py-3 px-3 rounded {{ str_contains(Route::currentRouteName(), 'request') == true ? 'text-white bg-primary-color' : 'primary-color' }}"
                            style="font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px;">
                            <x-icon type="file" style="width: 18px; height: 18px;" />
                            <span>Request Documents</span>
                        </a>
                    </li>

                    {{-- FAQ Link for Resident --}}
                    <li class="nav-item mt-2" style="border-top: 1px solid rgba(0,0,0,0.1); padding-top: 0.5rem;">
                        <a href="{{ route('home') }}#faq"
                            class="nav-link d-flex align-items-center gap-3 py-3 px-3 rounded primary-color"
                            style="font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px;">
                            <x-icon type="question-circle" style="width: 18px; height: 18px;" />
                            <span>FAQs</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role == 1 || Auth::user()->role == 2)
                    {{-- upload important files --}}
                    <li class="nav-item">
                        <a href="{{ route('important-files.index') }}"
                            class="nav-link d-flex align-items-center gap-3 py-3 px-3 rounded {{ str_contains(Route::currentRouteName(), 'important-files') == true ? 'text-white bg-primary-color' : 'primary-color' }}"
                            style="font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px;">
                            <x-icon type="file" style="width: 18px; height: 18px;" />
                            <span>Important Files</span>
                        </a>
                    </li>
                    {{-- announcements --}}
                    <li class="nav-item">
                        <a href="{{ route('announcements.index') }}"
                            class="nav-link d-flex align-items-center gap-3 py-3 px-3 rounded {{ str_contains(Route::currentRouteName(), 'announcements') == true ? 'text-white bg-primary-color' : 'primary-color' }}"
                            style="font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px;">
                            <x-icon type="bell" style="width: 18px; height: 18px;" />
                            <span>Announcements</span>
                        </a>
                    </li>
                    {{-- senior citizen records --}}
                    <li class="nav-item">
                        <a href="{{ route('senior-citizen.records.index') }}"
                            class="nav-link d-flex align-items-center gap-3 py-3 px-3 rounded {{ str_contains(Route::currentRouteName(), 'senior-citizen.records') == true ? 'text-white bg-primary-color' : 'primary-color' }}"
                            style="font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px;">
                            <x-icon type="users" style="width: 18px; height: 18px;" />
                            <span>Senior Citizens</span>
                        </a>
                    </li>
                @endif

                {{-- Logout --}}
                <li class="nav-item mt-4 pt-3" style="border-top: 1px solid rgba(0,0,0,0.1);">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="nav-link d-flex align-items-center gap-3 py-3 px-3 rounded w-100 border-0 bg-transparent primary-color"
                            style="font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px; text-align: left;">
                            <x-icon type="sign-out" style="width: 18px; height: 18px;" />
                            <span>Logout</span>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>
    @endauth

    {{-- Sidebar Footer --}}
    <div class="position-absolute bottom-0 start-0 end-0 p-3 border-top" style="border-color: rgba(0,0,0,0.1) !important;">
        <small class="text-muted d-block text-center" style="font-size: 0.7rem;">
            © {{ date('Y') }} Barangay Tigbao
        </small>
    </div>
</aside>

<style>
    /* Sidebar scrollbar styling */
    aside::-webkit-scrollbar {
        width: 4px;
    }

    aside::-webkit-scrollbar-track {
        background: rgba(0,0,0,0.05);
    }

    aside::-webkit-scrollbar-thumb {
        background: rgba(var(--primary-color-rgb), 0.3);
        border-radius: 2px;
    }

    aside::-webkit-scrollbar-thumb:hover {
        background: rgba(var(--primary-color-rgb), 0.5);
    }

    /* Active state transition */
    .nav-link {
        transition: all 0.2s ease;
    }

    .nav-link:hover {
        background: rgba(var(--primary-color-rgb), 0.1) !important;
        transform: translateX(3px);
    }

    .nav-link.bg-primary-color:hover {
        background: var(--primary-color) !important;
        opacity: 0.9;
    }

    /* Badge styling */
    .badge {
        font-weight: 600;
    }
</style>
