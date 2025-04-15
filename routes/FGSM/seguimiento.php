<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\FGSM\Index\Page as IndexSeguimiento;
use App\Livewire\FGSM\Public\SeguimientoFormacionGeneral;
use App\Livewire\FGSM\Public\SeguimientoFormacionGeneralEdit;
use App\Livewire\FGSM\Public\SeguimientoFormacionGeneralPolicia;
use App\Livewire\FGSM\Public\SeguimientoFormacionGeneralEditPolicia;


Route::get('/pais/{pais}/formacion-general/{uuid}/{email}', SeguimientoFormacionGeneral::class)->name('seguimiento.create');

Route::get('/pais/{pais}/formacion-general-policia/{uuid}/{email}', SeguimientoFormacionGeneralPolicia::class)->name('seguimiento.create.policia');

Route::get('/pais/{pais}/seguimiento/{id}/formacion-general/{codigo}', SeguimientoFormacionGeneralEdit::class)->name('seguimiento.edit');

Route::get('/pais/{pais}/seguimiento/{id}/formacion-general-policia/{codigo}', SeguimientoFormacionGeneralEditPolicia::class)->name('seguimiento.edit.policia');

Route::group(['middleware' => ['auth']], function () {
    //Route::get('admin/pais/{pais}/seguimiento/{id}/formacion-general/{codigo}', SeguimientoFormacionGeneralEdit::class)->name('admin.seguimiento.edit');
    Route::get('admin/seguimiento-formacion-general', IndexSeguimiento::class)->name('admin.seguimiento.index');
    //Route::get('admin/pais/{pais}/fgsm/create', IndexSeguimiento::class)->name('seguimiento.create');
    // Route::get('admin/pais/{pais}/fgsm/grupos', GruposParticipantes::class)->name('grupos');
    // Route::get('admin/pais/{pais}/fgsm/grupos/{grupo}', GrupoDetalle::class)->name('grupo');
});
