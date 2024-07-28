<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('app'); // Ensure this view loads your Vue.js app
})->where('any', '.*');
