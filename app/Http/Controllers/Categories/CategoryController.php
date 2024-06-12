<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category_Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;



class CategoryController extends Controller
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
    // public function index()
    // {
    //     $loadCategoriesFromDB = Category_Model::withoutTrashed()->get(); // Retrieve the marks from the database (exclude: softDeleted's).
    //     $process = $this->setPageSession("Manage Categories", "m-categories");
    //     if ($process) {
    //         return $this->setReturnView('userpanels/pages/v_m_categories', ['loadCategoriesFromDB' => $loadCategoriesFromDB]);
    //     }
    // }


    //
    public function index()
    {
        $process = $this->setPageSession("Manage Categories", "m-categories");
        if ($process) {
            $loadCategoriesFromDB = Category_Model::withoutTrashed()->get(); // Retrieve the marks from the database (exclude: softDeleted's).
            $data = [
                'loadCategoriesFromDB' => $loadCategoriesFromDB,
            ];
            return $this->setReturnView('userpanels/pages/v_m_categories', $data);
        }
    }



    public function add_categories(Request $request)
    {
        $catName = $request->input('modalEditCategoryName1');

        $cat = new Category_Model();
        $cat->cat_name = $catName;
        $cat->save();
        Session::flash('success', ['Category added successfully']);
        return Redirect::back();
    }


    public function edit_categories(Request $request)
    {
        $cat = Category_Model::where('cat_id', $request->input('modalEditCatID2'))->first();
        if ($cat) {
            $cat->cat_name = $request->input('modalEditCategoryName2');
            $cat->save();
            Session::flash('success', ['Category updated successfully']);
            return Redirect::back();
        } else {
            Session::flash('errors', ['Err[404]: Category updated failed!']);
        }
    }


    public function delete_categories(Request $request)
    {
        $cat = Category_Model::find($request->input('cat_id'));
        if ($cat) {
            $institutions = $cat->tb_institution()->get();
            if ($institutions->isNotEmpty()) {
                $institutionNames = $institutions->pluck('institu_name')->toArray();
                $error = 'categories is used by the following institution('. implode(', ', $institutionNames) .') and cannot be deleted.';
                Session::flash('n_errors', ['This ' . $error]);
            }else{
                $cat->delete();
                Session::flash('success', ['Category deletion successfully']);
            }
        } else {
            Session::flash('errors', ['Err[404]: Category deletion failed!']);
        }
        return redirect()->back();
    }





    public function get_categories(Request $request)
    {
        $catID = $request->input('catID');
        $cat = Category_Model::find($catID);

        if ($cat) {
            // Return the latitude and longitude as a JSON response
            return response()->json([
                'cat_id' => $catID,
                'category_name' => $cat->cat_name
            ]);
        } else {
            // Handle the case when the mark is not found
            return response()->json(['error' => 'Category not found'], 404);
        }
    }




    public function reset_categories(Request $request)
    {
        // Delete all records from the tb_mark table
        Category_Model::query()->delete();
        // Reset the auto-increment value
        DB::statement('ALTER TABLE tb_category AUTO_INCREMENT = 1');
        Session::flash('success', ['All categories data reset successfully!']);
        // Redirect back to the previous page
        return redirect()->back();
    }






    ///////////////////////////// PAGE TITLE & URL SETTER ////////////////////////////
    public function setPageSession($pageTitle, $pageUrl)    // Param1 = page title, Param2 = page url !
    {
        $pageData = Session::get('page');
        $pageData['page_title'] = $pageTitle;
        $pageData['page_url'] = $pageUrl;

        // Store the updated array back in the session
        Session::put('page', $pageData);
        return true;
    }
    public function setReturnView($viewurl, $loadCategoriesFromDB = [])
    {
        $pageData = Session::get('page');
        $mergedData = array_merge($loadCategoriesFromDB, ['pageData' => $pageData]);
        return view($viewurl, $mergedData);
    }
}
