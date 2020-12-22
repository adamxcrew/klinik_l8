<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
  public function index()
  {
    $permission = Permission::get();
    $role = Role::get();
    return view("Permission.Role-permission.index", [
      "roles" => $role,
      'role' => new Role(),
      "permissions" => $permission,
    ]);
  }
  public function create()
  {
    return view("Permission.Role-permission.create", [
      "roles" => Role::get(),
      "permissions" => Permission::get(),
    ]);
  }
  public function store()
  {
    request()->validate([
      "role" => "required",
      "permissions" => "array|required"
    ]);
    $role = Role::find(request('role'));
    $role->givePermissionTo(request('permissions'));

    return back()->with("success", "success add permissions to Role {$role->name}");
  }
  public function edit(Role $role)
  {
    return view("Permission.Role-permission.edit", [
      'submit' => "Update",
      "role" => $role,
      "roles" => Role::get(),
      "permissions" => Permission::get(),
    ]);
  }
  public function update(Role $role)
  {
    request()->validate([
      "role" => "required",
      "permissions" => "array|required"
    ]);
    $role = Role::find(request('role'));

    $role->permissions()->sync(request("permissions"));
    return redirect()->to(route("RolePermission"))->with("success", "Success Change");
  }
  public function destroy(Role $role)
  {
    $role->permissions()->detach();
    return response()->json([
      'status' =>  true,
    ]);
  }
}
