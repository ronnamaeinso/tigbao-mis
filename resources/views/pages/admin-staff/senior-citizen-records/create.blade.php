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
                    <form action="{{ route('senior-citizen.records.store') }}" method="POST"
                          class="w-100" style="max-width: 600px;">
                        @csrf

                        <div class="mb-3">
                            <label for="first_name" class="fw-medium primary-color">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control"
                                   value="{{ old('first_name') }}" placeholder="First name">
                            @error('first_name')
                                <small class="fw-medium text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="middle_name" class="fw-medium primary-color">Middle Name (Optional)</label>
                            <input type="text" name="middle_name" id="middle_name" class="form-control"
                                   value="{{ old('middle_name') }}" placeholder="Middle name">
                            @error('middle_name')
                                <small class="fw-medium text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="fw-medium primary-color">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control"
                                   value="{{ old('last_name') }}" placeholder="Last name">
                            @error('last_name')
                                <small class="fw-medium text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="fw-medium primary-color">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select Gender</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')
                                <small class="fw-medium text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bdate" class="fw-medium primary-color">Birth Date</label>
                            <input type="date" name="bdate" id="bdate" class="form-control"
                                   value="{{ old('bdate') }}">
                            @error('bdate')
                                <small class="fw-medium text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2">
                            <a href="{{ route('senior-citizen.records.index') }}" class="btn btn-sm bg-primary-color">
                                <x-icon type="arrow-left" /> Cancel
                            </a>
                            <button class="btn btn-sm bg-primary-color" type="submit">
                                <x-icon type="check" /> Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-auth-layout>
