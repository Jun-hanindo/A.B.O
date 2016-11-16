<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>
            @page { 
                margin: 20px 30px 30px 30px; 
            }
            body{
                font-family: 'Source Sans Pro',Helvetica,Arial,sans-serif;
                font-size: 12px;
                margin: 30px;
            }
            .title-report{
                border-bottom: 1px solid #000;
                font-size: 18px;
                margin: 0;
                padding:0;
            }
            table{
                border-collapse: collapse;
                width: 100%;
                max-width: 100%;
            }
            table tr th, table tr td{
                vertical-align: bottom;
                padding: 3px;
            }
            .column-1{
                width: 120px;
            }
            .column-2{
                vertical-align: top;
            }
            .page-break {
                page-break-after: always;
            }
            #footer { 
                position: fixed; 
                left: 30px; 
                bottom: 40px; 
                right: 30px; 
                border-top: 1px solid #000;
                /*height: 100px; */
                /*background-color: lightblue; */
            }
            .page{
                margin: 2px 0;
                font-size: 10px;
            }
            #footer .page:after { 
                content: counter(page, upper-roman); 
            }
        </style>
    </head>
    <body>
        <div id="footer">
            <p class="page">
                <i>Printed on {{ date('d F Y, g:ia') }} by {{ \Sentinel::getUser()->first_name.' '.\Sentinel::getUser()->last_name }}</i>
                <br>
                <i>{{ env('APP_NAME') }} - DailySummaryReport-Category-V1.0.0</i>
            </p>
        </div>
        <h3 class="title-report"><b>DAILY SALES SUMMARY REPORT BY EVENT</b></h3>
        <br>
        <br>
        <table>
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
                        <th rowspan="2" align="center" style="background: #e7e6e6;border-bottom:1px solid #000;">Sale Date</th>
                        <th rowspan="2" align="center" style="background: #e7e6e6;border-bottom:1px solid #000;">Event Day/Time</th>
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
                            <td align="right" rowspan="3" class="column-2">{{ date('d-M-Y', strtotime($dateCat->local_created)) }}</td>
                            <td align="right" rowspan="3" class="column-2">{{ date('d-M-Y, g:ia', strtotime($dateCat->event_date)) }}</td>
                            <td align="right">Full Amount:</td>
                            @if($countCat > 0)
                                @foreach($dateCat->amounts as $key3 => $amount) 
                                    <td align="right">{{ number_format_decimals($amount->full_price) }}</td>
                                @endforeach
                            @endif
                            <td align="right">{{ number_format_decimals($dateCat->full_price) }}</td>
                        </tr>
                        <tr>
                            <td align="right">Discounted Amt:</td>
                            @if($countCat > 0)
                                @foreach($dateCat->amounts as $key3 => $amount) 
                                    <td align="right">{{ number_format_decimals($amount->price) }}</td>
                                @endforeach
                            @endif
                            <td align="right">{{ number_format_decimals($dateCat->price) }}</td>
                        </tr>
                        <tr>
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
            <div id="chart-category" class="chart-img" style="">
                <img style="margin-top:5px;" width="100%" src="{{ $chartCat }}">
            </div>
            <div class="page-break"></div>
        @endif

        @if(!$datePays->isEmpty())
            <table>
                <thead>
                    <tr>
                        <th rowspan="2" align="center" style="background: #e7e6e6;border-bottom:1px solid #000;">Sale Date</th>
                        <th rowspan="2" align="center" style="background: #e7e6e6;border-bottom:1px solid #000;">Event Day/Time</th>
                        <th rowspan="2" align="center" style="background: #e7e6e6;border-bottom:1px solid #000;"></th>
                        <th colspan="{{ $countPay }}" align="center" style="background:#e7e6e6;border:1px solid #000;">Method of Payment</th>
                        <th rowspan="2" align="center" style="background: #e7e6e6;border-bottom:1px solid #000;">Total</th>
                    </tr>
                    <tr>
                        @if($countPay > 0)
                            @php
                                $cPay = 1;
                            @endphp
                            @foreach($payments as $key => $pay)  
                                <th style="background:#e7e6e6;border:1px solid #000;{{ ($cPay == $countPay) ? 'border-right:2px solid #000;' : '' }}">{{ $pay->payment_method_name }}</th>
                                @php
                                    $cPay++;
                                @endphp
                            @endforeach
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($datePays as $key2 => $datePay) 
                        <tr>
                            <td align="right" rowspan="3" class="column-2">{{ date('d-M-Y', strtotime($datePay->local_created)) }}</td>
                            <td align="right" rowspan="3" class="column-2">{{ date('d-M-Y, g:ia', strtotime($datePay->event_date)) }}</td>
                            <td align="right">Full Amount:</td>
                            @if($countPay > 0)
                                @foreach($datePay->amounts as $key3 => $amount) 
                                    <td align="right">{{ number_format_decimals($amount->full_price) }}</td>
                                @endforeach
                            @endif
                            <td align="right">{{ number_format_decimals($datePay->full_price) }}</td>
                        </tr>
                        <tr>
                            <td align="right">Discounted Amt:</td>
                            @if($countPay > 0)
                                @foreach($datePay->amounts as $key3 => $amount) 
                                    <td align="right">{{ number_format_decimals($amount->price) }}</td>
                                @endforeach
                            @endif
                            <td align="right">{{ number_format_decimals($datePay->price) }}</td>
                        </tr>
                        <tr>
                            <td align="right">Quantity:</td>
                            @if($countPay > 0)
                                @foreach($datePay->amounts as $key3 => $amount) 
                                    <td align="right">{{ $amount->ticket_quantity }}</td>
                                @endforeach
                            @endif
                            <td align="right">{{ $datePay->ticket_quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" align="right" style="background: #e7e6e6;border-top:1px solid #000;">Full Amount:</td>
                        @if($countPay > 0)
                            @foreach($totalPays as $key1 => $totalPay)  
                                <td align="right" style="background: #e7e6e6;border-top:1px solid #000;"><b>{{ number_format_decimals($totalPay->full_price) }}</b></td>
                            @endforeach
                        @endif
                        <td align="right" style="background: #e7e6e6;border-top:1px solid #000;"><b>{{ number_format_decimals($total->full_price) }}</b></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right" style="background: #e7e6e6;">Discounted Amt:</td>
                        @if($countPay > 0)
                            @foreach($totalPays as $key1 => $totalPay)  
                                <td align="right" style="background: #e7e6e6;"><b>{{ number_format_decimals($totalPay->price) }}</b></td>
                            @endforeach
                        @endif
                        <td align="right" style="background: #e7e6e6;"><b>{{ number_format_decimals($total->price) }}</b></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right" style="background: #e7e6e6;">Quantity:</td>
                        @if($countPay > 0)
                            @foreach($totalPays as $key1 => $totalPay)  
                                <td align="right" style="background: #e7e6e6;"><b>{{ $totalPay->ticket_quantity }}</b></td>
                            @endforeach
                        @endif
                        <td align="right" style="background: #e7e6e6;"><b>{{ $total->ticket_quantity }}</b></td>
                    </tr>
                </tfoot>
            </table>
            
            <div id="chart-payment" class="chart-img" style="">
                <img style="margin-top:5px;" width="100%" src="{{ $chartPay }}">
            </div>
        
            <div class="page-break"></div>
        @endif

        @if(!$datePros->isEmpty())
            <table>
                <thead>
                    <tr>
                        <th rowspan="2" align="center" style="background: #e7e6e6;border-bottom:1px solid #000;">Sale Date</th>
                        <th rowspan="2" align="center" style="background: #e7e6e6;border-bottom:1px solid #000;">Event Day/Time</th>
                        <th rowspan="2" align="center" style="background: #e7e6e6;border-bottom:1px solid #000;"></th>
                        <th colspan="{{ $countPro }}" align="center" style="background:#e7e6e6;border:1px solid #000;">Promotion</th>
                        <th rowspan="2" align="center" style="background: #e7e6e6;border-bottom:1px solid #000;">Total</th>
                    </tr>
                    <tr>
                        @if($countPro > 0)
                            @php
                                $cPro = 1;
                            @endphp
                            @foreach($promotions as $key => $pro)  
                                <th style="background:#e7e6e6;border:1px solid #000;{{ ($cPro == $countPro) ? 'border-right:2px solid #000;' : '' }}">{{ $pro->promo_code }}</th>
                                @php
                                    $cPro++;
                                @endphp
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
                            <td align="right" rowspan="3" class="column-2">{{ date('d-M-Y', strtotime($date->local_created)) }}</td>
                            <td align="right" rowspan="3" class="column-2">{{ date('d-M-Y, g:ia', strtotime($date->event_date)) }}</td>
                            <td align="right">Full Amount:</td>
                            @if($countPro > 0)
                                @foreach($promotions as $key1 => $pro)  
                                    @php
                                        $amount = $modelOrder->amountByPromotion($event_id, $pro->promo_code, $date->local_created, $date->event_date);
                                    @endphp
                                    <td align="right">{{ number_format_decimals($amount->full_price) }}</td>
                                @endforeach
                            @endif
                            <td align="right">{{ number_format_decimals($subtotal->full_price) }}</td>
                        </tr>
                        <tr>
                            <td align="right">Discounted Amt:</td>
                            @if($countPro > 0)
                                @foreach($promotions as $key1 => $pro)  
                                    @php
                                        $amount = $modelOrder->amountByPromotion($event_id, $pro->promo_code, $date->local_created, $date->event_date);
                                    @endphp
                                    <td align="right">{{ number_format_decimals($amount->price) }}</td>
                                @endforeach
                            @endif
                            <td align="right">{{ number_format_decimals($subtotal->price) }}</td>
                        </tr>
                        <tr>
                            <td align="right">Quantity:</td>
                            @if($countPro > 0)
                                @foreach($promotions as $key1 => $pro) 
                                    @php
                                        $amount = $modelOrder->amountByPromotion($event_id, $pro->promo_code, $date->local_created, $date->event_date);
                                    @endphp 
                                    <td align="right">{{ $amount->ticket_quantity }}</td>
                                @endforeach
                            @endif
                            <td align="right">{{ $subtotal->ticket_quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" align="right" style="background: #e7e6e6;border-top:1px solid #000;">Full Amount:</td>
                        @if($countPro > 0)
                            @foreach($totalPros as $key1 => $totalPro)  
                                <td align="right" style="background: #e7e6e6;border-top:1px solid #000;"><b>{{ number_format_decimals($totalPro->full_price) }}</b></td>
                            @endforeach
                        @endif
                        <td align="right" style="background: #e7e6e6;border-top:1px solid #000;"><b>{{ number_format_decimals($allTotalPro->full_price) }}</b></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right" style="background: #e7e6e6;">Discounted Amt:</td>
                        @if($countPro > 0)
                            @foreach($totalPros as $key1 => $totalPro)  
                                <td align="right" style="background: #e7e6e6;"><b>{{ number_format_decimals($totalPro->price) }}</b></td>
                            @endforeach
                        @endif
                        <td align="right" style="background: #e7e6e6;"><b>{{ number_format_decimals($allTotalPro->price) }}</b></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right" style="background: #e7e6e6;">Quantity:</td>
                        @if($countPro > 0)
                            @foreach($totalPros as $key1 => $totalPro)  
                                <td align="right" style="background: #e7e6e6;"><b>{{ $totalPro->ticket_quantity }}</b></td>
                            @endforeach
                        @endif
                        <td align="right" style="background: #e7e6e6;"><b>{{ $allTotalPro->ticket_quantity }}</b></td>
                    </tr>
                </tfoot>
            </table>
            
            <div id="chart-promotion" class="chart-img" style="">
                <img style="margin-top:5px;" width="100%" src="{{ $chartPro }}">
            </div>
        
            <div class="page-break"></div>
        @endif

        @if(!$allSale->isEmpty())
            <table>
                <thead>
                    <tr>
                        <th colspan="{{ $countAllCat + 3 }}" align="center" style="background:#e7e6e6;">SALES TO DATE: {{ date('d M Y', strtotime($first_date->local_created)) .' - '. date('d M Y') }}</th>
                    </tr>
                    <tr>
                        <th rowspan="2" align="center" style="background: #e7e6e6;border-bottom:1px solid #000;">Event Day</th>
                        <th rowspan="2" align="center" style="background: #e7e6e6;border-bottom:1px solid #000;"></th>
                        <th colspan="{{ $countAllCat }}" align="center" style="background:#e7e6e6;border:1px solid #000;">PRICE LEVEL/CATEGORY</th>
                        <th rowspan="2" align="center" style="background: #e7e6e6;border-bottom:1px solid #000;">Total</th>
                    </tr>
                    <tr>
                        @if($countAllCat > 0)
                            @php
                                $cACat = 1;
                            @endphp
                            @foreach($allCategories as $key1 => $cat)  
                                <th style="background:#e7e6e6;border:1px solid #000;{{ ($cACat == $countAllCat) ? 'border-right:2px solid #000;' : '' }}">{{ $cat->price_level_name }}</th>
                                @php
                                    $cACat++;
                                @endphp
                            @endforeach
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($allSale as $key2 => $sale) 
                        <tr>
                            <td align="right" rowspan="3" class="column-2" style="border-bottom:1px solid #000;">{{ date('d-M-Y, g:ia', strtotime($sale->event_date)) }}</td>
                            <td align="right" >Full Amount:</td>
                            @if($countAllCat > 0)
                                @foreach($sale->amounts as $key3 => $amount) 
                                    <td align="right" >{{ number_format_decimals($amount->full_price) }}</td>
                                @endforeach
                            @endif
                            <td align="right" >{{ number_format_decimals($sale->full_price) }}</td>
                        </tr>
                        <tr>
                            <td align="right" >Discounted Amt:</td>
                            @if($countAllCat > 0)
                                @foreach($sale->amounts as $key3 => $amount) 
                                    <td align="right" >{{ number_format_decimals($amount->price) }}</td>
                                @endforeach
                            @endif
                            <td align="right" >{{ number_format_decimals($sale->price) }}</td>
                        </tr>
                        <tr>
                            <td align="right" style="border-bottom:1px solid #000;" >Quantity:</td>
                            @if($countAllCat > 0)
                                @foreach($sale->amounts as $key3 => $amount) 
                                    <td align="right" style="border-bottom:1px solid #000;" >{{ $amount->ticket_quantity }}</td>
                                @endforeach
                            @endif
                            <td align="right" style="border-bottom:1px solid #000;" >{{ $sale->ticket_quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </body>
</html>
