<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::where('user_id', Auth::id())->with('histories')->get();
        return response()->json($barangs);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $barang = Barang::create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'message' => 'Barang berhasil ditambahkan.',
            'data' => $barang
        ], 201);
    }

    public function show($id)
    {
        $barang = Barang::where('user_id', Auth::id())->with('histories')->findOrFail($id);
        return response()->json($barang);
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric',
            'quantity' => 'sometimes|integer',
        ]);

        $oldQuantity = $barang->quantity;

        $barang->update([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        if ($oldQuantity != $request->quantity) {
            BarangHistory::create([
                'barang_id' => $barang->id,
                'user_id' => Auth::id(),
                'old_value' => $oldQuantity,
                'new_value' => $request->quantity,
            ]);
        }

        return response()->json([
            'message' => 'Barang berhasil diperbarui.',
            'data' => $barang
        ]);
    }

    public function destroy($id)
    {
        $barang = Barang::where('user_id', Auth::id())->findOrFail($id);
        $barang->delete();

        return response()->json([
            'message' => 'Barang berhasil dihapus.'
        ]);
    }

    public function deleteHistory($id)
    {
        $history = BarangHistory::where('user_id', Auth::id())->findOrFail($id);
        $history->delete();

        return response()->json([
            'message' => 'Riwayat berhasil dihapus.'
        ]);
    }
}
