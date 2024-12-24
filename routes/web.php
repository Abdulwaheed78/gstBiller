<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\baseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [baseController::class, 'index'])->name('index');
Route::post('/login', [baseController::class, 'login'])->name('login');
Route::post('/reset-password', [baseController::class, 'sendPasswordResetEmail'])->name('reset-password');
Route::get('/change_password',[baseController::class,'change_password'])->name('change.pasword');
Route::post('/verify_change', [baseController::class, 'verify_change'])->name('change.verify');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function () {
    //Pure admin and Vendor routes
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admins', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/add', [AdminController::class, 'add_admin'])->name('admin.add');
    Route::post('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/destroy/{id}', [AdminController::class, 'destroy_user'])->name('admin.destroy');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/admin/update-profile/{id}', [AdminController::class, 'update_profile'])->name('admin.update.profile');

    //Bills Route
    Route::get('/bills/index', [AdminController::class, 'bills'])->name('admin.bills.index');
    Route::get('/bills/add', [AdminController::class, 'bill_add'])->name('admin.bills.add');
    Route::post('/bills/create', [AdminController::class, 'bill_create'])->name('admin.bills.create');
    Route::get('/bills/edit/{id}', [AdminController::class, 'bill_edit'])->name('admin.bills.edit');
    Route::post('/bills/update/{id}', [AdminController::class, 'bill_update'])->name('admin.bills.update');
    Route::delete('/bills/destroy/{id}', [AdminController::class, 'bill_destroy'])->name('admin.bills.destroy');

    //bill products routes
    Route::get('/bills/add-products/{id}', [AdminController::class, 'bill_add_product'])->name('admin.bills.addpro');
    Route::post('/bills/create-products/{id}', [AdminController::class, 'bill_create_product'])->name('admin.bills.createpro');
    Route::get('/bills/edit-products/{id}', [AdminController::class, 'bill_edit_product'])->name('admin.bills.editpro');
    Route::post('/bills/update-products/{id}', [AdminController::class, 'bill_update_product'])->name('admin.bills.updatepro');
    Route::get('/admin/destroy_products/{id}', [AdminController::class, 'bills_destroy_product'])->name('admin.bills.destroypro');

    //additional bill routes
    Route::get('/bills/show/{id}', [AdminController::class, 'bill_show'])->name('admin.bills.show');
    Route::get('/bills/invoice/{id}/generate', [AdminController::class, 'generateInvoice'])->name('admin.bills.download');
    Route::get('/bills/mail/{data}', [AdminController::class, 'sendInvoice'])->name('admin.bills.mail');

    // Logout and Log File routes here
    Route::get('/logs', [AdminController::class, 'logs'])->name('admin.logs');
    Route::post('/logout', [baseController::class, 'logout'])->name('admin.logout');
});

Route::group(['prefix' => 'vendor', 'middleware' => ['auth', 'isVendor']], function () {
    Route::get('/dashboard', [VendorController::class, 'dashboard'])->name('vendor.dashboard');
    Route::get('/vendor/profile', [VendorController::class, 'profile'])->name('vendor.profile');
    Route::post('/vendor/update-profile/{id}', [VendorController::class, 'update_profile'])->name('vendor.update.profile');

    // Add more vendor routes here

    // Bills Routes
    Route::get('/bills/index', [VendorController::class, 'bills'])->name('vendor.bills.index');
    Route::get('/bills/add', [VendorController::class, 'bill_add'])->name('vendor.bills.add');
    Route::post('/bills/create', [VendorController::class, 'bill_create'])->name('vendor.bills.create');
    Route::get('/bills/edit/{id}', [VendorController::class, 'bill_edit'])->name('vendor.bills.edit');
    Route::post('/bills/update/{id}', [VendorController::class, 'bill_update'])->name('vendor.bills.update');
    Route::delete('/bills/destroy/{id}', [VendorController::class, 'bill_destroy'])->name('vendor.bills.destroy');

    // Bill Products Routes
    Route::get('/bills/add-products/{id}', [VendorController::class, 'bill_add_product'])->name('vendor.bills.addpro');
    Route::post('/bills/create-products/{id}', [VendorController::class, 'bill_create_product'])->name('vendor.bills.createpro');
    Route::get('/bills/edit-products/{id}', [VendorController::class, 'bill_edit_product'])->name('vendor.bills.editpro');
    Route::post('/bills/update-products/{id}', [VendorController::class, 'bill_update_product'])->name('vendor.bills.updatepro');
    Route::get('/bills/destroy-products/{id}', [VendorController::class, 'bills_destroy_product'])->name('vendor.bills.destroypro');

    //additional bill routes
    Route::get('/bills/show/{id}', [VendorController::class, 'bill_show'])->name('vendor.bills.show');
    Route::get('/bills/invoice/{id}/generate', [VendorController::class, 'generateInvoice'])->name('vendor.bills.download');
    Route::get('/bills/mail/{data}', [VendorController::class, 'sendInvoice'])->name('vendor.bills.mail');


    Route::post('/logout', [baseController::class, 'logout'])->name('vendor.logout');
});
