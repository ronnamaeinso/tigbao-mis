<x-auth-layout title="Profile">
    {{-- citizens --}}
    <section class="container p-4">
        <div class="d-flex justify-content-center">
            <x-card class="w-100" style="max-width: 800px;">
                <x-slot name="cardheader">
                    <div class="d-flex align-items-center gap-2">
                        <x-icon type="user primary-color" />
                        <h5 class="m-0 primary-color">My Profile</h5>
                    </div>
                </x-slot>
                {{-- form sign in --}}
                <x-form class="p-2" id="form-profile">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6">
                            {{-- first name --}}
                            <x-input-group type="text" class="mb-2" name="fname" label-icon="user primary-color"
                                value="{{$user->fname}}" placeholder="First Name" />
                        </div>
                        <div class="col-sm-6">
                            {{-- middle name --}}
                            <x-input-group type="text" class="mb-2" name="mname" label-icon="user primary-color"
                                value="{{$user->mname}}" placeholder="Middle Name" />
                        </div>
                        <div class="col-sm-6">
                            {{-- last name --}}
                            <x-input-group type="text" class="mb-2" name="lname" label-icon="user primary-color"
                                value="{{$user->lname}}" placeholder="Last Name" />
                        </div>
                        <div class="col-sm-6">
                            {{-- birthdate --}}
                            <x-input-group type="date" class="mb-2" name="bdate" label-icon="cake primary-color"
                                value="{{$user->bdate}}" placeholder="Birthdate" />
                        </div>
                        <div class="col-sm-6">
                            {{-- birthplace --}}
                            <x-input-group type="text" class="mb-2" name="bplace"
                                label-icon="location-pin primary-color" value="{{$user->bplace}}"
                                placeholder="birth place" />
                        </div>
                        {{-- address --}}
                        <div class="col-sm-6">
                            <x-input-group type="text" class="mb-2" name="address"
                                label-icon="location-dot primary-color" value="{{$user->address}}"
                                placeholder="address" />
                        </div>
                        {{-- sex --}}
                        <div class="col-sm-6">
                            <x-select-input-group name="sex" label-icon="venus-mars primary-color">
                                <option value="">--Select Sex--</option>
                                <option value="1" {{$user->sex == 1 ? 'selected' : ''}}>Male</option>
                                <option value="2" {{$user->sex == 2 ? 'selected' : ''}}>Female</option>
                            </x-select-input-group>
                        </div>
                        <div class="col-sm-6">
                            {{-- id type --}}
                            <x-select-input-group name="id-type" label-icon="id-card primary-color">
                                <option value="">--Select ID Type</option>
                                <option value="1" {{$user->id_type == 1 ? 'selected' : ''}}>National ID</option>
                                <option value="0" {{$user->sex == 0 ? 'selected' : ''}}>Other</option>
                            </x-select-input-group>
                        </div>
                        {{-- id picture --}}
                        <div class="col-sm-6">
                            <x-input-group type="file" class="mb-2" name="file" label-icon="id-card primary-color" :is-required="false" />
                        </div>
                        {{-- preview id pic --}}
                        <div class="col-sm-6 mb-3">
                            <img src="{{route('view-file', ['path' => urlencode($user->id_picture)])}}" alt="id-pic"
                                class="w-100" id="img-preview">
                        </div>
                        <div class="col-sm-6">
                            {{-- contact --}}
                            <x-input-group class="mb-2" name="contact" label-icon="phone primary-color"
                                value="{{$user->contact_number}}" placeholder="09*********" />
                        </div>
                        <div class="col-sm-6">
                            {{-- username --}}
                            <x-input-group type="email" class="mb-2" name="email" label-name="Email"
                                label-icon="envelope primary-color" value="{{$user->email}}"
                                placeholder="email@example.com" />
                        </div>
                        <div class="col-sm-6">
                            {{-- password --}}
                            <x-input-group type="password" class="mb-2" name="password" label-name="password"
                                label-icon="key primary-color"
                                tail-icon="eye-slash primary-color cursor-pointer showpassword" addons='minlength=8' :is-required="false" />
                        </div>
                    </div>

                    {{-- wrapper for signin & signup --}}
                    <div class="w-100 d-grid">

                        {{-- submit btn --}}
                        <x-button type="submit" id="btn-submit" class="btn-sm primary-color"
                            style="background-color: var(--third-color);">
                            <x-icon type="pencil primary-color" />
                            Update
                        </x-button>
                    </div>

                </x-form>
            </x-card>
        </div>
    </section>

    {{-- script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function(){
                // init show password
                showPassword();

                // update profile
                updateProfile();

                // preview id
                previewID();
            });

            /**
             * show password on click eye icon
             * if the type was password then turn type into text
             * else password
             */
            function showPassword() {
                const showpass_icon = document.querySelector('.showpassword');
                const password_input = document.getElementById('password');

                showpass_icon.addEventListener('click', function(e){
                    if (password_input.type == 'password') {
                        e.target.classList.remove('fa-eye-slash');
                        e.target.classList.add('fa-eye');
                        password_input.type = 'text';
                    }
                    else {
                        e.target.classList.add('fa-eye-slash');
                        e.target.classList.remove('fa-eye');
                        password_input.type = 'password';
                    }
                });
            }

            // sign up
            function updateProfile() {
                const form = document.getElementById('form-profile');
                const submit_btn = document.getElementById('btn-submit');

                // add event listener submit
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    submit_btn.disabled = true; // disabled btn

                    try {
                        /**
                         * url
                         * post request
                         */
                        const id = '{{$user->encrypted_id}}';

                        const url = `/profile/${encodeURIComponent(id)}`;
                        const response = await fetch(url, {
                            method : 'POST',
                            body : new FormData(form)
                        });

                        // if response was 409
                        if(response.status == 422){

                            // show error alert
                            Swal.fire({
                                title: 'Error',
                                icon: 'error',
                                text: 'Make user to upload img only and img size only accepts 5mb below!'
                            }).then(()=>{
                                submit_btn.disabled = false; //enable btn again
                            });

                            return;
                        }

                        // if response was 500
                        if(response.status == 500){
                            // throw new Error
                            throw new Error("response 500");
                        }

                        // if success then show success alert
                        Swal.fire({
                            title : 'Success',
                            icon : 'success',
                            text : 'Successfully Updated Profile'
                        });

                    } catch (error) {
                        /**
                         * show error alert
                         * log error
                         * enable btn again
                         */
                        Swal.fire({
                            title: 'Error',
                            icon: 'error',
                            text: 'Something Went Wrong, Pls Contact Developer',
                        });
                        console.error(error.message);
                        submit_btn.disabled = false;
                    }
                });
            }

            // preview id
            function previewID() {
                const id = document.getElementById('file'); // file input
                const img_container = document.getElementById('img-preview'); // image preview
                const originalSrc = img_container.src; // store original src

                id.addEventListener('change', function (e) {
                    const file = e.target.files[0]; // first selected file

                    if (file) {
                        const reader = new FileReader();

                        reader.onload = function (event) {
                            img_container.src = event.target.result; // set preview image
                        };

                        reader.readAsDataURL(file);
                    } else {
                        img_container.src = originalSrc; // revert to original if empty
                    }
                });
            }


    </script>

</x-auth-layout>