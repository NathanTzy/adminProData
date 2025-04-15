<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use App\Models\User;
use Illuminate\Routing\Controller;

class homeController extends Controller
{
    public function index()
    {
        $users = User::paginate(5); 
        $distri = Distributor::paginate(5);
        return view('pages.dashboard', compact('users','distri'));
    }
}
