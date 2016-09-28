<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\RolesModel;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create admin account
        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('admin');
        $admin->save();

        //Create Roles admin
        $role = new RolesModel();
        $role->name = 'Quản Trị';
        $role->slug = 'admin';
        $role->description = 'Quyền Quản Trị';
        $role->save();
        
        //Set Permission admin for user admin
        $admin->roles()->attach(['roleId' => $role->id]);
    }
}
