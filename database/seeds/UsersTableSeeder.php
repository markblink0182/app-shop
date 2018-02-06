<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'markitos',
            'email'=>'mark@hotmail.com',
            'password'=>bcrypt('markitos'),
            'admin' => true
        ]);
    }
}
