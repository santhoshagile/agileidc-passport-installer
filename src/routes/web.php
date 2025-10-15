<?php

use Illuminate\Support\Facades\Route;

Route::get('/passport-setup', function () {
    return response()->json(['message' => 'Passport is installed and running!']);
});
