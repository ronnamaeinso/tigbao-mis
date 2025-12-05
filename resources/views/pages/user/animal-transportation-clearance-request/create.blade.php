<x-auth-layout title="Request For Certificate of Animal Transportation Clearance">
    <section class="container mx-auto m-0 p-0">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="m-0 primary-color">
                    <x-icon type="plus" />
                    Request Certificate of Animal transportation Clearance
                </h5>
            </div>
            <div class="card-body">
                {{-- form --}}
                <form action="{{ route('animal-transportation-clearance.request.store') }}" class="p-3 mx-auto" method="POST" style="width: 600px;">
                    @csrf

                    {{-- requestor name --}}
                    <div class="mb-3">
                        <label for="name" class="fw-medium primary-color mb-1">
                            <x-icon type="user" />
                            Requestor Name
                        </label>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Requestor Full Name" value="{{old('name')}}">
                        @error('name')
                            <small class="fw-medium text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    {{-- animal type --}}
                    <div class="mb-3">
                        <label for="animal_type" class="fw-medium primary-color mb-1">
                            <x-icon type="dog" />
                            Animal Type
                        </label>
                        <input type="text" name="animal_type" id="animal_type" class="form-control"
                            placeholder="Animal Type" value="{{old('animal_type')}}">
                        @error('animal_type')
                            <small class="fw-medium text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    {{-- animal name --}}
                    <div class="mb-3">
                        <label for="animal_name" class="fw-medium primary-color mb-1">
                            <x-icon type="dog" />
                            Animal Name
                        </label>
                        <input type="text" name="animal_name" id="animal_name" class="form-control"
                            placeholder="Animal Name" value="{{old('animal_name')}}">
                        @error('animal_name')
                            <small class="fw-medium text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    {{-- animal age --}}
                    <div class="mb-3">
                        <label for="animal_age" class="fw-medium primary-color mb-1">
                            <x-icon type="dog" />
                            Animal Age
                        </label>
                        <input type="number" name="animal_age" id="animal_age" class="form-control"
                            placeholder="Animal Age" value="{{old('animal_age')}}">
                        @error('animal_age')
                            <small class="fw-medium text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    {{-- location --}}
                    <div class="mb-3">
                        <label for="location" class="fw-medium primary-color mb-1">
                            <x-icon type="location-pin" />
                            Location
                        </label>
                        <input type="text" name="location" id="location" class="form-control"
                            placeholder="Location">
                        @error('location')
                            <small class="fw-medium text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    {{-- btn cancel and submit --}}
                    <div class="d-flex align-items justify-content-end gap-2">
                        <a href="{{route('animal-transportation-clearance.request.index')}}" class="btn btn-sm bg-primary-color">
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
