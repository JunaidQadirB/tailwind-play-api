<?php

use App\Models\Playground;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/playgrounds/{playground:uuid}', fn (Playground $playground) => $playground);

Route::post('/playgrounds', function (Request $request) {
    return Playground::forceCreate($request->validate([
        'uuid' => 'required|string',
        'html' => 'required|string',
        'css' => 'required|string',
        'config' => 'required|string',
    ]));
})->middleware(['throttle:api']);
