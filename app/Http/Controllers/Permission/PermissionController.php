<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
  public function index()
  {
    return view("Permission.Permission.index", [
      "permissions" => Permission::get(),
    ]);
  }
  public function create()
  {
    return view("Permission.Permission.create", [
      "permission" => new Permission(),
    ]);
  }
  public function store()
  {
    request()->validate([
      "name" => "required",
    ]);
    Permission::create([
      "name" => request('name'),
      "guard_name" => request("guard_name") ?? "web",
    ]);
    return redirect(route("permission"))->with("success", "Permission Created");
  }
  public function edit(Permission $permission)
  {
    return view("Permission.Permission.edit", [
      'submit' => "Update",
      "permission" => $permission,
    ]);
  }
  public function update(Permission $permission)
  {
    request()->validate([
      "name" => "required",
    ]);
    $permission->update([
      "name" => request('name'),
      "guard_name" => request("guard_name") ?? "web",
    ]);
    return redirect()->to(route("permission"))->with("success", "Permission Updated");
  }
  public function destroy(Permission $permission)
  {
    $permission->roles()->detach();
    return response()->json([
      'status' =>  $permission->delete(),
    ]);
  }
}
