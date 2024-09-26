<?php

use App\Http\Controllers\ListsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('lists');
// });

Route::get('/' , [ListsController::class , 'lists'])->name('lists');
Route::post('/storeLists', [ListsController::class , 'storeLists'])->name('storeLists');
Route::patch('/{listId}', [ListsController::class , 'editList'])->name('editList');
Route::delete('/{listId}', [ListsController::class , 'deleteList'])->name('deleteList');

Route::get('/done}', [ListsController::class , 'filterLists'])->name('lists.done')->defaults('status', 'done');;
Route::get('/progress}', [ListsController::class , 'filterLists'])->name('lists.progress')->defaults('status', 'progress');;