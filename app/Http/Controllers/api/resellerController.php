<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Reseller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class resellerController extends Controller
{
    public function index()
    {
        $resellers = Reseller::where('user_id', Auth::id())->get();
        return response()->json($resellers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telp' => 'required|numeric|digits_between:13,15',
            'alamat' => 'required|string|max:255',
        ]);

        $reseller = Reseller::create([
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'message' => 'Reseller berhasil ditambahkan.',
            'data' => $reseller
        ], 201);
    }

    public function show($id)
    {
        $reseller = Reseller::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($reseller);
    }

    public function update(Request $request, $id)
    {
        $reseller = Reseller::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telp' => 'required|numeric|digits_between:13,15',
            'alamat' => 'required|string|max:255',
        ]);

        $reseller->update([
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return response()->json([
            'message' => 'Reseller berhasil diperbarui.',
            'data' => $reseller
        ]);
    }

    public function destroy($id)
    {
        $reseller = Reseller::where('user_id', Auth::id())->findOrFail($id);
        $reseller->delete();

        return response()->json([
            'message' => 'Reseller berhasil dihapus.'
        ]);
    }
}
