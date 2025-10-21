<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\Todocontroller;

Route::middleware('IsGuest')->group(function () {
    Route::get('/',[Todocontroller::class,'login'])->name('login.index');
    Route::post('/login',[Todocontroller::class, 'auth'])->name('login.auth');
    Route::get('/Register',[Todocontroller::class,'Register'])->name('Register');
    Route::post('/Register',[Todocontroller::class,'RegisterAccount'])->name('Register.creatAccount');
});

Route::get('logout',[Todocontroller::class,'logout'])->name('logout');


Route::middleware('Islogin')->prefix('/todo')->name('todo.')->group(function() {
    Route::get('/',[Todocontroller::class,'index'])->name('index');
    Route::get ('/create',[Todocontroller::class,'create'])->name('create');
    Route::post('/store',[Todocontroller::class,'store'])->name('store');
    Route::get ('/edit/{id}',[Todocontroller::class,'edit'])->name('edit');
    Route::patch('/update/{id}',[Todocontroller::class,'update'])->name('update');
    Route::delete('/destroy/{id}',[Todocontroller::class,'destroy'])->name('destroy');
    Route::patch('/complated/{id}',[Todocontroller::class,'updateTocompleted'])->name('update-completed');

});
