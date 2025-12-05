<x-auth-layout title="Edit - Senior Citizen Records">
    <div class="container mx-auto p-0 m-0">
<<<<<<< HEAD

=======
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
        <div class="card shadow-lg rounded-0">
            <div class="card-header">
                <h5 class="m-0 primary-color">
                    <x-icon type="pencil" />
                    Edit Senior Citizen Records
                </h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center">
<<<<<<< HEAD
                    <form action="{{ route('senior-citizen.records.update', ['record' => urlencode($id)]) }}" method="POST" class="w-100" style="max-width: 600px;">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="fw-medium primary-color">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Full name" value="{{ $data->name }}">
                            @error('name')
                                <small class="fw-medium text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="bdate" class="fw-medium primary-color">Birth Date</label>
                            <input type="date" name="bdate" id="bdate" class="form-control" value="{{ Carbon\Carbon::parse($data->bdate)->format('Y-m-d') }}">
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
                                Update
=======
                    <form action="{{ route('senior-citizen.records.update', ['record' => urlencode($id)]) }}"
                          method="POST" enctype="multipart/form-data"
                          class="w-100" style="max-width: 600px;">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="first_name" class="fw-medium primary-color">First Name</label>
                            <input type="text" name="first_name" id="first_name"
                                   class="form-control" value="{{ $data->first_name }}">
                            @error('first_name')
                                <small class="fw-medium text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="middle_name" class="fw-medium primary-color">Middle Name (Optional)</label>
                            <input type="text" name="middle_name" id="middle_name"
                                   class="form-control" value="{{ $data->middle_name }}">
                            @error('middle_name')
                                <small class="fw-medium text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="fw-medium primary-color">Last Name</label>
                            <input type="text" name="last_name" id="last_name"
                                   class="form-control" value="{{ $data->last_name }}">
                            @error('last_name')
                                <small class="fw-medium text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="fw-medium primary-color">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="Male" {{ $data->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $data->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')
                                <small class="fw-medium text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bdate" class="fw-medium primary-color">Birth Date</label>
                            <input type="date" name="bdate" id="bdate" class="form-control"
                                   value="{{ \Carbon\Carbon::parse($data->bdate)->format('Y-m-d') }}">
                            @error('bdate')
                                <small class="fw-medium text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="death_certificate" class="fw-medium primary-color">Death Certificate (Optional)</label>
                            <input type="file" name="death_certificate" id="death_certificate"
                                   class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            @if ($data->death_certificate)
                                <small class="d-block mt-1">
                                    Current file:
                                    <a href="{{ asset('storage/' . $data->death_certificate) }}" target="_blank">
                                        View Certificate
                                    </a>
                                </small>
                            @endif
                            @error('death_certificate')
                                <small class="fw-medium text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2">
                            <a href="{{ route('senior-citizen.records.index') }}" class="btn btn-sm bg-primary-color">
                                <x-icon type="arrow-left" /> Cancel
                            </a>
                            <button class="btn btn-sm bg-primary-color" type="submit">
                                <x-icon type="check" /> Update
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-auth-layout>
