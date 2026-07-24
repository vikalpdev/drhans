<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\CentreController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\TreatmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/about-us', [AboutController::class, 'index'])->name('about.index');
Route::get('/about-us/chairmans-desk', [AboutController::class, 'chairman'])->name('about.chairman');

Route::get('/speciality-service', [TreatmentController::class, 'index'])->name('treatments.index');
Route::get('/speciality-service/{treatment:slug}', [TreatmentController::class, 'show'])->name('treatments.show');

Route::get('/conditions-treated', [ConditionController::class, 'index'])->name('conditions.index');
Route::get('/conditions-treated/{condition:slug}', [ConditionController::class, 'show'])->name('conditions.show');

Route::get('/specialists', [SpecialistController::class, 'index'])->name('specialists.index');
Route::get('/specialists/{specialist:slug}', [SpecialistController::class, 'show'])->name('specialists.show');

Route::get('/our-centres', [CentreController::class, 'index'])->name('centres.index');

Route::get('/book-appointment', [AppointmentController::class, 'create'])->name('appointment.create');
Route::post('/book-appointment', [AppointmentController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('appointment.store');

Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact-us', [ContactController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('contact.store');

Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/video-gallery', [GalleryController::class, 'videos'])->name('gallery.videos');
