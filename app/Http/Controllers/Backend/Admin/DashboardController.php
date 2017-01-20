<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Trail;
use App\Models\Event;
use App\Models\Promotion;
use App\Models\User;
use App\Models\Subscription;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trail['desc'] = 'Dashboard';
        $insertTrail = new Trail();
        $insertTrail->insertNewTrail($trail);


        $eventModel = new Event();
        $data['events'] = $eventModel->countEvents();
        $data['total_events'] = $eventModel->countTotalEvents();
        $userModel = new User();
        $data['users'] = $userModel->countUsers();
        $promotionModel = new Promotion();
        $data['promotions'] = $promotionModel->countPromotions();
        $subscriptionModel = new Subscription();
        $data['subscribers'] = $subscriptionModel->countSubscribersLastWeek();

        return view('backend.admin.dashboard.dashboard', $data);
    }
}
