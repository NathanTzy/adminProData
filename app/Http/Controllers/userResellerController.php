<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserReseller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query to get only user reseller data for the logged-in user
        $query = UserReseller::where('user_id', auth()->id());

        // Check if the request has 'name' filter
        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Paginate the results with 5 per page
        $res = $query->paginate(5);

        // Return the view with the paginated results
        return view('pages.user-reseller.index', compact('res'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.user-reseller.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'reseller',
        ]);

        UserReseller::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'reseller',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('user-reseller.index')->with('success', 'User reseller berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $userReseller = UserReseller::where('user_id', auth()->id())->findOrFail($id);
        return view('pages.user-reseller.edit', compact('userReseller'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|max:255',
        ]);

        $userReseller = UserReseller::where('user_id', auth()->id())->findOrFail($id);
        $user = User::where('email', $userReseller->email)->first();

        $userReseller->update($validated);

        if ($user) {
            $user->update($validated);
        }

        return redirect()->route('user-reseller.index')->with('success', 'User updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userReseller = UserReseller::where('user_id', auth()->id())->findOrFail($id);

        // Hapus data dari tabel users juga
        $user = User::where('email', $userReseller->email)->first();
        if ($user) {
            $user->delete();
        }

        // Hapus data user_distributor
        $userReseller->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
