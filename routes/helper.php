<?php

use App\Http\Controllers\HelperController;
use App\Models\BarangayClearanceBuildingPermitRequest;
use App\Models\CertificateOfGoodMoralRequest;
use App\Models\AnimalTransportationClearanceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::get('/view-file', [HelperController::class, 'viewFile'])->name('view-file')->middleware('auth');
Route::get('/track-status', function (Request $request) {
    try {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            throw new Exception("Error Processing Request");
        }

        $decrypted_id = (int) Crypt::decrypt(urldecode($request->id));

        $data = null;

        switch ($request->type) {
            case "barangay-clearance-building-permit":
                $status = BarangayClearanceBuildingPermitRequest::findOrFail($decrypted_id);
                $data = BarangayClearanceBuildingPermitRequest::getStatusLayers($status->status);
                break;
            case "good-moral-cert":
                $status = CertificateOfGoodMoralRequest::findOrFail($decrypted_id);
                $data = CertificateOfGoodMoralRequest::getStatusLayers($status->status);
                break;
            case "animal":
                $status = AnimalTransportationClearanceRequest::findOrFail($decrypted_id);
                $data = AnimalTransportationClearanceRequest::getStatusLayers($status->status);
                break;
        }
        return view('pages.status-tracker', ['data' => $data]);
    } catch (\Throwable $th) {
        dd($th->getMessage());
        $message = $th->getMessage();
        return redirect()->back()->with('error', "$message");
    }
})->name('track.status')->middleware('auth');
