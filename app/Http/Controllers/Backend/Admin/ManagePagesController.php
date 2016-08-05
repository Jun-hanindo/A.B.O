<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\Admin\BaseController;

class ManagePagesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEditContactUs()
    {
        //
        return view('backend.admin.manage_page.contact_us.form');
    }

    public function storeUpdateContactUs(){
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEditTermsAndConditions()
    {
        //
        return view('backend.admin.manage_page.terms_and_conditions.form');
    }

    public function storeUpdateTermsAndConditions(){
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createEditFaq()
    {
        //
        return view('backend.admin.manage_page.faq.form');
    }

    public function storeUpdateFaq(){
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createEditCareer()
    {
        //
        return view('backend.admin.manage_page.career.form');
    }

    public function storeUpdateCareer(){
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createEditPrivacyPolicy()
    {
        //
        return view('backend.admin.manage_page.privacy_policy.form');
    }

    public function storeUpdatePrivacyPolicy(){
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createEditAboutUs()
    {
        //
        return view('backend.admin.manage_page.about_us.form');
    }

    public function storeUpdateAboutUs(){
        
    }
}
