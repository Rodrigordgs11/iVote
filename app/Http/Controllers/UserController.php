<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{
    public function show()
    { 
        $users = User::all();
        return view('app.users', ['users' => $users]);
    }

    public function create(Request $request)
    {

        // Create a new user
        $user = new User();

        $user->uuid = Uuid::uuid4()->toString();
        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->password = bcrypt($request->user_password);
        $user->phone_number = $request->user_phone;
        $user->user_type = $request->user_role;
        $user->save();

        // Redirect to the user's profile page
        return redirect()->route('users');
    }
}