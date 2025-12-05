<x-auth-layout title="Request For Barangay Clear - Building Permit">

    <section class="container mx-auto m-0 p-0">

        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="m-0 primary-color">
                        <x-icon type="file" />
                        Request for Barangay Clearance - Building Permit
                    </h5>

                </div>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center">

                    {{-- form create request --}}
                    <form action="{{route('barangay-clearance.building-permit.request.store')}}" method="POST" class="w-100" style="max-width: 600px;">
                        @csrf
                        {{-- name input --}}
                        <div class="mb-3">
                            <label for="name">
                                <x-icon type="user"/>
                                Full Name
                            </label>
                            <input type="text" name="name" id="name" class="form-control">

                            {{-- error --}}
                            @error('name')
                                <small class="text-danger fw-medium">{{$message}}</small>
                            @enderror
                        </div>

                        {{-- submit --}}
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{route('barangay-clearance.building-permit.request.index')}}" class="btn btn-sm bg-primary-color">
                                <x-icon type="arrow-left"/>
                                Back
                            </a>
                            <button class="btn btn-sm bg-primary-color">
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
