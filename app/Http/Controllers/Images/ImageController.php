<?php

namespace App\Http\Controllers\Images;

use App\Http\Controllers\Controller;
use App\Models\Image_Model;
use App\Models\Institution_Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;


class ImageController extends Controller
{
    //
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
        $loadInstitutionImagesFromDB = Image_Model::withoutTrashed()->with('tb_institution')->get();
        $process = $this->setPageSession("Manage Institution Images", "m-inst");

        if ($process) {
            return $this->setReturnView('userpanels/pages/v_m_images', ['loadInstitutionImagesFromDB' => $loadInstitutionImagesFromDB]);
        }
    }

    public function add_img(Request $request)
    {
        $img = new Image_Model();
        $img->img_title = $request->input('modalEditImageTitle1');
        $img->img_alt = Str::slug($request->input('modalEditImageTitle1')) . "-alt";
        $img->img_descb = $request->input('modalEditImageDescb1') ?? '';
        $img->img_src = $request->input('modalEditImageSRC1');
        $img->institu_id = $request->input('modalEditInstitutionIDSelect1');
        // Handle the file upload for modalEditImageSRC1
        if ($request->hasFile('modalEditImageSRC1')) {
            $file = $request->file('modalEditImageSRC1');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            // Store the uploaded file in the storage/app/public directory
            Storage::putFileAs('public', $file, $filename);
            // Update the institution's logo field with the stored file path
            // $img->img_src = asset(env(key: 'APP_URL')) . '/public/storage/' . $filename;
            $img->img_src = asset(env(key: 'APP_URL')) . '/storage/app/public/' . $filename;
            $img->save();
        } else {
            // Handle case where no logo file is provided
            $img->img_src = asset(env(key: 'APP_NOIMAGE')); // Set a default value or handle the case as needed
            $img->save();
        }

        return redirect()->back();
    }


    public function edit_img(Request $request)
    {
        $img = Image_Model::find($request->input('modalEditImageID2'));
        if ($img) {
            $img->img_title = $request->input('modalEditImageTitle2');
            $img->img_alt = Str::slug($request->input('modalEditImageTitle2')) . "-alt";
            $img->img_descb = $request->input('modalEditImageDescb2');
            $img->institu_id = $request->input('modalEditInstitutionIDSelect2');
            // $img->img_src = $request->input('modalEditImageSRC2');


            if ($request->hasFile('modalEditImageSRC2')) {
                $file = $request->file('modalEditImageSRC2');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();

                // Store the uploaded file in the storage/app/public directory
                Storage::putFileAs('public', $file, $filename);
                // Update the institution's logo field with the stored file path
                $img->img_src = asset(env(key: 'APP_URL')) . '/public/storage/' . $filename;
                $img->save();
                return Redirect::back();
            }else{
                $img->save();
                return Redirect::back();
            }
        } else {
            // Handle the case when the mark is not found
            return response()->json(['error' => 'Image not found'], 404);
        }
    }


    public function delete_img(Request $request)
    {
        $img = Image_Model::find($request->input('img_id'));
        if ($img) {
            $img->delete();
            // return response()->json(['success' => 'Image deleted successfully']);
            return Redirect::back();
        } else {
            return response()->json(['error' => 'Image not found'], 404);
        }
    }


    public function get_img(Request $request)
    {
        $imgID = $request->input('imgID');
        $img = Image_Model::find($imgID);

        $instList = Institution_Model::all()->map(function ($inst) use ($img) {
            $selected = ($inst->institu_id == $img->institu_id);
            return [
                'value' => $inst->institu_id,
                'text' => $inst->institu_name,
                'selected' => $selected,
            ];
        });


        if ($img) {
            // Return the latitude and longitude as a JSON response
            return response()->json([
                'img_id' => $imgID,
                'img_title' => $img->img_title,
                'img_alt' => $img->img_alt,
                'img_descb' => $img->img_descb,
                'img_src' => $img->img_src,
                'institu_id' => $img->institu_id,
                'instList' => $instList
            ]);
        } else {
            // Handle the case when the mark is not found
            return response()->json(['error' => 'Image not found'], 404);
        }
    }


    public function load_marks_into_map()
    {
        $marks = Image_Model::all();

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
        $institutionList = Institution_Model::all()->map(function ($inst) {
            return [
                'value' => $inst->institu_id,
                'text' => $inst->institu_name,
                'selected' => false, // Set to true if this option should be selected
            ];
        });

        // Return the institutionList and catList as a JSON response
        return response()->json([
            'institutionList' => $institutionList
        ]);
    }


    public function reset_img()
    {
        // Delete all records from the tb_mark table
        Image_Model::query()->delete();

        // Reset the auto-increment value
        DB::statement('ALTER TABLE tb_image AUTO_INCREMENT = 1');

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
    public function setReturnView($viewurl, $loadInstitutionImagesFromDB = [])
    {
        $pageData = Session::get('page');
        $mergedData = array_merge($loadInstitutionImagesFromDB, ['pageData' => $pageData]);
        return view($viewurl, $mergedData);
    }
}
