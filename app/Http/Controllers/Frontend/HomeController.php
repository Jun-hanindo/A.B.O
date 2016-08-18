<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Homepage;
use App\Models\Event;
use App\Models\Category;
//use View;

class HomeController extends Controller
{
    public function __construct(Homepage $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        $result['sliders'] = $this->model->getHomepage('slider');
        $result['events'] = $this->model->getHomepage('event');
        $result['src'] = url('uploads/events').'/';
        return view('frontend.partials.homepage', $result); 
    }

    public function discover()
    {
        $result['sliders'] = $this->model->getHomepage('slider');
        $result['src'] = url('uploads/events').'/';
        $result['categories'] = Category::all();
        $modelEvent = new Event();
        $limit = 9;
        $result['events'] = $modelEvent->getEvent($limit);
        dd($result['events']);
        return view('frontend.partials.discover', $result);
    }

    public function promotion()
    {
        return view('frontend.partials.promotion');
    }

    public function careers()
    {
        return view('frontend.partials.careers');
    }

    public function contactUs()
    {
        return view('frontend.partials.contact_us');
    }

    public function ourCompany()
    {
        return view('frontend.partials.our_company');
    }

    public function supportFaq()
    {
        return view('frontend.partials.support_faq');
    }

    public function searchResult()
    {
        return view('frontend.partials.search_result');
    }
}
