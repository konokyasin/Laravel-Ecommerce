<?php

namespace App\Http\Controllers;

use App\Category;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory()
    {
        $levels = Category::where(['parent_id'=>0])->get();
        return view('admin.category.add_category', compact('levels'));
    }

    public function storeCategory(Request $request)
    {
        $data = $request->all();
        $category = new Category;
        $category->name = $data['category_name'];
        $category->parent_id = $data['parent_category'];
        $category->url = $data['category_url'];
        $category->description = $data['category_description'];
        $category->save();

        session()->flash('working','Category has been added successfully');
        return redirect(route('admin.view-categories'));
    }

    public function viewCategories()
    {
        $categories = Category::all();
        return view('admin.category.view_category', compact('categories'));
    }

    public function editCategory($id=null)
    {
        $levels = Category::where(['parent_id'=>0])->get();
        $categoryDetails = Category::where(['id' => $id])->first();
        return view('admin.category.edit_category', compact('levels', 'categoryDetails'));
    }

    public function updateCategory(Request $request,$id=null)
    {
        $data = $request->all();
        Category::where(['id'=> $id])->update([
            'name' => $data['category_name'],
             'parent_id' => $data['parent_id'],
             'description' => $data['category_description'],
            'url' => $data['category_url']
        ]);

        return redirect('/admin/view-categories')->with('working', 'Category has been updated successfully!!');
    }

    public function deleteCategory($id = null)
    {
        Category::where(['id' => $id])->delete();
        Alert::success('Deleted Successfully', 'Category Deleted!!');
        return redirect()->back();
    }

    public function categoryStatus(Request $request, $id=null)
    {
        $data = $request->all();
        Category::where('id', $data['id'])->update(['status' => $data['status']]);
    }
}
