<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory as SubcategoryModel;
use App\Models\Category as CategoryModel;

class Subcategory extends Controller
{
    public function index()
    {
        $categorylist = CategoryModel::get();
        return view('admin.news.subcategory.index', compact('categorylist'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|max:255'
        ]);
        $subcategory = new SubcategoryModel();
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;
        $subcategory->save();

        return redirect('/admin/news/subcategory/list');
    }

    public function list()
    {
        $subcategorylist = SubcategoryModel::join('categories', 'subcategories.category_id', 'categories.id')->select('subcategories.*', 'categories.name as category_name')->get();
        return view('admin.news.subcategory.list', compact('subcategorylist'));
    }

    public function view($id)
    {
        $subcategory = SubcategoryModel::where('id', $id)->first();

        return view('admin.news.subcategory.view', compact('subcategory'));
    }

    public function edit($id)
    {
        $categorylist = CategoryModel::get();
        $subcategory = SubcategoryModel::where('id', $id)->first();
        return view('admin.news.subcategory.edit', compact('subcategory', 'categorylist'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|max:255'
        ]);
        $subcategory = SubcategoryModel::where('id', $request->id)->first();
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;
        $subcategory->save();

        return redirect('/admin/news/subcategory/list');
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $subcategory = SubcategoryModel::where('id', $id)->first();
        $subcategory->delete();

        return back();
    }

    public function getSubCategory($categoryId): \Illuminate\Http\JsonResponse
    {
        $subCategory = SubcategoryModel::where('category_id', $categoryId)->get();
        return response()->json($subCategory);
    }

    public function getSubCategoryByJson(Request $request)
    {
        $subCategory = SubcategoryModel::whereIn('category_id', json_decode($request->data))->get();
        return response()->json($subCategory);
        // return response()->json($request->data);
    }

    public function visible($id)
    {
        $subCategory = SubcategoryModel::where('id', $id)->first();
        $subCategory->visible = 1;
        $subCategory->save();
        return back();
    }

    public function invisible($id)
    {
        $subCategory = SubcategoryModel::where('id', $id)->first();
        $subCategory->visible = 0;
        $subCategory->save();
        return back();
    }
}
