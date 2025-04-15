<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Inscripcion\Create\Page as CreateInscripcion;
use App\Livewire\Inscripcion\Edit\Page as EditInscripcion;
use App\Livewire\Inscripcion\Index\Page as Inscripcion;
use App\Livewire\Inscripcion\Create\Policia as PoliciaInscripcion;
use App\Livewire\Inscripcion\Edit\Policia as PoliciaEditInscripcion;

Route::get('/pais/{pais}/inscripcion', CreateInscripcion::class)
    ->name('inscripcion.create');

Route::get('/pais/{pais}/inscripcion/{inscripcion}/edit', EditInscripcion::class)
    ->middleware(['auth', 'verified'])
    ->name('inscripcion.edit');

Route::get('/admin/inscripciones', Inscripcion::class)
    ->middleware(['auth', 'verified'])
    ->name('admin.inscripcion.index');

Route::get('/pais/{pais}/inscripcion-pnc', PoliciaInscripcion::class)
    ->name('inscripcion.create.policia');

Route::get('/pais/{pais}/inscripcion-pnc/{inscripcion}/edit', PoliciaEditInscripcion::class)
    ->middleware(['auth', 'verified'])
    ->name('inscripcion.edit.policia');
