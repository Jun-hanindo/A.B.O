@extends('layout.backend.admin.master.master')

@section('title', 'Dashboard')

@section('page-header', 'Dashboard')

@section('breadcrumb')
        <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-tachometer"></i> Home</a></li>
                <li class="active">Dashboard</li>
        </ol>
@endsection

@section('content')
<section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Monthly Recap Report</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-wrench"></i></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="text-center">
                                        <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                                    </p>

                                    <div class="chart">
                                        <!-- Sales Chart Canvas -->
                                        <canvas id="salesChart" style="height: 180px;"></canvas>
                                    </div>
                                    <!-- /.chart-responsive -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <p class="text-center">
                                        <strong>Goal Completion</strong>
                                    </p>

                                    <div class="progress-group">
                                        <span class="progress-text">Add Products to Cart</span>
                                        <span class="progress-number"><b>160</b>/200</span>

                                        <div class="progress sm">
                                            <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                                        </div>
                                    </div>
                                    <!-- /.progress-group -->
                                    <div class="progress-group">
                                        <span class="progress-text">Complete Purchase</span>
                                        <span class="progress-number"><b>310</b>/400</span>

                                        <div class="progress sm">
                                            <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                                        </div>
                                    </div>
                                    <!-- /.progress-group -->
                                    <div class="progress-group">
                                        <span class="progress-text">Visit Premium Page</span>
                                        <span class="progress-number"><b>480</b>/800</span>

                                        <div class="progress sm">
                                            <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                                        </div>
                                    </div>
                                    <!-- /.progress-group -->
                                    <div class="progress-group">
                                        <span class="progress-text">Send Inquiries</span>
                                        <span class="progress-number"><b>250</b>/500</span>

                                        <div class="progress sm">
                                            <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                                        </div>
                                    </div>
                                    <!-- /.progress-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- ./box-body -->
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-3 col-xs-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                                        <h5 class="description-header">$35,210.43</h5>
                                        <span class="description-text">TOTAL REVENUE</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-xs-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                                        <h5 class="description-header">$10,390.90</h5>
                                        <span class="description-text">TOTAL COST</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-xs-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                                        <h5 class="description-header">$24,813.53</h5>
                                        <span class="description-text">TOTAL PROFIT</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-xs-6">
                                    <div class="description-block">
                                        <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                                        <h5 class="description-header">1200</h5>
                                        <span class="description-text">GOAL COMPLETIONS</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.box-footer -->
                    </div>
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
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Visitors Report</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="row">
                                <div class="col-md-9 col-sm-8">
                                    <div class="pad">
                                        <!-- Map will be created here -->
                                        <div id="world-map-markers" style="height: 325px;"></div>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3 col-sm-4">
                                    <div class="pad box-pane-right bg-green" style="min-height: 280px">
                                        <div class="description-block margin-bottom">
                                            <div class="sparkbar pad" data-color="#fff">90,70,90,70,75,80,70</div>
                                            <h5 class="description-header">8390</h5>
                                            <span class="description-text">Visits</span>
                                        </div>
                                        <!-- /.description-block -->
                                        <div class="description-block margin-bottom">
                                            <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                                            <h5 class="description-header">30%</h5>
                                            <span class="description-text">Referrals</span>
                                        </div>
                                        <!-- /.description-block -->
                                        <div class="description-block">
                                            <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                                            <h5 class="description-header">70%</h5>
                                            <span class="description-text">Organic</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    <!-- /.row -->
                    <!-- /.box -->
                </div>
                <!-- /.col -->

                <div class="col-md-4">
                    <!-- Info Boxes Style 2 -->
                    <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Inventory</span>
                            <span class="info-box-number">5,200</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 50%"></div>
                            </div>
                                    <span class="progress-description">
                                        50% Increase in 30 Days
                                    </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Mentions</span>
                            <span class="info-box-number">92,050</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 20%"></div>
                            </div>
                                    <span class="progress-description">
                                        20% Increase in 30 Days
                                    </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Downloads</span>
                            <span class="info-box-number">114,381</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                                    <span class="progress-description">
                                        70% Increase in 30 Days
                                    </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Direct Messages</span>
                            <span class="info-box-number">163,921</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 40%"></div>
                            </div>
                                    <span class="progress-description">
                                        40% Increase in 30 Days
                                    </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->

                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        {{--<div class="col-md-6 col-md-offset-3" align="center">
                <h2>Welcome to <b>{{ env('APP_WEB_ADMIN_NAME', 'AHLOO Web Admin') }}</b>!</h2>
                <h3>~ share things that you love ~</h3>
        </div>--}}
@endsection