<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'App' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="light ">
    <main class="">
        <div class="d-flex position-relative" style="position: relative;">
            {{-- side bar --}}
            <x-side-bar />

            {{-- header and main content --}}
            <div class="d-flex flex-column w-100">
                {{-- header --}}
                <header class="shadow w-100" style="">
                    {{ $header ?? '' }}
                </header>
                @auth
                    @if ((Auth::user()->role == 1) | (Auth::user()->role == 2))
                        {{-- toggler file --}}
                        <section class="container mx-auto p-0 m-0 position-relative mt-4 px-2">
                            <div class="d-flex justify-content-end">
                                <div class="dropdown w-100 d-flex justify-content-end" style="max-width: 700px;">
                                    {{-- toggler --}}
                                    <button class="btn border-0 bg-transparent p-0" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <x-icon type="folder-open primary-color" style="font-size: 2em;" />
                                    </button>

                                    {{-- menu --}}
                                    <ul class="dropdown-menu w-100">
                                        <li class="dropdown-item">
                                            <div class="row g-3">
                                                @foreach (App\Models\Folder::getAllFolders() as $item)
                                                    <div class="col-sm-4">
                                                        <a href="{{ route('important-files.show', ['important_file' => Illuminate\Support\Facades\Crypt::encrypt($item->id)]) }}"
                                                            class="nav-link">
                                                            <x-icon type="folder primary-color" />
                                                            {{ $item->name }}
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </section>
                    @endif
                @endauth

                @guest
                    <div class="w-100 p-0">
                        {{-- guest --}}
                        {{ $guestlayout ?? '' }}
                    </div>
                @endguest

                @auth
                    <div class="w-100 p-3">
                        {{-- auth --}}
                        {{ $authlayout ?? '' }}
                    </div>
                @endauth
            </div>
        </div>
    </main>

    <footer>
        {{ $footer ?? '' }}
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                window.Swal.fire({
                    title: "Success",
                    icon: 'success',
                    text: `{{ session('success') }}`
                });
            @endif

            @if (session('error'))
                window.Swal.fire({
                    title: "Error",
                    icon: 'error',
                    text: `{{ session('error') }}`
                });
            @endif

            @if (session('warning'))
                window.Swal.fire({
                    title: "Warning",
                    icon: 'warning',
                    text: `{{ session('warning') }}`
                });
            @endif
        });
    </script>
</body>

</html>
