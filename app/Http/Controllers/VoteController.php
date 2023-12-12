<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poll;
use App\Models\Vote;

class VoteController extends Controller
{
    public function showById(Poll $poll)
    {
        $votes = Vote::where('poll_uuid', $poll->uuid)->get();
        return view('app.votes', ['votes' => $votes]);
    }
}
