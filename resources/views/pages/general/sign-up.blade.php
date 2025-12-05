<x-guest-layout title="Sign Up">

<<<<<<< HEAD
    {{-- custom blur background --}}
    <style>
        .signup-container {
            position: relative;
            overflow: hidden;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .signup-container::before {
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

        .signup-container::after {
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

        .signup-card {
            background: rgba(255, 255, 255, 0.98);
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
        }

        .signup-header {
            background: linear-gradient(135deg, var(--primary-color), var(--third-color));
            padding: 1.5rem;
            text-align: center;
            position: relative;
        }

        .signup-header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--third-color));
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

        .signup-title {
            color: white;
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 0.25rem;
        }

        .signup-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.85rem;
        }

        .form-container {
            padding: 1.5rem;
        }

        /* Enhanced styling for existing components */
        .form-container .form-group {
            margin-bottom: 0.8rem;
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
            padding: 8px 12px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .form-container .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(var(--primary-color-rgb), 0.1);
        }

        .form-container .form-select {
            border: 1.5px solid #dee2e6;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .form-container .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(var(--primary-color-rgb), 0.1);
        }

        .form-container .fa-eye-slash,
        .form-container .fa-eye {
            color: var(--primary-color);
            cursor: pointer;
        }

        .error-message {
            font-size: 0.75rem;
            color: #dc3545;
            margin-top: 0.25rem;
            display: block;
            font-weight: 500;
        }

        .preview-container {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 0.5rem;
            background: #f8f9fa;
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .preview-container img {
            max-width: 100%;
            max-height: 120px;
            object-fit: contain;
            border-radius: 4px;
        }

        .preview-label {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 0.5rem;
            display: block;
        }

        .otp-section {
            background: rgba(var(--primary-color-rgb), 0.05);
            border-radius: 8px;
            border-left: 3px solid var(--primary-color);
            padding: 1rem;
            margin: 1rem 0;
        }

        .otp-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .send-otp-btn {
            background: linear-gradient(135deg, var(--primary-color), var(--third-color));
            color: white;
            border: none;
            border-radius: 6px;
            padding: 6px 12px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .send-otp-btn:hover:not(:disabled) {
            background: linear-gradient(135deg, var(--third-color), var(--primary-color));
            transform: translateY(-1px);
        }

        .send-otp-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
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
            margin-top: 1rem;
        }

        .submit-btn:hover:not(:disabled) {
            background: linear-gradient(135deg, var(--primary-color), var(--third-color));
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(var(--primary-color-rgb), 0.2);
        }

        .submit-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .signin-link {
            text-align: center;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e9ecef;
        }

        .signin-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .signin-link a:hover {
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

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .signup-card {
                max-width: 95%;
            }
            
            .form-container {
                padding: 1.25rem;
            }
            
            .signup-header {
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

        /* CSS variable fallback */
        :root {
            --primary-color-rgb: 40, 167, 69;
        }
    </style>

    {{-- main --}}
    <section class="signup-container">
        <div class="signup-card">
            
            {{-- Header --}}
            <div class="signup-header">
                <div>
                    <div class="logo-circle">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h1 class="signup-title">Create Account</h1>
                    <p class="signup-subtitle">Join Barangay Tigbao MIS</p>
                </div>
            </div>

            {{-- Form --}}
            <div class="form-container">
                <x-form class="p-0" id="form-sign-up">
                    <div class="row g-2">
                        {{-- First Name --}}
                        <div class="col-sm-6">
                            <small class="error-message small-error fname"></small>
                            <x-input-group type="text" class="mb-2" name="fname" label-icon="user primary-color"
                                placeholder="First Name" label-name="First Name" :is-required="false" />
                        </div>
                        
                        {{-- Middle Name --}}
                        <div class="col-sm-6">
                            <small class="error-message small-error mname"></small>
                            <x-input-group type="text" class="mb-2" name="mname" label-icon="user primary-color"
                                placeholder="Middle Name" label-name="Middle Name" :is-required="false" />
                        </div>
                        
                        {{-- Last Name --}}
                        <div class="col-sm-6">
                            <small class="error-message small-error lname"></small>
                            <x-input-group type="text" class="mb-2" name="lname" label-icon="user primary-color"
                                placeholder="Last Name" label-name="Last Name" :is-required="false" />
                        </div>
                        
                        {{-- Birthdate --}}
                        <div class="col-sm-6">
                            <small class="error-message small-error bdate"></small>
                            <x-input-group type="date" class="mb-2" name="bdate" label-icon="cake primary-color"
                                placeholder="Birthdate" label-name="Birth Date" :is-required="false" />
                        </div>
                        
                        {{-- Birthplace --}}
                        <div class="col-sm-6">
                            <small class="error-message small-error bplace"></small>
                            <x-input-group type="text" class="mb-2" name="bplace"
                                label-icon="location-pin primary-color" placeholder="Birth Place" label-name="Birth Place"
                                :is-required="false" />
                        </div>
                        
                        {{-- Address --}}
                        <div class="col-sm-6">
                            <small class="error-message small-error address"></small>
                            <x-input-group type="text" class="mb-2" name="address"
                                label-icon="location-dot primary-color" placeholder="Address" label-name="Address"
                                :is-required="false" />
                        </div>
                        
                        {{-- Sex --}}
                        <div class="col-sm-6">
                            <small class="error-message small-error sex"></small>
                            <x-select-input-group name="sex" label-icon="venus-mars primary-color" label-name="Sex"
                                :is-required="false">
                                <option value="">--Select Sex--</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </x-select-input-group>
                        </div>
                        
                        {{-- ID Type --}}
                        <div class="col-sm-6">
                            <small class="error-message small-error id_type"></small>
                            <x-select-input-group name="id-type" label-icon="id-card primary-color" label-name="ID Type"
                                :is-required="false">
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
                        
                        {{-- ID Picture Upload --}}
                        <div class="col-sm-6">
                            <small class="error-message small-error file"></small>
                            <x-input-group type="file" class="mb-2" name="file" label-icon="id-card primary-color"
                                label-name="Upload ID" :is-required="false" />
                        </div>
                        
                        {{-- Preview ID --}}
                        <div class="col-sm-6 mb-2">
                            <div class="preview-container">
                                <img src="{{ asset('logos/img.png') }}" alt="" class="w-100" id="img-preview">
                                <span class="preview-label">ID Preview</span>
                            </div>
                        </div>
                        
                        {{-- Contact --}}
                        <div class="col-sm-6">
                            <small class="error-message small-error contact"></small>
                            <x-input-group class="mb-2" name="contact" label-icon="phone primary-color"
                                placeholder="09*********" label-name="Contact Number" :is-required="false" />
                        </div>
                        
                        {{-- Email --}}
                        <div class="col-sm-6">
                            <small class="error-message small-error email"></small>
                            <x-input-group type="email" class="mb-2" name="email" label-name="Email"
                                label-icon="envelope primary-color" placeholder="email@example.com" :is-required="false" />
                        </div>
                        
                        {{-- Password --}}
                        <div class="col-sm-6">
                            <small class="error-message small-error password"></small>
                            <x-input-group type="password" class="mb-2" name="password" label-name="Password"
                                label-icon="key primary-color"
                                tail-icon="eye-slash primary-color cursor-pointer showpassword" addons='minlength=8'
                                :is-required="false" />
                        </div>
                        
                        {{-- OTP Section --}}
                        <div class="col-12">
                            <div class="otp-section">
                                <div class="otp-header">
                                    <label for="otp" class="fw-medium" style="color: var(--primary-color);">
                                        <i class="fas fa-shield-alt me-2"></i>Verification Code
                                    </label>
                                    <button class="send-otp-btn" type="button" id="send-otp-btn">
                                        <i class="fas fa-paper-plane"></i>
                                        <span>Send OTP</span>
                                    </button>
                                </div>
                                <div class="w-100">
                                    <input type="number" class="form-control" name="otp" id="otp"
                                        placeholder="Enter 3-digit OTP">
                                    <small class="error-message small-error otp"></small>
                                    <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">
                                        <i class="fas fa-info-circle me-1"></i>Check your email for the verification code
                                    </small>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Features --}}
                        <div class="col-12">
                            <div class="features">
                                <div class="feature-item">
                                    <i class="fas fa-shield-alt"></i>
                                    <span>Secure Registration</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-user-check"></i>
                                    <span>Verified Users</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-headset"></i>
                                    <span>Support Available</span>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Submit Button --}}
                        <div class="col-12">
                            <button type="submit" id="btn-submit" class="submit-btn">
                                <i class="fas fa-user-plus"></i>
                                <span>Sign Up</span>
                            </button>
                        </div>
                        
                        {{-- Sign In Link --}}
                        <div class="col-12">
                            <div class="signin-link">
                                <a href="{{ route('signin') }}">
                                    <i class="fas fa-sign-in-alt"></i>
                                    Already Have Account? Sign In Here
                                </a>
                            </div>
                        </div>
                        
                        {{-- Footer Note --}}
                        <div class="col-12">
                            <div class="footer-note">
                                <p>By creating an account, you agree to our terms</p>
                                <p class="mt-1">Your registration requires admin approval</p>
                            </div>
                        </div>
                    </div>
                </x-form>
            </div>
        </div>
=======
    {{-- main --}}
    <section class="container d-flex justify-content-center my-3">
        <x-card class="w-100 shadow-lg" style="max-width: 700px;">
            <x-slot name="cardheader">
                <div class="d-flex align-items-center gap-1">
                    <x-icon type="user-plus" style="color: var(--primary-color);" />
                    <span class="fw-bold" style="color: var(--primary-color);">Sign Up</span>
                </div>
            </x-slot>

            {{-- form sign in --}}
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
                            label-icon="location-pin primary-color" placeholder="birth place" label-name="Birth Place"
                            :is-required="false" />
                    </div>
                    {{-- address --}}
                    <div class="col-sm-6">
                        <small class="fw-medium text-danger small-error address"></small>
                        <x-input-group type="text" class="mb-2" name="address"
                            label-icon="location-dot primary-color" placeholder="address" label-name="Address"
                            :is-required="false" />
                    </div>
                    {{-- sex --}}
                    <div class="col-sm-6">
                        <small class="fw-medium text-danger small-error sex"></small>
                        <x-select-input-group name="sex" label-icon="venus-mars primary-color" label-name="Sex"
                            :is-required="false">
                            <option value="">--Select Sex--</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </x-select-input-group>
                    </div>
                    <div class="col-sm-6">
                        {{-- id type --}}
                        <small class="fw-medium text-danger small-error id_type"></small>
                        <x-select-input-group name="id-type" label-icon="id-card primary-color" label-name="ID Type"
                            :is-required="false">
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
                    <div class="col-sm-6">
                        <small class="fw-medium text-danger small-error contact"></small>
                        {{-- contact --}}
                        <x-input-group class="mb-2" name="contact" label-icon="phone primary-color"
                            placeholder="09*********" label-name="contact" :is-required="false" />
                    </div>
                    <div class="col-sm-6">
                        {{-- username --}}
                        <small class="fw-medium text-danger small-error email"></small>
                        <x-input-group type="email" class="mb-2" name="email" label-name="Email"
                            label-icon="envelope primary-color" placeholder="email@example.com" :is-required="false" />
                    </div>
                    <div class="col-sm-6">
                        {{-- password --}}
                        <small class="fw-medium text-danger small-error password"></small>
                        <x-input-group type="password" class="mb-2" name="password" label-name="password"
                            label-icon="key primary-color"
                            tail-icon="eye-slash primary-color cursor-pointer showpassword" addons='minlength=8'
                            :is-required="false" />
                    </div>
                </div>

                {{-- otp confirmation --}}
                <div class="d-grid gap-2 mb-3">
                    <div class="w-100">
                        <label for="otp" class="fw-medium primary-color">OTP</label>
                        <input type="number" class="form-control" name="otp" id="otp"
                            placeholder="3 digit otp" :is-required="false">
                        <small class="fw-medium text-danger otp"></small>
                    </div>
                    <button class="btn btn-sm bg-primary-color text-nowrap m-0" type="button" id="send-otp-btn"
                        style="width: fit-content;">
                        Send otp
                    </button>
                </div>

                {{-- wrapper for signin & signup --}}
                <div class="w-100 d-grid">

                    {{-- submit btn --}}
                    <x-button type="submit" id="btn-submit" class="btn-sm bg-primary-color mb-3">
                        <x-icon type="sign-in text-white" />
                        Sign up
                    </x-button>

                    {{-- sign up --}}
                    <a href="{{ route('signin') }}" class="text-decoration-none text-center"
                        style="font-size: 0.7rem; color: var(--primary-color);">Already Have Account? Sign In Here</a>
                </div>

            </x-form>

        </x-card>
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
    </section>

    {{-- script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // init show password
            showPassword();

            // sign up
            signUp();

            // preview id
            previewID();

            // send otp
            sendOTP();
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
<<<<<<< HEAD
            const submitText = submit_btn.querySelector('span');
            const submitIcon = submit_btn.querySelector('i');
=======
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571

            // add event listener submit
            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                submit_btn.disabled = true; // disabled btn
<<<<<<< HEAD
                const originalText = submitText.textContent;
                const originalIcon = submitIcon.className;
                submitText.textContent = 'Processing...';
                submitIcon.className = 'fas fa-spinner fa-spin';
=======
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571

                try {
                    /**
                     * url
                     * post request
                     */
                    const url = `/signup-process`;
                    const response = await fetch(url, {
                        method: 'POST',
                        body: new FormData(form),
                        headers: {
                            'Accept': 'application/json',
                        }
                    });

                    clear_errors();

                    // if response was 409
                    if (response.status == 409) {
                        // show error alert
                        Swal.fire({
                            title: 'Error',
                            icon: 'error',
                            text: 'Make user to upload img only and img size only accepts 5mb below!'
                        }).then(() => {
<<<<<<< HEAD
                            resetSubmitButton();
=======
                            submit_btn.disabled = false; //enable btn again
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
                        });
                        return; // return/
                    }

                    // if response was 403
                    if (response.status == 403) {
                        // show error alert
                        Swal.fire({
                            title: 'Warning',
                            icon: 'warning',
                            text: 'OTP do not match!'
                        }).then(() => {
<<<<<<< HEAD
                            resetSubmitButton();
=======
                            submit_btn.disabled = false; //enable btn again
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
                        });
                        return; // return
                    }

                    // if response was 422
                    if (response.status == 422) {
                        const errors = await response.json();
                        console.log(errors);

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
                            }
                            else {
                                document.querySelector(`.${key}`).textContent = val.join(', ');
                            }

                            count++;
                        }

<<<<<<< HEAD
                        resetSubmitButton();
=======
                        submit_btn.disabled = false; //enable btn again
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
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
<<<<<<< HEAD
                        text: 'Successfully Registered, Please wait for registration approval'
=======
                        text: 'Successfully Register, Pls wait for registration approval'
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
                    }).then(() => {
                        window.location.href = '/sign-in';
                    });

                } catch (error) {
                    console.error(error);

                    /**
                     * show error alert
                     * log error
                     * enable btn again
                     */
                    Swal.fire({
                        title: 'Error',
                        icon: 'error',
<<<<<<< HEAD
                        text: 'Something Went Wrong, Please Contact Developer',
                    });
                    console.error(error.message);
                    resetSubmitButton();
                }

                function resetSubmitButton() {
                    submit_btn.disabled = false;
                    submitText.textContent = originalText;
                    submitIcon.className = originalIcon;
=======
                        text: 'Something Went Wrong, Pls Contact Developer',
                    });
                    console.error(error.message);
                    submit_btn.disabled = false;
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
                }
            });
        }

        // preview id
        function previewID() {
            const id = document.getElementById('file'); // file input
            const img_container = document.getElementById('img-preview'); // image preview
            const originalSrc = img_container.src; // store original src
<<<<<<< HEAD
            const previewContainer = img_container.parentElement;
=======
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571

            id.addEventListener('change', function(e) {
                const file = e.target.files[0]; // first selected file

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(event) {
                        img_container.src = event.target.result; // set preview image
<<<<<<< HEAD
                        previewContainer.style.borderColor = 'var(--primary-color)';
=======
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
                    };

                    reader.readAsDataURL(file);
                } else {
                    img_container.src = originalSrc; // revert to original if empty
<<<<<<< HEAD
                    previewContainer.style.borderColor = '#dee2e6';
=======
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
                }
            });
        }

        /**
         * send otp
         */
        function sendOTP() {
            const btn = document.getElementById('send-otp-btn');
            const email = document.getElementById('email');
<<<<<<< HEAD
            const btnText = btn.querySelector('span');
            const btnIcon = btn.querySelector('i');
=======
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571

            btn.addEventListener('click', async function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                if (email.value == "") {

                    Swal.fire({
                        title: 'Warning',
                        icon: 'warning',
                        text: 'Put Email in the email field'
                    });

                    return;
                }

                try {
<<<<<<< HEAD
                    btn.disabled = true;
                    btnText.textContent = 'Sending...';
                    btnIcon.className = 'fas fa-spinner fa-spin';

=======
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
                    await axios.post(`/send-otp`, {
                        email: email.value
                    }, {
                        headers: {
                            'X-CSRF-TOKEN': window.token,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    });

                    Swal.fire({
                        title: 'Success',
                        icon: 'success',
<<<<<<< HEAD
                        text: 'OTP sent'
                    });

                    btnText.textContent = 'Resend OTP';
                    btnIcon.className = 'fas fa-paper-plane';

=======
                        text: 'OTP send'
                    });

>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
                } catch (error) {
                    console.error(error);
                    Swal.fire({
                        title: 'Server Error',
                        icon: 'error',
                        text: 'Something went wrong'
                    });
<<<<<<< HEAD
                    btnText.textContent = 'Send OTP';
                    btnIcon.className = 'fas fa-paper-plane';
                } finally {
                    btn.disabled = false;
=======
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
                }
            });
        }

        const clear_errors = ()=>{
            const errors = document.querySelectorAll('.small-error');

            errors.forEach(item => {
                item.textContent = "";
            });
        }
    </script>
<<<<<<< HEAD
</x-guest-layout>
=======
</x-guest-layout>
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
