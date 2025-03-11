<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $color = Color::latest()->paginate(3);
        return view('admin.color.index', compact('color'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.color.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        Color::create([
            'slug' => Str::slug($request->name) . uniqid(),
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Color Created Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $col = Color::where('slug', $id)->first();
        if (!$col) {
            return redirect()->back()->with('error', 'Color Not Found');
        }

        return view('admin.color.edit', compact('col'));
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
        $col = Color::where('slug', $id)->first();
        if (!$col) {
            return redirect()->back()->with('error', 'Color Not Found');
        }

        Color::where('slug', $id)->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Color Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $col = Color::where('slug', $id)->first();
        if (!$col) {
            return redirect()->back()->with('error', 'Color Not Found');
        }
        $col->delete();
        return redirect()->back()->with('Color Deleted');
    }
}
