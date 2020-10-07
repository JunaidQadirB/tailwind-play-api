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

    $hash = md5(implode('.', $request->only(['html', 'css', 'config'])));

    return Playground::forceCreate(array_merge($request->only(['html', 'css', 'config']), [
        'uuid' => Str::random(10),
        'hash' => $hash,
    ]));

    // New idea
    // return Playground::firstOrCreate(array_merge($request->only(['html', 'css', 'config']), [
    //     'uuid' => Str::random(10)
    // ]));
})->middleware(['throttle:api']);
