<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use App\Models\Poll;
use App\Models\User;
use App\Models\Option;
use App\Models\Attachment;
use App\Models\Vote;
use Ramsey\Uuid\Uuid;
use App\Models\Notification;

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
        $users = User::whereNotIn('uuid', $poll->users->pluck('uuid'))->get();
        $votes = Vote::where('poll_uuid', $poll->uuid)->get();

        //Se o utilizador logado tiver um voto na poll, retorna algo
        $hasVoted = $votes->contains('user_uuid', Auth::user()->uuid);
        if (Auth::user()->uuid != $poll->owner_uuid && Auth::user()->user_type != 'admin') return view('app.vote', ['poll' => $poll, 'attachments' => $attachments, 'users' => $users, 'options' => $options, 'votes' => $votes, 'hasVoted' => $hasVoted]);
        else return view('app.pollView', ['poll' => $poll, 'attachments' => $attachments, 'users' => $users, 'options' => $options]);
    }  
    
    public function showByUser()
    {
        $polls = Poll::where('owner_uuid', auth()->user()->uuid)->get();
        $attachments = Attachment::all();

        return view('app.userPolls', ['polls' => $polls, 'attachments' => $attachments]);
    }

    public function sharedPolls()
    {
        $polls = Auth::user()->sharedPolls;
        $attachments = Attachment::all();

        return view('app.userPolls', ['polls' => $polls, 'attachments' => $attachments]);
    }

    public function togglePolls($currentRoute)
    {
        if ($currentRoute == 'my.polls') {
            return redirect()->route('shared.polls');
        } else if ($currentRoute == 'shared.polls') {
            return redirect()->route('my.polls');
        }
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

    public function deleteSelected(Request $request)
    {
        $selectedPollUuids = json_decode($request->input('selected_polls'));

        $polls = Poll::whereIn('uuid', $selectedPollUuids)->get();

        foreach ($polls as $poll) {
            $poll->delete();
        }

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

        $notification = new NotificationController();
        $notification->create($request);
        
        return redirect()->back()->with('success', 'Selected users added successfully.');
    }

    public function deleteSelectedUsers(Request $request, Poll $poll)
    {
        $selectedUserUuids = json_decode($request->input('selected_users'));

        $poll->users()->detach($selectedUserUuids);
        Notification::where('poll_uuid', $poll->uuid)->whereIn('user_uuid', $selectedUserUuids)->delete();

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

    public function searchPolls(Request $request)
    {
        $searchTerm = $request->input('search');
        $popularity = $request->input('popularity');
        $dateFilter = $request->input('date_filter');
       
        if ($searchTerm) {
            if (filter_var($searchTerm, FILTER_VALIDATE_URL) !== false) {
                return response()->json([
                    'error' => 'Invalid search. URLs are not allowed.',
                ], 400);
            }
   
            $disallowedHosts = ['localhost', '127.0.0.1', '::1'];
            $parsedUrl = parse_url($searchTerm);
   
            if (
                isset($parsedUrl['host']) && in_array($parsedUrl['host'], $disallowedHosts) ||
                isset($parsedUrl['scheme'])
            ) {
                return response()->json([
                    'error' => 'Invalid search. Hosts or URLs are not allowed.',
                ], 400);
            }
        }
   
        $polls = Poll::where('title', 'like', '%' . $searchTerm . '%')->get();
        $users = User::all();
        $attachments = Attachment::all();
   
        if ($popularity == '1') {
            $polls = $polls->sortByDesc(function ($poll) {
                return count($poll->votes);
            });
        } elseif ($popularity == '2') {
            $polls = $polls->sortBy(function ($poll) {
                return count($poll->votes);
            });
        }
   
        if ($dateFilter) {
            $polls = $polls->filter(function ($poll) use ($dateFilter) {
                return $poll->start_date >= $dateFilter;
            });
        }
   
        if (Auth::user()->user_type == 'admin') {
            return view('app.polls', [
                'polls' => $polls,
                'users' => $users
            ]);
        } else {
            return view('app.home', [
                'polls' => $polls,
                'attachments' => $attachments,
            ]);
        }
    }

}