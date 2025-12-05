<x-auth-layout title="Certificate of Residency">
    <section class="container mx-auto m-0 p-0">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="m-0 primary-color">
                    <x-icon type="plus" />
                    Request Certificate of Residency
                </h5>
            </div>
            <div class="card-body">
                {{-- form --}}
                <form action="{{ route('certificate-of-residency-request.store') }}" class="p-3" method="POST">
                    @csrf

                    {{-- input --}}
                    <div class="mb-3">
                        <label for="name" class="fw-medium primary-color mb-1">
                            <x-icon type="user" />
                            Name
                        </label>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Full Name">
                        @error('name')
                            <small class="fw-medium text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    {{-- btn cancel and submit --}}
                    <div class="d-flex align-items justify-content-end gap-2">
                        <a href="{{ route('certificate-of-residency-request.index') }}" class="btn btn-sm bg-primary-color">
                            <x-icon type="arrow-left" />
                            Cancel
                        </a>
                        <button class="btn btn-sm bg-primary-color">
                            <x-icon type="check" />
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-auth-layout>
