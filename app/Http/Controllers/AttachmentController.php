<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Route;

class AttachmentController extends Controller
{
    public function create(Request $request)
    {           
        $pollUuid = Route::input('poll');

        $input = $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $path = $input['avatar']->store('attachments', 'public');

        $attachment = new Attachment();
        $attachment->uuid = Uuid::uuid4()->toString();
        $attachment->attachment = $path;
        if($pollUuid != null) $attachment->poll_uuid = $pollUuid;
        else $attachment->poll_uuid = $request->uuid;
        $attachment->save();

        return redirect()->back();
    }
}