<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with(['images', 'user'])->latest()->get();
        return view('portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('portfolios.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'nullable|string',
            'images' => 'required|array|min:1|max:5',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $portfolio = Portfolio::create([
            'user_id' => Auth::id(),
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
        ]);

        foreach ($request->file('images') as $file) {
            $name = $file->hashName();
            $file->move(public_path('uploads/portfolios'), $name);
            $portfolio->images()->create([
                'path' => 'uploads/portfolios/' . $name,
            ]);
        }

        return redirect()->route('portfolios.index')
            ->with('success', 'Portofolio berhasil ditambahkan.');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $data = $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'nullable|string',
        ]);

        $portfolio->update($data);

        return redirect()->route('portfolios.index')
            ->with('success', 'Portofolio berhasil diperbarui.');
    }

    public function destroy(Portfolio $portfolio)
    {
        foreach ($portfolio->images as $image) {
            File::delete(public_path($image->path));
        }

        $portfolio->delete();

        return redirect()->route('portfolios.index')
            ->with('success', 'Portofolio berhasil dihapus.');
    }
}