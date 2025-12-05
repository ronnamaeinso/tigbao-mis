<x-guest-layout title="Sign In">

    {{-- custom blur background --}}
    <style>
        .blur-bg {
            position: relative;
            overflow: hidden;
        }

        .blur-bg::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset("images/bg-tigbao.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-color: rgba(0,0,0,0.2);
            background-blend-mode: darken;
            filter: blur(2px); /* adjust blur level */
            transform: scale(1.1); /* prevents blur edges */
            z-index: -1;
        }
    </style>

    {{-- main --}}
    <section class="container-fluid vh-100 d-flex justify-content-center align-items-center blur-bg">

        <x-card class="w-100 shadow-lg" style="max-width: 500px;">
            <x-slot name="cardheader">
                <div class="d-flex align-items-center gap-1">
                    <x-icon type="sign-in" style="color: var(--primary-color);" />
                    <span class="fw-bold" style="color: var(--primary-color);">Sign In</span>
                </div>
            </x-slot>

            {{-- form sign in --}}
            <x-form class="p-4" id="form-signin">

                {{-- username --}}
                <x-input-group type="email" class="mb-3" name="email" label-name="Email" label-icon="envelope"
                    placeholder="email@example.com" />

                {{-- password --}}
                <x-input-group type="password" class="mb-3" name="password" label-name="Password" label-icon="key"
                    placeholder="password" tail-icon="eye-slash cursor-pointer showpassword" addons='minlength=8' />

                <div class="w-100 d-grid gap-3">

                    {{-- submit btn --}}
                    <x-button type="submit" id="btn-submit" class="btn-sm text-white"
                        style="background-color: var(--third-color);">
                        <x-icon type="sign-in text-white" />
                        Sign in
                    </x-button>

                    {{-- sign up --}}
                    <a href="{{route('signup')}}" class="text-decoration-none text-center"
                        style="font-size: 0.7rem; color: var(--primary-color);">Don't Have Account? Sign Up Here</a>
                </div>

            </x-form>

        </x-card>
    </section>

    {{-- script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            showPassword();
            signin();
        });

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

        function signin(){
            const form = document.getElementById('form-signin');
            const submit_btn = document.getElementById('btn-submit');

            form.addEventListener('submit', async function(e){
                e.preventDefault();
                e.stopImmediatePropagation();

                submit_btn.disabled = true;

                try {
                    const url = `/signin-process`;
                    const response = await fetch(url, {
                        method : 'POST',
                        body : new FormData(form)
                    });

                    if(response.status == 500){
                        throw new Error("");
                    }

                    if(response.status == 403){
                        Swal.fire({
                            title: 'Warning',
                            icon: 'warning',
                            text: 'Your Account Is Not Verified, Pls Wait For The Admin To Verify Your Account',
                        });
                        submit_btn.disabled = false;
                        return;
                    }

                    if(response.status == 401){
                        Swal.fire({
                            title: 'Warning',
                            icon: 'warning',
                            text: 'Invalid Credentials',
                        });
                        submit_btn.disabled = false;
                        return;
                    }

                    Swal.fire({
                        title : 'Success',
                        icon : 'success',
                        text : 'Successfully Sign In'
                    }).then(async()=>{
                        submit_btn.disabled = false;
                        const data = await response.json();
                        window.location.href = data.url;
                    });

                } catch (error) {
                    console.error(error.message);
                    submit_btn.disabled = false;
                    Swal.fire({
                        title: 'Error',
                        icon: 'error',
                        text: 'Something Went Wrong!, Pls Contact Developer'
                    });
                }
            });
        }
    </script>

</x-guest-layout>
