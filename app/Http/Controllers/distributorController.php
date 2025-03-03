<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;

class distributorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $distri = Distributor::all();

        return view('pages.distributors.index', compact('distri'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('pages.distributors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_telp' => 'required|numeric|regex:/^[0-9]{13,15}$/',
            'alamat' => 'required|string|max:255',
        ]);


        Distributor::create([
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('distributor.index')->with('success', 'Distributor berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $distributor = Distributor::findOrFail($id);
        return view('pages.distributors.read', compact('distributor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $distributor = Distributor::findOrFail($id);
        $distributor->delete();

        return redirect()->route('distributor.index')->with('success', 'Distributor berhasil dihapus.');
    }
}
