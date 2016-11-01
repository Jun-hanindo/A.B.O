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
    <div class="row">
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
                        {!! Form::submit('Apply', ['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
            @if(!empty($event_id))
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('general.by_category') }}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table-bordered table">
                            <thead>
                                <tr>
                                    <td rowspan="2">Sale Date</td>
                                    <td rowspan="2">Event Day/Time</td>
                                    <td rowspan="2"></td>
                                    <td colspan="{{ $countCat }}" align="center">PRICE LEVEL/CATEGORY</td>
                                    <td rowspan="2">Total</td>
                                </tr>
                                <tr>
                                    @if($countCat > 0)
                                        @foreach($categories as $key1 => $cat)  
                                            <td>{{ $cat->price_level_name }}</td>
                                        @endforeach
                                    @endif
                                </tr>
                            </thead>
                            @if(!empty($dates))
                                <tbody>
                                    @foreach($dates as $key2 => $date) 
                                        @php
                                            $total = $modelOrder->total($event_id, $date->local_created, $date->event_date);
                                        @endphp
                                        <tr>
                                            <td rowspan="3">{{ date('d-M-Y', strtotime($date->local_created)) }}</td>
                                            <td rowspan="3">{{ date('d-M-Y', strtotime($date->event_date)) }}</td>
                                            <td>Full Amount:</td>
                                            @if($countCat > 0)
                                                @foreach($categories as $key1 => $cat)  
                                                    @php
                                                        $amount = $modelOrder->amountByCategory($event_id, $cat->price_level_name, $date->local_created, $date->event_date);
                                                    @endphp
                                                    <td>{{ number_format_drop_zero_decimals($amount->full_price) }}</td>
                                                @endforeach
                                            @endif
                                            <td>{{ number_format_drop_zero_decimals($total->full_price) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Discounted Amt:</td>
                                            @if($countCat > 0)
                                                @foreach($categories as $key1 => $cat)  
                                                    @php
                                                        $amount = $modelOrder->amountByCategory($event_id, $cat->price_level_name, $date->local_created, $date->event_date);
                                                    @endphp
                                                    <td>{{ number_format_drop_zero_decimals($amount->price) }}</td>
                                                @endforeach
                                            @endif
                                            <td>{{ number_format_drop_zero_decimals($total->price) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Quantity:</td>
                                            @if($countCat > 0)
                                                @foreach($categories as $key1 => $cat) 
                                                    @php
                                                        $amount = $modelOrder->amountByCategory($event_id, $cat->price_level_name, $date->local_created, $date->event_date);
                                                    @endphp 
                                                    <td>{{ $amount->ticket_quantity }}</td>
                                                @endforeach
                                            @endif
                                            <td>{{ $total->ticket_quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('general.by_payment') }}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table-bordered table">
                            <thead>
                                <tr>
                                    <td rowspan="2">Sale Date</td>
                                    <td rowspan="2">Event Day/Time</td>
                                    <td rowspan="2"></td>
                                    <td colspan="{{ $countPay }}" align="center">Method Of Payment</td>
                                    <td rowspan="2">Total</td>
                                </tr>
                                <tr>
                                    @if($countPay > 0)
                                        @foreach($payments as $key1 => $pay)  
                                            <td>{{ $pay->payment_method_name }}</td>
                                        @endforeach
                                    @endif
                                </tr>
                            </thead>
                            @if(!empty($dates))
                                <tbody>
                                    @foreach($dates as $key2 => $date) 
                                        @php
                                            $total = $modelOrder->total($event_id, $date->local_created, $date->event_date);
                                        @endphp
                                        <tr>
                                            <td rowspan="3">{{ date('d-M-Y', strtotime($date->local_created)) }}</td>
                                            <td rowspan="3">{{ date('d-M-Y', strtotime($date->event_date)) }}</td>
                                            <td>Full Amount:</td>
                                            @if($countPay > 0)
                                                @foreach($payments as $key1 => $pay)  
                                                    @php
                                                        $amount = $modelOrder->amountByPayment($event_id, $pay->payment_method_name, $date->local_created, $date->event_date);
                                                    @endphp
                                                    <td>{{ number_format_drop_zero_decimals($amount->full_price) }}</td>
                                                @endforeach
                                            @endif
                                            <td>{{ number_format_drop_zero_decimals($total->full_price) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Discounted Amt:</td>
                                            @if($countPay > 0)
                                                @foreach($payments as $key1 => $pay)  
                                                    @php
                                                        $amount = $modelOrder->amountByPayment($event_id, $pay->payment_method_name, $date->local_created, $date->event_date);
                                                    @endphp
                                                    <td>{{ number_format_drop_zero_decimals($amount->price) }}</td>
                                                @endforeach
                                            @endif
                                            <td>{{ number_format_drop_zero_decimals($total->price) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Quantity:</td>
                                            @if($countPay > 0)
                                                @foreach($payments as $key1 => $pay) 
                                                    @php
                                                        $amount = $modelOrder->amountByPayment($event_id, $pay->payment_method_name, $date->local_created, $date->event_date);
                                                    @endphp 
                                                    <td>{{ $amount->ticket_quantity }}</td>
                                                @endforeach
                                            @endif
                                            <td>{{ $total->ticket_quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('general.by_promotion') }}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table-bordered table">
                            <thead>
                                <tr>
                                    <td rowspan="2">Sale Date</td>
                                    <td rowspan="2">Event Day/Time</td>
                                    <td rowspan="2"></td>
                                    <td colspan="{{ $countPro }}" align="center">Promotion</td>
                                    <td rowspan="2">Total</td>
                                </tr>
                                <tr>
                                    @if($countPro > 0)
                                        @foreach($promotions as $key1 => $pro)  
                                            <td>{{ $pro->promo_code }}&nbsp;</td>
                                        @endforeach
                                    @endif
                                </tr>
                            </thead>
                            @if(!empty($dates))
                                <tbody>
                                    @foreach($dates as $key2 => $date) 
                                        @php
                                            $total = $modelOrder->total($event_id, $date->local_created, $date->event_date);
                                        @endphp
                                        <tr>
                                            <td rowspan="3">{{ date('d-M-Y', strtotime($date->local_created)) }}</td>
                                            <td rowspan="3">{{ date('d-M-Y', strtotime($date->event_date)) }}</td>
                                            <td>Full Amount:</td>
                                            @if($countPro > 0)
                                                @foreach($promotions as $key1 => $pro)  
                                                    @php
                                                        $amount = $modelOrder->amountByPromotion($event_id, $pro->promo_code, $date->local_created, $date->event_date);
                                                    @endphp
                                                    <td>{{ number_format_drop_zero_decimals($amount->full_price) }}</td>
                                                @endforeach
                                            @endif
                                            <td>{{ number_format_drop_zero_decimals($total->full_price) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Discounted Amt:</td>
                                            @if($countPro > 0)
                                                @foreach($promotions as $key1 => $pro)  
                                                    @php
                                                        $amount = $modelOrder->amountByPromotion($event_id, $pro->promo_code, $date->local_created, $date->event_date);
                                                    @endphp
                                                    <td>{{ number_format_drop_zero_decimals($amount->price) }}</td>
                                                @endforeach
                                            @endif
                                            <td>{{ number_format_drop_zero_decimals($total->price) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Quantity:</td>
                                            @if($countPro > 0)
                                                @foreach($promotions as $key1 => $pro) 
                                                    @php
                                                        $amount = $modelOrder->amountByPromotion($event_id, $pro->promo_code, $date->local_created, $date->event_date);
                                                    @endphp 
                                                    <td>{{ $amount->ticket_quantity }}</td>
                                                @endforeach
                                            @endif
                                            <td>{{ $total->ticket_quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@include('backend.admin.tixtrack.script.index')