<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\Poll;
use Ramsey\Uuid\Uuid;

class OptionController extends Controller
{
    public function showById(Option $option)
    {
        return view('app.optionView', ['option' => $option]);
    }

    public function create(Request $request, Poll $poll)
    {
        $option = new Option();
        $option->uuid = Uuid::uuid4()->toString();
        $option->title = $request->title;
        $option->description = $request->description;
        $option->poll_uuid = $poll->uuid;
        $option->save();

        return redirect()->back();
    }

    public function delete(array $selectedOptionUuids)
    {
        // Find and delete the options by UUIDs
        Option::whereIn('uuid', $selectedOptionUuids)->delete();
    }
}
