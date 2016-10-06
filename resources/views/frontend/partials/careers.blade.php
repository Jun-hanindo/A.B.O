@extends('layout.frontend.master.master')
@section('title', trans('frontend/general.careers').' - ')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
@section('content')
<section class="about-content career-content">
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar">
                @include('layout.frontend.partial.our_company_left_side')
            </div>
        </div>
        <div class="col-md-9">
            <div class="main-content">
                <div class="career-desc">
                    <div class="row">
                        <h3 class="head-about">Careers</h3>
                            {!! $content !!}
                        <div class="job-head">
                            <h4>We Have <span id="count-job">{{ $count_job }}</span> Job Openings</h4>
                            @if(!empty($departments))
                                <select class="form-control" id="department-filter">
                                    <option value="0">All Departments</option>
                                    @foreach($departments as $key => $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                        <div class="job-body">
                            @if(!empty($careers))
                                @foreach($careers as $key => $career)
                                    <div class="job-list {{ ($key == 0) ? 'job-list-head' : '' }}">
                                        <table>
                                            <tr>
                                                <td class="jobs">{{ $career->job }}</td>
                                                <td class="divisions">{{ $career->dept }}</td>
                                                <td class="job-type">{{ $career->type }}</td>
                                                <td class="payroll">{{ $career->currency_symbol_left.$career->salary.$career->currency_symbol_right }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="career-mobile mobile-content">
    <div class="row">
        <div class="col-md-12 mobile-sidebar">
            <div class="container">
                <div class="mobile-sidebar-menu">
                    @include('layout.frontend.partial.our_company_top_mobile')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="mobile-page-title">
                    <h3>Careers</h3>
                </div>
                <div class="mobile-page-desc">
                    {!! $content !!}
                </div>
                <div class="mobile-jobs-available">
                    <h3>We Have <span id="count-job">{{ $count_job }}</span> Job Openings</h3>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mobile-filter">
                            @if(!empty($departments))
                                <select class="form-control" id="department-filter">
                                    <option value="0">All Departments</option>
                                    @foreach($departments as $key => $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="job-body-mobile">
                    @if(!empty($careers))
                        @foreach($careers as $key => $career)
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="#" class="mobile-jobs-a">
                                        <div class="mobile-job-list">
                                            <div class="mobile-job-head">
                                                <h4>{{ $career->job }}</h4>
                                            </div>
                                            <div class="mobile-job-desc">
                                                <ul>
                                                    <li class="divisions">{{ $career->dept }}</li>
                                                    <li class="job-type">{{ $career->type }}</li>
                                                    <li class="payroll">{{ $career->salary }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
          

@stop
@include('frontend.partials.script.career_script')