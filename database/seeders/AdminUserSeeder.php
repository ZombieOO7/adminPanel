<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::updateOrCreate(['name' => strtolower('superadmin')],['name' => strtolower('superadmin'), 'guard_name' => 'admin']);
        /** Super admin */
        $superAdmin = Admin::create([
            'uuid' => \Str::uuid(),
            'name' => 'Super Admin',
            'email' => 'testadmin@yopmail.com',
            'email_verified_at' => date('Y-m-d h:i:s'),
            'password' => 'admin@1234',
            'status' => 1,
        ]);
        $superAdmin->assignRole('superadmin');
    }
}
