<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Permission\{MenuController, NavigationController, PermissionController, RoleController, RolePermissionController, RoleUserController};
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SecurityController;
use App\Models\Navigation;

Route::prefix("super-admin")->middleware(['role:super admin', "auth"])->group(function () {
  Route::namespace("permission")->group(function () {
    Route::prefix("permission")->group(function () {
      Route::get('/', [PermissionController::class, "index"])->name("permission");
      Route::get('/create', [PermissionController::class, "create"])->name("permission.create");
      Route::post('/create', [PermissionController::class, 'store']);
      Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->name("permission.edit");
      Route::put('/{permission}/edit', [PermissionController::class, 'update']);
      Route::delete('/{permission}/delete', [PermissionController::class, 'destroy'])->name("permission.delete");
    });
    Route::prefix("role")->group(function () {
      Route::get('/', [RoleController::class, "index"])->name("role");
      Route::get('/create', [RoleController::class, "create"])->name("role.create");
      Route::post('/create', [RoleController::class, 'store']);
      Route::get('/{role}/edit', [RoleController::class, 'edit'])->name("role.edit");
      Route::put('/{role}/edit', [RoleController::class, 'update']);
      Route::delete('/{role}/delete', [RoleController::class, 'destroy'])->name("role.delete");
    });
    Route::prefix("role-permission")->group(function () {
      Route::get('/', [RolePermissionController::class, "index"])->name("RolePermission");
      Route::get('/create', [RolePermissionController::class, "create"])->name("RolePermission.create");
      Route::post('/create', [RolePermissionController::class, 'store']);
      Route::get('/{role}/edit', [RolePermissionController::class, 'edit'])->name("RolePermission.edit");
      Route::put('/{role}/edit', [RolePermissionController::class, 'update']);
      Route::delete('/{role}/delete', [RolePermissionController::class, 'destroy'])->name("RolePermission.delete");
    });
    Route::prefix("role-user")->group(function () {
      Route::get('/', [RoleUserController::class, "index"])->name("RoleUser");
      Route::get('/create', [RoleUserController::class, "create"])->name("RoleUser.create");
      Route::post('/create', [RoleUserController::class, 'store']);
      Route::get('/{user}/edit', [RoleUserController::class, 'edit'])->name("RoleUser.edit");
      Route::put('/{user}/edit', [RoleUserController::class, 'update']);
      Route::delete('/{user}/delete', [RoleUserController::class, 'destroy'])->name("RoleUser.delete");
    });
    Route::prefix("navigation")->group(function () {
      Route::get('/', [NavigationController::class, "index"])->name("navigation");
      Route::get('/create', [NavigationController::class, "create"])->name("navigation.create");
      Route::post('/create', [NavigationController::class, 'store']);
      Route::get('/{navigation}/edit', [NavigationController::class, 'edit'])->name("navigation.edit");
      Route::put('/{navigation}/edit', [NavigationController::class, 'update']);
      Route::delete('/{navigation}/delete', [NavigationController::class, 'destroy'])->name("navigation.delete");
    });
    Route::prefix("menu")->group(function () {
      Route::get('/', [MenuController::class, "index"])->name("menu");
      Route::get('/create', [MenuController::class, "create"])->name("menu.create");
      Route::post('/create', [MenuController::class, 'store']);
      Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name("menu.edit");
      Route::put('/{menu}/edit', [MenuController::class, 'update']);
      Route::delete('/{menu}/delete', [MenuController::class, 'destroy'])->name("menu.delete");
    });
  });
});
Route::prefix("admin")->middleware("auth")->group(function () {
  Route::prefix("user")->namespace("User")->group(function () {
    Route::get("profile", [ProfileController::class, "index"])->name("user.profile");
    Route::put("profile", [ProfileController::class, "update"]);
    Route::post("{user}/upload-img", [ProfileController::class, "uploadThumbnail"])->name("user.uploadthumbnail");
    Route::get("security", [SecurityController::class, "index"])->name("user.security");
    Route::post("security", [SecurityController::class, "update"]);
  });
});
