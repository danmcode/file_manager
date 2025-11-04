<?php

use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')
    ->group(function () {
        Route::get(
            '/profile',
            [ProfileController::class, 'edit']
        )->name('profile.edit');

        Route::patch(
            '/profile',
            [ProfileController::class, 'update']
        )->name('profile.update');

        Route::delete(
            '/profile',
            [ProfileController::class, 'destroy']
        )->name('profile.destroy');

        Route::get(
            '/users',
            [UserController::class, 'index']
        )->name('users');

        Route::get(
            '/users/create',
            [UserController::class, 'create']
        )->name('users.create');

        Route::post(
            '/users/store',
            [UserController::class, 'store']
        )->name('users.store');

        Route::get(
            '/users/{id}/edit',
            [UserController::class, 'edit']
        )->name('users.edit');

        Route::patch(
            '/users/{user}',
            [UserController::class, 'update']
        )->name('users.update');

        Route::delete(
            '/users/{user}',
            [UserController::class, 'destroy']
        )->name('users.destroy');

        Route::get(
            '/users/get',
            [UserController::class, 'getUsers']
        )->name('users.get');

        // Groups
        Route::get(
            '/groups',
            [GroupController::class, 'index']
        )->name('groups');

        Route::get(
            '/groups/create',
            [GroupController::class, 'create']
        )->name('groups.create');

        Route::post(
            '/groups/store',
            [GroupController::class, 'store']
        )->name('groups.store');

        Route::get(
            '/groups/{id}/edit',
            [GroupController::class, 'edit']
        )->name('groups.edit');

        Route::patch(
            '/groups/{group}',
            [GroupController::class, 'update']
        )->name('groups.update');

        Route::delete(
            '/groups/{group}',
            [GroupController::class, 'destroy']
        )->name('groups.destroy');

        Route::get(
            '/groups/get',
            [GroupController::class, 'getGroups']
        )->name('groups.get');

        // Roles
        Route::get(
            '/roles',
            [RoleController::class, 'index']
        )->name('roles');

        Route::get(
            '/roles/create',
            [RoleController::class, 'create']
        )->name('roles.create');

        Route::post(
            '/roles/store',
            [RoleController::class, 'store']
        )->name('roles.store');

        Route::get(
            '/roles/{id}/edit',
            [RoleController::class, 'edit']
        )->name('roles.edit');

        Route::patch(
            '/roles/{role}',
            [RoleController::class, 'update']
        )->name('roles.update');

        Route::delete(
            '/roles/{role}',
            [RoleController::class, 'destroy']
        )->name('roles.destroy');

        Route::get(
            '/roles/get',
            [RoleController::class, 'getRoles']
        )->name('roles.get');

        Route::post(
            '/files',
            [FileController::class, 'store']
        )->name('files.store');


    });

require __DIR__ . '/auth.php';