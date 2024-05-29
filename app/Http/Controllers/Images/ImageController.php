<?php

namespace App\Http\Controllers\Images;

use App\Http\Controllers\Controller;
use App\Models\Image_Model;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class ImageController extends Controller
{
    //
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
        $loadInstitutionsFromDB = Institution_Model::withoutTrashed()->with('tb_mark', 'tb_category', 'tb_image')->get();
        $process = $this->setPageSession("Manage Institutions", "m-inst");

        if ($process) {
            return $this->setReturnView('userpanels/pages/v_m_institutions', ['loadInstitutionsFromDB' => $loadInstitutionsFromDB]);
        }
    }

    public function add_inst(Request $request)
    {
        $inst = new Institution_Model();
        $inst->institu_name = $request->input('modalEditInstitutionName1');
        $inst->institu_npsn = $request->input('modalEditInstitutionNPSN1');
        $inst->mark_id = $request->input('modalEditInstitutionMARKID1');
        $inst->cat_id = $request->input('modalEditInstitutionCATID1');
        // Handle the file upload for modalEditInstitutionLOGO1
        if ($request->hasFile('modalEditInstitutionLOGO1')) {
            $file = $request->file('modalEditInstitutionLOGO1');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            // Store the uploaded file in the storage/app/public directory
            Storage::putFileAs('public', $file, $filename);
            // Update the institution's logo field with the stored file path
            $inst->institu_logo = asset(env(key: 'APP_URL')) . '/public/storage/' . $filename;
            $inst->save();
        } else {
            // Handle case where no logo file is provided
            $inst->institu_logo = asset(env(key: 'APP_NOIMAGE')); // Set a default value or handle the case as needed
            $inst->save();
        }

        return redirect()->back();
    }


    public function edit_inst(Request $request)
    {
        $mark = Institution_Model::find($request->input('modalEditMarkID2'));
        if ($mark) {
            $mark->mark_lat = $request->input('modalEditLatitude2');
            $mark->mark_lon = $request->input('modalEditLongitude2');
            $mark->mark_lon = $request->input('modalEditMarkAddress2');
            $mark->save();
            return Redirect::back();
        } else {
            // Handle the case when the mark is not found
            return response()->json(['error' => 'Mark not found'], 404);
        }
    }


    public function delete_inst(Request $request)
    {
        $inst = Institution_Model::find($request->input('institu_id'));
        if ($inst) {
            $inst->delete();
            return response()->json(['success' => 'Institution deleted successfully']);
            // return Redirect::back();
        } else {
            return response()->json(['error' => 'Institution not found'], 404);
        }
    }


    public function get_inst(Request $request)
    {
        $markID = $request->input('markID');
        $mark = Institution_Model::find($markID);

        if ($mark) {
            // Return the latitude and longitude as a JSON response
            return response()->json([
                'mark_id' => $markID,
                'latitude' => $mark->mark_lat,
                'longitude' => $mark->mark_lon,
                'mark_address' => $mark->mark_laddress
            ]);
        } else {
            // Handle the case when the mark is not found
            return response()->json(['error' => 'Institution not found'], 404);
        }
    }


    public function load_marks_into_map()
    {
        $marks = Institution_Model::all();

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


    public function load_select_list_for_modal()
    {
        $markList = Mark_Model::all()->map(function ($mark) {
            return [
                'value' => $mark->mark_id,
                'text' => $mark->mark_address,
                'selected' => false, // Set to true if this option should be selected
            ];
        });

        $catList = Category_Model::all()->map(function ($category) {
            return [
                'value' => $category->cat_id,
                'text' => $category->cat_name,
                'selected' => false, // Set to true if this option should be selected
            ];
        });

        // Return the markList and catList as a JSON response
        return response()->json([
            'markList' => $markList,
            'catList' => $catList,
        ]);
    }


    public function reset_inst(Request $request)
    {
        // Delete all records from the tb_mark table
        Institution_Model::query()->delete();

        // Reset the auto-increment value
        DB::statement('ALTER TABLE tb_institution AUTO_INCREMENT = 1');

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
    public function setReturnView($viewurl, $loadInstitutionsFromDB = [])
    {
        $pageData = Session::get('page');
        $mergedData = array_merge($loadInstitutionsFromDB, ['pageData' => $pageData]);
        return view($viewurl, $mergedData);
    }
}
