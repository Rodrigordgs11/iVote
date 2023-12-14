<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Poll;
use Illuminate\Support\Carbon;
use Illuminate\Support\CarbonPeriod;

class DashboardController extends Controller
{
    public function showStatistics()
    {
        $users = User::all();
        $usersCount = count($users);
        $progressBar = round(($usersCount * 100) / 20000);

        $pollsByDay = $this->getPollsByDay(); 

        return view('app.dashboard', ['progressBar' => $progressBar, 'pollsByDay' => $pollsByDay]);
    }

    public function getPollsByDay()
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
