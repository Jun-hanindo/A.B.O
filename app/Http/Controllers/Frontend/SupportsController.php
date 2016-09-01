<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ManagePage;
//use View;

class SupportsController extends Controller
{
    public function __construct(Event $model)
    {
        parent::__construct($model);
    }

    public function index($slug)
    {
        $result['support'] = $this->model->findPageBySlug($slug);
        if(!empty($result['support'])){
            
        }else{
            return view('errors.404');
        }
    }
}
