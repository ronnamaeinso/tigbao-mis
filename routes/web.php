<?php

use App\Http\Controllers\AdminStaff\CertificateOfResidencyRequestListController;
use App\Http\Controllers\Auth\Admin\UserManagementController;
use App\Http\Controllers\Auth\AdminStaff\AnimalTransportationClearanceRequestListController;
use App\Http\Controllers\Auth\AdminStaff\AnnouncementController;
use App\Http\Controllers\Auth\AdminStaff\BarangayClearanceBuildingPermitRequestListController;
use App\Http\Controllers\Auth\AdminStaff\CertificateOfGoodMoralRequestListController;
use App\Http\Controllers\Auth\AdminStaff\CertificateOfIndigencyRequestsController;
use App\Http\Controllers\Auth\AdminStaff\DashboardController as AdminStaffDashboardController;
use App\Http\Controllers\Auth\AdminStaff\ImportantFilesController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\Staff\AttestationCertificateRequestsController;
use App\Http\Controllers\Auth\Staff\CitizenController;
use App\Http\Controllers\Auth\Staff\StaffSummonController;
use App\Http\Controllers\Auth\User\AnimalClearanceRequestController;
use App\Http\Controllers\Auth\User\BarangayClearanceBuildingPermitRequestController;
use App\Http\Controllers\Auth\User\CertificateOfGoodMoralRequestController;
use App\Http\Controllers\Auth\User\CertificateOfIndencyController;
use App\Http\Controllers\Auth\User\CertificateOfResidencyRequestController;
use App\Http\Controllers\Auth\User\ProfileController;
use App\Http\Controllers\Auth\User\RequestDocumentAttestationCertController;
use App\Http\Controllers\Auth\User\UserDashboardController;
use App\Http\Controllers\Auth\User\UserSummonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminStaff\SeniorCitizenRecordsController;
use App\Http\Controllers\NotificationController;

// landing page
Route::get('/', [AuthController::class, 'viewLandingPage'])->name('home');

// FAQ Page (Public - accessible to everyone) SHAN
Route::get('/faqs', function () {
    return view('pages.user.faqs.indexfaqs');  // Public FAQs
})->name('faqs');


// SHAN



// <=================== auth ===================>
Route::get('/sign-in', [AuthController::class, 'viewSignin'])->name('signin');
Route::get('/sign-up', [AuthController::class, 'viewSignup'])->name('signup');
Route::post('/signup-process', [AuthController::class, 'signupProcess'])->name('signup.process');
Route::post('/signin-process', [AuthController::class, 'signinProcess'])->name('signin.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/send-otp', [AuthController::class, 'sendOTP'])->name('send.otp');

// <=================== admin ===================>
Route::get('/a/manage/users', [UserManagementController::class, 'index'])
    ->name('admin.manage.users')
    ->middleware('auth');

Route::get('/a/manage/users/create', [UserManagementController::class, 'create'])
    ->name('admin.manage.users.create')
    ->middleware('auth');

Route::post('/a/manage/users', [UserManagementController::class, 'store'])
    ->name('admin.manage.users.store')
    ->middleware('auth');

Route::get('/a/manage/users/pending', [UserManagementController::class, 'viewPendingUsers'])
    ->name('admin.manage.users.pending')
    ->middleware('auth');

Route::put('/verify-account/{id}', [UserManagementController::class, 'verifyPendingUser'])
    ->name('admin.manage.users.pending.verify')
    ->middleware('auth');

Route::put('/reject-account-verification-request/{id}', [UserManagementController::class, 'rejectPendingUser'])
    ->name('admin.manage.users.pending.reject')
    ->middleware('auth');

Route::get('/a/manage/users/{id}/edit', [UserManagementController::class, 'edit'])
    ->name('admin.manage.users.edit')
    ->middleware('auth');

Route::put('/a/manage/users/{id}', [UserManagementController::class, 'update'])
    ->name('admin.manage.users.update')
    ->middleware('auth');

Route::delete('/a/manage/users/{id}', [UserManagementController::class, 'destroy'])
    ->name('admin.manage.users.destroy')
    ->middleware('auth');

// <=================== staff and admin ===================>
Route::resource('/as/dashboard', AdminStaffDashboardController::class)
    ->names('as.dashboard');

Route::get('/get-chart-data', [AdminStaffDashboardController::class, 'getChartData'])
    ->middleware('auth');

Route::resource('/staff/citizen', CitizenController::class)
    ->names('staff.citizen')
    ->middleware('auth');

Route::get('/request-document-layouts', function () {
    return view('requested-documents-container');
})->name('request-documents-layouts')->middleware('auth');

Route::resource('/staff/attestation-certificate-requests', AttestationCertificateRequestsController::class)
    ->names('staff.attestation-certificate-requests')
    ->middleware('auth');

Route::put('/staff/attestation-certificate-requests/{id}/approve', [AttestationCertificateRequestsController::class, 'approveRequest'])
    ->name('staff.attestation-certificate-requests.approved')
    ->middleware('auth');

Route::put('/staff/attestation-certificate-requests/{id}/reject', [AttestationCertificateRequestsController::class, 'rejectRequest'])
    ->name('staff.attestation-certificate-requests.reject')
    ->middleware('auth');

Route::get('/staff/attestation-certificate-requests/{id}/generate-certificate', [AttestationCertificateRequestsController::class, 'generateAttestationCertificate'])
    ->name('staff.attestation-certificate-requests.generate-certificate')
    ->middleware('auth');

Route::put('/staff/attestation-certificate-requests/{id}/issue-certificate', [AttestationCertificateRequestsController::class, 'issueAttestationCertificate'])
    ->name('staff.attestation-certificate-requests.issue-certificate')
    ->middleware('auth');

Route::resource('/summons', StaffSummonController::class)
    ->middleware('auth');

Route::put('/summons/{id}/approve', [StaffSummonController::class, 'approveSummonRequest'])
    ->name('summons.approve')
    ->middleware('auth');

Route::put('/summons/{id}/reject', [StaffSummonController::class, 'rejectSummonRequest'])
    ->name('summons.reject')
    ->middleware('auth');

Route::get('/summons/{id}/generate', [StaffSummonController::class, 'generateSummonRequest'])
    ->name('summons.generate')
    ->middleware('auth');

Route::get('/summons/{id}/view', [StaffSummonController::class, 'viewSummon'])
    ->name('summons.view')
    ->middleware('auth');

Route::put('/summons/{id}/issue', [StaffSummonController::class, 'issueSummon'])
    ->name('summons.issue')
    ->middleware('auth');

Route::resource('/important-files', ImportantFilesController::class)
    ->middleware('auth');

Route::post('/important-files/upload-files', [ImportantFilesController::class, 'uploadFiles'])
    ->name('important-files.upload-files')
    ->middleware('auth');

Route::delete('/important-files/upload-files/{id}', [ImportantFilesController::class, 'destroyFile'])
    ->name('important-files.upload-files.destroy')
    ->middleware('auth');

Route::get('/important-files/upload-files/{id}', [ImportantFilesController::class, 'downloadFile'])
    ->name('important-files.upload-files.download')
    ->middleware('auth');

Route::resource('/request-list/certificate-of-indigency', CertificateOfIndigencyRequestsController::class)
    ->names('request-list.certificate-of-indigency')
    ->middleware('auth');

Route::put('/approve-cert-indigency/{id}', [CertificateOfIndigencyRequestsController::class, 'approveRequest'])
    ->middleware('auth');

Route::put('/reject-cert-indigency/{id}', [CertificateOfIndigencyRequestsController::class, 'rejectRequest'])
    ->middleware('auth');

Route::get('/generate-cert-indigency/{id}', [CertificateOfIndigencyRequestsController::class, 'generateCert'])
    ->middleware('auth');

Route::put('/issue-cert-indigency/{id}', [CertificateOfIndigencyRequestsController::class, 'issueCert'])
    ->middleware('auth');

Route::resource('/certificate-of-residency/request/list', CertificateOfResidencyRequestListController::class)
    ->names('certificate-of-residency.request.list')
    ->middleware('auth');

Route::resource('/barangay-clearance/building-permit/request/list', BarangayClearanceBuildingPermitRequestListController::class)
    ->names('barangay-clearance.building-permit.request.list')
    ->middleware('auth');

Route::resource('/certificate-of-good-moral/request/list', CertificateOfGoodMoralRequestListController::class)
    ->names('certificate-of-good-moral.request.list')
    ->middleware('auth');

// animal transportation clearance request
Route::resource('/animaltransportationrequestlist', AnimalTransportationClearanceRequestListController::class)
    ->middleware('auth');

// senior c records
Route::resource('/senior-citizen/records', SeniorCitizenRecordsController::class)
    ->names('senior-citizen.records')->middleware('auth');
Route::put('/senior-citizen/decease/{id}', [SeniorCitizenRecordsController::class, 'setAsDecease'])
    ->middleware('auth');
Route::get('/senior-citizen/archive', [SeniorCitizenRecordsController::class, 'openArchive'])
    ->name('senior-citizen.archive')
    ->middleware('auth');

// <=================== USER ===================>
Route::resource('/dashboard', UserDashboardController::class)->middleware('auth');

// certificate of attestation
Route::resource('/request/documents/attestation/certificate', RequestDocumentAttestationCertController::class)
    ->names('request.documents.attestation.certificate')
    ->middleware('auth');

// kp form no9
Route::resource('/request/documents/kp-form-no-9', UserSummonController::class)
    ->names('request.documents.kp-form-no-9')
    ->middleware('auth');

// profile
Route::resource('/profile', ProfileController::class)
    ->middleware('auth');

// certificate of indigency
Route::resource('/request/certificate-of-indigency', CertificateOfIndencyController::class)
    ->names('request.certificate-of-indigency')
    ->middleware('auth');

// certificate of residency
Route::resource('/certificate-of-residency-request', CertificateOfResidencyRequestController::class)
    ->middleware('auth');

// certifacte of residency status tracker
Route::get('/certificate-of-residency-request/track/{id}', [CertificateOfResidencyRequestController::class, 'trackRequest'])
    ->middleware('auth')
    ->name('certificate-of-residency-request.track');

// barangay clearance - building permit
Route::resource('/barangay-clearance/building-permit/request', BarangayClearanceBuildingPermitRequestController::class)
    ->names('barangay-clearance.building-permit.request')
    ->middleware('auth');

// certificate of good moral
Route::resource('/certificate-of-good-moral/request', CertificateOfGoodMoralRequestController::class)
    ->names('certificate-of-good-moral.request')
    ->middleware('auth');

// animal transportation clearance request
Route::resource('/animal-transportation-clearance/request', AnimalClearanceRequestController::class)
    ->names('animal-transportation-clearance.request')
    ->middleware('auth');

// announcement
Route::resource('/announcements', AnnouncementController::class)
    ->middleware('auth');

// notifications
Route::resource('/notifications', NotificationController::class)->middleware('auth');
Route::get('//mark-read-all', [NotificationController::class, 'markAllRead'])->middleware('auth');





// utilities
require __DIR__.'/helper.php';

// certificate layouts
require __DIR__.'/certificate-layouts.php';
