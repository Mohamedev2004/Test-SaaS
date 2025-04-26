<?php

use App\Console\Commands\DeactivateBrandAccount;
use App\Console\Commands\SendPackReminders;
use Illuminate\Support\Facades\Schedule;



Schedule::command(SendPackReminders::class)->daily();
Schedule::command(DeactivateBrandAccount::class)->daily();