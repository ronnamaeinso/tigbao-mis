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
            width: 90px;
            height: 90px;
        }

        .pos-30 {
            right: 35%;

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
        <div class=" position-absolute" style="">
            </div>
        </div>

    <div class="position-relative" style="margin-bottom: 100px;">
        <img src="./logos/seal-1.jpg" class="img-100  position-absolute" alt="logo-2" style="left: 140px;">
        <div class=" position-absolute text-center" style="left: 230px;">
            <span>Province of Southern Leyte</span><br>
            <span>Municipality of Libagon</span><br>
            <span style="font-weight: bold;">BARANGAY TIGBAO</span>
        </div>
        <img src="./logos/bagong-pilipinas.jpg" class="img-100  position-absolute" alt="logo-3" style="left: 430px;">
    </div>

    <div class="text-center">
        <h2 style="color: maroon;">OFFICE OF THE PUNONG-BARANGAY</h2>
    </div>

    <div class="" style="color: black; background-color: black; height: 2px; margin-top: 20px; margin-bottom: 40px;"></div>



    <div class="position-relative">
        {{-- bg img --}}
        <img src="./logos/seal-1.jpg" class="position-absolute bg-img-seal-2" alt="logo">

        <div class="text-center" style="margin-bottom: 40px;">
            <h1 style="color: #393360ff;">CERTIFICATE OF INDIGENCY</h1>
        </div>

        <div class="" style="margin-bottom: 40px;">
            <span style="font-weight: medium;">TO WHOM IT MAY CONCERN:</span>
        </div>

        <div class="text-indent mb-1 text-justify">
            <p>THIS IS TO CERTIFY that {{ $data->fullname }} of legal age, female, Single, Filipino, and a resident of Barangay Tigbao, Libagon, Southern Leyte.</p>
        </div>

        <div class="text-indent mb-1 text-justify">
            <p>THIS IS TO CERTIFY FURTHER that, {{ $data->fullname }}, and the family has no property, no other source of income and belong to low-income families.
            </p>
        </div>

        <div class="text-indent mb-1 text-justify">
            <p>
                This certification is issued upon the request of the interested party for whatever legal or lawful purpose this may serve.
            </p>
        </div>

        <div class="text-indent mb-lg-1 text-justify">
            <p>
                Issued this {{ $data->updated_at->format('d F Y') }} at Barangay Tigbao, Libagon, Southern Leyte.
            </p>
        </div>

        <div class="text-right position-relative">
            <div class="text-center position-absolute right-0">
                <span class="fw-bold text-underline">HON. CELESTINA C. RUBIO</span><br>
                <span>PUNONG BARANGAY</span>
            </div>
        </div>
    </div>

</body>
