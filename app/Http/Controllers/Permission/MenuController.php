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
      "menu" => new Menu(),
      "menus" => Menu::orderBy('sequence_number')->get(),
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
      "sequence_number" => "nullable|numeric",

    ]);
    Menu::create([
      "name" => request('name'),
      "sequence_number" => request('sequence_number') ?? 10,

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
      "sequence_number" => "nullable|numeric",

    ]);
    $menu->update([
      "name" => request('name'),
      "sequence_number" => request('sequence_number') ?? null,
    ]);
    return redirect()->to(route("menu"));
  }
  public function destroy(Menu $menu)
  {
    $menu->navigations()->delete();
    return response()->json([
      'status' =>  $menu->delete(),
    ]);
  }
}
