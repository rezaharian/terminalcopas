<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Menampilkan semua kategori.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10); // Pagination, 10 data per halaman
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Menampilkan form tambah kategori.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        // Simpan ke database
        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit kategori.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update data kategori.
     */
    public function update(Request $request, Category $category)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        // Update ke database
        $category->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diupdate.');
    }

    /**
     * Hapus kategori dari database.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->route('admin.categories.index')->with('error', 'Kategori gagal dihapus: ' . $th->getMessage());
        }
    }

    /**
     * (Opsional) Menampilkan detail kategori tertentu (kalau mau pakai show).
     */
    public function show(Category $category)
    {
        // Kalau nggak dipakai, hapus method ini dari routes dan controller
        return view('admin.categories.show', compact('category'));
    }
}