<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Developer_Model;
use App\Models\Mark_Model;
use App\Models\Category_Model;
use App\Models\Image_Model;
use App\Models\Institution_Model;

class Setup_Default_Developers_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Developer_Model::create([
            'dev_id' => '1152125001',
            'dev_firstname' => 'Hendri',
            'dev_lastname' => '',
            'dev_job' => 'Programmer',
            'dev_image' => '',
            'user_id' => '1',
        ]);

        Developer_Model::create([
            'dev_id' => '1152120006',
            'dev_firstname' => 'M. Ramdan',
            'dev_lastname' => 'P',
            'dev_job' => 'Analize',
            'dev_image' => '',
            'user_id' => '2',
        ]);

        Developer_Model::create([
            'dev_id' => '1152120003',
            'dev_firstname' => 'Yopi Okta',
            'dev_lastname' => 'R.W',
            'dev_job' => 'Designer',
            'dev_image' => '',
            'user_id' => '3',
        ]);

        Developer_Model::create([
            'dev_id' => '1152120001',
            'dev_firstname' => 'Akhmad Hafizh',
            'dev_lastname' => 'D',
            'dev_job' => 'Project Manager',
            'dev_image' => '',
            'user_id' => '4',
        ]);


    }
}
