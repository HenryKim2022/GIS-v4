<?php

namespace App\Http\Controllers\Institutions;

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



class InstutionController extends Controller
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
        $loadInstitutionsFromDB = Institution_Model::withoutTrashed()->with('tb_mark', 'tb_category')->get();
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
            Session::flash('success', ['Institution added successfully!']);
            $inst->save();
        } else {
            // Handle case where no logo file is provided
            $inst->institu_logo = asset(env(key: 'APP_NOIMAGE')); // Set a default value or handle the case as needed
            Session::flash('success', ['Institution added successfully!']);
            $inst->save();
        }

        return redirect()->back();
    }


    public function edit_inst(Request $request)
    {
        $inst = Institution_Model::find($request->input('modalEditInstitutionID2'));
        if ($inst) {
            $inst->institu_name = $request->input('modalEditInstitutionName2');
            $inst->institu_npsn = $request->input('modalEditInstitutionNPSN2');
            $inst->cat_id = $request->input('modalEditInstitutionCATID2');
            $inst->mark_id = $request->input('modalEditInstitutionMARKID2');

            if ($request->hasFile('modalEditInstitutionLOGO2')) {
                $file = $request->file('modalEditInstitutionLOGO2');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();

                // Store the uploaded file in the storage/app/public directory
                Storage::putFileAs('public', $file, $filename);
                $inst->institu_logo = asset('public/storage/' . $filename);

                $inst->save();
                Session::flash('success', ['Institution updated successfully!']);
                return Redirect::back();
            }else{
                $inst->save();
                Session::flash('success', ['Institution updated successfully!']);
                return Redirect::back();
            }
        } else {
            Session::flash('errors', ['Err[404]: Institution update failed!']);
        }
    }




    public function delete_inst(Request $request)
    {
        $inst = Institution_Model::find($request->input('institu_id'));
        if ($inst) {
            $images = $inst->tb_image;
            if ($images->isNotEmpty()) {
                $imageNames = $images->pluck('img_title')->toArray();
                $imageNamesString = implode(', ', $imageNames);
                $imageIDs = $images->pluck('img_id')->toArray();
                $imageIDsString = implode(', ', $imageIDs);
                $error = 'Institution is used by the following images('. $imageNamesString .') with id(' . $imageIDsString . ') and cannot be deleted.';
                Session::flash('n_errors', ['This ' . $error]);
            } else {
                $inst->delete();
                Session::flash('success', ['Institution deletion successful!']);
            }
        } else {
            Session::flash('errors', ['Err[404]: Institution deletion failed!']);
        }
        return redirect()->back();
    }


    public function get_inst(Request $request)
    {
        $instituID = $request->input('instituID');
        $inst = Institution_Model::find($instituID);
        if ($inst) {
            // Load the select input for Mark & Category (this loading is diff with load_select_list_for_addmodal())
            $markList = Mark_Model::all()->map(function ($mark) use ($inst) {
                $selected = ($mark->mark_id == $inst->mark_id);
                return [
                    'value' => $mark->mark_id,
                    'text' => $mark->mark_address,
                    'selected' => $selected,
                ];
            });
            $catList = Category_Model::all()->map(function ($category) use ($inst) {
                $selected = ($category->cat_id == $inst->cat_id);
                return [
                    'value' => $category->cat_id,
                    'text' => $category->cat_name,
                    'selected' => $selected,
                ];
            });

            // Return queried data as a JSON response
            return response()->json([
                'inst_id' => $instituID,
                'inst_name' => $inst->institu_name,
                'inst_npsn' => $inst->institu_npsn,
                'inst_cat_id' => $inst->cat_id,
                'inst_logo' => $inst->institu_logo,
                'inst_mark_id' => $inst->mark_id,
                'markList' => $markList,
                'catList' => $catList,
            ]);
        } else {
            // Handle the case when the mark is not found
            return response()->json(['error' => 'Institution not found'], 404);
        }
    }



    public function load_select_list_for_addmodal()
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




    // public function load_institutions_into_map()
    // {
    //     $institutions = Institution_Model::withoutTrashed()->with('tb_mark', 'tb_category', 'tb_image')->get();

    //     $featureCollection = [
    //         "type" => "FeatureCollection",
    //         "generator" => "overpass-turbo",
    //         "copyright" => "The data included in this document is own by " . env(key: 'APP_NAME') . ". The data is made available when we are active.",
    //         "timestamp" => date('Y-m-d\TH:i:s\Z'),
    //         "features" => []
    //     ];

    //     foreach ($institutions as $inst) {
    //         $feature = [
    //             "type" => "Feature",
    //             "properties" => [
    //                 "institu_id" => $inst->institu_id,
    //                 "institu_name" => $inst->institu_name,
    //                 "institu_category" => $inst->tb_category->cat_name,
    //                 "institu_npsn" => $inst->institu_npsn,
    //                 "institu_logo" => $inst->institu_logo,
    //                 "institu_address" => $inst->tb_mark->mark_address,
    //                 "institu_images" => $inst->tb_image->map(function ($image) {
    //                     return [
    //                         "title" => $image->img_title,
    //                         "src" => $image->img_src,
    //                         "alt" => $image->img_alt,
    //                         "description" => $image->img_descb
    //                     ];
    //                 })->all(),
    //                 "institu_mark_id" => $inst->tb_mark->mark_id,
    //                 "created_at" => $inst->tb_mark->created_at,
    //                 "updated_at" => max($inst->updated_at, $inst->tb_mark->updated_at, $inst->tb_category->updated_at, $inst->tb_image->max('updated_at'))
    //             ],
    //             "geometry" => [
    //                 "type" => "Point",
    //                 "coordinates" => [
    //                     $inst->tb_mark->mark_lon,
    //                     $inst->tb_mark->mark_lat
    //                 ]
    //             ]
    //         ];

    //         $featureCollection["features"][] = $feature;
    //     }

    //     $response = response()->json($featureCollection);
    //     // Append a query parameter to the logo and image URLs (avoid image not updated in browser cache).
    //     $queryParam = 'v=' . time(); // Unique value, such as a timestamp
    //     $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    //     $response->header('Pragma', 'no-cache');
    //     $response->header('Expires', '0');
    //     $response->header('Content-Type', 'application/json');
    //     $response->header('Vary', 'Accept-Encoding');
    //     $response->header('X-Powered-By', 'Laravel');
    //     $response->header('Access-Control-Allow-Origin', '*');

    //     // Modify the logo and image URLs in the feature collection
    //     $response->setData($this->modifyAssetUrls($response->getData(), $queryParam));

    //     return $response;
    // }


    // private function modifyAssetUrls($data, $queryParam)
    // {
    //     if (!isset($data->features) || !is_array($data->features)) {
    //         return $data;
    //     }
    //     foreach ($data->features as $feature) {
    //         if (isset($feature->properties->institu_logo)) {
    //             $feature->properties->institu_logo .= '?' . $queryParam;
    //         }
    //         if (isset($feature->properties->institu_images) && is_array($feature->properties->institu_images)) {
    //             foreach ($feature->properties->institu_images as $image) {
    //                 if (isset($image->src)) {
    //                     $image->src .= '?' . $queryParam;
    //                 }
    //             }
    //         }
    //     }

    //     return $data;
    // }



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
