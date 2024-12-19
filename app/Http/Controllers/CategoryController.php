<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Kategori::all();
        return view('categories.create', compact('categories'));
    }

    public function create()
    {
        $categories = Kategori::all();
        return view('categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategoris,nama',
            'keterangan' => 'nullable|string|max:500',
        ]);

        Kategori::create($request->only(['nama', 'keterangan']));

        return redirect()->route('categories.create')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $categories = Kategori::all();
        $category = Kategori::findOrFail($id);
        return view('categories.create', compact('categories', 'category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategoris,nama,' . $id,
            'keterangan' => 'nullable|string|max:500',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->only(['nama', 'keterangan']));

        return redirect()->route('categories.create')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('categories.create')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}

