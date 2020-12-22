<?php

namespace App\Http\Controllers\Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Navigation;
use Spatie\Permission\Models\Permission;

class NavigationController extends Controller
{
  public function index()
  {
    $navigation = new Navigation();
    $permissions = Permission::get();
    $menus = Menu::get();
    $navigations = Navigation::get();
    return view("Permission.Navigation.index", compact(['navigations', 'permissions', 'navigation', "menus"]));
  }
  public function create()
  {
    return view("Permission.Navigation.create", [
      "navigations" => Navigation::get(),
      "permissions" => Permission::get(),
    ]);
  }
  public function store()
  {
    request()->validate([
      "name" => "required",
      "menu_id" => "required",
      "permission" => "required"
    ]);
    Navigation::create([
      'name' => request('name'),
      'url' => request("url") ?? null,
      "parent_id" => request("parent") ?? null,
      "menu_id" => request("menu_id"),
      'permission_name' => request('permission'),
    ]);

    return back()->with("success", "success add Navigation");
  }
  public function edit(Navigation $navigation)
  {
    return view("Permission.Navigation.edit", [
      'submit' => "Update",
      "menus" => Menu::get(),
      "navigation" => $navigation,
      "navigations" => Navigation::get(),
      "permissions" => Permission::get(),
    ]);
  }
  public function update(Navigation $navigation)
  {
    request()->validate([
      "name" => "required",
      "menu_id" => "required",
      "permission" => "required"
    ]);
    $navigation->update([
      'name' => request('name'),
      'url' => request("url") ?? null,
      "parent_id" => request("parent") ?? null,
      "menu_id" => request("menu_id"),
      'permission_name' => request('permission'),
    ]);
    return redirect()->to(route("navigation"))->with("success", "Success Change Navigation");
  }
  public function destroy(Navigation $navigation)
  {
    return response()->json([
      'status' =>  $navigation->delete(),
    ]);
  }
}
