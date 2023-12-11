<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\Poll;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;

class OptionController extends Controller
{
    public function showById(Option $option)
    {
        return view('app.optionView', ['option' => $option]);
    }

    public function create(Request $request, Poll $poll)
    {
        // Validation rules
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];

        // Custom error messages
        $messages = [
            'title.required' => 'Title is required.',
            'description.required' => 'Description is required.',
        ];        

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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