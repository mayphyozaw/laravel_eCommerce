<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAddTransaction;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::all();
        $category = Category::all();
        $color = Color::all();
        $brand = Brand::all();
        return view('admin.product.create', compact('supplier', 'category', 'color', 'brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request->purchase_price;
        // return $request->category_slug;
        $request->validate([
            'name' => "required|string",
            'description' => "required|string",
            'total_qty' => "required|integer",
            'purchase_price' => "required|integer",
            'sale_price' => "required|integer",
            'discount_price' => "required|integer",
            'supplier_slug' => "required|string",
            'category_slug' => "required|string",
            'brand_slug' => "required|string",
            'color_slug.*' => "required|string",
            'image' => "required|mimes:jpg,png,jpeg,webp|max:2048",
        ]);

        // image upload
        $image = $request->file('image');
        $image_name = uniqid() . Str::slug($image->getClientOriginalName());
        $image->move(public_path('/images'), $image_name);

        // product store
        $category = Category::where('slug', $request->category_slug)->first();
        if (!$category) {
            return redirect()->back()->with('error', 'category not Found');
        }
        $supplier = Supplier::where('id', $request->supplier_slug)->first();
        if (!$supplier) {
            return redirect()->back()->with('error', 'supplier not Found');
        }
        $brand = Brand::where('slug', $request->brand_slug)->first();
        if (!$brand) {
            return redirect()->back()->with('error', 'brand not Found');
        }

        $colors = [];
        foreach ($request->color_slug as $c) {
            $color = Color::where('slug', $c)->first();
            if (!$color) {
                return redirect()->back()->with('error', 'color not found');
            }
            $colors[] = $color->id;
        }


        $product = Product::create([
            'category_id' => $category->id,
            'supplier_id' => $supplier->id,
            'brand_id' => $brand->id,
            'slug' => uniqid() . Str::slug($request->name),
            'name' => $request->name,
            'image' => $image_name,
            'discount_price' => $request->discount_price,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'total_qty' => $request->total_qty,
            'view_count' => 0,
            'like_count' => 0,
            'description' => $request->description
        ]);

        // add to transaction
        ProductAddTransaction::create([
            'product_id' => $product->id,
            'supplier_id' => $supplier->id,
            'total_qty' => $request->total_qty,
        ]);

        //store to product_color
        $p = Product::find($product->id);
        $p->color()->sync($colors);

        return redirect()->back()->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function imageUpload()
    {
        $file = request()->file('image');
        $file_name = uniqid() . $file->getClientOriginalName();
        $file->move(public_path('/images'), $file_name);
        return asset('/images/' . $file_name);
    }
}
