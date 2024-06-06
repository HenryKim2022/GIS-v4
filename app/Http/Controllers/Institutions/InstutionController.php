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
                // Update the institution's logo field with the stored file path
                $inst->institu_logo = asset(env(key: 'APP_URL')) . '/public/storage/' . $filename;
                $inst->save();
                return Redirect::back();
            }else{
                $inst->save();
                return Redirect::back();
            }
        } else {
            // Handle the case when the institution is not found
            return response()->json(['error' => 'Institution not found'], 404);
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
