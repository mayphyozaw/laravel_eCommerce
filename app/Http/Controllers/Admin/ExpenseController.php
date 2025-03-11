<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expense = Expense::latest()->paginate(10);
        $todayExpense = Expense::whereDay('created_at', date('d'))->sum('amount');
        return view('admin.expense.index', compact('expense', 'todayExpense'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.expense.create');
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
        Expense::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'description' => $request->description
        ]);
        return redirect()->back()->with('success', 'Expense Created');
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
        $expense = Expense::where('id', $id)->first();
        if (!$expense) {
            return redirect()->back()->with('error', 'Expenses not found');
        }
        return view('admin.expense.edit', compact('expense'));
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

        $expense = Expense::where('id', $id)->first();
        if (!$expense) {
            return redirect()->back()->with('error', 'Expenses not Found');
        }


        Expense::where('id', $id)->update([
            'title' => $request->title,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);
        return redirect()->back()->with('success', "Expenses Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::where('id', $id)->first();
        if (!$expense) {
            return redirect()->back()->with('error', 'Expense Not Found');
        }
        $expense->delete();
        return redirect()->back()->with('Expense Deleted');
    }
}
