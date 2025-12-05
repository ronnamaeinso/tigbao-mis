<x-auth-layout title="Certificate of Indigency - Create">

    <section class="container mt-4">
        {{-- request --}}
        <a href="{{route('request.certificate-of-indigency.index')}}" class="btn btn-sm bg-primary-color">
            <x-icon type="arrow-left" />
            Back
        </a>

        {{-- create fomm --}}
        <div class="card mt-4 shadow-lg bg-white">
            <div class="card-header">
                <h5 class="m-0 primary-color">
                    <x-icon type="file"/>
                    Certificate of Indigency Request Form
                </h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    {{-- form --}}
                    <form action="{{ route('request.certificate-of-indigency.store') }}" method="POST" class="w-100" style="max-width: 500px;">
                        @csrf

                        <input type="text" name="fullname" id="fullname" placeholder="Full name" class="form-control" value="{{ old('fullname') }}">

                        @error('fullname')
                            <small class="text-danger fw-medium">{{$message}}</small>
                        @enderror

                        <div class="d-flex justify-content-end">
                            <button class="btn btn-sm bg-primary-color mt-3" type="submit">
                                <x-icon type="check"/>
                                Submit
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
</x-auth-layout>
