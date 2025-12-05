<x-guest-layout title="Sign In">

    {{-- custom blur background --}}
    <style>
        .signin-container {
            position: relative;
            overflow: hidden;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .signin-container::before {
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
            background-color: rgba(0,0,0,0.3);
            background-blend-mode: darken;
            filter: blur(2px);
            z-index: -2;
        }

        .signin-container::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, 
                rgba(var(--primary-color-rgb), 0.15) 0%, 
                rgba(var(--primary-color-rgb), 0.08) 50%,
                rgba(255, 255, 255, 0.03) 100%);
            z-index: -1;
        }

        .signin-card {
            background: rgba(255, 255, 255, 0.98);
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
            width: 100%;
            max-width: 420px;
        }

        .signin-header {
            background: linear-gradient(135deg, var(--primary-color), var(--third-color));
            padding: 1.5rem;
            text-align: center;
            position: relative;
        }

        .logo-circle {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.75rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
            border: 2px solid white;
        }

        .logo-circle i {
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .signin-title {
            color: white;
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 0.25rem;
        }

        .signin-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.85rem;
        }

        .form-container {
            padding: 1.5rem;
        }

        /* Enhanced styling for your existing x-input-group components */
        .form-container .form-group {
            margin-bottom: 1.2rem;
        }

        .form-container .input-group {
            position: relative;
        }

        .form-container .input-group .input-group-text {
            background-color: transparent;
            border-right: none;
            border-color: #dee2e6;
            color: var(--primary-color);
        }

        .form-container .form-control {
            border: 1.5px solid #dee2e6;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .form-container .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(var(--primary-color-rgb), 0.1);
        }

        .form-container .fa-eye-slash,
        .form-container .fa-eye {
            color: var(--primary-color);
            cursor: pointer;
        }

        .submit-btn {
            width: 100%;
            padding: 10px;
            background: linear-gradient(135deg, var(--third-color), var(--primary-color));
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 0.5rem;
        }

        .submit-btn:hover:not(:disabled) {
            background: linear-gradient(135deg, var(--primary-color), var(--third-color));
            transform: translateY(-1px);
        }

        .submit-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .submit-btn i {
            font-size: 1rem;
        }

        .signup-link {
            text-align: center;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e9ecef;
        }

        .signup-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .signup-link a:hover {
            color: var(--third-color);
            text-decoration: underline;
        }

        .features {
            display: flex;
            justify-content: space-between;
            margin: 1rem 0;
            padding: 0.75rem;
            background: rgba(var(--primary-color-rgb), 0.05);
            border-radius: 8px;
            border-left: 3px solid var(--primary-color);
        }

        .feature-item {
            text-align: center;
            flex: 1;
            padding: 0 0.25rem;
        }

        .feature-item i {
            color: var(--primary-color);
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .feature-item span {
            display: block;
            font-size: 0.75rem;
            color: #495057;
            font-weight: 600;
            line-height: 1.2;
        }

        .footer-note {
            text-align: center;
            margin-top: 1rem;
            color: #6c757d;
            font-size: 0.75rem;
        }

        .footer-note a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .footer-note a:hover {
            text-decoration: underline;
        }

        /* Responsive adjustments */
        @media (max-width: 480px) {
            .signin-container {
                padding: 15px;
            }
            
            .signin-card {
                max-width: 100%;
            }
            
            .form-container {
                padding: 1.25rem;
            }
            
            .signin-header {
                padding: 1.25rem;
            }
            
            .features {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .feature-item {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
            }
            
            .feature-item i {
                margin-bottom: 0;
            }
            
            .feature-item span {
                display: inline;
            }
        }
    </style>

    {{-- main --}}
    <section class="signin-container">
        <div class="signin-card">
            
            {{-- Header --}}
            <div class="signin-header">
                <div>
                    <div class="logo-circle">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h1 class="signin-title">Welcome Back</h1>
                    <p class="signin-subtitle">Sign in to Barangay Tigbao MIS</p>
                </div>
            </div>

            {{-- Form --}}
            <div class="form-container">
                <x-form class="p-0" id="form-signin">
                    
                    {{-- Email --}}
                    <x-input-group 
                        type="email" 
                        class="mb-3" 
                        name="email" 
                        label-name="Email" 
                        label-icon="envelope"
                        placeholder="email@example.com" 
                    />

                    {{-- Password --}}
                    <x-input-group 
                        type="password" 
                        class="mb-3" 
                        name="password" 
                        label-name="Password" 
                        label-icon="key"
                        placeholder="password" 
                        tail-icon="eye-slash cursor-pointer showpassword" 
                        addons='minlength=8' 
                    />

                    {{-- Features --}}
                    <div class="features">
                        <div class="feature-item">
                            <i class="fas fa-shield-alt"></i>
                            <span>Secure</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-clock"></i>
                            <span>24/7 Access</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-headset"></i>
                            <span>Support</span>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" id="btn-submit" class="submit-btn">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Sign in</span>
                    </button>

                    {{-- Sign Up Link --}}
                    <div class="signup-link">
                        <a href="{{ route('signup') }}">
                            <i class="fas fa-user-plus"></i>
                            Don't Have Account? Sign Up Here
                        </a>
                    </div>

                    {{-- Footer Note --}}
                    <div class="footer-note">
                        <p>By signing in, you agree to our terms</p>
                        <p class="mt-1">Need help? <a href="#">Contact Support</a></p>
                    </div>

                </x-form>
            </div>
        </div>
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
                const submitText = submit_btn.querySelector('span');
                const submitIcon = submit_btn.querySelector('i');
                const originalText = submitText.textContent;
                const originalIcon = submitIcon.className;

                // Show loading state
                submitText.textContent = 'Signing in...';
                submitIcon.className = 'fas fa-spinner fa-spin';

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
                        resetSubmitButton();
                        return;
                    }

                    if(response.status == 401){
                        Swal.fire({
                            title: 'Warning',
                            icon: 'warning',
                            text: 'Invalid Credentials',
                        });
                        resetSubmitButton();
                        return;
                    }

                    Swal.fire({
                        title : 'Success',
                        icon : 'success',
                        text : 'Successfully Sign In'
                    }).then(async()=>{
                        const data = await response.json();
                        window.location.href = data.url;
                    });

                } catch (error) {
                    console.error(error.message);
                    Swal.fire({
                        title: 'Error',
                        icon: 'error',
                        text: 'Something Went Wrong!, Pls Contact Developer'
                    });
                    resetSubmitButton();
                }

                function resetSubmitButton() {
                    submit_btn.disabled = false;
                    submitText.textContent = originalText;
                    submitIcon.className = originalIcon;
                }
            });
        }
    </script>

</x-guest-layout>