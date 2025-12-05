<x-auth-layout title="Register - Senior Citizen Records">
    <div class="container mx-auto p-0 m-0">
        <div class="card shadow-lg rounded-0">
            <div class="card-header">
                <h5 class="m-0 primary-color">
                    <x-icon type="user-plus" />
                    Register Senior Citizen Records
                </h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <form action="{{ route('senior-citizen.records.store') }}" method="POST" class="w-100" style="max-width: 600px;">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="fw-medium primary-color">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Full name" value="{{ old('name') }}">
                            @error('name')
                                <small class="fw-medium text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="bdate" class="fw-medium primary-color">Birth Date</label>
                            <input type="date" name="bdate" id="bdate" class="form-control" value="{{ old('bdate') }}">
                            @error('bdate')
                                <small class="fw-medium text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="d-flex align-items-center justify-content-end gap-2">
                            <a href="{{ route('senior-citizen.records.index') }}" class="btn btn-sm bg-primary-color">
                                <x-icon type="arrow-left"/>
                                Cancel
                            </a>
                            <button class="btn btn-sm bg-primary-color" type="submit">
                                <x-icon type="check"/>
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-auth-layout>
