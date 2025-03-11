<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $cre = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($cre)) {
            return redirect('/admin')->with('success', 'Welcome Admin');
        }

        return back()->with('error', 'Email and Password are incorrect');
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect('/');
    }

    public function showDashboard()
    {
        $todayIncomeCount = Income::whereDay('created_at', date('d'))->sum('amount');
        $todayExpenseCount = Expense::whereDay('created_at', date('d'))->sum('amount');
        $userCount = User::count();
        $productCount = Product::count();


        $months = [date('F')];
        $yearMonth = [
            ['year' => date('Y'), 'month' => date('m')]
        ];


        for ($i = 1; $i <= 5; $i++) {
            $months[] = date('F', strtotime("-$i month"));

            $yearMonth[] = [
                'year' => date('Y', strtotime("-$i month")),
                'month' => date('m', strtotime("-$i month")),
            ];
        }

        $saleData = [];

        foreach ($yearMonth as $ym) {
            $saleData[] = ProductOrder::whereYear('created_at', $ym['year'])->whereMonth('created_at', $ym['month'])->count();
        }


        return view('admin.dashboard', compact('todayIncomeCount', 'todayExpenseCount', 'userCount', 'productCount', 'months', 'saleData'));
    }
}
