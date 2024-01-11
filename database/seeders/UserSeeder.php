<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $new_user = new User();
        $new_user->name = 'Francesco';
        $new_user->email = 'mail.franc@yahoo.it';
        $new_user->password = 'ciaomamma';
        $new_user->save();

    }
}
