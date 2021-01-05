<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    $user = auth()->user();
    if ($user->hasRole('super admin')) {
      return view("Dashboard.admin");
    }
  }
}
