<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return redirect('/')->with('error', 'Product Not Found');
        }
        $category = Category::withCount('product')->get();
        $brand = Brand::all();
        return view('product-detail', compact('category', 'slug', 'brand'));
    }
}
