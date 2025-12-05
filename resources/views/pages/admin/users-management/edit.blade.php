<x-auth-layout title="User Management Edit User">
    {{-- main --}}
    <section class="container-fluid d-flex p-3 justify-content-center align-items-center">
        <x-card class="w-100 shadow-lg" style="max-width: 700px;">
            <x-slot name="cardheader">
                <div class="d-flex align-items-center gap-1">
                    <x-icon type="pencil" style="color: var(--primary-color);" />
                    <span class="fw-bold" style="color: var(--primary-color);">Edit User</span>
                </div>
            </x-slot>

            {{-- form create user --}}
            <x-form class="p-2" id="edit-user-form">
                @method('PUT')
                <div class="row">
                    <div class="col-sm-6">
                        {{-- first name --}}
                        <x-input-group type="text" class="mb-2" name="fname" label-icon="user primary-color"
                            placeholder="First Name" value="{{$user->fname}}" />
                    </div>
                    <div class="col-sm-6">
                        {{-- middle name --}}
                        <x-input-group type="text" class="mb-2" name="mname" label-icon="user primary-color"
                            placeholder="Middle Name" value="{{$user->mname}}" />
                    </div>
                    <div class="col-sm-6">
                        {{-- last name --}}
                        <x-input-group type="text" class="mb-2" name="lname" value="{{$user->lname}}"
                            label-icon="user primary-color" placeholder="Last Name" />
                    </div>
                    <div class="col-sm-6">
                        {{-- birthdate --}}
                        <x-input-group type="date" class="mb-2" name="bdate" value="{{$user->bdate}}"
                            label-icon="cake primary-color" placeholder="Birthdate" />
                    </div>
                    <div class="col-sm-6">
                        {{-- birthplace --}}
                        <x-input-group type="text" class="mb-2" name="bplace" label-icon="location-pin primary-color"
                            value="{{$user->bplace}}" placeholder="birth place" />
                    </div>
                    {{-- address --}}
                    <div class="col-sm-6">
                        <x-input-group type="text" class="mb-2" name="address" label-icon="location-dot primary-color"
                            placeholder="address" value="{{$user->address}}" />
                    </div>
                    {{-- sex --}}
                    <div class="col-sm-6">
                        <x-select-input-group name="sex" label-icon="venus-mars primary-color">
                            <option value="">--Select Sex--</option>
                            <option value="1" {{$user->sex == '1' ? 'selected' : ''}}>Male</option>
                            <option value="2" {{$user->sex == '2' ? 'selected' : ''}}>Female</option>
                        </x-select-input-group>
                    </div>
                    <div class="col-sm-6">
                        {{-- id type --}}
                        <x-select-input-group name="id-type" label-icon="id-card primary-color">
                            <option value="">--Select ID Type</option>
                            <option value="1" {{ $user->id_type == "1" ? 'selected' : ''}}>National ID</option>
                            <option value="0">Other</option>
                        </x-select-input-group>
                    </div>
                    {{-- id picture --}}
                    <div class="col-sm-6">
                        <x-input-group type="file" class="mb-2" name="file" label-icon="id-card primary-color"
                            :is-required="false" />
                    </div>
                    {{-- preview id pic --}}
                    <div class="col-sm-6 mb-3">
                        <img src="{{route('view-file', ['path' => urlencode($user->id_picture)])}}" alt="" class="w-100"
                            id="img-preview">
                    </div>
                    {{-- contact --}}
                    <div class="col-sm-6">
                        <x-input-group class="mb-2" name="contact" label-icon="phone primary-color"
                            placeholder="09*********" value="{{$user->contact_number}}" />
                    </div>
                    {{-- user type --}}
                    <div class="col-sm-6">
                        <x-select-input-group name="user-type" label-icon="user-gear primary-color">
                            <option value="">-- select user type --</option>
                            <option value="2" {{$user->role == 2 ? 'selected' : ''}}>Staff</option>
                            <option value="3" {{$user->role == 3 ? 'selected' : ''}}>Citizen</option>
                        </x-select-input-group>
                    </div>
                    {{-- username --}}
                    <div class="col-sm-6">
                        <x-input-group type="email" class="mb-2" name="email" label-name="Email"
                            label-icon="envelope primary-color" placeholder="email@example.com"
                            value="{{$user->email}}" />
                    </div>
                    <div class="col-sm-6">
                        {{-- password --}}
                        <x-input-group type="password" class="mb-2" name="password" label-name="password"
                            label-icon="key primary-color"
                            tail-icon="eye-slash primary-color cursor-pointer showpassword" addons='minlength=8'
                            :is-required="false" />
                    </div>
                </div>

                {{-- wrapper for signin & signup --}}
                <div class="w-100 d-flex algin-items-center justify-content-end gap-2">
                    {{-- submit btn --}}
                    <x-button type="submit" id="btn-submit" class="btn-sm primary-color"
                        style="background-color: var(--third-color);">
                        <x-icon type="check primary-color" />
                        Submit
                    </x-button>

                    <a href="{{route('admin.manage.users')}}" class="btn btn-sm primary-color"
                        style="background-color: var(--third-color);">
                        <x-icon type="xmark primary-color" />
                        Cancel
                    </a>
                </div>

            </x-form>

        </x-card>
    </section>

    {{-- script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            // init show password
            showPassword();

            // preview id
            previewID();

            // init edit user
            editUser();
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

        // preview id
        function previewID() {
            const id = document.getElementById('file'); // file input
            const img_container = document.getElementById('img-preview'); // image preview
            const originalSrc = `{{$user->id_picture}}`;

            id.addEventListener('change', async function (e) {
                const file = e.target.files[0]; // first selected file

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function (event) {
                        img_container.src = event.target.result; // set preview image
                    };

                    reader.readAsDataURL(file);
                } else {
                    const response = await fetch(`/view-file?path=${encodeURIComponent(originalSrc)}`);

                    const blob_src = URL.createObjectURL(await response.blob());

                    img_container.src = blob_src; // revert to original if empty
                }
            });
        }

        // edit user
        function editUser(){
            const form = document.getElementById('edit-user-form');
            const btn_submit = document.getElementById('btn-submit');
            const id = '{{Illuminate\Support\Facades\Crypt::encrypt($user->id)}}';

            form.addEventListener('submit', async function(e){
                e.preventDefault();

                btn_submit.disabled = true;

                try {
                    const url = `/a/manage/users/${id}`; // url

                    // response
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN' : token
                        },
                        body: new FormData(form)
                    });

                    // response 422
                    if(response.status == 422){
                        Swal.fire({
                            title: 'Warning',
                            icon: 'warning',
                            text: 'Pls Check if the file was and image, and the file size do not exceed 10mb'
                        });
                    }

                    // response 500
                    if(response.status == 500){
                        throw new Error("");
                    }

                    // response 200
                    Swal.fire({
                        title: 'Updated',
                        icon: 'success',
                        text: 'Updated Successfully'
                    }).then(()=>{
                        window.location.reload();
                    });
                } catch (error) {
                    /**
                     * enable btn
                     * log error
                     * show error alert
                     */
                    btn_submit.disabled = true;
                    console.error(error.message);
                    Swal.fire({
                        title: 'Error',
                        icon: 'error',
                        text: 'Something Went Wrong!, Pls Contact Developer'
                    });
                }
            });
        };
    </script>

</x-auth-layout>