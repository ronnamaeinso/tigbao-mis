<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">
    <title>Certificate Of Attestation</title>
    <style>
        *,
        *::after,
        *::before {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .fw-bold {
            font-weight: bold;
        }

        .text-success {
            color: green;
        }

        .text-center {
            text-align: center !important;
        }

        .text-right {
            text-align: right;
        }

        .text-underline {
            text-decoration: underline;
        }

        .text-justify {
            text-align: justify;
        }

        .text-indent {
            text-indent: 50px;
        }

        .m-1 {
            margin: 96px;
        }

        .p-1 {
            /* padding: calc(96px / 2px); */
            padding: 96px;
        }

        .mb-1 {
            margin-bottom: 1em;
        }

        .mb-2 {
            margin-bottom: 1.5em;
        }

        .mb-3 {
            margin-bottom: 2em;
        }

        .mb-4 {
            margin-bottom: 2.5em;
        }

        .mb-5 {
            margin-bottom: 3em;
        }

        .mb-lg-1 {
            margin-bottom: 6em;
        }

        .line-height-1 {
            line-height: 1.5em;
        }

        .line-height-2 {
            line-height: 1.75em;
        }

        .line-height-3 {
            line-height: 2em;
        }

        .border-danger {
            border: 1px solid red;
        }

        .position-relative {
            position: relative;
        }

        .position-absolute {
            position: absolute;
        }

        .right-0 {
            right: 0;
        }

        .pt-0 {
            padding-top: 0 !important;
        }

        .img-100 {
            width: 80px;
            height: 80px;
        }

        .pos-30 {
            right: 20%;
        }

        .mr-1 {
            margin-right: 1em;
        }

        .bg-img-seal-2 {
            top: 0;
            left: 0;
            width: 100%;
            opacity: 10%;
        }
    </style>
</head>

<body class="p-1 pt-0">
    {{-- header --}}
    <div class="mb-lg-1  position-relative" style="padding-top: 20px;">
        <div class=" position-absolute pos-30">
            <img src="./logos/seal-2.png" class=" img-100 mr-1" alt="logo-1">
            <img src="./logos/seal-1.jpg" class=" img-100 mr-1" alt="logo-2">
            <img src="./logos/seal-3.png" class=" img-100 mr-1" alt="logo-2">
            <img src="./logos/bagong-pilipinas.jpg" class="img-100" alt="logo-3">
        </div>
    </div>

    <div class="text-center mb-2">
        <span>Republic of the Philippines</span></br>
        <span>Province of Southern Leyte</span></br>
        <span>MUNICIPALITY OF LIBAGON</span></br>
        <span class="fw-bold">BARANGAY TIGBAO</span>
    </div>

    <div class="position-relative">
        {{-- bg img --}}
        <img src="./logos/seal-1.jpg" class="position-absolute bg-img-seal-2" alt="logo">

        <div class="text-center mb-2">
            <h1 class="fw-bold text-success">CERTIFICATE OF ATTESTATION</h1>
        </div>

        <div class="mb-lg-1">
            <p class="text-justify text-indent mb-1 line-height-3">
                This is to certify that Mr/Mrs./Ms.<span class="text-underline">{{$item->name}}</span>, <span
                    class="text-underline">{{Carbon\Carbon::parse($item->bdate)->age}}</span> years old, residing at
                <span class="text-underline">{{$item->address}}</span> is currently working as <span
                    class="text-underline">{{$item->work}}</span> in
                Tigbao,
                Libagon, Southern Leyte, earning PHP <span
                    class="text-underline">{{number_format($item->monthly_earning)}}</span> per month.
            </p>
            <p class="text-justify text-indent mb-1 line-height-3">
                Based on the assessment and validation conducted by the undersigned, the above-mentioned income remains
                insufficient to meet the family’s daily sustenance and is currently experiencing financial difficulties
                due
                to rising inflation.
            </p>
            <p class="text-justify text-indent line-height-3 mb-1">
                The certification is issued upon the request of the above-named person for whatever legal purpose/s it
                may
                serve her/his best.
            </p>
            @if ($item->status == 4)
                <p class="text-justify text-indent line-height-3">
                    Issued this <span class="text-underline">{{Carbon\Carbon::parse($item->updated_at)->day}}</span> day of
                    <span>{{Carbon\Carbon::parse($item->updated_at)->format('F')}}, {{Carbon\Carbon::parse($item->updated_at)->year}}</span> at
                    Libagon, Southern Leyte.
                </p>
            @endif
            @if ($item->status == 2)
                <p class="text-justify text-indent line-height-3">
                    Issued this <span class="text-underline">{{Carbon\Carbon::now()->day}}</span> day of
                    <span>{{Carbon\Carbon::now()->format('F')}}, {{Carbon\Carbon::now()->year}}</span> at
                    Libagon, Southern Leyte.
                </p>
            @endif
        </div>

        <div class="text-right position-relative">
            <div class="text-center position-absolute right-0">
                <span class="fw-bold text-underline">HON. CELESTINA C. RUBIO</span><br>
                <span>PUNONG BARANGAY</span>
            </div>
        </div>
    </div>

</body>