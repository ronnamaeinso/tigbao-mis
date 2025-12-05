<x-auth-layout title="View KP Form No.9 (Summons)">
    <div class="container mt-4 p-0">
        <x-card class="mx-4 m-sm-0">

            {{-- card header --}}
            <x-slot name="cardheader">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <x-icon type="file primary-color" />
                        <div class="h5 card-title m-0 primary-color">KP Form No. Summon Request Details</div>
                    </div>

                    {{-- back to index --}}
                    <a href="{{ route('summons.index') }}" class="btn btn-sm bg-primary-color">
                        <x-icon type="arrow-left" />
                        back
                    </a>

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
                            <span class="text-secondary">{{ $data->mga_nagsumbong }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-0 pb-2">
                            <x-icon type="user primary-color" />
                            <span class="font-medium primary-color">(Mga) Gisumbong:</span>
                        </td>
                        <td class="border-0 pb-2">
                            <span class="text-secondary">{{ $data->mga_gisumbong }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-0 pb-2">
                            <x-icon type="scale-balanced primary-color" />
                            <span class="font-medium primary-color">Kaso sa Barangay isip:</span>
                        </td>
                        <td class="border-0 pb-2">
                            <span class="text-secondary">{{ $data->kaso_sa_brgy_isip }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-0 pb-2">
                            <x-icon type="book-open primary-color" />
                            <span class="font-medium primary-color">Bahin sa:</span>
                        </td>
                        <td class="border-0 pb-2">
                            <span class="text-secondary">{{ $data->bahin_sa }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-0 pb-2">
                            <x-icon type="calendar-days primary-color" />
                            <span class="font-medium primary-color">Petsa:</span>
                        </td>
                        <td class="border-0 pb-2">
                            <span class="text-secondary">{{ $data->petsa->format('F j, Y @ H:i A') }}</span>
                        </td>
                    </tr>

                </table>
            </div>

            {{-- reject/approve btn wrapper --}}
            <div class="d-flex align-items-center gap-2 p-3 pt-0">

                {{-- approve btn --}}
                <x-button class="btn-sm bg-primary-color" id="approve-btn" data-id="{{ $data->encypted_id }}">
                    <x-icon type="check" />
                    Approve
                </x-button>

                {{-- reject btn --}}
                <x-button class="btn-sm bg-primary-color" id="reject-btn" data-bs-toggle="modal" data-bs-target="#modal-reject-comments">
                    <x-icon type="x" />
                    Reject
                </x-button>

            </div>
        </x-card>
    </div>

    {{-- reject comment modal --}}
    <div class="modal" aria-hidden="true" tabindex="-1" id="modal-reject-comments">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <h3 class="primary-color m-0">
                            <x-icon type="comments "/>
                            Reject Comments
                        </h3>
                        {{-- dismiss modal --}}
                        <button class="btn btn-close" data-bs-dismiss="modal"></button>
                    </div>
                </div>
                <div class="modal-body">

                    {{-- form reject comments --}}
                    <x-form action="" id="form-reject-comment" data-id="{{ $data->encypted_id }}">

                        {{-- input --}}
                        <textarea name="comments" id="comments" class="form-control mb-3 h-[150px]" placeholder="Your Reject Comment here" required></textarea>

                        {{-- submit btn --}}
                        <div class="d-flex justify-content-end align-items-center gap-2">
                            <button class="btn btn-sm bg-primary-color" type="submit" id="reject-btn-comment">
                                <x-icon type="check"/>
                                Submit
                            </button>
                            <button class="btn btn-sm bg-primary-color" type="button" data-bs-dismiss="modal">
                                <x-icon type="arrow-left"/>
                                Cancel
                            </button>
                        </div>
                    </x-form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // init approve btn
            approveSummonRequest();

            // init reject btn
            rejectSummonRequest();
        });

        /**
         * Approve a summon request
         *
         * Get approve btn
         * add event click
         * disabled btn if click
         * display confirmation if confirmed then
         * perform put request
         * if status is 500 throw new Error
         * else show success alert and enable btn again
         *
         * @returns void
         */
        const approveSummonRequest = () => {
            const approve_btn = document.getElementById('approve-btn');

            approve_btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                const id = e.target.dataset.id;

                const btn = e.target;

                btn.disabled = true;

                // confirmation
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Approve it!"
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        try {
                            const url = `/summons/${encodeURIComponent(id)}/approve`;
                            const response = await fetch(url, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': window.token
                                }
                            });

                            if (response.status == 500) throw new Error("Server Error");

                            Swal.fire({
                                title: 'Success',
                                icon: 'success',
                                text: 'Successfully Approved Request'
                            }).then(()=>{
                                btn.disabled = false;
                                window.location.href = `{{route('summons.index')}}`;
                            });


                        } catch (error) {
                            Swal.fire({
                                title: 'Error',
                                icon: 'error',
                                text: 'Something went wrong, Pls contact developer'
                            }).then(() => {
                                console.error(error);
                                btn.disabled = true;
                            });
                        }
                    }
                });
            });
        }

        /**
         * Reject summon request
         *
         * get reject button and form for reject comment, add submit event to the form,
         * disabled submit btn upon submitting, show confirmation modal if confirmed
         * then reject initialized (PUT request) else cancel rejection
         */
        const rejectSummonRequest = ()=>{
            const reject_btn = document.getElementById('reject-btn-comment');
            const form = document.getElementById('form-reject-comment');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                const id = e.target.dataset.id;

                reject_btn.disabled = true;

                // confirmation
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Reject it!"
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        try {
                            const url = `/summons/${encodeURIComponent(id)}/reject`;
                            const response = await fetch(url, {
                                method: 'PUT',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': window.token,
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify(Object.fromEntries(new FormData(form)))
                            });

                            if (response.status == 500) throw new Error("Server Error");

                            Swal.fire({
                                title: 'Success',
                                icon: 'success',
                                text: 'Successfully Rejected Request'
                            }).then(()=>{
                                reject_btn.disabled = false;
                                window.location.href = `{{route('summons.index')}}`;
                            });


                        } catch (error) {
                            Swal.fire({
                                title: 'Error',
                                icon: 'error',
                                text: 'Something went wrong, Pls contact developer'
                            }).then(() => {
                                console.error(error);
                                reject_btn.disabled = false;
                            });
                        }
                    }

                    reject_btn.disabled = false;
                });
            });
        }
    </script>
</x-auth-layout>
