<?php

use App\Livewire\BuscadorPersonas\Index\Page as BuscadorIndex;
use Illuminate\Support\Facades\Route;


Route::get('/admin/buscador-personas', BuscadorIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('admin.buscador-personas.index');
