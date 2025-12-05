<x-auth-layout title="Request Documents">


    <section class="container mt-4">
        {{-- create form --}}
        <x-card card-body-class="d-flex justify-content-center">
            {{-- card header --}}
            <x-slot name="cardheader">
                <div class="d-flex align-items-center gap-2">
                    <x-icon type="file primary-color" />
                    <h5 class="m-0 primary-color">Request Certificate Of Attestation</h5>
                </div>
            </x-slot>

            {{-- form --}}
            <x-form class="w-100" id="form-request" style="max-width: 500px;">

                {{-- work --}}
                <x-input name="work" label-name="Work" label-icon="briefcase" class="mb-3" placeholder="your work" />

                {{-- monthly earning --}}
                <x-input type="number" name="monthly-earning" class="mb-3" label-name="Monthly Earning"
                    label-icon="money-bill" addons='step="any"' placeholder="your monthly earnings" />

                <div class="d-flex align-items-center justify-content-end gap-2 flex-wrap">
                    {{-- back --}}
                    <a href="{{route('request.documents.attestation.certificate.index')}}" class="btn btn-sm bg-primary-color px-3 text-nowrap">
                        <x-icon type="arrow-left" />
                        <span>Back</span>
                    </a>
                    {{-- submit --}}
                    <x-button type="submit" id="submit-btn" class="btn btn-sm bg-primary-color px-3 text-nowrap">
                        <x-icon type="arrow-right" />
                        <span class="text-white">Submit</span>
                    </x-button>
                </div>
            </x-form>
        </x-card>
    </section>

    {{-- script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            submitRequest(); // init submit request
        });

        // submit request
        function submitRequest(){
            // form and submit btn
            const form = document.getElementById('form-request');
            const btn = document.getElementById('submit-btn');

            // add submit request
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                // disabled btn
                btn.disabled = true;

                try {
                    /**
                     * url
                     * post request
                     */
                    const url = `{{route('request.documents.attestation.certificate.store')}}`;
                    const response = await fetch(url, {
                        method : 'POST',
                        body : new FormData(form)
                    });

                    // if response not ok
                    if(!response.ok){
                        throw new Error("");
                    }

                    // if ok
                    Swal.fire({
                        title: 'Request Success',
                        icon: 'success',
                        text: 'Successfully Request Certificate'
                    }).then(()=>{
                        /**
                         * enable btn
                         * redirect to index
                         */
                        btn.disabled = false;
                        window.location.href = `{{route('request.documents.attestation.certificate.index')}}`;
                    });

                } catch (error) {
                    btn.disabled = false;
                    console.error(error.message);
                    Swal.fire({
                        title: 'Error',
                        icon: 'error',
                        text: 'Something Went Wrong, Pls Contact Developer'
                    });
                }
            });
        }
    </script>
</x-auth-layout>