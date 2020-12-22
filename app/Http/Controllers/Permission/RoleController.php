<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
  public function index()
  {
    return view("Permission.Role.index", [
      "roles" => Role::get(),
    ]);
  }
  public function create()
  {
    return view("Pages.Role.create", [
      "role" => new Role(),
    ]);
  }
  public function store()
  {
    request()->validate([
      "name" => "required",
    ]);
    Role::create([
      "name" => request('name'),
      "guard_name" => request("guard_name") ?? "web",
    ]);
    return back();
  }
  public function edit(Role $role)
  {
    return view("Permission.Role.edit", [
      'submit' => "Update",
      "role" => $role,
    ]);
  }
  public function update(Role $role)
  {
    request()->validate([
      "name" => "required",
    ]);
    $role->update([
      "name" => request('name'),
      "guard_name" => request("guard_name") ?? "web",
    ]);
    return redirect()->to(route("role"))->with("success", "Updated Role!");
  }
  public function destroy(Role $role)
  {
    $role->permissions()->detach();
    return response()->json([
      'status' =>  $role->delete(),
    ]);
  }
}
