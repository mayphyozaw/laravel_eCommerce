<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $income = Income::latest()->paginate(10);
        $todayIncome = Income::whereDay('created_at', date('d'))->sum('amount');
        return view('admin.income.index', compact('income', 'todayIncome'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.income.create');
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
            'title' => 'required',
            'amount' => 'required | numeric',
            'description' => 'required'
        ]);
        Income::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'description' => $request->description
        ]);
        return redirect()->back()->with('success', 'Income Created');
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
        $income = Income::where('id', $id)->first();
        if (!$income) {
            return redirect()->back()->with('error', 'Incomes not found');
        }
        return view('admin.income.edit', compact('income'));
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
            'title' => 'required',
            'amount' => 'required | numeric',
            'description' => 'required'
        ]);

        $income = Income::where('id', $id)->first();
        if (!$income) {
            return redirect()->back()->with('error', 'Incomes not Found');
        }


        Income::where('id', $id)->update([
            'title' => $request->title,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);
        return redirect()->back()->with('success', "Income Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $income = Income::where('id', $id)->first();
        if (!$income) {
            return redirect()->back()->with('error', 'Income Not Found');
        }
        $income->delete();
        return redirect()->back()->with('Income Deleted');
    }
}
