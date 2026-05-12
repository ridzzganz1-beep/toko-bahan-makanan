<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

/**
 * Controller untuk CRUD barang pada toko bahan makanan.
 */
class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $barangs = Barang::orderBy('nama')->paginate(10);

        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $uploadPath = public_path('images/barangs');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $imageName = time() . '_' . uniqid() . '.' . $request->gambar->extension();
            $request->gambar->move($uploadPath, $imageName);
            $data['gambar'] = $imageName;
        }

        Barang::create($data);

        return redirect()->route('admin.barangs.index')
            ->with('success', 'Barang berhasil dibuat.');
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $uploadPath = public_path('images/barangs');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Delete old image if exists
            if ($barang->gambar && file_exists($uploadPath . '/' . $barang->gambar)) {
                unlink($uploadPath . '/' . $barang->gambar);
            }

            $imageName = time() . '_' . uniqid() . '.' . $request->gambar->extension();
            $request->gambar->move($uploadPath, $imageName);
            $data['gambar'] = $imageName;
        }

        $barang->update($data);

        return redirect()->route('admin.barangs.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        // Delete image file if exists
        if ($barang->gambar && file_exists(public_path('images/barangs/' . $barang->gambar))) {
            unlink(public_path('images/barangs/' . $barang->gambar));
        }

        $barang->delete();

        return redirect()->route('admin.barangs.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}
