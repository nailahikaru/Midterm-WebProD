<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cash;
use Illuminate\Support\Facades\Auth;

class CashController extends Controller
{
    public function index()
    {
        // Ambil semua transaksi (terbaru di atas)
        $cashes = Cash::orderBy('date', 'desc')->get();

        // Hitung total pemasukan, pengeluaran, dan saldo akhir
        $totalIncome = Cash::where('type', 'income')->sum('amount');
        $totalExpense = Cash::where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        return view('cash.index', compact('cashes', 'totalIncome', 'totalExpense', 'balance'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        Cash::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        return redirect()->route('cash.index')->with('success', 'Transaction added successfully!');
    }

    public function destroy($id)
    {
        Cash::findOrFail($id)->delete();
        return redirect()->route('cash.index')->with('success', 'Transaction deleted!');
    }
}