<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDistributor;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = UserDistributor::where('user_id', auth()->id());

        // Filter berdasarkan nama jika ada
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Ambil data dengan paginasi
        $users = $query->paginate(5);

        // Kirim data ke view
        return view('pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Membuat user baru
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'reseller',
        ]);

        // Membuat distributor terkait dengan user yang login
        UserDistributor::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'distributor',
            'user_id' => auth()->id(), 
        ]);

        return redirect()->route('user.index')->with('success', 'Distributor berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil user distributor berdasarkan user_id yang sesuai dengan login user
        $user = UserDistributor::where('user_id', auth()->id())->findOrFail($id);

        return view('pages.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $validated = $request->validate([
        'name' => 'string|max:255',
        'email' => 'email|max:255',
    ]);

    $userDistributor = UserDistributor::where('user_id', auth()->id())->findOrFail($id);
    $user = User::where('email', $userDistributor->email)->first();

    $userDistributor->update($validated);

    if ($user) {
        $user->update($validated);
    }

    return redirect()->route('user.index')->with('success', 'User updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userDistributor = UserDistributor::where('user_id', auth()->id())->findOrFail($id);
    
        // Hapus data dari tabel users juga
        $user = User::where('email', $userDistributor->email)->first();
        if ($user) {
            $user->delete();
        }
    
        // Hapus data user_distributor
        $userDistributor->delete();
    
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
    
}
