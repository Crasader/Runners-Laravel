<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lib\Models\Role::create([
            "role" => "runner"
        ]);
        Lib\Models\Role::create([
            "role" => "admin"
        ]);
    }
}
