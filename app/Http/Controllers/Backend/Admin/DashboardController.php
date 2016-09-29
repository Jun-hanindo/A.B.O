<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Trail;
use App\Models\Event;
use App\Models\Promotion;
use App\Models\Career;
use App\Models\User;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('sentinel_access:dashboard');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trail = 'Dashboard';
        $insertTrail = new Trail();
        $insertTrail->insertTrail($trail);


        $eventModel = new Event();
        $data['events'] = $eventModel->countEvents();
        $userModel = new User();
        $data['users'] = $userModel->countUsers();
        //dd($data['events']);

        return view('backend.admin.dashboard.dashboard', $data);
    }
}
