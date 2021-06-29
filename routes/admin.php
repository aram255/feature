<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PractitionerController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\ImageController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Admin Auth
Route::get('/',[AuthController::class, 'getLogin'])->name('adminLogin');
Route::post('/login', [AuthController::class, 'postLogin'])->name('adminLoginPost');
Route::get('/logout', [AuthController::class, 'logout'])->name('adminLogout');

Route::group(['middleware' => 'adminauth'], function () {
	// Admin Dashboard
    Route::get('dashboard',[AdminController::class, 'dashboard'])->name('dashboard');

    // Practitioners
    Route::match(['get', 'post'],'practitioners',[PractitionerController::class, 'index'])->name('adminPractitioners');
    Route::get('practitioners-data',[PractitionerController::class, 'data'])->name('practitionersData');
    Route::get('practitioners-edit',[PractitionerController::class, 'edit'])->name('practitionersEdit');
    Route::post('change-status',[PractitionerController::class, 'changeStatus'])->name('changeStatus');

    Route::get('clients',[ClientController::class, 'index'])->name('adminClients');
    Route::get('clients-data',[ClientController::class, 'data'])->name('clientsData');
    Route::get('clients-edit',[ClientController::class, 'edit'])->name('clientsEdit');

    //Content
    //Practices
    Route::get('practices',[ContentController::class, 'indexPractices'])->name('adminPractices');
    Route::get('practices-data',[ContentController::class, 'dataPractices'])->name('adminDataPractices');
    Route::get('practices-publish',[ContentController::class, 'publishPractices'])->name('adminPracticesPublish');
    Route::get('practices-get',[ContentController::class, 'getPractices'])->name('adminPracticesGet');
    Route::post('practices-save',[ContentController::class, 'savePractices'])->name('adminSavePractices');
    Route::post('practices-remove',[ContentController::class, 'removePractices'])->name('adminRemovePractices');

    // Teg Managements
    Route::get('practices-teg-management',[ContentController::class, 'tegManagement'])->name('adminPracticesTegManagement');
    Route::post('add-practices-teg-management',[ContentController::class, 'AddTegManagements'])->name('adminAddPracticesTegManagement');
    Route::post('edit-practices-teg-management',[ContentController::class, 'editTegManagements'])->name('adminEditPracticesTegManagement');
    Route::post('delete-practices-teg-management',[ContentController::class, 'DeleteTegManagements'])->name('adminDeletePracticesTegManagement');

    // Category
    Route::get('category',[ContentController::class, 'category'])->name('adminCategory');
    Route::post('add-category',[ContentController::class, 'addCategory'])->name('adminAddCategory');
    Route::post('edit-category',[ContentController::class, 'editCategory'])->name('adminEditCategory');
    Route::post('delete-category',[ContentController::class, 'deleteCategory'])->name('adminDeleteCategory');
     // edit title category
    Route::post('edit-title-category',[ContentController::class, 'editTitleCategory'])->name('adminEditTitleCategory');

    //Specialities
    Route::get('specialities',[ContentController::class, 'indexSpecialities'])->name('adminSpecialities');
    Route::get('specialities-data',[ContentController::class, 'dataSpecialities'])->name('adminDataSpecialities');
    Route::get('specialities-publish',[ContentController::class, 'publishSpecialities'])->name('adminSpecialitiesPublish');
    Route::get('specialities-get',[ContentController::class, 'getSpecialities'])->name('adminSpecialitiesGet');
    Route::post('specialities-save',[ContentController::class, 'saveSpecialities'])->name('adminSaveSpecialities');
    Route::post('specialities-remove',[ContentController::class, 'removeSpecialities'])->name('adminRemoveSpecialities');
    //Blog
    Route::get('blog',[ContentController::class, 'indexBlog'])->name('adminBlog');
    Route::get('blog-data',[ContentController::class, 'dataBlog'])->name('adminBlogData');
    Route::get('blog-publish',[ContentController::class, 'publishBlog'])->name('adminBlogPublish');
    Route::get('blog-get',[ContentController::class, 'getBlog'])->name('adminBlogGet');
    Route::post('blog-save',[ContentController::class, 'saveBlog'])->name('adminBlogSave');
    Route::post('blog-remove',[ContentController::class, 'removeBlog'])->name('adminBlogRemove');

    // Admin profile
    Route::get('profile',[AdminController::class, 'profile'])->name('adminProfile');
    Route::post('save-profile',[AuthController::class, 'saveProfile'])->name('adminSaveProfile');
    Route::post('change-password',[AuthController::class, 'changePassword'])->name('adminChangePassword');

    Route::post('upload',[ImageController::class, 'upload'])->name('adminUploadImage');
    Route::post('remove',[ImageController::class, 'remove'])->name('adminRemoveImage');
});
