<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::latest()->paginate(3);
        return view('admin.supplier.index', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { {
            $request->validate([
                'name' => 'required',
                'image' => 'required|mimes:jpg,png,jpeg,webp|max:2048',
                'description' => 'required',

            ]);

            // *Image file Upload *//


            // $image = $request->file('image');
            // $image_name = uniqid() . $image->getClientOriginalName();
            // $image->move(public_path('/images'), $image_name);

            $file = $request->file('image');
            $file_name = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('/images') . $file_name);

            Supplier::create([
                'name' => $request->name,
                'image' => $file_name,
                'description' => $request->description,

            ]);
            return redirect()->back()->with('success', 'Supplier Created Success');
        }
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
        $s = Supplier::find($id);
        if (!$s) {
            return redirect()->back()->with('error', 'Supplier not found');
        }


        return view('admin.supplier.edit', compact('s'));
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
        $request->validate([
            'name' => 'required',

        ]);

        $s = Supplier::where('id', $id)->first();
        if (!$s) {
            return redirect()->back()->with('error', 'Supplier not found');
        }


        if ($request->file('image')) {
            $file = $request->file('image');
            $file_name = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('/images'), $file_name);
        } else {
            $file_name = $s->image;
        }
        Supplier::where('id', $id)->update([
            'name' => $request->name,
            'image' => $file_name,
            'description' => $request->description,
        ]);
        return redirect()->back()->with('success', 'Supplier Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $s = Supplier::where('id', $id)->first();
        if (!$s) {
            return redirect()->back()->with('error', 'Supplier not found');
        }

        $s->delete();
        return redirect()->back()->with('Supplier Deleted');
    }
}
