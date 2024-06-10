<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Setup_Default_Users;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class Setup_Default_Users_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setup_Default_Users::create([
            'firstname' => 'Henry',
            'lastname' => '.K',
            'user_name' => 'admin',
            'user_email' => 'admin1@mail.com',
            'user_pwd' => Hash::make('1234567'),
            'type' => 1,
            'user_image' => '',
        ]);

        Setup_Default_Users::create([
            'firstname' => 'M. Ramdan',
            'lastname' => 'Pujianto',
            'user_name' => 'madan',
            'user_email' => 'admin2@mail.com',
            'user_pwd' => Hash::make('123456'),
            'type' => 1,
            'user_image' => '',
        ]);

        Setup_Default_Users::create([
            'firstname' => 'Yopi Okta',
            'lastname' => 'R.W',
            'user_name' => 'shoppe',
            'user_email' => 'admin3@mail.com',
            'user_pwd' => Hash::make('123456'),
            'type' => 1,
            'user_image' => '',
        ]);

        Setup_Default_Users::create([
            'firstname' => 'M. Haffizh',
            'lastname' => 'Dzulfikar',
            'user_name' => 'haffizh',
            'user_email' => 'admin4@mail.com',
            'user_pwd' => Hash::make('123456'),
            'type' => 1,
            'user_image' => '',
        ]);
    }
}
