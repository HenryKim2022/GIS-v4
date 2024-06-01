<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Mark_Model;
use App\Models\Category_Model;
use App\Models\Image_Model;
use App\Models\Institution_Model;

class Setup_Default_WFK extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mark_Model::create([
            'mark_lat' => '-7.5854804',
            'mark_lon' => '111.7089844',
            'mark_address' => 'Jl. Sample 1',
        ]);

        Category_Model::create([
            'cat_name' => 'SMA',
        ]);

        Institution_Model::create([
            'institu_name' => 'SMA N 1 JAYAPURA',
            'institu_npsn' => '00000001',
            'institu_logo' => 'https://www.sman1jayapura.com/upload/picture/50709381logoSMAN1JAYAPURA.png',
            'mark_id' => '1',
            'cat_id' => '1',
        ]);

        Image_Model::create([
            'img_title' => 'Images 1',
            'img_alt' => 'Images 1 alt',
            'img_descb' => 'Images 1 blabla',
            'img_src' => 'https://www.sman1jayapura.com/upload/picture/50709381logoSMAN1JAYAPURA.png',
            'institu_id' => '1',
        ]);
        Image_Model::create([
            'img_title' => 'Images 2',
            'img_alt' => 'Images 2 alt',
            'img_descb' => 'Images 2 blabla',
            'img_src' => 'https://www.dbl.id/uploads/school/31330/710-SMAN_2_JAYAPURA.png',
            'institu_id' => '1',
        ]);
        Image_Model::create([
            'img_title' => 'Images 3',
            'img_alt' => 'Images 3 alt',
            'img_descb' => 'Images 4 blabla',
            'img_src' => 'https://www.dbl.id/uploads/school/31323/209-SMAN_3_JAYAPURA.png',
            'institu_id' => '1',
        ]);


    }
}
