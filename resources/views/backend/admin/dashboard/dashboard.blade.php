@extends('layout.backend.admin.master.master')

@section('title', trans('backend/general.dashboard'))

@section('page-header', trans('backend/general.dashboard'))

@section('breadcrumb')
        <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-tachometer"></i>{{ trans('backend/general.home') }}</a></li>
                <li class="active">{{ trans('backend/general.dashboard') }}</li>
        </ol>
@endsection

@section('content')
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-calendar-check-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ trans('backend/general.events') }}</span>
                    <span class="info-box-number">{{ $events }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-tags"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ trans('backend/general.promotions') }}</span>
                    <span class="info-box-number">{{ $promotions }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ trans('backend/general.users') }}</span>
                    <span class="info-box-number">{{ $users }}</span>
                </div>
            <!-- /.info-box-content -->
            </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-envelope-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ trans('backend/general.last_week_subscribers') }}LAST WEEK SUBSCRIBERS</span>
                    <span class="info-box-number">{{ $subscribers }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-8">
                    <!-- MAP & BOX PANE -->
                    <!-- /.box -->
                    <!-- /.row -->
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
@endsection