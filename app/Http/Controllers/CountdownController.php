<?php

namespace App\Http\Controllers;

use App\Models\CountdownSetting;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CountdownController extends Controller
{
    public function show()
    {
        $countdown = CountdownSetting::firstOrCreate([], [
            'original_end_time' => '2025-04-22 19:00:00',
            'current_end_time' => '2025-04-22 19:00:00',
            'extension_minutes' => 0
        ]);
        
        return view('countdown', [
            'countdownDate' => $countdown->current_end_time,
            'homeUrl' => url('/')
        ]);
    }

    public function adminView()
    {
        $countdown = CountdownSetting::firstOrCreate([], [
            'original_end_time' => '2025-04-22 19:00:00',
            'current_end_time' => '2025-04-22 19:00:00',
            'extension_minutes' => 0
        ]);
        
        return view('admin.countdown', compact('countdown'));
    }

    public function extendTime(Request $request)
    {
        $request->validate([
            'minutes' => 'required|integer|min:1|max:1440'
        ]);

        $countdown = CountdownSetting::first();
        
        // Convert minutes to integer explicitly
        $minutes = (int)$request->minutes;

        $countdown->update([
            'current_end_time' => Carbon::parse($countdown->current_end_time)
                ->addMinutes($minutes),
            'extension_minutes' => $countdown->extension_minutes + $minutes
        ]);

        return back()->with('success', "Countdown extended by {$minutes} minutes!");
    }

    public function updateOriginalTime(Request $request)
    {
        $request->validate([
            'original_end_time' => 'required|date|after:now',
        ]);

        $countdown = CountdownSetting::first();

        $newOriginal = Carbon::parse($request->original_end_time);

        $countdown->update([
            'original_end_time' => $newOriginal,
            'current_end_time' => $newOriginal, // reset current_end_time
            'extension_minutes' => 0            // reset extension
        ]);

        return back()->with('success', 'Original end time updated successfully!');
    }

}