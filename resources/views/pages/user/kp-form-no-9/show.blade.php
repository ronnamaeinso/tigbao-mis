<x-auth-layout title="View Request Summon">
    <section class="container mt-3 p-0">
        {{-- card --}}
        <x-card>

            {{-- card header --}}
            <x-slot name="cardheader">
                <div class="d-flex align-items-center gap-2">
                    <x-icon type="note-sticky primary-color" />
                    <h5 class="m-0 primary-color">View Summon Request</h5>
                </div>
            </x-slot>

            {{-- card-body --}}
            <div class="table-responsive p-3">
                <table class="table table-sm" style="width: fit-content; border: none;">
                    <tr>
                        <td class="border-0 pb-2">
                            <x-icon type="user primary-color" />
                            <span class="font-medium primary-color">(Mga) Nagsumbong:</span>
                        </td>
                        <td class="border-0 pb-2">
                            <span class="text-secondary">{{$data->mga_nagsumbong}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-0 pb-2">
                            <x-icon type="user primary-color" />
                            <span class="font-medium primary-color">(Mga) Gisumbong:</span>
                        </td>
                        <td class="border-0 pb-2">
                            <span class="text-secondary">{{$data->mga_gisumbong}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-0 pb-2">
                            <x-icon type="scale-balanced primary-color" />
                            <span class="font-medium primary-color">Kaso sa Barangay isip:</span>
                        </td>
                        <td class="border-0 pb-2">
                            <span class="text-secondary">{{$data->kaso_sa_brgy_isip}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-0 pb-2">
                            <x-icon type="book-open primary-color" />
                            <span class="font-medium primary-color">Bahin sa:</span>
                        </td>
                        <td class="border-0 pb-2">
                            <span class="text-secondary">{{$data->bahin_sa}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-0 pb-2">
                            <x-icon type="calendar-days primary-color" />
                            <span class="font-medium primary-color">Petsa:</span>
                        </td>
                        <td class="border-0 pb-2">
                            <span class="text-secondary">{{$data->petsa->format('F j, Y @ H:i A')}}</span>
                        </td>
                    </tr>

                </table>
            </div>

            {{-- back to index --}}
            <div class="flex justify-end p-3">
                <a href="{{route('request.documents.kp-form-no-9.index')}}" class="btn btn-sm bg-primary-color">
                    <x-icon type="arrow-left" />
                    Back
                </a>
            </div>
        </x-card>
    </section>
</x-auth-layout>