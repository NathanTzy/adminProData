<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class distributorController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        $query = Distributor::where('user_id', auth()->id());  // Filter berdasarkan user_id yang sedang login

        if ($request->has('name') && $request->name != '') {
            $query->where('nama', 'like', '%' . $request->name . '%');
        }

        $distributors = $query->paginate(5);

        return view('pages.distributors.index', compact('distributors'));
    }

    public function create()
    {
        return view('pages.distributors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_telp' => 'required|numeric|regex:/^[0-9]{13,15}$/',
            'alamat' => 'required|string|max:255',
        ]);

        // Menambahkan user_id sesuai dengan user yang sedang login
        Distributor::create([
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'role' => 'distributor',
            'user_id' => auth()->id(),  // Menyimpan user_id
        ]);

        return redirect()->route('distributor.index')->with('success', 'Distributor berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $distributor = Distributor::where('user_id', auth()->id())->findOrFail($id); // Hanya edit data milik user yang sedang login
        return view('pages.distributors.update', compact('distributor'));
    }

    public function show(string $id)
    {
        $distributor = Distributor::where('user_id', auth()->id())->findOrFail($id);

        return view('pages.distributors.read', compact('distributor'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telp' => 'required|numeric|digits_between:13,15',
            'alamat' => 'required|string|max:255',
        ]);

        $distributor = Distributor::where('user_id', auth()->id())->findOrFail($id);  // Hanya update data milik user yang sedang login

        $distributor->update([
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('distributor.show', $distributor->id)->with('success', 'Data distributor berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $distributor = Distributor::where('user_id', auth()->id())->findOrFail($id);  // Hanya hapus data milik user yang sedang login
        $distributor->delete();

        return redirect()->route('distributor.index')->with('success', 'Distributor berhasil dihapus.');
    }
}
