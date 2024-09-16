<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(CountrySeeder::class);

        // \App\Models\User::factory(10)->create();

        // Permission::create(['name' => 'edit articles']);
        // Permission::create(['name' => 'delete articles']);

        // Creating roles and assigning existing permissions
        // $role = Role::create(['name' => 'المدير التنفيذي']);
        // $role = Role::create(['name' => 'المدير المالي']);
        // $role = Role::create(['name' => 'مدير المبيعات']);
        // $role = Role::create(['name' => 'مدير التسويق']);
        // $role = Role::create(['name' => 'المدير التقني']);
        // $role = Role::create(['name' => 'مدير الموارد البشرية']);
        // $role = Role::create(['name' => 'مسؤول الفرانشيز']);
        // $role = Role::create(['name' => 'مسؤول الموارد البشرية']);
        // // $role->givePermissionTo('edit articles');
        // $role = Role::create(['name' => 'مسؤول مبيعات']);
        $role = Role::create(['name' => 'وكيل مبيعات']);

        // $role = Role::create(['name' => 'admin']);
        // $role->givePermissionTo(['edit articles', 'delete articles']);

        

    }
}
