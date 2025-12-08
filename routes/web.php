<?php

use Illuminate\Support\Facades\Route;


Route::get('/', App\Livewire\Home::class)->name('home');
Route::get('/tasks', App\Livewire\Tasks::class)->name('tasks');
Route::get('/notes', App\Livewire\Notes::class)->name('notes');
Route::get('/links', App\Livewire\Links::class)->name('links');