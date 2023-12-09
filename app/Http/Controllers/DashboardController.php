<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function showStatistics()
    {
        $users = User::all();
        $usersCount = count($users);
        $progressBar = round(($usersCount * 100) / 20000);
        
        return view('app.dashboard', ['progressBar' => $progressBar]);
    }
}