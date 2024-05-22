<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Setup_Default_Users;

class Setup_Default_Users_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setup_Default_Users::create([
            'user_name' => 'admingis',
            'user_pwd' => bcrypt(str_pad('123456', 255)),
            'user_image' => '',
        ]);
    }
}
