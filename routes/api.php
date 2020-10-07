<?php

use App\Models\Playground;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/playgrounds/{playground:uuid}', fn (Playground $playground) => $playground);

Route::post('/playgrounds', function (Request $request) {
    $request->validate([
        'html' => 'required|string',
        'css' => 'required|string',
        'config' => 'required|string',
    ]);

    return Playground::forceCreate(array_merge($request->only(['html', 'css', 'config']), [
        'uuid' => Str::random(16)
    ]));
})->middleware(['throttle:api']);
