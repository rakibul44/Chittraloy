<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminApiController;

// === Admin API (protected by web session auth) ===
Route::get('/admin/data', [AdminApiController::class, 'index']);
Route::post('/admin/hero', [AdminApiController::class, 'saveHero']);
Route::post('/admin/projects', [AdminApiController::class, 'saveProject']);
Route::post('/admin/gallery', [AdminApiController::class, 'saveGallery']);
Route::post('/admin/packages', [AdminApiController::class, 'savePackage']);
Route::post('/admin/testimonials', [AdminApiController::class, 'saveTestimonial']);
Route::post('/admin/inquiries/{id}/status', [AdminApiController::class, 'updateInquiryStatus']);
Route::post('/admin/contacts/{id}/status', [AdminApiController::class, 'updateContactStatus']);
Route::post('/admin/settings', [AdminApiController::class, 'saveSettings']);
Route::delete('/admin/{model}/{id}', [AdminApiController::class, 'deleteItem']);

// === Public form submissions ===
Route::post('/inquiries', [AdminApiController::class, 'storeInquiry']);
Route::post('/contacts', [AdminApiController::class, 'storeContact']);
