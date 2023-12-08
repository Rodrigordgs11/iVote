<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Poll;
use App\Models\User;
use Ramsey\Uuid\Uuid;


class PollController extends Controller
{
    public function show()
    {
        $polls = Poll::all();
        $users = User::all();
        return view('app.polls', ['polls' => $polls, 'users' => $users]);
    }


    public function showById(Poll $poll)
    {
        $users = User::all();
        return view('app.pollView', ['poll' => $poll, 'users' => $users]);
    }

    public function create(Request $request)
    {
        $poll = new Poll();

        $poll->uuid = Uuid::uuid4()->toString();
        $poll->title = $request->poll_title;
        $poll->description = $request->poll_description;
        $poll->poll_privacy = $request->poll_privacy;
        $poll->start_date = $request->event_datetime_start;
        $poll->end_date = $request->event_datetime_end;
        $poll->owner_uuid = $request->user;
        $poll->save();

        return redirect()->route('polls');
    }

    public function update(Request $request, Poll $poll)
    {
         // Validation rules
         $rules = [
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required',
        ];

        // Custom error messages
        $messages = [
            'title.required' => 'The name field is required.',
            'start_date.required' => 'The email field is required.',
            'end_date.required' => 'The password field is required.',
            'description.required' => 'The phone number field is required.',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $poll->update($request->all());

        return redirect()->route('polls')->with('success', 'Poll updated successfully');
    }

    public function delete(Request $request)
    {
        $uuid = $request->input('uuid');

        // Find the user by UUID
        $poll = Poll::where('uuid', $uuid)->first();

        // If user not found, redirect back with error
        if (!$poll) {
            return redirect()->back()->withErrors(['Poll not found']);
        }

        // Delete the user
        $poll->delete();

        // Redirect to the users list page
        return redirect()->route('polls');
    }
}
