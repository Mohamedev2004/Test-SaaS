<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\ContactBrand;
use App\Models\ContactInfluencer;
use App\Models\Influencer;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
{
    $influencerCount = Influencer::count(); // Assuming you have an 'Influencer' model
    $brandCount = Brand::count(); // Assuming you have a 'Brand' model
    $influencerMessages = ContactInfluencer::count();
    $brandMessages = ContactBrand::count();
    $messages = $influencerMessages + $brandMessages;

    $influencers = Influencer::latest()->take(5)->get();
    $brands = Brand::latest()->take(5)->get();
    $sponsor = Sponsor::count();

    return view('admin.index', compact('influencerCount', 'brandCount', 'messages', 'influencers', 'brands', 'sponsor'));
}
}
