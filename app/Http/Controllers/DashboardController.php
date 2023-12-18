<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Support\Carbon;
use Illuminate\Support\CarbonPeriod;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function showStatistics()
    {
        $users = User::all();
        $usersCount = count($users);
        $progressBarUser = round(($usersCount * 100) / 20000);

        $votes = Vote::all();
        $votesCount = count($votes);
        $progressBarVote = round(($votesCount * 100) / 15000);

        $polls = Poll::where('start_date', '<=', now())->get();
        $pollsCount = count($polls);
        $progressBarPoll = round(($pollsCount * 100) / 500);

        $numberOfVisits = Cache::get('visitor_count', 0);
        $progressBarVisit = round(($numberOfVisits * 100) / 100);
        
        $bestContributors = Vote::select('users.name', 'users.email', 'users.uuid')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('user_uuid')
            ->orderByDesc('total')
            ->limit(5)
            ->join('users', 'votes.user_uuid', '=', 'users.uuid')
            ->get();

        $pollsByDay = $this->getPollsByDay(); 

        return view('app.dashboard', ['progressBarUser' => $progressBarUser, 'pollsByDay' => $pollsByDay, 'progressBarVote' => $progressBarVote, 'progressBarPoll' => $progressBarPoll, 'progressBarVisit' => $progressBarVisit, 'bestContributors' => $bestContributors]);
    }

    private function getPollsByDay()
    {
        $next7Days = [];
        for ($i = 0; $i < 7; $i++) {
            $next7Days[] = Carbon::now()->addDays($i)->format('D'); // Day of the week
        }

        $pollsByDay = [];
        foreach ($next7Days as $day) {
            $pollsForDay = Poll::whereDate('start_date', Carbon::now()->addDays(array_search($day, $next7Days)))
                ->orderBy('start_date', 'asc')
                ->get();

            $pollsByDay[$day] = $pollsForDay;
        }

        return $pollsByDay;
    }
}
