<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Navigation;
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
    $user = User::create([
      'name' => "super admin",
      'email' => 'super-admin@gmail.com',
      'password' => Hash::make('root'),
    ]);
    // Reset cached roles and permissions
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    // this can be done as separate statements
    Role::create(['name' => 'admin']);
    Role::create(['name' => 'poli']);
    $role = Role::create(['name' => 'super admin']);
    $role->givePermissionTo(Permission::all());
    $user->assignRole("super admin");
    $user->assignRole("poli");

    $permission = Permission::create(['name' => "Mengolah Permission"]);
    Permission::create(['name' => "Mengolah Poliklinik"]);
    Permission::create(['name' => "Mengolah Dokter"]);
    Permission::create(['name' => "Mengolah Obat"]);
    Permission::create(['name' => "Mengolah Tindakan"]);
    Permission::create(['name' => "Tambah Pasien"]);
    Permission::create(['name' => "Diagnosa Pasien"]);


    $menuPasien =  Menu::create(['name' => "Pasien"]);
    $menuAntrian =  Menu::create(['name' => "Antrian"]);
    $menuMaster =  Menu::create(['name' => "Master"]);
    $menuMaster->Navigations()->create([
      "name" => "Poliklinik",
      "permission_name" => "Mengolah Poliklinik",
      "url" => "admin/poliklinik",
    ]);
    $menuMaster->Navigations()->create([
      "name" => "Obat",
      "permission_name" => "Mengolah Obat",
      "url" => "admin/obat",
    ]);
    $menuMaster->Navigations()->create([
      "name" => "Tindakan",
      "permission_name" => "Mengolah Tindakan",
      "url" => "admin/tindakan",
    ]);
    $menuMaster->Navigations()->create([
      "name" => "Dokter",
      "permission_name" => "Mengolah Dokter",
      "url" => "admin/dokter",
    ]);
    $menuMaster->Navigations()->create([
      "name" => "Diagnosa",
      "permission_name" => "Mengolah Diagnosa",
      "url" => "admin/diagnosa",
    ]);

    $menuPasien->Navigations()->create([
      "name" => "Poli Pasien Antri",
      "permission_name" => "Diagnosa Pasien",
      "url" => "admin/pasien/poli/antri",
    ]);
    $tambahPasien =  $menuPasien->Navigations()->create([
      "name" => "Tambah",
      "permission_name" => "Tambah Pasien",
    ]);
    $menuPasien->Navigations()->create([
      "name" => "Pasien Baru",
      "parent_id" => $tambahPasien->id,
      "permission_name" => "Tambah Pasien",
      "url" => "admin/tambah-pasien",
    ]);
    $menuPasien->Navigations()->create([
      "name" => "Pasien Terdaftar",
      "parent_id" => $tambahPasien->id,
      "permission_name" => "Tambah Pasien",
      "url" => "admin/pasien-terdaftar",
    ]);


    $m = Menu::create(['name' => "Super Admin"]);


    $parent = $m->Navigations()->create([
      "name" => "Mengolah Permission",
      "permission_name" => $permission->name,
    ]);
    $m->Navigations()->create([
      "name" => "Menu",
      "parent_id" => $parent->id,
      "permission_name" => $permission->name,
      "url" => "super-admin/menu",
    ]);
    $m->Navigations()->create([
      "name" => "Navigation",
      "parent_id" => $parent->id,
      "permission_name" => $permission->name,
      "url" => "super-admin/navigation",
    ]);
    $m->Navigations()->create([
      "name" => "Role",
      "parent_id" => $parent->id,
      "permission_name" => $permission->name,
      "url" => "super-admin/role",
    ]);
    $m->Navigations()->create([
      "name" => "Permission",
      "parent_id" => $parent->id,
      "permission_name" => $permission->name,
      "url" => "super-admin/permission",
    ]);
    $m->Navigations()->create([
      "name" => "Role Permission",
      "parent_id" => $parent->id,
      "permission_name" => $permission->name,
      "url" => "super-admin/role-permission",
    ]);
    $m->Navigations()->create([
      "name" => "User Role",
      "parent_id" => $parent->id,
      "permission_name" => $permission->name,
      "url" => "super-admin/role-user",
    ]);
  }
}
