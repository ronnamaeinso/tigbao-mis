<x-auth-layout title="User Management Create User">
    {{-- main --}}
    <section class="container my-4 d-flex justify-content-center ">
        <x-card class="w-100 shadow-lg" style="max-width: 700px;">
            <x-slot name="cardheader">
                <div class="d-flex align-items-center gap-1">
                    <x-icon type="user-plus" style="color: var(--primary-color);" />
                    <span class="fw-bold" style="color: var(--primary-color);">Create User</span>
                </div>
            </x-slot>

            {{-- form create user --}}
            <x-form class="p-2" id="form-sign-up">
                <div class="row">
                    <div class="col-sm-6">
                        {{-- first name --}}
                        <small class="fw-medium text-danger small-error fname"></small>
                        <x-input-group type="text" class="mb-2" name="fname" label-icon="user primary-color"
                            placeholder="First Name" label-name="First Name" :is-required="false" />
                    </div>
                    <div class="col-sm-6">
                        {{-- middle name --}}
                        <small class="fw-medium text-danger small-error mname"></small>
                        <x-input-group type="text" class="mb-2" name="mname" label-icon="user primary-color"
                            placeholder="Middle Name" label-name="Middle Name" :is-required="false" />
                    </div>
                    <div class="col-sm-6">
                        {{-- last name --}}
                        <small class="fw-medium text-danger small-error lname"></small>
                        <x-input-group type="text" class="mb-2" name="lname" label-icon="user primary-color"
                            placeholder="Last Name" label-name="Last Name" :is-required="false" />
                    </div>
                    <div class="col-sm-6">
                        {{-- birthdate --}}
                        <small class="fw-medium text-danger small-error bdate"></small>
                        <x-input-group type="date" class="mb-2" name="bdate" label-icon="cake primary-color"
                            placeholder="Birthdate" label-name="Birth Date" :is-required="false" />
                    </div>
                    <div class="col-sm-6">
                        {{-- birthplace --}}
                        <small class="fw-medium text-danger small-error bplace"></small>
                        <x-input-group type="text" class="mb-2" name="bplace"
                            label-icon="location-pin primary-color" placeholder="birth place"
                            label-name="Birth Place" :is-required="false" />
                    </div>
                    {{-- address --}}
                    <div class="col-sm-6">
                        <small class="fw-medium text-danger small-error address"></small>
                        <x-input-group type="text" class="mb-2" name="address"
                            label-icon="location-dot primary-color" placeholder="address" label-name="Address" :is-required="false" />
                    </div>
                    {{-- sex --}}
                    <div class="col-sm-6">
                        <small class="fw-medium text-danger small-error sex"></small>
                        <x-select-input-group name="sex" label-icon="venus-mars primary-color" label-name="Sex" :is-required="false" >
                            <option value="">--Select Sex--</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </x-select-input-group>
                    </div>

                    {{-- id type --}}
                    <div class="col-sm-6">
                        <small class="fw-medium text-danger small-error id_type"></small>
                        <x-select-input-group name="id-type" label-icon="id-card primary-color" label-name="ID Type" :is-required="false" >
                            <option value="">--Select ID Type</option>
                            <option value="1">National ID</option>
                            <option value="2">Driver's License</option>
                            <option value="3">Passport</option>
                            <option value="4">Voter's ID</option>
                            <option value="5">PRC ID</option>
                            <option value="6">Postal ID</option>
                            <option value="7">UMID</option>
                            <option value="8">Student ID</option>
                            <option value="9">Employee ID</option>
                            <option value="10">SSS ID</option>
                            <option value="11">PhilHealth ID</option>
                            <option value="12">Pag-Ibig ID</option>
                        </x-select-input-group>
                    </div>

                    {{-- id picture --}}
                    <div class="col-sm-6">
                        <small class="fw-medium text-danger small-error file"></small>
                        <x-input-group type="file" class="mb-2" name="file" label-icon="id-card primary-color"
                            label-name="Upload ID" :is-required="false" />
                    </div>

                    {{-- preview id pic --}}
                    <div class="col-sm-6 mb-3">
                        <img src="{{ asset('logos/img.png') }}" alt="" class="w-100" id="img-preview">
                    </div>

                    {{-- contact --}}
                    <div class="col-sm-6">
                        <small class="fw-medium text-danger small-error contact"></small>
                        <x-input-group class="mb-2" name="contact" label-icon="phone primary-color"
                            placeholder="09*********" label-name="Contact" :is-required="false" />
                    </div>

                    {{-- user type --}}
                    <div class="col-sm-6">
                        <small class="fw-medium text-danger small-error user_type"></small>
                        <x-select-input-group name="user-type" label-icon="user-gear primary-color"
                            label-name="User Type" :is-required="false" >
                            <option value="">-- select user type --</option>
                            <option value="2">Staff</option>
                            <option value="3">Citizen</option>
                        </x-select-input-group>
                    </div>

                    {{-- username --}}
                    <div class="col-sm-6">
                        <small class="fw-medium text-danger small-error email"></small>
                        <x-input-group type="email" class="mb-2" name="email" label-name="Email"
                            label-icon="envelope primary-color" placeholder="email@example.com"
                            label-name="Username" :is-required="false" />
                    </div>

                    {{-- password --}}
                    <div class="col-sm-6">
                        <small class="fw-medium text-danger small-error password"></small>
                        <x-input-group type="password" class="mb-2" name="password" label-name="password"
                            label-icon="key primary-color"
                            tail-icon="eye-slash primary-color cursor-pointer showpassword" addons='minlength=8'
                            label-name="Password" :is-required="false" />
                    </div>
                </div>

                {{-- wrapper for signin & signup --}}
                <div class="w-100 d-flex algin-items-center justify-content-end gap-2">
                    {{-- submit btn --}}
                    <x-button type="submit" id="btn-submit" class="btn-sm bg-primary-color">
                        <x-icon type="check text-white" />
                        Submit
                    </x-button>

                    <a href="{{ route('admin.manage.users') }}" class="btn btn-sm bg-primary-color">
                        <x-icon type="xmark text-white" />
                        Cancel
                    </a>
                </div>

            </x-form>

        </x-card>
    </section>

    {{-- script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // init show password
            showPassword();

            // sign up
            signUp();

            // id preview
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

            showpass_icon.addEventListener('click', function(e) {
                if (password_input.type == 'password') {
                    e.target.classList.remove('fa-eye-slash');
                    e.target.classList.add('fa-eye');
                    password_input.type = 'text';
                } else {
                    e.target.classList.add('fa-eye-slash');
                    e.target.classList.remove('fa-eye');
                    password_input.type = 'password';
                }
            });
        }

        // sign up
        function signUp() {
            const form = document.getElementById('form-sign-up');
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
                    const url = `/a/manage/users`;
                    const response = await fetch(url, {
                        method: 'POST',
                        body: new FormData(form),
                        headers: {
                            'Accept': 'application/json',
                        }
                    });

                    // if response was 409
                    if (response.status == 409) {
                        // show error alert
                        Swal.fire({
                            title: 'Error',
                            icon: 'error',
                            text: 'Make user to upload img only and img size only accepts 5mb below!'
                        }).then(() => {
                            submit_btn.disabled = false; //enable btn again
                            return; // return
                        });
                    }

                    // if response was 422
                    if (response.status == 422) {
                        const errors = await response.json();

                        let count = 0;

                        for (const [key, val] of Object.entries(errors)) {

                            if (count == 0) {
                                console.log(val.join(', '));

                                document.querySelector(`.${key}`).textContent = val.join(', ');
                                document.querySelector(`.${key}`).scrollIntoView({
                                    inline: 'center',
                                    block: 'start',
                                    behavior: 'smooth'
                                });
                            } else {
                                document.querySelector(`.${key}`).textContent = val.join(', ');
                            }

                            count++;
                        }

                        submit_btn.disabled = false; //enable btn again
                        return; // return
                    }

                    // if response was 500
                    if (response.status == 500) {
                        // throw new Error
                        throw new Error("response 500");
                    }

                    // if success then show success alert
                    Swal.fire({
                        title: 'Success',
                        icon: 'success',
                        text: 'Successfully Created User'
                    }).then(() => {
                        window.location.href = '{{ route('admin.manage.users.pending') }}';
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

            id.addEventListener('change', function(e) {
                const file = e.target.files[0]; // first selected file

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(event) {
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
