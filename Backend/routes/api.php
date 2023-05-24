<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PlanetsController;
use App\Http\Controllers\VehiclesController;

// rutas de libre acceso
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [RegisterController::class, 'store'])->name('register');

// Rutas protegidas por autenticación JWT
Route::middleware('jwt.auth')->group(function () {

    // router get people
    Route::get('/people', [PeopleController::class, 'getAllPeople'])->name('getAllPeople');
    Route::get('/people/{id}', [PeopleController::class, 'getOnePeople'])->name('getOnePeople');

    // router get planets
    Route::get('/planets', [PlanetsController::class, 'getAllPlanets'])->name('getAllPlanets');
    Route::get('/planet/{id}', [PlanetsController::class, 'getOnePlanet'])->name('getOnePlanet');

    // router get vehicles
    Route::get('/vehicles', [VehiclesController::class, 'getAllVehicles'])->name('getAllVehicles');
    Route::get('/vehicle/{id}', [VehiclesController::class, 'getOneVehicle'])->name('getOneVehicle');
});
