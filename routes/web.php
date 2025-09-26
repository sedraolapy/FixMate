<?php

use App\Http\Controllers\Auth\CustomerPasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GovernmentEntity\GovernmentEntityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\Offer\OfferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceProvider\ServiceProviderController;
use App\Http\Controllers\Settings\AboutUsController;
use App\Http\Controllers\Settings\ContactUsController;
use App\Http\Controllers\Settings\PrivacyPolicyController;
use App\Http\Controllers\SubCategory\SubCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

//guest
Route::get('/', function () {return view('welcome');})->name('welcome');
Route::get('/dashboard', [HomeController::class , 'dashboard'])->name('dashboard');

//service providers
Route::get('/apply-provider', [ServiceProviderController::class, 'create'])->name('providers.apply.form');
Route::post('/apply-provider', [ServiceProviderController::class, 'store'])->name('providers.apply');
Route::get('/providers', [ServiceProviderController::class, 'index'])->name('providers.index');

//categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

//offers
Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');
Route::get('/offers/store', [OfferController::class, 'store'])->name('offers.store');

//government entities
Route::get('/entities', [GovernmentEntityController::class, 'index'])->name('entities.index');

//settings
Route::get('/privacy-policy', [PrivacyPolicyController::class, 'show'])->name('privacy.policy');
Route::get('/about-us', [AboutUsController::class, 'show'])->name('about.us');
Route::get('/contact-us', [ContactUsController::class, 'show'])->name('contact.us');
Route::post('/contact-us', [ContactUsController::class, 'submit'])->name('contact.submit');
Route::post('/switch-language', [LanguageController::class, 'switch'])->name('language.switch');


Route::middleware('auth:customer')->group(function () {
    Route::get('/sub-categories', [SubCategoryController::class, 'index'])->name('subcategories.index');
    Route::get('/sub-categories/{id}', [SubCategoryController::class, 'show'])->name('subcategories.show');
    Route::get('/providers/{provider}', [ServiceProviderController::class, 'show'])->name('providers.show');

    Route::patch('/notifications/{id}/toggle', [NotificationController::class, 'toggle'])->name('notifications.toggle');
    Route::patch('/notifications/settings', [NotificationController::class, 'updateSettings'])->name('notifications.settings.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});



Route::get('/cities/{state_id}', [RegisterController::class, 'getCities']);
require __DIR__.'/auth.php';
