<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\{Permission, Role};

class RoleAndPermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('users')->insert([
      'name' => "super admin",
      'email' => 'super-admin@gmail.com',
      'password' => Hash::make('password'),
    ]);
    // Reset cached roles and permissions
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    // this can be done as separate statements
    $role = Role::create(['name' => 'super admin']);
    $role->givePermissionTo(Permission::all());
    $user = User::find(1)->first();
    $user->assignRole("super admin");
  }
}
