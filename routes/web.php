<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/books', 301);
Route::resource('books', BookController::class);
Route::get('test', function(){
    return 'oke';
});
