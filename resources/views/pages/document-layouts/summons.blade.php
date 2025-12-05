<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>KP No. 9 - Summon</title>

    {{-- style --}}
    <style>
        html {
            font-size: 15px;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            padding: 1in;
        }

        .text-sm {
            font-size: 0.7rem;
        }

        .text-center {
            text-align: center;
        }

        .w-50 {
            width: 292px;
        }

        .border-debug {
            border: 1px solid red;
        }

        .float-right {
            float: right;
        }

        .float-left {
            float: left;
        }

        .font-bold {
            font-weight: bold;
        }

        .text-justify {
            text-align: justify;
        }

        .text-indent {
            text-indent: 0.5in;
        }

        .text-end {
            text-align: right;
        }

        .mb-base {
            margin-bottom: 0.5em;
        }

        .d-block {
            display: block;
        }

        .text-underline {
            text-decoration: underline;
        }

        .w-full {
            width: 100%;
        }

        .border-bottom {
            border-bottom: 1px solid black;
        }

        .text-start {
            text-align: start;
        }

        .mr-base {
            margin-right: 1em;
        }

        .px-base {
            padding-inline: 1em;
        }
        .text-right{
            text-align: right;
        }
    </style>
</head>

<body>
    <span class="text-sm">KP Form No. 9</span>
    <br>
    <div class="text-center">
        <span>Republika sa Pilipinas</span>
        <br>
        <span>Lalawigan sa Southern Leyte</span>
        <br>
        <span>Dakbayan/Lungsod sa Libagon</span>
        <br>
        <span>Barangay Tigbao</span>
        <br>
        <br>
        <span class="font-bold">BUHATAN SA LUPONG TAGAPAMAYAPA</span>
    </div>
    <br>
    <br>
    <div class="">
        <div class="w-50 float-left mr-base ">
            <div class="border-bottom text-start">
                <span class="">{{ $data->mga_nagsumbong }}</span>
            </div>
            <br>
            <div class="text-center">
                <span>(Mga) Nagsumbong</span>
            </div>
        </div>
        <div class="w-50 float-left text-right">
            <span>Kaso sa Barangay isip: <span class="text-underline">{{$data->kaso_sa_brgy_isip}}</span></span><br>
            <span class="w-full">Bahin sa: <span class="text-underline">{{$data->bahin_sa}}</span></span><br>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="">
        <span>-batok ni-</span>
    </div>
    <br>
    <br>

    <div class="w-50">
        <div class="text-start border-bottom">
            <span>{{$data->mga_gisumbong}}</span>
        </div>
        <br>
        <div class="text-center">
            <span>(Mga) Sinumbong</span>
        </div>
    </div>
    <br>
    <br>

    <div class="text-center">
        <span class="font-bold">MGA PAGTAWAG</span><br>
        <span class="font-bold">(Summons)</span>
    </div>
    <br>
    <br>

    <div class="">
        <span>Ngadtu kang: </span>
        <span class="text-underline px-base">
            {{ $data->mga_gisumbong }}
        </span>
    </div>
    <br>
    <br>
    <br>
    <br>

    <span>Mga Sinumbong,</span>
    <br>
    <br>

    <p class="text-justify text-indent mb-base">
        Ikaw gipatawag dinhi nga moatubang kanako sa linawas uban sa imong mga testigos karong petsa <span
            class="text-underline">{{ $data->petsa->format('j') }}</span>, bulan sa <span
            class="text-underline">{{ $data->petsa->format('F') }}</span>, <span
            class="text-underline">{{ $data->petsa->format('Y') }}</span> sa may alas <span
            class="text-underline">{{ $data->petsa->format('h:i A') }}</span> ang takna sa buntag/hapon, aron dinhing
        tungura imong tubagon diri kanako ang reklamo batok kanimo nga
        gisumbong. Akong gisukip ang kopya sa maong sumbong aron husayon/areglohon ang panagbangi tali kanimo ug ang
        (mga) nagsumbong.
    </p>

    <p class="text-justify text-indent mb-base">
        Ikaw gipahimangnoan dinhi nga ang imong tinuyong kapakyas sa pagtuman niining maong pagtawag magdili kanimo sa
        pagpasaka ug “counter claim” kon sumbalik nga sumbong gumikan niining kasoha.
    </p>

    <p class="text-justify text-indent mb-base">
        Kon ikaw mapakyas, moatubang ka sa silot nga “contempt of court” kon pagbiaybiay sa husgado.
    </p>

    <p class="text-justify text-indent mb-base">
        Niining ika <span class="text-underline">{{ $data->date->day }}</span> nga petsa sa bulan sa <span
            class="text-underline">{{ $data->date->format('F, Y') }}</span>.
    </p>
    <br>
    <br>
    <br>
    <br>
    <div class="text-end">
        <span>______________________________</span><br>
        <span>Punong Barangay/Pangkat Tsirman</span>
    </div>
</body>

</html>
