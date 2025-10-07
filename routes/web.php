<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', fn() => 'Central app (no tenant)'); // central

// Everything under /t/{tenant} is tenant-aware
Route::middleware('tenant')->prefix('t/{tenant}')->group(function () {
    Route::get('/', function () {
        // Example: prove which tenant you’re in
        return 'Tenant ID: ' . tenant('id');
    });

    // Add your tenant routes here…
    Route::get('/hello', fn() => 'Hello from '.tenant('id'));
});

