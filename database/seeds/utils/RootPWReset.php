<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;
use App\Group;
use App\Festival;
use App\Status;

/**
 * RootPWReset
 * Resets the password of root user.
 *
 * @author X. Carrel
 */
class RootPWReset extends Seeder
{
    public function run()
    {
        $root = User::where('email','=','root.toor@paleo.ch')->first();
        $root->password = bcrypt('secret');
        $root->save();
    }
}
