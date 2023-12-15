<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\Poll;
use App\Models\User;
use App\Models\Option;
use App\Models\Attachment;
use App\Models\Vote;
use Ramsey\Uuid\Uuid;

class PollController extends Controller
{
    public function show()
    {
        $polls = Poll::all();
        $users = User::all();
        $attachments = Attachment::all();

        if (Auth::user()->user_type == 'admin') return view('app.polls', ['polls' => $polls, 'users' => $users]);
        else return view('app.home', ['polls' => $polls, 'attachments' => $attachments]);
    }
    

    public function showById(Poll $poll)
    {
        $attachments = Attachment::where('poll_uuid', $poll->uuid)->get();
        $options = Option::where('poll_uuid', $poll->uuid)->get();
        $voteCount = Vote::where('poll_uuid', $poll->uuid)->count();
        $users = User::whereNotIn('uuid', $poll->users->pluck('uuid'))->get();

        if (Auth::user()->uuid != $poll->owner_uuid && Auth::user()->user_type != 'admin') return view('app.vote', ['poll' => $poll, 'attachments' => $attachments, 'users' => $users, 'options' => $options, 'voteCount' => $voteCount]);
        else return view('app.pollView', ['poll' => $poll, 'attachments' => $attachments, 'users' => $users, 'options' => $options, 'voteCount' => $voteCount]);
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

        if ($request->has('avatar')) {
            $request->uuid = $poll->uuid;
            $attachment = new AttachmentController();
            $attachment->create($request);
        }

        return redirect()->route('polls.getId', ['poll' => $poll])->with('success', 'Poll created successfully');
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
            'title.required' => 'The title field is required.',
            'start_date.required' => 'The start date field is required.',
            'end_date.required' => 'The end date field is required.',
            'description.required' => 'The description field is required.',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $poll->update($request->all());
        
        return redirect()->back()->with('success', 'Poll updated successfully');
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
        return redirect()->back();
    }

    public function addSelectedUsers(Request $request, Poll $poll)
    {
        
        $rules = [
            'users.*' => 'required', 
        ];
        
        // Custom error messages
        $messages = [
            'users.*.required' => 'The field cannot be empty.',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $users = $request->input('users');

        $uniqueUsers = array_unique($users);
        $poll->users()->attach($uniqueUsers);

        return redirect()->back()->with('success', 'Selected users added successfully.');
    }

    public function deleteSelectedUsers(Request $request, Poll $poll)
    {
        $selectedUserUuids = json_decode($request->input('selected_users'));

        $poll->users()->detach($selectedUserUuids);

        return redirect()->back()->with('success', 'Selected users deleted successfully.');
    }

    public function addSelectedOptions(Request $request, Poll $poll)
    {
        $option = new OptionController();
        $option->create($request, $poll);

        return redirect()->back()->with('success', 'Selected options added successfully.');
    }

    public function deleteSelectedOptions(Request $request, Poll $poll)
    {
        $selectedOptionUuids = json_decode($request->input('selected_options'));
        //chamar o delete do option controller
        $option = new OptionController();
        $option->delete($selectedOptionUuids);

        return redirect()->back()->with('success', 'Selected options deleted successfully.');
    }
}