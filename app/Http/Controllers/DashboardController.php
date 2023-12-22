<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Poll;
use App\Models\Vote;
use App\Models\Statistics;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function showStatistics()
    {
        $usersCount = User::count();
        $progressBarUser = $this->calculateProgressBar($usersCount, 20000);

        $votesCount = Vote::count();
        $progressBarVote = $this->calculateProgressBar($votesCount, 15000);

        $pollsCount = Poll::where('start_date', '<=', now())->where('end_date', '>=', now())->count();
        $progressBarPoll = $this->calculateProgressBar($pollsCount, 500);

        $numberOfVisits = Cache::get('visitor_count', 0);
        $progressBarVisit = $this->calculateProgressBar($numberOfVisits, 100);

        $this->updateStatistics('users_count', $usersCount);
        $this->updateStatistics('votes_count', $votesCount);
        $this->updateStatistics('polls_count', $pollsCount);
        $this->updateStatistics('visits_count', $numberOfVisits);

        $bestContributors = $this->getBestContributors();

        $pollsByDay = $this->getPollsByDay(); 

        return view('app.dashboard', compact('progressBarUser', 'pollsByDay', 'progressBarVote', 'progressBarPoll', 'progressBarVisit', 'bestContributors'));
    }

    private function calculateProgressBar($value, $total)
    {
        return round(($value * 100) / $total);
    }

    private function getBestContributors()
    {
        return Vote::select('users.name', 'users.email', 'users.uuid', 'users.photo')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('user_uuid')
            ->orderByDesc('total')
            ->limit(5)
            ->join('users', 'votes.user_uuid', '=', 'users.uuid')
            ->get();
    }

   private function updateStatistics($name, $value)
    {
        $statistic = Statistics::where('name', $name)->first();
        if ($statistic) {
            $statistic->update(['value' => $value]);
        } else {
            $statistic = new Statistics();
            $statistic->uuid = Uuid::uuid4()->toString();
            $statistic->name = $name;
            $statistic->value = $value;
            $statistic->save();
        }
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
