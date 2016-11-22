@extends('layout.backend.admin.master.master')

@section('title')
Tixtrack
@endsection

@section('header')
        {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}

        <style>
            .activity-log-filter-date {
                    padding-bottom:20px;
            }
            .activity-log-filter-chart {
                    padding-bottom:20px;
            }
        </style>
@endsection

@section('content')
    <div class="row" id="report-tixtrack-box">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                        <h3 class="box-title">{{ trans('general.report_tixtrack') }}</h3>
                </div>
                {!! Form::open(array('url' => route('admin-report-tixtrack'),'method'=>'GET','id'=>'form-account', 'class' => 'form-horizontal')) !!}
                    <div class="box-body">
                        @include('flash::message')
                        <div class="form-group">
                            <label for="event" class="col-sm-1 control-label">{{ trans('general.event') }} :</label>
                            <div class="col-sm-5">
                                <select name="event" id="event" class="form-control">
                                    @if(!empty($events))
                                        @foreach($events as $key => $value)
                                            <option value="{{ $value->event_id_tixtrack }}" {{ !empty($event_id) ? ($value->event_id_tixtrack == $event_id) ? 'selected' : '' : '' }}>{{ $value->event_id_tixtrack }} - {{ $value->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="start_date" class="col-sm-1 control-label">{{ trans('general.from') }} :</label>
                            <div class="col-sm-3">
                                <input name="start_date" class="form-control datepicker" id="start_date" data-date-end-date="0d" value={{ (!empty($start_date)) ? date('Y-m-d', strtotime($start_date)) : date('Y-m-d',strtotime('-7days')) }}>
                            </div>
                            <label for="end_date" class="col-sm-1 control-label">{{ trans('general.to') }} :</label>
                            <div class="col-sm-3">
                                <input name="end_date" class="form-control datepicker" id="end_date" data-date-end-date="0d" value={{ (!empty($end_date)) ? date('Y-m-d', strtotime($end_date)) : date('Y-m-d') }}>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! Form::submit('Apply', ['class' => 'btn btn-primary pull-right', 'id' => 'btn_apply_report']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="box" id="report-box">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('admin-report-tixtrack-excel', 'event='.$event_id.'&start_date='.$start_date.'&end_date='.$end_date) }}" title="{{ trans('general.create_new') }}"><i class="fa fa-print fa-fw"></i></a>
                        <a class="btn btn-success" href="{{ route('admin-report-tixtrack-excel', 'event='.$event_id.'&start_date='.$start_date.'&end_date='.$end_date) }}" title="{{ trans('general.create_new') }}"><i class="fa fa-file-excel-o fa-fw"></i></a>
                        <a class="btn btn-danger" href="{{ route('admin-report-tixtrack-pdf', 'event='.$event_id.'&start_date='.$start_date.'&end_date='.$end_date) }}" title="{{ trans('general.create_new') }}"><i class="fa fa-file-pdf-o fa-fw"></i></a>
                    </div>
                </div>
                <div class="box-body">
                    <page class="report-page">
                        <div class="report-box">
                            <div class="logo-title">
                                <img src="{{ asset('/assets/backend/admin/img/abo.png') }}">
                            </div>
                            <h3 class="title-report"><b>DAILY SALES SUMMARY REPORT BY EVENT</b></h3>
                            <br>
                            <br>
                            <table class="table-title">
                                <tbody>
                                    <tr>
                                        <td class="column-1">Event:</td>
                                        <td><b>{{ $event->title }}</b></td>
                                    </tr>
                                    <tr>
                                        <td class="column-1">Report Period:</td>
                                        <td>{{ short_text_date($start_date) .' to '. short_text_date($end_date) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            @if(!$dateCats->isEmpty())
                                <table>
                                    <thead>
                                        <tr>
                                            <th rowspan="2" align="center" style="background: #e7e6e6;border-bottom:1px solid #000;width:70px;">Sale Date</th>
                                            <th rowspan="2" align="center" style="background: #e7e6e6;border-bottom:1px solid #000;width:70px;">Event Day/Time</th>
                                            <th rowspan="2" align="center" style="background: #e7e6e6;border-bottom:1px solid #000;"></th>
                                            <th colspan="{{ $countCat }}" align="center" style="background:#e7e6e6;border:1px solid #000;">PRICE LEVEL/CATEGORY</th>
                                            <th rowspan="2" align="center" style="background: #e7e6e6;border-bottom:1px solid #000;">Total</th>
                                        </tr>
                                        <tr>
                                            @if($countCat > 0)
                                                @php
                                                    $cCat = 1;
                                                @endphp
                                                @foreach($categories as $key => $cat)  
                                                    <th style="background:#e7e6e6;border:1px solid #000;{{ ($cCat == $countCat) ? 'border-right:2px solid #000;' : '' }}">{{ $cat->price_level_name }}</th>
                                                    @php
                                                        $cCat++;
                                                    @endphp
                                                @endforeach
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dateCats as $key2 => $dateCat) 
                                            <tr>
                                                <td align="right" class="column-2">{{ date('d-M-Y', strtotime($dateCat->local_created)) }}</td>
                                                <td align="right" class="column-2">{{ date('d-M-Y,', strtotime($dateCat->event_date)) }}</td>
                                                <td align="right">Full Amount:</td>
                                                @if($countCat > 0)
                                                    @foreach($dateCat->amounts as $key3 => $amount) 
                                                        <td align="right">{{ number_format_decimals($amount->full_price) }}</td>
                                                    @endforeach
                                                @endif
                                                <td align="right">{{ number_format_decimals($dateCat->full_price) }}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td align="right" class="column-2">{{ date('g:ia', strtotime($dateCat->event_date)) }}</td>
                                                <td align="right">Discounted Amt:</td>
                                                @if($countCat > 0)
                                                    @foreach($dateCat->amounts as $key3 => $amount) 
                                                        <td align="right">{{ number_format_decimals($amount->price) }}</td>
                                                    @endforeach
                                                @endif
                                                <td align="right">{{ number_format_decimals($dateCat->price) }}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td align="right">Quantity:</td>
                                                @if($countCat > 0)
                                                    @foreach($dateCat->amounts as $key3 => $amount) 
                                                        <td align="right">{{ $amount->ticket_quantity }}</td>
                                                    @endforeach
                                                @endif
                                                <td align="right">{{ $dateCat->ticket_quantity }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" align="right" style="background: #e7e6e6;border-top:1px solid #000;">Full Amount:</td>
                                            @if($countCat > 0)
                                                @foreach($totalCats as $key1 => $totalCat)  
                                                    <td align="right" style="background: #e7e6e6;border-top:1px solid #000;"><b>{{ number_format_decimals($totalCat->full_price) }}</b></td>
                                                @endforeach
                                            @endif
                                            <td align="right" style="background: #e7e6e6;border-top:1px solid #000;"><b>{{ number_format_decimals($total->full_price) }}</b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="right" style="background: #e7e6e6;">Discounted Amt:</td>
                                            @if($countCat > 0)
                                                @foreach($totalCats as $key1 => $totalCat)  
                                                    <td align="right" style="background: #e7e6e6;"><b>{{ number_format_decimals($totalCat->price) }}</b></td>
                                                @endforeach
                                            @endif
                                            <td align="right" style="background: #e7e6e6;"><b>{{ number_format_decimals($total->price) }}</b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="right" style="background: #e7e6e6;">Quantity:</td>
                                            @if($countCat > 0)
                                                @foreach($totalCats as $key1 => $totalCat)  
                                                    <td align="right" style="background: #e7e6e6;"><b>{{ $totalCat->ticket_quantity }}</b></td>
                                                @endforeach
                                            @endif
                                            <td align="right" style="background: #e7e6e6;"><b>{{ $total->ticket_quantity }}</b></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="error-category"></div>
                                <canvas id="category_chart" width="1000" height="400"></canvas>
                                <div class="page-break"></div>
                            @endif
                        </div>
                    </page>
                </div>
            </div>

            @if(!empty($event_id))
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('general.event') }}</h3>
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('admin-report-tixtrack-excel', 'event='.$event_id.'&start_date='.$start_date.'&end_date='.$end_date) }}" title="{{ trans('general.create_new') }}"><i class="fa fa-download fa-fw"></i> EXCEL</a>
                            <a class="btn btn-danger" href="{{ route('admin-report-tixtrack-pdf', 'event='.$event_id.'&start_date='.$start_date.'&end_date='.$end_date) }}" title="{{ trans('general.create_new') }}"><i class="fa fa-download fa-fw"></i> PDF</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <h4>Event: <b>{{ $event->title }}</b></h4>
                        <h4>Report Period: {{ short_text_date($start_date) .' to '. short_text_date($end_date) }}</h4>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('general.by_category') }}</h3>
                    </div>
                    <div class="box-body">
                        @if(!$dateCats->isEmpty())
                            <table class="table-bordered table">
                                <thead>
                                    <tr>
                                        <th rowspan="2">Sale Date</th>
                                        <th rowspan="2">Event Day/Time</th>
                                        <th rowspan="2"></th>
                                        <th colspan="{{ $countCat }}" align="center">PRICE LEVEL/CATEGORY</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        @if($countCat > 0)
                                            @foreach($categories as $key1 => $cat)  
                                                <th>{{ $cat->price_level_name }}</th>
                                            @endforeach
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dateCats as $key2 => $dateCat) 
                                        <tr>
                                            <td>{{ date('d-M-Y', strtotime($dateCat->local_created)) }}</td>
                                            <td>{{ date('d-M-Y, g:ia', strtotime($dateCat->event_date)) }}</td>
                                            <td>Full Amount:</td>
                                            @if($countCat > 0)
                                                @foreach($dateCat->amounts as $key3 => $amount) 
                                                    <td>{{ number_format_decimals($amount->full_price) }}</td>
                                                @endforeach
                                            @endif
                                            <td>{{ number_format_decimals($dateCat->full_price) }}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Discounted Amt:</td>
                                            @if($countCat > 0)
                                                @foreach($dateCat->amounts as $key3 => $amount) 
                                                    <td>{{ number_format_decimals($amount->price) }}</td>
                                                @endforeach
                                            @endif
                                            <td>{{ number_format_decimals($dateCat->price) }}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Quantity:</td>
                                            @if($countCat > 0)
                                                @foreach($dateCat->amounts as $key3 => $amount) 
                                                    <td>{{ $amount->ticket_quantity }}</td>
                                                @endforeach
                                            @endif
                                            <td>{{ $dateCat->ticket_quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text">Full Amount:</td>
                                        @if($countCat > 0)
                                            @foreach($totalCats as $key1 => $totalCat)  
                                                <td>{{ number_format_decimals($totalCat->full_price) }}</td>
                                            @endforeach
                                        @endif
                                        <td>{{ number_format_decimals($total->full_price) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text">Discounted Amt:</td>
                                        @if($countCat > 0)
                                            @foreach($totalCats as $key1 => $totalCat)  
                                                <td>{{ number_format_decimals($totalCat->price) }}</td>
                                            @endforeach
                                        @endif
                                        <td>{{ number_format_decimals($total->price) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text">Quantity:</td>
                                        @if($countCat > 0)
                                            @foreach($totalCats as $key1 => $totalCat)  
                                                <td>{{ $totalCat->ticket_quantity }}</td>
                                            @endforeach
                                        @endif
                                        <td>{{ $total->ticket_quantity }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        @else
                            <h3 class="center-align">No Result.</h3>
                        @endif
                    </div>
                </div>
                @if(!$dateCats->isEmpty())
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">{{ trans('general.by_category') }} {{ trans('general.chart') }}</h3>
                        </div>
                        <div class="box-body">
                            <div class="error-category"></div>
                            <canvas id="category_chart" width="1000" height="400"></canvas>
                            <img src="" id="category_chart_img">
                        </div>
                    </div>
                @endif
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('general.by_payment') }}</h3>
                    </div>
                    <div class="box-body">
                        @if(!$datePays->isEmpty())
                            <table class="table-bordered table">
                                <thead>
                                    <tr>
                                        <th rowspan="2">Sale Date</th>
                                        <th rowspan="2">Event Day/Time</th>
                                        <th rowspan="2"></th>
                                        <th colspan="{{ $countPay }}" align="center">Method Of Payment</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        @if($countPay > 0)
                                            @foreach($payments as $key1 => $pay)  
                                                <th>{{ $pay->payment_method_name }}</th>
                                            @endforeach
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datePays as $key2 => $datePay) 
                                        <tr>
                                            <td>{{ date('d-M-Y', strtotime($datePay->local_created)) }}</td>
                                            <td>{{ date('d-M-Y, g:ia', strtotime($datePay->event_date)) }}</td>
                                            <td>Full Amount:</td>
                                            @if($countPay > 0)
                                                @foreach($datePay->amounts as $key3 => $amount) 
                                                    <td>{{ number_format_decimals($amount->full_price) }}</td>
                                                @endforeach
                                            @endif
                                            <td>{{ number_format_decimals($datePay->full_price) }}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Discounted Amt:</td>
                                            @if($countPay > 0)
                                                @foreach($datePay->amounts as $key3 => $amount) 
                                                    <td>{{ number_format_decimals($amount->price) }}</td>
                                                @endforeach
                                            @endif
                                            <td>{{ number_format_decimals($datePay->price) }}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Quantity:</td>
                                            @if($countPay > 0)
                                                @foreach($datePay->amounts as $key3 => $amount) 
                                                    <td>{{ $amount->ticket_quantity }}</td>
                                                @endforeach
                                            @endif
                                            <td>{{ $datePay->ticket_quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text">Full Amount:</td>
                                        @if($countPay > 0)
                                            @foreach($totalPays as $key1 => $totalPay)  
                                                <td>{{ number_format_decimals($totalPay->full_price) }}</td>
                                            @endforeach
                                        @endif
                                        <td>{{ number_format_decimals($total->full_price) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text">Discounted Amount:</td>
                                        @if($countPay > 0)
                                            @foreach($totalPays as $key1 => $totalPay)  
                                                <td>{{ number_format_decimals($totalPay->price) }}</td>
                                            @endforeach
                                        @endif
                                        <td>{{ number_format_decimals($total->price) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text">Quantity:</td>
                                        @if($countPay > 0)
                                            @foreach($totalPays as $key1 => $totalPay)  
                                                <td>{{ $totalPay->ticket_quantity }}</td>
                                            @endforeach
                                        @endif
                                        <td>{{ $total->ticket_quantity }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        @else
                            <h3 class="center-align">No Result.</h3>
                        @endif
                    </div>
                </div>
                @if(!$datePays->isEmpty())
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">{{ trans('general.by_payment') }} {{ trans('general.chart') }}</h3>
                        </div>
                        <div class="box-body">
                            <div class="error-category"></div>
                            <canvas id="payment_chart" width="1000" height="400"></canvas>
                            <img src="" id="payment_chart_img">
                        </div>
                    </div>
                @endif
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('general.by_promotion') }}</h3>
                    </div>
                    <div class="box-body">
                        @if(!$datePros->isEmpty())
                            <table class="table-bordered table">
                                <thead>
                                    <tr>
                                        <th rowspan="2">Sale Date</th>
                                        <th rowspan="2">Event Day/Time</th>
                                        <th rowspan="2"></th>
                                        <th colspan="{{ $countPro }}" align="center">Promotion</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        @if($countPro > 0)
                                            @foreach($promotions as $key1 => $pro)  
                                                <th>{{ $pro->promo_code }}&nbsp;</th>
                                            @endforeach
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datePros as $key2 => $date) 
                                        @php
                                            $subtotal = $modelOrder->totalByDatePromotion($event_id, $date->local_created, $date->event_date);
                                        @endphp
                                        <tr>
                                            <td>{{ date('d-M-Y', strtotime($date->local_created)) }}</td>
                                            <td>{{ date('d-M-Y, g:ia', strtotime($date->event_date)) }}</td>
                                            <td>Full Amount:</td>
                                            @if($countPro > 0)
                                                @foreach($promotions as $key1 => $pro)  
                                                    @php
                                                        $amount = $modelOrder->amountByPromotion($event_id, $pro->promo_code, $date->local_created, $date->event_date);
                                                    @endphp
                                                    <td>{{ number_format_decimals($amount->full_price) }}</td>
                                                @endforeach
                                            @endif
                                            <td>{{ number_format_decimals($subtotal->full_price) }}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Discounted Amt:</td>
                                            @if($countPro > 0)
                                                @foreach($promotions as $key1 => $pro)  
                                                    @php
                                                        $amount = $modelOrder->amountByPromotion($event_id, $pro->promo_code, $date->local_created, $date->event_date);
                                                    @endphp
                                                    <td>{{ number_format_decimals($amount->price) }}</td>
                                                @endforeach
                                            @endif
                                            <td>{{ number_format_decimals($subtotal->price) }}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Quantity:</td>
                                            @if($countPro > 0)
                                                @foreach($promotions as $key1 => $pro) 
                                                    @php
                                                        $amount = $modelOrder->amountByPromotion($event_id, $pro->promo_code, $date->local_created, $date->event_date);
                                                    @endphp 
                                                    <td>{{ $amount->ticket_quantity }}</td>
                                                @endforeach
                                            @endif
                                            <td>{{ $subtotal->ticket_quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text">Full Amount:</td>
                                        @if($countPro > 0)
                                            @foreach($totalPros as $key1 => $totalPro)  
                                                <td>{{ number_format_decimals($totalPro->full_price) }}</td>
                                            @endforeach
                                        @endif
                                        <td>{{ number_format_decimals($allTotalPro->full_price) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text">Discounted Amount:</td>
                                        @if($countPro > 0)
                                            @foreach($totalPros as $key1 => $totalPro)  
                                                <td>{{ number_format_decimals($totalPro->price) }}</td>
                                            @endforeach
                                        @endif
                                        <td>{{ number_format_decimals($allTotalPro->price) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text">Quantity:</td>
                                        @if($countPro > 0)
                                            @foreach($totalPros as $key1 => $totalPro)  
                                                <td>{{ $totalPro->ticket_quantity }}</td>
                                            @endforeach
                                        @endif
                                        <td>{{ $allTotalPro->ticket_quantity }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        @else
                            <h3 class="center-align">No Result.</h3>
                        @endif
                    </div>
                </div>
                @if(!$datePros->isEmpty())
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">{{ trans('general.by_promotion') }} {{ trans('general.chart') }}</h3>
                        </div>
                        <div class="box-body">
                            <div class="error-category"></div>
                            <canvas id="promotion_chart" width="1000" height="400"></canvas>
                            <img src="" id="promotion_chart_img">
                        </div>
                    </div>
                @endif
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('general.sale_to_date') }} ( {{ date('d M Y', strtotime($first_date->local_created)) .' - '. date('d M Y', strtotime($end_date)) }} )</h3>
                    </div>
                    <div class="box-body">
                        @if(!$allSale->isEmpty())
                            <table class="table-bordered table">
                                <thead>
                                    <tr>
                                        <th rowspan="2">Event Day</th>
                                        <th rowspan="2"></th>
                                        <th colspan="{{ $countAllCat }}" align="center">PRICE LEVEL/CATEGORY</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        @if($countAllCat > 0)
                                            @foreach($allCategories as $key1 => $cat)  
                                                <th>{{ $cat->price_level_name }}</th>
                                            @endforeach
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allSale as $key2 => $sale) 
                                        <tr>
                                            <td>{{ date('d-M-Y, g:ia', strtotime($sale->event_date)) }}</td>
                                            <td>Full Amount:</td>
                                            @if($countAllCat > 0)
                                                @foreach($sale->amounts as $key3 => $amount) 
                                                    <td>{{ number_format_decimals($amount->full_price) }}</td>
                                                @endforeach
                                            @endif
                                            <td>{{ number_format_decimals($sale->full_price) }}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Discounted Amt:</td>
                                            @if($countAllCat > 0)
                                                @foreach($sale->amounts as $key3 => $amount) 
                                                    <td>{{ number_format_decimals($amount->price) }}</td>
                                                @endforeach
                                            @endif
                                            <td>{{ number_format_decimals($sale->price) }}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Quantity:</td>
                                            @if($countAllCat > 0)
                                                @foreach($sale->amounts as $key3 => $amount) 
                                                    <td>{{ $amount->ticket_quantity }}</td>
                                                @endforeach
                                            @endif
                                            <td>{{ $sale->ticket_quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <h3 class="center-align">No Result.</h3>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@include('backend.admin.tixtrack.script.chart_script')
