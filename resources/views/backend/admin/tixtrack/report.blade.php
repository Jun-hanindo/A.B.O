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
                {!! Form::open(array('url' => route('admin-report-tixtrack'),'method'=>'GET','id'=>'form-account')) !!}
                    <div class="box-body">
                        @include('flash::message')
                        <div class="error"></div>
                        <div class="form-inline activity-log-filter-date">
                            <div class="form-group">
                                <label for="filter" class="">{{ trans('general.event') }} </label>
                                <select name="event" id="event" class="form-control">
                                    @if(!empty($events))
                                        @foreach($events as $key => $value)
                                            <option value="{{ $value->event_id_tixtrack }}" {{ !empty($event_id) ? ($value->event_id_tixtrack == $event_id) ? 'selected' : '' : '' }}>{{ $value->event_id_tixtrack }} - {{ $value->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div style="margin-left:1.5cm;" id="date-picker" class="form-group">
                                <label for="start-date">{{ trans('general.from') }}</label>
                                <input name="start_date" class="form-control datepicker" id="start_date" data-date-end-date="0d" value={{ (!empty($start_date)) ? date('Y-m-d', strtotime($start_date)) : date('Y-m-d',strtotime('-7days')) }}>

                                <label for="end-date">{{ trans('general.to') }}</label>
                                <input name="end_date" class="form-control datepicker" id="end_date" data-date-end-date="0d" value={{ (!empty($end_date)) ? date('Y-m-d', strtotime($end_date)) : date('Y-m-d') }}>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! Form::submit('Apply', ['class' => 'btn btn-primary pull-right', 'id' => 'btn_apply_report']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
            @if(!empty($event_id))
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('general.event') }}</h3>
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('admin-report-tixtrack-excel', 'event='.$event_id.'&start_date='.$start_date.'&end_date='.$end_date) }}" title="{{ trans('general.create_new') }}"><i class="fa fa-upload fa-fw"></i> EXCEL</a>
                            <a class="btn btn-danger" href="{{ route('admin-report-tixtrack-pdf', 'event='.$event_id.'&start_date='.$start_date.'&end_date='.$end_date) }}" title="{{ trans('general.create_new') }}"><i class="fa fa-upload fa-fw"></i> PDF</a>
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
                {{-- <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('general.by_category') }} {{ trans('general.chart') }}</h3>
                    </div>
                    <div class="box-body">
                        <canvas id="category_chart" width="100%" height="400"></canvas>
                    </div>
                </div> --}}
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

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('general.sale_to_date') }}</h3>
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
@include('backend.admin.tixtrack.script.index')