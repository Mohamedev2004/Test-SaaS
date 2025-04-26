<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\Meeting;


class MeetingController extends Controller
{
    public function index()
    {
        $meetings = Meeting::all();
        return view('admin.meetings.meetings', compact('meetings'));
    }
}
