<?php

use App\Http\Controllers\MapController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [MapController::class, 'index'])->name('home');

Route::prefix('/api')->group( function(){
    Route::get('/coordinates', function() {
        $coordinates = [
            'latitude' => rand( -33 * 1000000, 5 * 1000000) / 1000000,
            'longitude' => rand( -73 * 1000000, -34 * 1000000) / 1000000,
        ];
        return json_encode($coordinates);
    })->name('map.coordinates');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
