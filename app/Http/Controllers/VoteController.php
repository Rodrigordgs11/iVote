<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\Vote;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function showById(Option $option)
    {
        $votes = Vote::where('option_uuid', $option->uuid)->get();
        return view('app.votes', ['votes' => $votes, 'option' => $option]);
    }

    public function create(Request $request)
    {
        $selectedOptionUuids = json_decode($request->selected_options);
        foreach ($selectedOptionUuids as $selectedOptionUuid) {
            $vote = new Vote();
            $vote->uuid = Uuid::uuid4()->toString();
            $vote->poll_uuid = $request->poll;
            $vote->option_uuid = $selectedOptionUuid;
            $vote->user_uuid = Auth::user()->uuid;
            $vote->save();
        }
        
        return redirect()->back();
    }
}
