<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SecurityController extends Controller
{
  public function index()
  {
    return view("User.security");
  }
  public function update()
  {
    request()->validate([
      'current_password' => "required",
      'password' => "required|confirmed",
    ]);
    $user = auth()->user();
    if (!Hash::check(request("current_password"), $user->password))
      throw ValidationException::withMessages([
        'current_password' => "Passwords are not the same"
      ]);
    $user->password = bcrypt(request("password"));
    $user->update();
    return redirect()->back()->with("success", "Security Updated");
  }
}
