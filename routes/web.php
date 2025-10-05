<?php

use App\Http\Controllers\MapController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [MapController::class, 'index'])->name('map.index');

Route::prefix('/api')->group( function(){
    Route::get('/coordinates', function() {
        return response()->json(
            cache('last_coordinates', ['latitude' => null, 'longitude' => null])
        );
    })->name('map.coordinates');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
