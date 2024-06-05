<?php

namespace App\Http\Controllers\Marks;

use App\Http\Controllers\Controller;
use App\Models\Mark_Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MarkController extends Controller
{
    protected $pageData;
    public function __construct()
    {
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
        $process = $this->setPageSession("Manage Markings", "m-mark");
        if ($process) {
            return $this->setReturnView('userpanels/pages/v_m_marks', ['loadMarksFromDB' => $loadMarksFromDB]);
        }
    }

    public function add_marking(Request $request)
    {
        $latitude = $request->input('modalEditLatitude1');
        $longitude = $request->input('modalEditLongitude1');
        $address = $request->input('modalEditMarkAddress1');

        $mark = new Mark_Model();
        $mark->mark_lat = $latitude;
        $mark->mark_lon = $longitude;
        $mark->mark_address = $address;
        $mark->save();
        return Redirect::back();
    }


    public function edit_marking(Request $request)
    {
        $mark = Mark_Model::find($request->input('modalEditMarkID2'));
        if ($mark) {
            $mark->mark_lat = $request->input('modalEditLatitude2');
            $mark->mark_lon = $request->input('modalEditLongitude2');
            $mark->mark_address = $request->input('modalEditMarkAddress2');
            $mark->save();
            return Redirect::back();
        } else {
            // Handle the case when the mark is not found
            return response()->json(['error' => 'Mark not found'], 404);
        }
    }


    public function delete_marking(Request $request)
    {
        $mark = Mark_Model::find($request->input('mark_id'));
        if ($mark) {
            $mark->delete();
            return response()->json(['success' => 'Mark deleted successfully']);
            // return Redirect::back();
        } else {
            return response()->json(['error' => 'Mark not found'], 404);
        }
    }


    public function get_marking(Request $request)
    {
        $markID = $request->input('markID');
        $mark = Mark_Model::find($markID);

        if ($mark) {
            // Return the latitude and longitude as a JSON response
            return response()->json([
                'mark_id' => $markID,
                'latitude' => $mark->mark_lat,
                'longitude' => $mark->mark_lon,
                'mark_address' => $mark->mark_address
            ]);
        } else {
            // Handle the case when the mark is not found
            return response()->json(['error' => 'Mark not found'], 404);
        }
    }


    public function load_marks_into_map()
    {
        $marks = Mark_Model::all();

        $featureCollection = [
            "type" => "FeatureCollection",
            "generator" => "overpass-turbo",
            "copyright" => "The data included in this document is own by " . env(key: 'APP_NAME') . ". The data is made available when we are active.",
            "timestamp" => date('Y-m-d\TH:i:s\Z'),
            "features" => []
        ];

        foreach ($marks as $mark) {
            $feature = [
                "type" => "Feature",
                "properties" => [
                    "institu_id" => $mark->institu_id,
                    "institu_name" => $mark->institu_name,
                    "institu_category" => $mark->institu_category,
                    "institu_npsn" => $mark->institu_npsn,
                    "institu_logo" => $mark->institu_logo,
                    "institu_address" => $mark->institu_address,
                    "institu_descb" => $mark->institu_descb,
                    "institu_image" => $mark->institu_image,
                    "institu_mark_id" => $mark->institu_mark_id,
                    "created_at" => $mark->created_at,
                    "updated_at" => $mark->updated_at
                ],
                "geometry" => [
                    "type" => "Point",
                    "coordinates" => [
                        $mark->mark_lon,
                        $mark->mark_lat
                    ]
                ]
            ];

            $featureCollection["features"][] = $feature;
        }

        return response()->json($featureCollection);
    }



    public function reset_marking(Request $request)
    {
        // Delete all records from the tb_mark table
        Mark_Model::query()->delete();

        // Reset the auto-increment value
        DB::statement('ALTER TABLE tb_mark AUTO_INCREMENT = 1');

        // Redirect back to the previous page
        return redirect()->back();
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
