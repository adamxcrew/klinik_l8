<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
  public function index()
  {
    return view("User.index
     ");
  }
  public function update()
  {
    $attr =   request()->validate([
      "name" => 'required|min:4',
    ]);
    $user = auth()->user();
    $user->update($attr);
    return redirect()->back()->with("success", "Profile Updated");
  }
  public function uploadThumbnail(User $user)
  {
    request()->validate([
      "thumbnail" => 'required|image|mimes:jpg,bmp,png,jpeg,ico',
    ]);
    $thumbnail = request()->file('thumbnail');
    Storage::delete($user->thumbnail);
    $user->thumbnail = $thumbnail->storeAs(
      'images/thumbnail',
      "usr_{$user->id}.{$thumbnail->extension()}"
    );
    $user->update();
    return response()->json([
      'status' => true,
    ]);
  }
}
