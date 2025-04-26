<?php

namespace App\Console\Commands;

use App\Models\BrandPack;
use Illuminate\Console\Command;

class DeactivateBrandAccount extends Command
{
    protected $signature = 'brand:deactivate-account';
    protected $description = 'Deactivate brand accounts whose latest pack has expired.';

    public function handle()
    {
        $counter = 0;
        $brandPacks = BrandPack::with('brand.user')
            ->whereHas('brand.user', function ($query) {
                $query->where('status', 'Active');
            })
            ->whereIn('end_date', function ($sub) {
                $sub->selectRaw('MAX(end_date)')
                    ->from('brand_pack')
                    ->groupBy('brand_id');
            })
            ->get();

        foreach ($brandPacks as $brandPack) {
            if (now()->greaterThan($brandPack->end_date)) {
                $user = $brandPack->brand?->user;
                $user->update(['status' => 'Inactive']);
                $this->info('Brand account ' . $user->email . ' has been deactivated!');
                $counter++;
            }
        }

        $this->info('Done. Deactivated ' . $counter . ' brand accounts with expired packs.');
    }
}
