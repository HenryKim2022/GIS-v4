<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Setup_Default_Users;
use Illuminate\Support\Facades\Crypt;

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
            'user_pwd' => Crypt::encryptString('123456'),
            'user_image' => '',
        ]);

        Setup_Default_Users::create([
            'firstname' => 'M. Ramdan',
            'lastname' => 'Pujianto',
            'user_name' => 'madan',
            'user_pwd' => Crypt::encryptString('123456'),
            'user_image' => '',
        ]);

        Setup_Default_Users::create([
            'firstname' => 'Yopi Okta',
            'lastname' => 'R.W',
            'user_name' => 'shoppe',
            'user_pwd' => Crypt::encryptString('123456'),
            'user_image' => '',
        ]);

        Setup_Default_Users::create([
            'firstname' => 'M. Haffizh',
            'lastname' => 'Dzulfikar',
            'user_name' => 'haffizh',
            'user_pwd' => Crypt::encryptString('123456'),
            'user_image' => '',
        ]);
    }
}
