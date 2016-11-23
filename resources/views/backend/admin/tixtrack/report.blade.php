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

            @if(!empty($event_id))
                <div class="box" id="report-box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <div class="pull-right">
                            <a class="btn btn-default" id="btn-preview" title="{{ trans('general.preview') }}"  data-toggle="modal" data-target="#modal-preview"><i class="fa fa-eye fa-fw"></i></a>
                            {{-- <a class="btn btn-primary" id="btn-print" title="{{ trans('general.print') }}"><i class="fa fa-print fa-fw"></i></a> --}}
                            <a class="btn btn-success" href="{{ route('admin-report-tixtrack-excel', 'event='.$event_id.'&start_date='.$start_date.'&end_date='.$end_date) }}" title="{{ trans('general.export_to_excel') }}"><i class="fa fa-file-excel-o fa-fw"></i></a>
                            <a class="btn btn-danger" href="{{ route('admin-report-tixtrack-pdf', 'event='.$event_id.'&start_date='.$start_date.'&end_date='.$end_date) }}" title="{{ trans('general.export_to_pdf') }}"><i class="fa fa-file-pdf-o fa-fw"></i></a>
                        </div>
                    </div>
                    <div class="box-body">
                        <page class="report-page" id="report-page">
                            <div class="report-box">
                                <div class="report-header">
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
                                </div>
                                @if(!$dateCats->isEmpty())
                                <div id="category_table">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th rowspan="2" class="border-bottom width-70">Sale Date</th>
                                                <th rowspan="2" class="border-bottom width-70">Event Day/Time</th>
                                                <th rowspan="2" class="border-bottom"></th>
                                                <th colspan="{{ $countCat }}" class="border">PRICE LEVEL/CATEGORY</th>
                                                <th rowspan="2" class="border-bottom">Total</th>
                                            </tr>
                                            <tr>
                                                @if($countCat > 0)
                                                    @foreach($categories as $key1 => $cat)  
                                                        <th class="border">{{ $cat->price_level_name }}</th>
                                                    @endforeach
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($dateCats as $key2 => $dateCat) 
                                                <tr>
                                                    <td>{{ date('d-M-Y', strtotime($dateCat->local_created)) }}</td>
                                                    <td>{{ date('d-M-Y,', strtotime($dateCat->event_date)) }}</td>
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
                                                    <td class="vertical-top">{{ date('g:ia', strtotime($dateCat->event_date)) }}</td>
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
                                                        <td class="bold">{{ number_format_decimals($totalCat->full_price) }}</td>
                                                    @endforeach
                                                @endif
                                                <td class="bold">{{ number_format_decimals($total->full_price) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text">Discounted Amt:</td>
                                                @if($countCat > 0)
                                                    @foreach($totalCats as $key1 => $totalCat)  
                                                        <td class="bold">{{ number_format_decimals($totalCat->price) }}</td>
                                                    @endforeach
                                                @endif
                                                <td class="bold">{{ number_format_decimals($total->price) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text">Quantity:</td>
                                                @if($countCat > 0)
                                                    @foreach($totalCats as $key1 => $totalCat)  
                                                        <td class="bold">{{ $totalCat->ticket_quantity }}</td>
                                                    @endforeach
                                                @endif
                                                <td class="bold">{{ $total->ticket_quantity }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <img class="chart_img" src="" id="category_chart_img">
                                    <div class="page-break-print"></div>
                                    <br>
                                </div>
                                    <div class="error-category"></div>
                                    <canvas id="category_chart" class="chart-report" width="598" height="300"></canvas>
                                    <div class="page-break"></div>
                                    <br>
                                @endif

                                @if(!$datePays->isEmpty())
                                <div id="payment_table">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th rowspan="2" class="border-bottom width-70">Sale Date</th>
                                                <th rowspan="2" class="border-bottom width-70">Event Day/Time</th>
                                                <th rowspan="2" class="border-bottom"></th>
                                                <th colspan="{{ $countPay }}" class="border">Method Of Payment</th>
                                                <th rowspan="2" class="border-bottom">Total</th>
                                            </tr>
                                            <tr>
                                                @if($countPay > 0)
                                                    @foreach($payments as $key1 => $pay)  
                                                        <th class="border">{{ $pay->payment_method_name }}</th>
                                                    @endforeach
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($datePays as $key2 => $datePay) 
                                                <tr>
                                                    <td>{{ date('d-M-Y', strtotime($datePay->local_created)) }}</td>
                                                    <td>{{ date('d-M-Y,', strtotime($datePay->event_date)) }}</td>
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
                                                    <td class="vertical-top">{{ date('g:ia', strtotime($datePay->event_date)) }}</td>
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
                                                        <td class="bold">{{ number_format_decimals($totalPay->full_price) }}</td>
                                                    @endforeach
                                                @endif
                                                <td class="bold">{{ number_format_decimals($total->full_price) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text">Discounted Amount:</td>
                                                @if($countPay > 0)
                                                    @foreach($totalPays as $key1 => $totalPay)  
                                                        <td class="bold">{{ number_format_decimals($totalPay->price) }}</td>
                                                    @endforeach
                                                @endif
                                                <td class="bold">{{ number_format_decimals($total->price) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text">Quantity:</td>
                                                @if($countPay > 0)
                                                    @foreach($totalPays as $key1 => $totalPay)  
                                                        <td class="bold">{{ $totalPay->ticket_quantity }}</td>
                                                    @endforeach
                                                @endif
                                                <td class="bold">{{ $total->ticket_quantity }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <img class="chart_img" src="" id="payment_chart_img">
                                    <div class="page-break-print"></div>
                                    <br>
                                </div>
                                    <div class="error-payment"></div>
                                    <canvas id="payment_chart" class="chart-report" width="598" height="300"></canvas>
                                    <div class="page-break"></div>
                                    <br>
                                @endif

                                @if(!$datePros->isEmpty())
                                <div id="promotion_table">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th rowspan="2" class="border-bottom width-70">Sale Date</th>
                                                <th rowspan="2" class="border-bottom width-70">Event Day/Time</th>
                                                <th rowspan="2" class="border-bottom"></th>
                                                <th colspan="{{ $countPro }}" class="border">Promotion</th>
                                                <th rowspan="2" class="border-bottom">Total</th>
                                            </tr>
                                            <tr>
                                                @if($countPro > 0)
                                                    @foreach($promotions as $key1 => $pro)  
                                                        <th class="border">{{ $pro->promo_code }}&nbsp;</th>
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
                                                    <td>{{ date('d-M-Y,', strtotime($date->event_date)) }}</td>
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
                                                    <td class="vertical-top">{{ date('g:ia', strtotime($date->event_date)) }}</td>
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
                                    <img class="chart_img" src="" id="promotion_chart_img">
                                    <div class="page-break-print"></div>
                                    <br>
                                </div>
                                    <div class="error-promotion"></div>
                                    <canvas id="promotion_chart" class="chart-report" width="598" height="300"></canvas>
                                    <div class="page-break"></div>
                                    <br>
                                @endif

                                @if(!$allSale->isEmpty())
                                <div id="allsale_table">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th colspan="{{ $countAllCat + 3 }}">SALES TO DATE: {{ date('d M Y', strtotime($first_date->local_created)) .' - '. date('d M Y', strtotime($end_date)) }}</th>
                                            </tr>
                                            <tr>
                                                <th rowspan="2" class="border-bottom width-70">Event Day</th>
                                                <th rowspan="2" class="border-bottom"></th>
                                                <th colspan="{{ $countAllCat }}" class="border">PRICE LEVEL/CATEGORY</th>
                                                <th rowspan="2" class="border-bottom">Total</th>
                                            </tr>
                                            <tr>
                                                @if($countAllCat > 0)
                                                    @foreach($allCategories as $key1 => $cat)  
                                                        <th class="border">{{ $cat->price_level_name }}</th>
                                                    @endforeach
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($allSale as $key2 => $sale) 
                                                <tr>
                                                    <td>{{ date('d-M-Y,', strtotime($sale->event_date)) }}</td>
                                                    <td>Full Amount:</td>
                                                    @if($countAllCat > 0)
                                                        @foreach($sale->amounts as $key3 => $amount) 
                                                            <td>{{ number_format_decimals($amount->full_price) }}</td>
                                                        @endforeach
                                                    @endif
                                                    <td>{{ number_format_decimals($sale->full_price) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="vertical-top">{{ date('g:ia', strtotime($sale->event_date)) }}</td>
                                                    <td>Discounted Amt:</td>
                                                    @if($countAllCat > 0)
                                                        @foreach($sale->amounts as $key3 => $amount) 
                                                            <td>{{ number_format_decimals($amount->price) }}</td>
                                                        @endforeach
                                                    @endif
                                                    <td>{{ number_format_decimals($sale->price) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-bottom"></td>
                                                    <td class="border-bottom">Quantity:</td>
                                                    @if($countAllCat > 0)
                                                        @foreach($sale->amounts as $key3 => $amount) 
                                                            <td class="border-bottom">{{ $amount->ticket_quantity }}</td>
                                                        @endforeach
                                                    @endif
                                                    <td class="border-bottom">{{ $sale->ticket_quantity }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                            </div>
                            <div id="footer">
                                <p class="page">
                                    <i>Printed on {{ date('d F Y, g:ia') }} by {{ \Sentinel::getUser()->first_name.' '.\Sentinel::getUser()->last_name }}</i>
                                    <br>
                                    <i>{{ env('APP_NAME') }} - DailySummaryReport-Category-V1.0.0</i>
                                </p>
                            </div>
                        </page>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="modal-preview" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <iframe id="pdf-frame" src="" style="width:850px; height:600px;" frameborder="0"></iframe>
          </div>
        </div>
      </div>
    </div>
@endsection
@include('backend.admin.tixtrack.script.chart_script')
