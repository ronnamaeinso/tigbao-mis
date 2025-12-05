<?php

use App\Models\AnimalTransportationClearanceRequest;
use App\Models\CertificateOfResidencyRequest;
use App\Models\CertificateOfGoodMoralRequest;
use App\Models\BarangayClearanceBuildingPermitRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;

Route::get('/view-cert-indigency', function () {
    return Pdf::loadView('pages.document-layouts.certificate-of-indigency')
        ->setPaper('letter')->stream('indigency.pdf');
})->middleware('auth');

Route::get('/view-cert-for-owning-coconut-rice-field', function () {
    return Pdf::loadView('pages.document-layouts.certificate-for-owning-coconut-rice-field')
        ->setPaper('letter')->stream('Certificate for owning coconut and rice field.pdf');
})->middleware('auth');

Route::get('/view-cert-of-residency/{id}', function (string $id) {
    $decrypted_id = Crypt::decrypt(urldecode($id));

    $data = CertificateOfResidencyRequest::findOrFail($decrypted_id);

    return Pdf::loadView('pages.document-layouts.certificate-of-residency', [
        'data' => $data,
    ])
        ->setPaper('letter')->stream('Certificate of Residency.pdf');
})->name('view-cert-of-residency')
    ->middleware('auth');

Route::get('/building-permit/{id}', function (string $id) {
    $d_id = Crypt::decrypt(urldecode($id));

    $row = BarangayClearanceBuildingPermitRequest::findOrFail($d_id);

    return Pdf::loadView('pages.document-layouts.building-permit', ['data' => $row])->stream('Brgy Clearance -Building Permit');
})->middleware('auth');

Route::get('/good-moral/{id}', function (string $id) {
    $d_id = Crypt::decrypt(urldecode($id));

    $row = CertificateOfGoodMoralRequest::findOrFail($d_id);

    return Pdf::loadView('pages.document-layouts.good-moral-certificate', ['data' => $row])->stream('Certificate of Good Moral');
})->middleware('auth');

Route::get('/animal-transportation-clearance/{id}', function (string $id) {
    $d_id = Crypt::decrypt(urldecode($id));
    $row = AnimalTransportationClearanceRequest::findOrFail($d_id);

    return Pdf::loadView('pages.document-layouts.animal-transport-clearance', ['data' => $row])
        ->stream('Animal Transportation Clearance');
})->middleware('auth');
