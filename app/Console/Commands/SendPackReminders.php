<?php

namespace App\Console\Commands;

use App\Mail\PackExpiringSoonMail;
use App\Models\BrandPack;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendPackReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pack:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command send mail to the brands whose pack is about to get expired.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $targetDay = now()->addDays(7)->format('Y-m-d');
        $targetBrandPacks = BrandPack::where('end_date',$targetDay)->with('brand')->get();

        foreach ($targetBrandPacks as $brandPack) {
            Mail::to($brandPack->brand->user->email)->send(new PackExpiringSoonMail($brandPack->brand->user->name,$targetDay));
            $this->info('pack expiring email sent to '.$brandPack->brand->user->email);
        }
        $this->info('All pack expiring emails sent successfully!');
    }
}
