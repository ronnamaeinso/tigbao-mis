<x-auth-layout title="Edit Request Summons">
    <section class="container mt-3 p-0">

        {{-- card --}}
        <x-card class="m-auto" style="width: 90%;">

            {{-- card header --}}
            <x-slot name="cardheader">
                <div class="d-flex align-items-center gap-2">
                    <x-icon type="pencil primary-color" />
                    <h5 class="m-0 primary-color">Edit Summon Request</h5>
                </div>
            </x-slot>

            {{-- card-body --}}
            <div class="p-3 overflow-auto">
                <x-form id="update-summon-request" data-id="{{$data->encrypted_id}}">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="block space-y-2 mb-3">
                                <label for="mga-nagsumbong" class="font-medium primary-color">(Mga) Nagsumbong</label>
                                <textarea name="mga_nagsumbong" id="mga-nagsumbong" class="form-control"
                                placeholder="mga nagsumbong">{{$data->mga_nagsumbong}}</textarea>
                                <small class="text-red-500 font-medium mga_nagsumbong small-error-container"></small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="block space-y-2 mb-3">
                                <label for="kaso-sa-brgy-isip" class="font-medium primary-color">Kaso sa Barangay isip:
                                </label>
                                <textarea name="kaso-sa-brgy-isip" id="kaso-sa-brgy-isip" class="form-control"
                                    placeholder="kaso sa brgy">{{$data->kaso_sa_brgy_isip}}</textarea>
                                <small class="text-red-500 font-medium kaso-sa-brgy-isip small-error-container"></small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="block space-y-2 mb-3">
                                <label for="mga-sinumbong" class="font-medium primary-color">(Mga) Sinumbong: </label>
                                <textarea name="mga_sinumbong" id="mga-sinumbong" class="form-control"
                                placeholder="mga sinumbong">{{$data->mga_gisumbong}}</textarea>
                                <small class="text-red-500 font-medium mga_sinumbong small-error-container"></small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="block space-y-2 mb-3">
                                <label for="bahin-sa" class="font-medium primary-color">Bahin sa : </label>
                                <textarea name="bahin-sa" id="bahin-sa" class="form-control"
                                placeholder="bahin sa">{{$data->bahin_sa}}</textarea>
                                <small class="text-red-500 font-medium bahin-sa small-error-container"></small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="block space-y-2 mb-3">
                                <label for="petsa" class="font-medium primary-color">Petsa : </label>
                                <x-input type="datetime-local" name="petsa" :is-required="false" value="{{$data->petsa->format('Y-m-d H:i:s')}}"/>
                                <small class="text-red-500 font-medium petsa small-error-container"></small>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2">
                        {{-- redirect to index --}}
                        <a href="{{route('request.documents.kp-form-no-9.index')}}" class="btn btn-sm bg-primary-color">
                            <x-icon type="arrow-left" />
                            Back
                        </a>

                        {{-- submit btn --}}
                        <x-button type="submit" class="btn-sm bg-primary-color">
                            <x-icon type="check" />
                            Update
                        </x-button>
                    </div>
                </x-form>
            </div>
        </x-card>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            // initialized update request
            update();
        });

        /**
         * @function update
         * this update the request
         * @response.status == 422 - payload warning/error
         * @response.status == 500 - server error
         * @response.status == 200 - Successfully updated
         * @function clearError - clear textContent of the error small
         */
        const update = ()=>{
            const form = document.getElementById('update-summon-request');

            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                try {
                    clearError();

                    const id = form.dataset.id;
                    const data = Object.fromEntries(new FormData(form));
                    const url = `/request/documents/kp-form-no-9/${encodeURIComponent(id)}`;
                    const response = await fetch(url, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': window.token,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(data)
                    });

                    if (response.status == 422) {
                        const json_response = await response.json();

                        for (const [key, value] of Object.entries(json_response.errors)) {
                            document.querySelector(`.${key}`).textContent = value.join(', ');
                            console.log(value.join(', '));

                        }

                        return;
                    }

                    else if (response.status == 500) {
                        throw new Error("Server Error");
                    }

                    else if (response.status == 200) {
                        Swal.fire({
                            title: 'Success',
                            icon: 'success',
                            text: 'Successfully Updated Request'
                        });
                    }

                    else{
                        throw new Error(response.status);
                    }

                } catch (error) {
                    console.error(error.message);
                    Swal.fire({
                        title: 'Server Error',
                        icon: 'error',
                        text: 'Something went wrong, Pls contact developer'
                    });
                }
            });
        }

        /**
         * @function clearError
         *
         */
        const clearError = ()=>{
            const error_containers = document.querySelectorAll('.small-error-container');

            error_containers.forEach(item => {
                item.textContent = '';
            });
        }
    </script>
</x-auth-layout>