<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleUserController extends Controller
{
  public function index()
  {
    return view("Permission.Role-user.index", [
      "roles" => Role::get(),
      'user' => new User(),
      'users' => User::has('roles')->get(),
    ]);
  }
  public function create()
  {
    return view("Permission.Role-user.create", [
      "roles" => Role::get(),
      "user" => new User(),
    ]);
  }
  public function store()
  {
    request()->validate([
      "email" => "required",
      "roles" => "array|required"
    ]);
    $user = User::where('email', request('email'))->first();
    if (!$user) return back()->with("danger", "Cannot find User from email \"" . request('email') . "\"");
    $user->assignRole(request("roles"));
    return back()->with("success", "success add Role to {$user->name}");
  }
  public function edit(User $user)
  {
    return view("Permission.Role-user.edit", [
      'submit' => "Sync",
      "user" => $user,
      "roles" => Role::get(),
    ]);
  }
  public function update(User $user)
  {
    request()->validate([
      "email" => "required",
      "roles" => "array|required"
    ]);
    $user->syncRoles(request("roles"));
    return redirect()->to(route("RoleUser"))->with("success", "Success Sync Roles to \"{$user->name}\"");
  }
  public function destroy(User $user)
  {

    return response()->json([
      'status' =>    $user->roles()->detach(),
    ]);
  }
}
