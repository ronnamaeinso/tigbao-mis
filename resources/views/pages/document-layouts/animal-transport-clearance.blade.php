<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">
    <title>Animal Transport Clearance</title>
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

        .bg-img-seal-1 {
            top: 0;
            right: 0;
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

    <div class="position-relative" style="margin-bottom: 110px;">
        <img src="./logos/seal-1.jpg" class="img-100  position-absolute" alt="logo-2" style="left: 120px;">
        <div class=" position-absolute text-center" style="left: 210px;">
            <span>Republic of the Philippines</span><br>
            <span>Province of Southern Leyte</span><br>
            <span>Municipality of Libagon</span><br>
            <span style="font-weight: bold;">BARANGAY TIGBAO</span>
        </div>
        <img src="./logos/bagong-pilipinas.jpg" class="img-100  position-absolute" alt="logo-2" style="right: 100px;">
    </div>

    <div class="position-relative">
        {{-- bg img --}}
        <img src="./logos/seal-1.jpg" class="position-absolute bg-img-seal-2" alt="logo">

        <div class="text-center" style="margin-bottom: 70px; margin-top: 1.5em">
            <span style="color: black; font-size: 1.5rem; font-weight: bold;">ANIMAL TRANSPORT CLEARANCE</span>
        </div>

        <div class="text-indent mb-1 text-justify">
            <p>
                Clearance is hereby granted to <strong><u>{{$data->name}}</u></strong>. to transport {{ $data->animal_type }}, {{ $data->animal_age }} old bound to
                {{ $data->location }}
            </p>
        </div>
        <div class="text-indent mb-1 text-justify">
            <p>
                Pursuant to Barangay Ordinance no. 01- s. 2018, Animal traders are required to secure transport fee
                receipt prior to transport domesticated Animal specified in the provision of this Ordinance.
            </p>
        </div>

        <div class="text-indent text-justify" style="margin-bottom: 50px;">
            <p>
                This Clearance is issued upon the request of interested party concerned, to vouch for whatever legal
                purpose it may serve.
            </p>
        </div>

        <div class="text-indent text-justify" style="margin-bottom: 50px;">
            <p>
                Issued on the {{ $data->updated_at->format('d') }}th  day of {{ $data->updated_at->format('F') }} {{ $data->updated_at->format('Y') }} at Tigbao, Libagon, Southern Leyte.
            </p>
        </div>

        <div class="text-right position-relative" style="margin-bottom: 60px;">
            <div class="text-center position-absolute right-0">
                <span class="fw-bold text-underline">HON. CELESTINA C. RUBIO</span><br>
                <span>PUNONG BARANGAY</span>
            </div>
        </div>

        <div class="" style="margin-bottom: 2em;">
            Paid Under O.R. #: N/A<br>
            Issued on: March 7, 2016<br>
            Issued at: Tigbao, Libagon,<br>
            Southern Leyte<br>
            Amount paid: P100.00<br>
        </div>

    </div>

</body>
