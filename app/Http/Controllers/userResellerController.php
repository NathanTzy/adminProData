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

        // Create the user in the users table
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'reseller',
        ]);

        // Create the user reseller record with the created user ID
        UserReseller::create([
            'user_id' => $user->id,
            'name' => $request->name, // You can store only essential details
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'reseller',
            // user id
            'user_id' => auth()->id(),
        ]);

        // Redirect to the index with success message
        return redirect()->route('user-reseller.index')->with('success', 'User reseller berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Fetch the reseller data and ensure it belongs to the current user
        $userReseller = UserReseller::where('user_id', auth()->id())->findOrFail($id);
        return view('pages.user-reseller.edit', compact('userReseller'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'string',
        ]);

        // Fetch the user reseller record
        $userReseller = UserReseller::where('user_id', auth()->id())->findOrFail($id);

        // Update the data
        $userReseller->update([
            'name' => $request->name,
        ]);

        // Optionally, you can update the associated User data if needed
        $user = User::findOrFail($userReseller->user_id);
        $user->update([
            'name' => $request->name,
        ]);

        // Redirect back with success message
        return redirect()->route('user-reseller.index')->with('success', 'User reseller berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Fetch the user reseller record and delete
        $userReseller = UserReseller::where('user_id', auth()->id())->findOrFail($id);

        // Delete the associated user
        User::where('id', $userReseller->user_id)->delete();

        // Delete the user reseller record
        $userReseller->delete();

        // Redirect with success message
        return redirect()->route('user-reseller.index')->with('success', 'User reseller berhasil dihapus.');
    }
}
