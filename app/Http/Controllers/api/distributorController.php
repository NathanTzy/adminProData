<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Distributor;
use Illuminate\Http\Request;

class distributorController extends Controller
{
    public function index()
    {
        return response()->json(Distributor::where('user_id', auth()->id())->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_telp' => 'required|numeric|digits_between:13,15',
            'alamat' => 'required|string|max:255',
        ]);

        $distributor = Distributor::create([
            'nama' => $validated['nama'],
            'no_telp' => $validated['no_telp'],
            'alamat' => $validated['alamat'],
            'user_id' => auth()->id(),
        ]);

        return response()->json(['message' => 'Distributor created successfully', 'data' => $distributor], 201);
    }

    public function show($id)
    {
        $distributor = Distributor::where('user_id', auth()->id())->findOrFail($id);
        return response()->json($distributor);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_telp' => 'required|numeric|digits_between:13,15',
            'alamat' => 'required|string|max:255',
        ]);

        $distributor = Distributor::where('user_id', auth()->id())->findOrFail($id);
        $distributor->update($validated);

        return response()->json(['message' => 'Distributor updated', 'data' => $distributor]);
    }

    public function destroy($id)
    {
        $distributor = Distributor::where('user_id', auth()->id())->findOrFail($id);
        $distributor->delete();

        return response()->json(['message' => 'Distributor deleted']);
    }
}
