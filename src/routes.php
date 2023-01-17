<?php
Route::group(['middleware' => ['web','auth']], function () {
    Route::resource('/roles', \Vdes\PermisionRoles\RolesController::class);
    Route::resource('/permissions', \Vdes\PermisionRoles\PermissionsController::class);
});