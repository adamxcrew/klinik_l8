<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
  public function index()
  {
    return view("Permission.Menu.index", [
      "menus" => Menu::get(),
    ]);
  }
  public function create()
  {
    return view("Permission.Menu.create", [
      "menu" => new Menu(),
    ]);
  }
  public function store()
  {
    request()->validate([
      "name" => "required|min:3",
    ]);
    Menu::create([
      "name" => request('name'),
    ]);
    return back()->with('success', "Menu Ditambahkan");
  }
  public function edit(Menu $menu)
  {
    return view("Permission.Menu.edit", [
      'submit' => "Update",
      "menu" => $menu,
    ]);
  }
  public function update(Menu $menu)
  {
    request()->validate([
      "name" => "required",
    ]);
    $menu->update([
      "name" => request('name'),
      "guard_name" => request("guard_name") ?? "web",
    ]);
    return redirect()->to(route("permission.menu"));
  }
  public function destroy(Menu $menu)
  {
    $menu->navigations()->delete();
    return response()->json([
      'status' =>  $menu->delete(),
    ]);
  }
}
