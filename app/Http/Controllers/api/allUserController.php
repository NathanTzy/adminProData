<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class allUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }
}
