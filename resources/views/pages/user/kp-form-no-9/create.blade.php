<x-auth-layout title="Request Documents - KP Form No. 9 (Summon) - Create">
    <section class="container mt-4">
        <x-card>
            <x-slot name="cardheader">
                <div class="d-flex align-items-center gap-1">
                    <x-icon type="file primary-color" />
                    <h5 class="m-0 primary-color">Request KP Form No.9</h5>
                </div>
            </x-slot>
            {{-- form request kp form no.9 --}}
            <x-form id="request-form">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="block space-y-2 mb-3">
                            <label for="mga-nagsumbong" class="font-medium primary-color">(Mga) Nagsumbong</label>
                            <textarea name="mga_nagsumbong" id="mga-nagsumbong" class="form-control" placeholder="mga nagsumbong"></textarea>
                            <small class="text-red-500 font-medium mga_nagsumbong error_wrapper"></small>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="block space-y-2 mb-3">
                            <label for="kaso-sa-brgy-isip" class="font-medium primary-color">Kaso sa Barangay isip: </label>
                            <textarea name="kaso-sa-brgy-isip" id="kaso-sa-brgy-isip" class="form-control" placeholder="kaso sa brgy"></textarea>
                            <small class="text-red-500 font-medium kaso-sa-brgy-isip error_wrapper"></small>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="block space-y-2 mb-3">
                            <label for="mga-sinumbong" class="font-medium primary-color">(Mga) Sinumbong: </label>
                            <textarea name="mga_sinumbong" id="mga-sinumbong" class="form-control" placeholder="mga sinumbong"></textarea>
                            <small class="text-red-500 font-medium mga_sinumbong error_wrapper"></small>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="block space-y-2 mb-3">
                            <label for="bahin-sa" class="font-medium primary-color">Bahin sa : </label>
                            <textarea name="bahin-sa" id="bahin-sa" class="form-control" placeholder="bahin sa"></textarea>
                            <small class="text-red-500 font-medium bahin-sa error_wrapper"></small>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="block space-y-2 mb-3">
                            <label for="petsa" class="font-medium primary-color">Petsa : </label>
                            <x-input type="datetime-local" name="petsa" min="{{Carbon\Carbon::now()}}" :is-required="false"/>
                            <small class="text-red-500 font-medium petsa error_wrapper"></small>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-2">
                    {{-- redirect to index --}}
                    <a href="{{route('request.documents.kp-form-no-9.index')}}" class="btn btn-sm bg-primary-color">
                        <x-icon type="arrow-left"/>
                        Back
                    </a>

                    {{-- submit btn --}}
                    <x-button class="btn-sm bg-primary-color" id="submit-btn">
                        <x-icon type="check"/>
                        Submit
                    </x-button>
                </div>
            </x-form>
        </x-card>
    </section>

    {{-- script --}}
    <script>
        /**
         * When the DOM loaded load the functions
         *
         * Functions:
         *
         * @function store()
         */
        document.addEventListener('DOMContentLoaded', function(){
            store();
        });

        /**
         * This process the submission of summon request
         *
         * Get form and submit button,
         * add form event listener with async fun in its callback,
         * prevent default behavior and send post request
         * disabled submit btn, send post request,
         * if else condtion the response.status, enabled submit btn and returns a specific throw, response
         *
         * $throws {Object} JSON error response from the server
         * @returns {void}
         */
        const store = ()=>{
            const form = document.getElementById('request-form');
            const submit_btn = document.getElementById('submit-btn');

            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                try {
                    submit_btn.disabled = true;

                    const url = `/request/documents/kp-form-no-9`;
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                        },
                        body: new FormData(e.currentTarget)
                    });

                    if(response.status == 500){
                        throw await response.json();
                    }

                    else if (response.status == 422){
                        const error = await response.json();

                        processError(error.errors);
                        submit_btn.disabled = false;
                        return;
                    }

                    else if (response.status == 200) {
                        clearInputsAndErrors(); // clear inputs
                        submit_btn.disabled = false;
                        Swal.fire({
                            title: 'Success',
                            icon: 'success',
                            text: 'Successfully Made Request'
                        }).then(()=>{
                            window.location.href = `{{route('request.documents.kp-form-no-9.index')}}`;
                        });

                    }

                    else {
                        throw await response.json();
                    }

                } catch (error) {
                    submit_btn.disabled = false;

                    console.error(error);

                    Swal.fire({
                        title: 'Server Error',
                        icon: 'error',
                        text: 'Something went wrong, Pls contact developer'
                    });
                }
            });
        }

        /**
         * This process the errors response from the post request
         *
         * Get small that has class name error_wrapper
         * Loop the small then clear the textcontent
         * Loop the errors and add the error in the small the textcontent
         *
         * @param {Object} errors This is the errors from the request
         * @returns {void}
         */
        const processError = (errors)=>{

            const error_wrapper = document.querySelectorAll('.error_wrapper');

            error_wrapper.forEach(item => {
                item.textContent = '';
            });

            for (const [key, value] of Object.entries(errors)) {
                document.querySelector(`.${key}`).textContent = value;
            }
        }

        const clearInputsAndErrors = ()=>{
            const fields = document.querySelectorAll('input, textarea');

            fields.forEach(item => { item.value = ''; });

            const error_wrapper = document.querySelectorAll('.error_wrapper');

            error_wrapper.forEach(item => {
                item.textContent = '';
            });

        };
    </script>
</x-auth-layout>
