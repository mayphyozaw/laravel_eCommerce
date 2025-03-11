<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAddTransaction;
use App\Models\ProductRemoveTransaction;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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
        $products = Product::latest()->select('slug', 'name', 'image', 'total_qty', 'description')->paginate(5);
        return view('admin.product.index', compact('products'));
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
        $image_name = uniqid() . $image->getClientOriginalName();
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
        $supplier = Supplier::all();
        $category = Category::all();
        $color = Color::all();
        $brand = Brand::all();
        $p = Product::where('slug', $id)
            ->with('supplier', 'brand', 'color', 'category')
            ->first();
        if (!$p) {
            return redirect()->back()->with('error', 'Product Not found');
        }
        return view('admin.product.edit', compact('supplier', 'category', 'color', 'brand', 'p'));
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
        $find_product = Product::where('slug', $id);
        if (!$find_product->first()) {
            return redirect()->back()->with('error', 'Product Not Found');
        }
        $product_id = $find_product->first()->id;

        //image (if user chose image)
        if ($file = $request->file('image')) {
            $file_name = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('/images'), $file_name);
        } else { // if user not choose,
            $file_name = $find_product->first()->image;
        }


        //update
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

        $slug = uniqid() . Str::slug($request->name);
        $find_product->update([
            'category_id' => $category->id,
            'supplier_id' => $supplier->id,
            'brand_id' => $brand->id,
            'slug' => $slug,
            'name' => $request->name,
            'image' => $file_name,
            'discount_price' => $request->discount_price,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'total_qty' => $request->total_qty,
            'view_count' => 0,
            'like_count' => 0,
            'description' => $request->description
        ]);

        //color
        $product = Product::find($product_id);
        $product->color()->sync($colors);

        return redirect(route('product.edit', $slug))->with('success', 'Product has updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //find product
        $p = Product::where('slug', $id);
        if (!$p->first()) {
            return redirect()->back()->with('error', 'Product Not Found');
        }

        //remove image
        File::delete(public_path('/images/' . $p->first()->image));


        //delete product-color
        Product::find($p->first()->id)->color()->sync([]);

        //delete product
        $p->delete();
        return redirect()->back()->with('success', 'Product has been deleted');
    }

    public function imageUpload()
    {
        $file = request()->file('image');
        $file_name = uniqid() . $file->getClientOriginalName();
        $file->move(public_path('/images'), $file_name);
        return asset('/images/' . $file_name);
    }

    public function createProductAdd($slug)
    {

        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not Found');
        }
        $supplier = Supplier::all();
        return view('admin.product.create-product-add', compact('product', 'supplier'));
    }

    public function storeProductAdd(Request $request, $slug)
    {
        // product find
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not Found');
        }

        //store to transaction
        ProductAddTransaction::create([
            'product_id' => $product->id,
            'supplier_id' => $request->supplier_id,
            'total_qty' => $request->total_qty,
            'description' => $request->description
        ]);

        //update product
        $product->update([
            'total_qty' => DB::raw('total_qty+' . $request->total_qty)
        ]);
        return redirect()->back()->with('success', $request->total_qty . 'added.');
    }

    public function productAddTransaction()
    {
        $transactions = ProductAddTransaction::with('product')->paginate(5);
        return view('admin.product.add-transaction', compact('transactions'));
    }


    // Product decrease
    public function createProductRemove($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not Found');
        }
        return view('admin.product.create-product-remove', compact('product'));
    }

    public function storeProductRemove(Request $request, $slug)
    {
        // product find
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not Found');
        }

        //store to transaction
        ProductRemoveTransaction::create([
            'product_id' => $product->id,
            'total_qty' => $request->total_qty,
            'description' => $request->description,
        ]);

        //update product
        $product->update([
            'total_qty' => DB::raw('total_qty-' . $request->total_qty)
        ]);
        return redirect()->back()->with('success', $request->total_qty . 'removed.');
    }

    public function productRemoveTransaction()
    {
        $transactions = ProductRemoveTransaction::with('product')->paginate(2);
        return view('admin.product.add-transaction', compact('transactions'));
    }
}
