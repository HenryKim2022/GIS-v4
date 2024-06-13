<?php

namespace App\Http\Controllers\MarksAndInstitutions;

use App\Http\Controllers\Controller;
use App\Models\Category_Model;
use App\Models\Mark_Model;
use App\Models\Institution_Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;



class MarksAndInstitutionController extends Controller
{
    protected $pageData;
    public function __construct()
    {
        $this->middleware('auth');

        $this->pageData = [
            'page_title' => 'User Panel',
            'page_url' => base_url('userpanel'),
        ];
        Session::put('page', $this->pageData);
    }




    //
    public function index()
    {
        $loadMarksFromDB = Mark_Model::withoutTrashed()->get(); // Retrieve the marks from the database (exclude: softDeleted's).
        $process = $this->setPageSession("Manage Mark & Institutions", "one-time");
        if ($process) {
            $categories = Category_Model::with('tb_institution')->withoutTrashed()->get();
            $loadInstitutionsFromDB = Institution_Model::withoutTrashed()->with('tb_mark', 'tb_category')->get();
            $loadMarksFromDB = Mark_Model::withoutTrashed()->get();
            $data = [
                'categories' => $categories,
                'loadInstitutionsFromDB' => $loadInstitutionsFromDB,
                'loadMarksFromDB' => $loadMarksFromDB,
            ];
            return $this->setReturnView('userpanels/pages/v_m_onetimemarks', $data);
        }
    }




    public function load_one_into_map()
    {
        $marks = Mark_Model::withoutTrashed()->get();
        $featureCollection = [
            "type" => "FeatureCollection",
            "generator" => "overpass-turbo",
            "copyright" => "The data included in this document is owned by " . env('APP_NAME') . ". The data is made available when we are active.",
            "timestamp" => date('Y-m-d\TH:i:s\Z'),
            "features" => []
        ];

        foreach ($marks as $mark) {
            $markColor = Institution_Model::where('mark_id', $mark->mark_id)->exists() ? "success" : "warning";
            $feature = [
                "type" => "Feature",
                "properties" => [
                    "mark" => [
                        "mark_id" => $mark->mark_id,
                        "mark_color" => $markColor,
                        "mark_address" => $mark->mark_address,
                        "created_at" => $mark->created_at,
                        "updated_at" => $mark->updated_at
                    ]
                ],
                "geometry" => [
                    "type" => "Point",
                    "coordinates" => [
                        $mark->mark_lon,
                        $mark->mark_lat
                    ]
                ]
            ];

            // Retrieve associated institution, category, and image data
            $institution = Institution_Model::where('mark_id', $mark->mark_id)
                ->with('tb_category', 'tb_image')
                ->first();
            if ($institution) {
                $maxUpdatedAt = max(
                    $institution->updated_at,
                    $institution->tb_mark->updated_at,
                    $institution->tb_category->updated_at,
                    $institution->tb_image->max('updated_at')
                );
                $maxCreatedAt = max(
                    $institution->created_at,
                    $institution->tb_mark->created_at,
                    $institution->tb_category->created_at,
                    $institution->tb_image->max('created_at')
                );
                $feature['properties']['institution'] = [
                    "name" => $institution->institu_name,
                    "category" => $institution->tb_category->name,
                    "images" => $institution->tb_image->pluck('img_src')->toArray()
                ];
                $feature['properties']['mark']['created_at'] = $maxCreatedAt;
                $feature['properties']['mark']['updated_at'] = $maxUpdatedAt;
            }

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









    ///////////////////////////// PAGE TITLE & URL SETTER ////////////////////////////
    public function setPageSession($pageTitle, $pageUrl, $lastTab = "")    // Param1 = page title, Param2 = page url !
    {
        $pageData = Session::get('page');
        $pageData['page_title'] = $pageTitle;
        $pageData['page_url'] = $pageUrl;

        $lastTab = $lastTab == "" ? 'from-maps' : $lastTab;
        $pageData['last_tab'] = $lastTab;

        // Store the updated array back in the session
        Session::put('page', $pageData);
        return true;
    }
    public function setReturnView($viewurl, $loadMarksFromDB = [])
    {
        $pageData = Session::get('page');
        $mergedData = array_merge($loadMarksFromDB, ['pageData' => $pageData]);
        return view($viewurl, $mergedData);
    }
}
