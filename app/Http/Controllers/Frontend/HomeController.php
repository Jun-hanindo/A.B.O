<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use View;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.partials.homepage');
    }

    public function discover()
    {
        return view('frontend.partials.discover');
    }

    public function event()
    {
        return view('frontend.partials.event');
    }

    public function promotion()
    {
        return view('frontend.partials.promotion');
    }


    public function eventSeated()
    {
        return view('frontend.partials.event_seated');
    }
}
