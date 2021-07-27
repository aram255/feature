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

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\FullCalenderController;

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
    Route::match(['get', 'post'],'Search', [IndexController::class, 'search'])->name('search');
    Route::match(['get', 'post'],'reset-field', [IndexController::class, 'resetField'])->name('reset-field');
    Route::get('/blog', [IndexController::class, 'blog'])->name('blog');
    Route::get('/balance', [IndexController::class, 'balance'])->name('balance');
    // Practitioner
    Route::get('/profile-practitioner', [PractitionersController::class, 'profilePractitioner'])->name('profile-practitioner');
    Route::get('/edit-profile-practitioner', [PractitionersController::class, 'EditProfilePractitioner'])->name('edit-profile-practitioner');
    Route::get('/my-appointments-practitioners', [PractitionersController::class, 'myAppointmentsPractitioners'])->name('my-appointments-practitioners');

    // Type Form
    Route::get('/type-form-practitioner', [PractitionersController::class, 'typeFormPractitioner'])->name('type-form-practitioner');
    Route::get('/type-form-practitioner-view/{id}', [PractitionersController::class, 'typeFormPractitionerView'])->name('type-form-practitioner-view');
    Route::post('/add-type-form-practitioner', [PractitionersController::class, 'addTypeFormPractitioner'])->name('add-type-form-practitioner');
    Route::post('/edit-type-form-practitioner', [PractitionersController::class, 'editTypeFormPractitioner'])->name('edit-type-form-practitioner');
    Route::post('/delete-type-form-practitioner', [PractitionersController::class, 'deleteTypeFormPractitioner'])->name('delete-type-form-practitioner');

    // Tag
    Route::post('/add-tag-my-list-management', [PractitionersController::class, 'addTagMyListManagements'])->name('add-tag-my-list-management');
    Route::post('/add-tag-management', [PractitionersController::class, 'addTagManagements'])->name('add-tag-management');
    Route::post('/delete-tag-management', [PractitionersController::class, 'deleteTeg'])->name('delete-tag-management');

    // Customers
    Route::get('/profile-customer', [CustomerController::class, 'profileCustomer'])->name('profile-customer');
    Route::get('/edit-profile-customer', [CustomerController::class, 'editProfileCustomer'])->name('edit-profile-customer');
    Route::post('/edit-profile-customer-post', [CustomerController::class, 'editProfileCustmerPost'])->name('edit-profile-customer-post');
    Route::get('/profile-view-customer', [CustomerController::class, 'profileViewCustomer'])->name('profile-view-customer');

    // ZOOM
    Route::match(['get', 'post'],'/zoom', [ZoomController::class, 'index'])->name('meetings-list-zoom');
    Route::post('/add-zoom-meeting', [ZoomController::class, 'addZoomMeeting'])->name('add-zoom-meeting');
    Route::post('/delete-zoom-meeting', [ZoomController::class, 'deleteZoomMeeting'])->name('zoom-delete');

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
    Route::get('/delete-service/{id}', [PractitionersController::class, 'deleteService'])->name('delete-service');


    // login

//     Route::get('/redirect', 'SocialController@redirect');
//     Route::get('/callback/google', 'SocialController@callback');
     Route::get('/index', 'SocialController@index');

    Route::get('redirect', [SocialController::class, 'redirect']);
    Route::get('callback/google', [SocialController::class, 'callback']);

    // Calendar
    Route::get('calendar', [CalendarController::class, 'index']);


    //calendar full
    Route::get('full-calender', [FullCalenderController::class, 'index']);

    Route::post('full-calender/action', [FullCalenderController::class, 'action'])->name('kk');

});
Route::get('/transaction-page', [PaymentController::class, 'index']);
Route::post('/transaction', [PaymentController::class, 'makePayment'])->name('make-payment');
Route::post('/add-card', [PaymentController::class, 'addCard'])->name('add-card');
Route::post('/remove-card/{id}', [PaymentController::class, 'removeCard'])->name('remove-card');
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});


// require __DIR__.'/auth.php';
