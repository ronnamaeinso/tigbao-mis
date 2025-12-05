<x-auth-layout title="View - Animal Transportation Clearance Request">
    <section class="container mx-auto m-0 p-0">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="m-0 primary-color">
                    <x-icon type="plus" />
                    Animal transportation Clearance Details
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row row-gap-3">
                    <div class="col-12">
                        <div class="">
                            <span class="fw-medium primary-color">
                                <x-icon type="user" />
                                Requestor Name:
                            </span>
                            <span>{{ $data->name }}</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="">
                            <span class="fw-medium primary-color">
                                <x-icon type="dog" />
                                Animal Type:
                            </span>
                            <span>{{ $data->animal_type }}</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="">
                            <span class="fw-medium primary-color">
                                <x-icon type="dog" />
                                Animal Name:
                            </span>
                            <span>{{ $data->animal_name }}</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="">
                            <span class="fw-medium primary-color">
                                <x-icon type="dog" />
                                Animal Age:
                            </span>
                            <span>{{ $data->animal_age }}</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="">
                            <span class="fw-medium primary-color">
                                <x-icon type="location-pin" />
                                Location:
                            </span>
                            <span>{{ $data->location }}</span>
                        </div>
                    </div>
                </div>

                {{-- redirect back --}}
                <div class="d-flex justify-content-end mt-3">
                    <a href="{{route('animal-transportation-clearance.request.index')}}" class="btn btn-sm bg-primary-color">
                        <x-icon type="arrow-left"/>
                        Back
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-auth-layout>
