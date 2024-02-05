<?php

namespace App\Http\Controllers;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function show()
    {
        $users = User::all();

        return view('app.users', ['users' => $users]);
    }

    public function showById(User $user)
    {
        $polls = $user->polls()->get();
        $votes = $user->votes()->get();
        return view('app.profile', ['user' => $user, 'polls' => $polls, 'votes' => $votes]);
    }

    public function create(Request $request)
    {
        // Validation rules
        $rules = [
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users,email',
            'user_password' => 'required|string|min:6',
            'user_phone' => 'required|string|max:20|unique:users,phone_number',
        ];

        // Custom error messages
        $messages = [
            'user_name.required' => 'The name field is required.',
            'user_email.required' => 'The email field is required.',
            'user_email.email' => 'Please enter a valid email address.',
            'user_email.unique' => 'This email address is already taken.',
            'user_password.required' => 'The password field is required.',
            'user_password.min' => 'The password must be at least :min characters.',
            'user_phone.required' => 'The phone number field is required.',
            'phone_number.unique' => 'The phone number already exists.',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // Create a new user
        $user = new User();

        $user->uuid = Uuid::uuid4()->toString();
        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->password = bcrypt($request->user_password);
        $user->phone_number = $request->user_phone;
        $user->user_type = $request->user_role;

        if ($request->has('avatar')) {
            $path = $input['avatar']->store('users', 'public');
            $user->photo = $path;
        } else {
            $user->photo = null;
        }

        $user->save();
        
        // Redirect to the user's profile page
        return redirect()->route('users.get')->with('success', 'User created successfully');
    }

    public function update(User $user, Request $request)
    {
        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone_number' => 'required|string|max:20|unique:users,phone_number',
        ];

        // Check if email is the same as the user's current email
        if ($request->input('email') === $user->email) {
            // Remove the email validation rule
            unset($rules['email']);
        }

        // Check if email is the same as the user's current email
        if ($request->input('phone_number') === $user->phone_number) {
            // Remove the email validation rule
            unset($rules['phone_number']);
        }

        // Custom error messages
        $messages = [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least :min characters.',
            'phone_number.required' => 'The phone number field is required.',
            'phone_number.unique' => 'The phone number already exists.',
        ];

        $input = $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->has('avatar')) {
            $path = $input['avatar']->store('users', 'public');
            $user->photo = $path;
        } else {
            $user->photo = null;
        }

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $user->update($request->all());

        return redirect()->back()->with('success', 'User updated successfully');
    }

    public function delete(Request $request)
    {
        $uuid = $request->input('uuid');

        // Find the user by UUID
        $user = User::where('uuid', $uuid)->first();

        // If user not found, redirect back with error
        if (!$user) {
            return redirect()->back()->withErrors(['User not found']);
        }

        // Delete the user
        $user->delete();

        // Redirect to the users list page
        return redirect()->back();
    }

    public function deleteSelected(Request $request)
    {
        $selectedUserUuids = json_decode($request->input('selected_users', []));

        $users = User::whereIn('uuid', $selectedUserUuids)->get();

        foreach ($users as $user) {
            $user->delete();
        }
        
        return redirect()->back();
    }


}


