<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use \App\Category as Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller {
    public function listCategories(Request $request)
    {
        // search case
        if ($request->isMethod('post'))
        {
            $this->validate($request,[
                'search' => 'required|alpha_num'
            ]);
            $data['categories'] = Category::where('wording_category', 'like', '%'.$request->search.'%')
                ->paginate(5);
        } else {
            $data['categories'] = Category::paginate(1);
        }

        return view('BackOffice.ListCategories', $data);
    }

    public function addCategory(Request $request) {
        $category = new Category();
        if($request->isMethod('post')) {
            //dd($request->all());
            $this->validate($request,[
                'wording_category' => 'required|max:255|unique:categories'
            ]);
            $category->wording_category = $request->wording_category;
            $category->save();

            Session::flash('flash_message', 'Catégorie créé');
            return redirect()->route('admin_category_list');
        }
        $data['category'] = $category;

        return view('BackOffice.addCategory', $data);
    }

    public function editCategory($id, Request $request)
    {

        $aCategories = Category::where(['id_category' => $id])->get();
        if ($aCategories->count() != 1) {
            echo 'not found';
            return false;
        }
        $category = $aCategories->first();

        if ($request->isMethod('post'))
        {
            $this->validate($request,[
                'wording_category' => 'required|max:255|unique:categories,wording_category,'.$category->id_category.',id_category',
            ]);

            $category->wording_category = $request->wording_category;
            $category->save();

            Session::flash('flash_message', 'Catégorie modifié');
            return redirect()->route('admin_category_list');

        }
        $data['category'] = $category;
        return view('BackOffice.editCategory', $data);
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        Session::flash('flash_message', 'Catégorie supprimé');

        return redirect()->route('admin_category_list');

    }

}