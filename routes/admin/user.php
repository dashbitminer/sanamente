<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\User\Index\Page as ListingUser;

Route::middleware(['auth'])->prefix('admin')->group(function () {

     Route::get('users', ListingUser::class)->name('admin.users.index');
     Route::get('users/create', \App\Livewire\Admin\User\Create\Page::class)->name('admin.users.create');

    // Route::get('users/{user}/edit', \App\Http\Livewire\Admin\User\Edit::class)->name('admin.users.edit');
    // Route::get('users/{user}/show', \App\Http\Livewire\Admin\User\Show::class)->name('admin.users.show');
    // Route::get('users/{user}/delete', \App\Http\Livewire\Admin\User\Delete::class)->name('admin.users.delete');

    // Route::get('users/{user}/restore', \App\Http\Livewire\Admin\User\Restore::class)->name('admin.users.restore');
    // Route::get('users/{user}/force-delete', \App\Http\Livewire\Admin\User\ForceDelete::class)->name('admin.users.force-delete');
    // Route::get('users/{user}/confirm-password', \App\Http\Livewire\Admin\User\ConfirmPassword::class)->name('admin.users.confirm-password');
    // Route::get('users/{user}/two-factor-authentication', \App\Http\Livewire\Admin\User\TwoFactorAuthentication::class)->name('admin.users.two-factor-authentication');
    // Route::get('users/{user}/session-management', \App\Http\Livewire\Admin\User\SessionManagement::class)->name('admin.users.session-management');
    // Route::get('users/{user}/browser-sessions', \App\Http\Livewire\Admin\User\BrowserSessions::class)->name('admin.users.browser-sessions');
    // Route::get('users/{user}/delete-other-browser-sessions', \App\Http\Livewire\Admin\User\DeleteOtherBrowserSessions::class)->name('admin.users.delete-other-browser-sessions');
    // Route::get('users/{user}/delete-browser-session', \App\Http\Livewire\Admin\User\DeleteBrowserSession::class)->name('admin.users.delete-browser-session');
    // Route::get('users/{user}/delete-sessions', \App\Http\Livewire\Admin\User\DeleteSessions::class)->name('admin.users.delete-sessions');
    // Route::get('users/{user}/delete-other-sessions', \App\Http\Livewire\Admin\User\DeleteOtherSessions::class)->name('admin.users.delete-other-sessions');


});
