<?php

namespace Database\Seeders\Users;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::factory()->create([
            'name' => 'Srinivas',
            'email' => 'cnuphp@gmail.com',
        ]);
        $user->assignRole('Administrator');
    }
}
