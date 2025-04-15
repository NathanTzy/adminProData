<?php

namespace App\Http\Controllers;

use App\Models\Reseller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class resellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index(Request $request)
    {
        $query = Reseller::query();

        if ($request->has('name') && $request->name != '') {
            $query->where('nama', 'like', '%' . $request->name . '%');
        }

        $re = $query->paginate(5);
        return view('pages.reseller.index', compact('re'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.reseller.create');
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
        
        Reseller::create([
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('reseller.index')->with('success', 'Distributor berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $re = Reseller::findOrFail($id);
        return view('pages.reseller.read', compact('re'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $re = Reseller::findOrFail($id);
        return view('pages.reseller.update', compact('re'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telp' => 'required|numeric|digits_between:13,15',
            'alamat' => 'required|string|max:255',
        ]);

        $re = Reseller::findOrFail($id);

        $re->update([
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('reseller.index', $re->id)->with('success', 'Data reseller berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $re = Reseller::findOrFail($id);
        $re->delete();

        return redirect()->route('reseller.index')->with('success', 'Reseller berhasil dihapus.');
    }
}
