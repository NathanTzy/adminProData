<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Menampilkan semua data barang milik user yang sedang login
        $barang = Barang::where('user_id', auth()->id())->get();
        return view('pages.inventori.index', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk membuat barang baru
        return view('pages.inventori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        // Menyimpan data barang baru dengan user_id yang sedang login
        Barang::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'user_id' => auth()->id(), // Menambahkan user_id
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $barang = Barang::where('user_id', auth()->id())->findOrFail($id);
        return view('pages.inventori.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barang = Barang::where('user_id', auth()->id())->findOrFail($id);

        return view('pages.inventori.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        $oldQuantity = $barang->quantity;

        // Update barang
        $barang->update([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        // Jika ada perubahan pada quantity, simpan riwayat
        if ($oldQuantity != $request->quantity) {
            BarangHistory::create([
                'barang_id' => $barang->id,
                'user_id' => auth()->id(),
                'old_value' => $oldQuantity,
                'new_value' => $request->quantity,
            ]);
        }

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari barang berdasarkan ID dan menghapusnya
        $barang = Barang::where('user_id', auth()->id())->findOrFail($id);
        $barang->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }

    public function deleteHistory($id)
    {
        $history = \App\Models\BarangHistory::findOrFail($id);
        $history->delete();

        return back()->with('success', 'Riwayat berhasil dihapus.');
    }
}
