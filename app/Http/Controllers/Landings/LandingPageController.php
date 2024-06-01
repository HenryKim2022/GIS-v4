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

use Illuminate\Http\Response;



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
    public function index()
    {
        $loadInstReviewFromDB = Institution_Model::withoutTrashed()->with('tb_mark', 'tb_category', 'tb_image')->get(); // Retrieve the marks from the database (exclude: softDeleted's).
        $process = $this->setPageSession("Landing Page", "landing-page");
        if ($process) {
            return $this->setReturnView('landings/pages/v_landing_customizer', ['loadInstReviewFromDB' => $loadInstReviewFromDB]);
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
                            "title" => $image->img_title,
                            "src" => $image->img_src,
                            "alt" => $image->img_alt,
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

        $response = response()->json($featureCollection);
        // Append a query parameter to the logo and image URLs (avoid image not updated in browser cache).
        $queryParam = 'v=' . time(); // Unique value, such as a timestamp
        $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->header('Pragma', 'no-cache');
        $response->header('Expires', '0');
        $response->header('Content-Type', 'application/json');
        $response->header('Vary', 'Accept-Encoding');
        $response->header('X-Powered-By', 'Laravel');
        $response->header('Access-Control-Allow-Origin', '*');

        // Modify the logo and image URLs in the feature collection
        $response->setData($this->modifyAssetUrls($response->getData(), $queryParam));

        return $response;
    }


    private function modifyAssetUrls($data, $queryParam)
    {
        if (!isset($data->features) || !is_array($data->features)) {
            return $data;
        }

        foreach ($data->features as $feature) {
            if (isset($feature->properties->institu_logo)) {
                $feature->properties->institu_logo .= '?' . $queryParam;
            }

            if (isset($feature->properties->institu_images) && is_array($feature->properties->institu_images)) {
                foreach ($feature->properties->institu_images as $image) {
                    if (isset($image->src)) {
                        $image->src .= '?' . $queryParam;
                    }
                }
            }
        }

        return $data;
    }











    ///////////////////////////// PAGE SETTER ////////////////////////////
    public function setPageSession($pageTitle, $pageUrl)
    {
        $pageData = Session::get('page');
        $pageData['page_title'] = $pageTitle;
        $pageData['page_url'] = $pageUrl;

        // Store the updated array back in the session
        Session::put('page', $pageData);
        return true;
    }
    public function setReturnView($viewurl, $loadInstReviewFromDB = [])
    {
        $pageData = Session::get('page');
        $mergedData = array_merge($loadInstReviewFromDB, ['pageData' => $pageData]);
        return view($viewurl, $mergedData);
    }
}
