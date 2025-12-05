<x-auth-layout title="Citizen's Profile">
    <section class="container p-4">
        {{-- redirect back --}}
        <a href="{{route('staff.citizen.index')}}" class="btn btn-sm bg-primary-color mb-3">Go Back</a>

        {{-- citizens --}}
        <x-card style="">
            {{-- card header --}}
            <x-slot name="cardheader">
                <div class="d-flex align-items-center gap-2">
                    <x-icon type="users primary-color" />
                    <h5 class="m-0 primary-color">Citizen' s Profile</h5>
                </div>
            </x-slot>

            <div class="row row-gap-3">
                <div class="col-sm-6">
                    <div class="d-flex align-items-center gap-2">
                        <span class="fw-bold primary-color">Name: </span>
                        <small class="text-secondary m-0">{{$citizen->name}}</small>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center gap-2">
                        <span class="fw-bold primary-color">Birth Date: </span>
                        <small class="text-secondary m-0">{{Carbon\Carbon::parse($citizen->bdate)->format('F j,
                            Y')}}</small>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center gap-2">
                        <span class="fw-bold primary-color">Birth Place: </span>
                        <small class="text-secondary m-0">{{$citizen->bplace}}</small>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center gap-2">
                        <span class="fw-bold primary-color">Sex: </span>
                        <small class="text-secondary m-0">{{$citizen->sex == 1 ? 'Male' : 'Female'}}</small>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center gap-2">
                        <span class="fw-bold primary-color">Address: </span>
                        <small class="text-secondary m-0">{{$citizen->address}}</small>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center gap-2">
                        <span class="fw-bold primary-color">Contact Number: </span>
                        <small class="text-secondary m-0">{{$citizen->contact_number}}</small>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center gap-2">
                        <span class="fw-bold primary-color">Email Address: </span>
                        <small class="text-secondary m-0">{{$citizen->email}}</small>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex flex-column gap-2">
                        <span class="fw-bold primary-color">ID ({{$citizen->formated_id}}): </span>
                        <img src="{{route('view-file', ['path' => urlencode($citizen->id_picture)])}}" alt="id picture"
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </x-card>
    </section>
</x-auth-layout>