<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
// importando l hash possiamo codificare la password 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        // $new_user = new User();
        // $new_user->name = 'Francesco';
        // $new_user->email = 'test@yahoo.it';
        // $new_user->password = Hash::make('ciaomamma');
        // $new_user->save();

        $user = User::create([
            'name' => 'Francesco',
            'email' => 'test@yahoo.it',
            'password' => Hash::make('ciaomamma'),
        ]);
     
        for ($i=0; $i < 20; $i++) { 
            $user = User::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'password' => Hash::make($faker->password()),
            ]);
        }
        // possiamo generare tot utenti finti 
    }
}
