<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthPractitionersController;
use App\Http\Controllers\PractitionersController;
use App\Http\Controllers\CustomerController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use \App\Http\Controllers\PaymentController;
 // reset Password
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;

use App\Http\Controllers\ZoomController;

use App\Http\Controllers\SocialController;
use App\Http\Controllers\CalendarController;

// google Login
use App\Http\Controllers\LoginGoogleCustommerController;

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('change-locale/{locale}', function($locale){
    App::setLocale($locale);
    return back();
})->name('change-locale');

Route::redirect('/','/en');
Route::redirect('home','/en');
Route::redirect('register','/en');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');




Route::group(['prefix' => '{locale?}','where' => ['locale' => '[a-zA-Z]{2}']], function() {


    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::match(['get', 'post'],'Search/{protocolId?}/{service_id?}/{meetings_id?}', [IndexController::class, 'search'])->name('search');
    Route::match(['get', 'post'],'reset-field', [IndexController::class, 'resetField'])->name('reset-field');
    Route::get('/blog', [IndexController::class, 'blog'])->name('blog');
    Route::get('/balance', [IndexController::class, 'balance'])->name('balance');
    Route::get('/profile-view-customer/{practitionerID}', [IndexController::class, 'profileViewCustomer'])->name('profile-view-customer');
    Route::get('/view-type-form-practitioner/{practitionerID}', [IndexController::class, 'typeFormPractitioner'])->name('view-type-form-practitioner');
    Route::get('/view-type-form-practitioner-view/{id}', [IndexController::class, 'typeFormPractitionerView'])->name('view-type-form-practitioner-view');


    // Practitioner
    Route::match(['get', 'post'],'/profile-practitioner/{protocolId?}/{service_id?}', [PractitionersController::class, 'profilePractitioner'])->name('profile-practitioner');
    Route::get('/edit-profile-practitioner', [PractitionersController::class, 'EditProfilePractitioner'])->name('edit-profile-practitioner');
    Route::get('/my-appointments-practitioners/{id}', [PractitionersController::class, 'myAppointmentsPractitioners'])->name('my-appointments-practitioners');
    Route::post('/edit-profile-practitioner-post', [PractitionersController::class, 'EditProfilePractitionerPost'])->name('edit-profile-practitioner-post');
    Route::post('/add-lang-practitioner', [PractitionersController::class, 'addLang'])->name('add-lang-practitioner');
    Route::post('/delete-lang-practitioner', [PractitionersController::class, 'deleteLang'])->name('delete-lang-practitioner');
    Route::get('/delete-photo-video/{id}', [PractitionersController::class, 'deletePhotoVideo'])->name('delete-photo-video');

    // Add free date time calendar Practitioner
    Route::post('/add-free-date-practitioner-calendar', [PractitionersController::class, 'calendarAddFreeDate'])->name('add-free-date-practitioner-calendar');
    Route::post('/free-date-time-delete', [PractitionersController::class, 'calendarDeleteFreeDate'])->name('free-date-time-delete');
    Route::post('/free-date-time-update', [PractitionersController::class, 'calendarEditFreeDate'])->name('free-date-time-update');


    // Type Form
    Route::get('/type-form-practitioner', [PractitionersController::class, 'typeFormPractitioner'])->name('type-form-practitioner');
    Route::get('/type-form-practitioner-view/{id}', [PractitionersController::class, 'typeFormPractitionerView'])->name('type-form-practitioner-view');
    Route::match(['get', 'post'],'/default-type-form-practitioner-view/{id}', [PractitionersController::class, 'DefaultTypeFormPractitioner'])->name('default-type-form-practitioner-view');
    Route::post('/add-type-form-practitioner', [PractitionersController::class, 'addTypeFormPractitioner'])->name('add-type-form-practitioner');
    Route::post('/edit-type-form-practitioner', [PractitionersController::class, 'editTypeFormPractitioner'])->name('edit-type-form-practitioner');
    Route::post('/delete-type-form-practitioner', [PractitionersController::class, 'deleteTypeFormPractitioner'])->name('delete-type-form-practitioner');
    Route::get('/customer-type-form-practitioner-view/{id}/{meeting_id}', [CustomerController::class, 'typeFormPractitionerView'])->name('customer-type-form-practitioner-view');

    // Tag
    Route::post('/add-tag-my-list-management', [PractitionersController::class, 'addTagMyListManagements'])->name('add-tag-my-list-management');
    Route::post('/add-tag-management', [PractitionersController::class, 'addTagManagements'])->name('add-tag-management');
    Route::post('/delete-tag-management', [PractitionersController::class, 'deleteTeg'])->name('delete-tag-management');

    // Customers
    Route::get('/profile-customer', [CustomerController::class, 'profileCustomer'])->name('profile-customer');
    Route::get('/edit-profile-customer', [CustomerController::class, 'editProfileCustomer'])->name('edit-profile-customer');
    Route::post('/edit-profile-customer-post', [CustomerController::class, 'editProfileCustmerPost'])->name('edit-profile-customer-post');
    Route::post('/add-favorite', [CustomerController::class, 'addFavorite'])->name('add-favorite');
    Route::post('/edit-response-id', [CustomerController::class, 'editTypeForm'])->name('edit-response-id');
    // Add Star
    Route::post('/add-star', [CustomerController::class, 'addStarPractitioner'])->name('add-star');
    Route::post('/add-review', [CustomerController::class, 'addReview'])->name('add-review');

    // Protocol
    Route::match(['get', 'post'],'/my-appointments-customer/{id}/{practitionrers?}/{service_name?}/{date_time?}/{price?}', [CustomerController::class, 'myAppointmentsCustomer'])->name('my-appointments-customer');
    Route::get('/view-protocol-customer/{service_id}/{user_id}/{practitioner_id}/{meeting_id}', [CustomerController::class, 'ViewProtocol'])->name('view-protocol-customer');
    Route::post('/add-select-another/{practitioner_id}/{service_id}', [CustomerController::class, 'addSelectProtocol'])->name('add-select-another');


    // ZOOM
    Route::match(['get', 'post'],'/zoom', [ZoomController::class, 'index'])->name('meetings-list-zoom');
    Route::post('/add-zoom-meeting', [ZoomController::class, 'addZoomMeeting'])->name('add-zoom-meeting');
    Route::post('/delete-zoom-meeting', [ZoomController::class, 'deleteZoomMeeting'])->name('zoom-delete');
    Route::post('/delete-zoom-meeting-table', [ZoomController::class, 'deleteZoomMeetingTable'])->name('zoom-delete-table');
    Route::get('/confirm-meeting/{Code}/{Status}/{email}/{title}/{first_name}/{last_name}', [PractitionersController::class, 'confirmMeeting'])->name('confirm-meeting');

    Route::post('/update-zoom-meeting', [ZoomController::class, 'update'])->name('update-zoom-meeting');

    Route::get('/test', [ZoomController::class, 'test'])->name('test');


    // Offline
    Route::post('/add-offline-meeting', [ZoomController::class, 'addOfflineMeeting'])->name('add-offline-meeting');
    Route::post('/update-offline-meeting', [ZoomController::class, 'updateOffline'])->name('update-offline-meeting');

    // Practitioners
    Route::post('/custom-registration', [AuthPractitionersController::class, 'customRegistration'])->name('register.custom');
    Route::get('/get-city/{country_id}', [AuthPractitionersController::class, 'city'])->name('get-city');
    Route::post('/custom-login', [AuthPractitionersController::class, 'customLogin'])->name('login.custom');
    Route::get('/custom-logout', [AuthPractitionersController::class, 'LogOut'])->name('logout.custom');

    // Auth Practitioners
    Route::get('/login-practitioners', [AuthPractitionersController::class, 'login'])->name('login-practitioners');
    Route::get('/register-practitioners', [AuthPractitionersController::class, 'register'])->name('register-practitioners');

    // Resset Password Practitioners
    Route::get('/forget-password-view', 'ForgotPasswordController@getEmail')->name("forget-password-view");
    Route::post('/forget-password-practitioners', 'ForgotPasswordController@postEmail')->name("forget-password-practitioners");
    Route::get('/reset-password-practitioners/{token}', 'ResetPasswordController@getPassword')->name("reset-password-view");
    Route::post('/reset-password-practitioners', 'ResetPasswordController@updatePassword')->name("reset-password-practitioners");

    // Auth User
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

    // Resset Password Users
    Route::get('/forget-password', [PasswordResetLinkController::class, 'create'])->name('forget-password');
    Route::post('/password.reset', [PasswordResetLinkController::class, 'store'])->name('password.reset');
    Route::get('/password.reset/{token}', [NewPasswordController::class, 'create']);
    Route::post('/password.update', [NewPasswordController::class, 'store'])->name('password.update');


    // Service Practitioners
    Route::post('/add-service', [PractitionersController::class, 'addService'])->name('add-service');
    Route::post('/edit-service', [PractitionersController::class, 'editService'])->name('edit-service');
    Route::post('/delete-service', [PractitionersController::class, 'deleteService'])->name('delete-service');


    // Practitioners Protocol
    Route::get('/protocol/{user_id}/{service_id}', [PractitionersController::class, 'protocol'])->name('protocol');
    Route::post('/add-protocol', [PractitionersController::class, 'AddProtocol'])->name('add-protocol');
    Route::post('/delete-protocol/', [PractitionersController::class, 'deleteProtocol'])->name('delete-protocol');
    Route::get('/view-protocol-practitioner/{service_id}/{user_id}/{practitioner_id}/{meeting_id}', [PractitionersController::class, 'ViewProtocol'])->name('view-protocol-practitioner');
    Route::get('/add-edit-protocol-practitioner/{service_id}/{user_id}/{practitioner_id}/{meeting_id}', [PractitionersController::class, 'addEditProtocol'])->name('add-edit-protocol-practitioner');
    Route::get('/edit-protocol-practitioner-view/{service_id}/{user_id}/{practitioner_id}/{meeting_id}', [PractitionersController::class, 'EditProtocolView'])->name('edit-protocol-practitioner-view');

    Route::get('/edit-view-protocol/{service_id}/{user_id}/{practitioner_id}/{meeting_id}', [PractitionersController::class, 'EditViewProtocol'])->name('edit-view-protocol');
    Route::post('/edit-protocol', [PractitionersController::class, 'EditProtocol'])->name('edit-protocol');

    Route::post('/view-protocol-practitioner-ajax', [PractitionersController::class, 'getDataProtocolAjax'])->name('view-protocol-practitioner-ajax');

    Route::get('/edit-protocol-view', [PractitionersController::class, 'editProtocolView'])->name('edit-protocol-view');

    Route::post('autocomplete', [PractitionersController::class, 'getAutocomplete'])->name('autocomplete');


    // login
    Route::get('/customer-redirect/{id}', 'LoginGoogleCustommerController@redirect');
    Route::get('/callback/google/', 'LoginGoogleCustommerController@callback');



    // Testing

//      Route::get('/redirect', 'SocialController@redirect');
//      Route::get('/callback/google', 'SocialController@callback');
//     Route::get('/indexx', 'SocialController@index');
//
//    Route::get('redirect', [SocialController::class, 'redirect']);
//    Route::get('callback/google', [SocialController::class, 'callback']);

    // Calendar
//    Route::get('calendar', [CalendarController::class, 'index']);



//    Route::get('/search-go/', [IndexController::class, 'searchHome'])->name('search-go');
    Route::post('/search-go/', [IndexController::class, 'searchHome'])->name('search-go');


});
Route::get('/transaction-page', [PaymentController::class, 'index']);
Route::post('/transaction', [PaymentController::class, 'makePayment'])->name('make-payment');
Route::post('/add-card', [PaymentController::class, 'addCard'])->name('add-card');
Route::post('/add-card-practitioner', [PaymentController::class, 'addCardPractitioner'])->name('add-card-practitioner');
Route::post('/remove-card/{id}', [PaymentController::class, 'removeCard'])->name('remove-card');
Route::get('/remove-card-practitioner', [PractitionersController::class, 'removeCardPractitioner'])->name('remove-card-practitioner');

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});


// require __DIR__.'/auth.php';
