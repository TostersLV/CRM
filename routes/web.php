<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnalystController;
use App\Http\Controllers\BrokerController;
use App\Http\Controllers\InspectorController;
use Illuminate\Support\Facades\Route;

Route::get('admin', [AdminController::class, 'index'])->middleware(['auth', 'can:viewAdmin'])->name('roleviews.admin');

Route::get('admin/users/{user}/edit', [AdminController::class, 'edit'])->middleware(['auth', 'can:viewAdmin'])->name('admin.users.edit');

Route::put('admin/users/{user}', [AdminController::class, 'update'])
    ->middleware(['auth', 'can:viewAdmin'])
    ->name('admin.users.update');


Route::get('analyst', [AnalystController::class, 'index'])
    ->middleware(['auth', 'can:viewAnalyst'])
    ->name('roleviews.analyst');

Route::get('analyst/screening-cases', [AnalystController::class, 'screeningCases'])
    ->middleware(['auth', 'can:viewAnalyst']);

Route::patch('analyst/cases/{caseId}', [AnalystController::class, 'update'])->middleware(['auth', 'can:viewAnalyst'])->name('roleview.analyst');
Route::patch('inspector/cases/{caseId}', [InspectorController::class, 'update'])->middleware(['auth', 'can:viewInspector'])->name('roleview.inspector');
    




Route::get('broker', [BrokerController::class, 'index'])
    ->middleware(['auth', 'can:viewBroker'])
    ->name('roleviews.broker');

Route::patch('broker/cases/{caseId}/screening', [BrokerController::class, 'sendToScreening'])
    ->middleware(['auth', 'can:viewBroker'])
    ->name('broker.cases.screening');

    


Route::get('inspector', [InspectorController::class, 'index'])->middleware(['auth', 'can:viewInspector'])->name('roleviews.inspector');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
