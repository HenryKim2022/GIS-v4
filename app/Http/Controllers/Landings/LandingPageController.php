<?php

namespace App\Http\Controllers\Landings;

use App\Http\Controllers\Controller;
use App\Models\Institution_Model;
use App\Models\Image_Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use App\Models\Mark_Model;
use App\Models\Category_Model;

use Illuminate\Support\Facades\Storage;




class LandingPageController extends Controller
{
    protected $pageData;
    public function __construct()
    {

        // if ($this->middleware('auth')){
        //     echo ('console.log("LOGIN FIRST :)")');
        // }

        $this->pageData = [
            'page_title' => 'What Public See',
            'page_url' => base_url('public-url'),
        ];
        Session::put('page', $this->pageData);
    }


    //
    public function index(){
        $process = $this->setPageSession("Landing Page", "landing-page");
        if ($process){
            return view('landings/pages/v_landing_customizer');
        }
    }



    public function load_marks_into_map()
    {
        $institutions = Institution_Model::withoutTrashed()->with('tb_mark', 'tb_category', 'tb_image')->get();
        // $institutions = Institution_Model::all();

        $featureCollection = [
            "type" => "FeatureCollection",
            "generator" => "overpass-turbo",
            "copyright" => "The data included in this document is own by " . env(key: 'APP_NAME') . ". The data is made available when we are active.",
            "timestamp" => date('Y-m-d\TH:i:s\Z'),
            "features" => []
        ];

        foreach ($institutions as $inst) {
            $feature = [
                "type" => "Feature",
                "properties" => [
                    "institu_id" => $inst->institu_id,
                    "institu_name" => $inst->institu_name,
                    "institu_category" => $inst->tb_category->cat_name,
                    "institu_npsn" => $inst->institu_npsn,
                    "institu_logo" => $inst->institu_logo,
                    "institu_address" => $inst->tb_mark->mark_address,
                    "institu_images" => $inst->tb_image->map(function ($image) {
                        return [
                            "src" => $image->img_src,
                            "description" => $image->img_descb
                        ];
                    })->all(),
                    "institu_mark_id" => $inst->tb_mark->mark_id,
                    "created_at" => $inst->tb_mark->created_at,
                    "updated_at" => $inst->tb_mark->updated_at
                ],
                "geometry" => [
                    "type" => "Point",
                    "coordinates" => [
                        $inst->tb_mark->mark_lon,
                        $inst->tb_mark->mark_lat
                    ]
                ]
            ];

            $featureCollection["features"][] = $feature;
        }

        return response()->json($featureCollection);
    }









    ///////////////////////////// PAGE SETTER ////////////////////////////
    public function setPageSession($pageTitle, $pageUrl){
        $pageData = Session::get('page');
        $pageData['page_title'] = $pageTitle;
        $pageData['page_url'] = $pageUrl;

        // Store the updated array back in the session
        Session::put('page', $pageData);
        return true;
    }
    public function setReturnView($viewurl){
        $pageData = Session::get('page');
        return view($viewurl, ['pageData' => $pageData]);
    }
}
