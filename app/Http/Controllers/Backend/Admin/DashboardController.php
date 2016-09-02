<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Trail;
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
        return view('backend.admin.dashboard.dashboard');
    }
}
