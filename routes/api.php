<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\P_ApprobationController;
use App\Http\Controllers\L_NiveauApprobationController;
use App\Http\Controllers\E_EtatNiveauApprobationController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DemandeCongeController;






Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);


    Route::middleware('auth:api')->group(function (){
    

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/approbations/store',[ P_ApprobationController::class,'store']);
    Route::get('/approbations/index',[ P_ApprobationController::class,'index']);
    Route::put('/approbations/update/{id}',[ P_ApprobationController::class,'update']);
    Route::delete('/approbations/destroy/{id}',[ P_ApprobationController::class,'destroy']);
    Route::post('/niveaux/store', [L_NiveauApprobationController::class,'store']);
    Route::get('/niveaux/index', [L_NiveauApprobationController::class,'index']);
    Route::put('/niveaux/update/{id}', [L_NiveauApprobationController::class,'update']);
    Route::delete('/niveaux/destroy/{id}', [L_NiveauApprobationController::class,'destroy']);
    Route::post('/etats/store', [E_EtatNiveauApprobationController::class,'store']);
    Route::get('/etats/index', [E_EtatNiveauApprobationController::class,'index']);
    Route::put('/etats/update/{id}', [E_EtatNiveauApprobationController::class,'update']);
    Route::delete('/etats/destroy/{id}', [E_EtatNiveauApprobationController::class,'destroy']);
    Route::post('/utilisateurs/store', [UtilisateurController::class,'store']);
    Route::get('/utilisateurs/index', [UtilisateurController::class,'index']);
    Route::put('/utilisateurs/update/{id}', [UtilisateurController::class,'update']);
    Route::delete('/utilisateurs/destroy/{id}', [UtilisateurController::class,'destroy']);
    Route::post('/demandes-conge/store', [DemandeCongeController::class, 'store']);
    Route::get('/demandes-conge/index', [DemandeCongeController::class, 'index']);
    Route::put('/demandes-conge/update/{id}', [DemandeCongeController::class, 'update']);
    Route::delete('/demandes-conge/destroy/{id}', [DemandeCongeController::class, 'destroy']);
});

