<?php

namespace App\Http\Controllers;

use App\Banners;
use App\Category;
use App\Products;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    
    public function index()
    {
        $banners = Banners::where('status', '1')->orderBy('sort_order', 'ASC')->get();
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $products = Products::paginate(3);
        return view('wayshop.index', compact('banners', 'categories', 'products'));
    }

    
    public function categories($category_id)
    {
        $categories = Category::with('categories')->where(['parent_id' => 0])->get();
        $products = Products::where(['category_id'=>$category_id])->get();
        $product_name = Products::where(['category_id' => $category_id])->first();
        return view('wayshop.category', compact('categories', 'products', 'product_name'));
    }

    public function home()
    {
        $banners = Banners::where('status', '1')->orderBy('sort_order', 'ASC')->get();
        $categories = Category::with('categories')->where(['parent_id' => 0])->get();
        $products = Products::paginate(3);
        return view('wayshop.index', compact('banners', 'categories', 'products'));
    }

    
}
