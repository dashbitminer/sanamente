<?php
use Illuminate\Support\Facades\Route;

use App\Livewire\ClubNNA\Create\Page AS NuevoClubNNA;
use App\Livewire\ClubNNA\Index\Page AS IndexClubNNA;

Route::get('/pais/{pais}/club-nna/inscripciones', NuevoClubNNA::class)
    //->middleware(['auth', 'verified'])
    ->name('club-nna.nuevo');

Route::get('admin/club-nna', IndexClubNNA::class)
    ->middleware(['auth', 'verified'])
    ->name("club-nna.index");
