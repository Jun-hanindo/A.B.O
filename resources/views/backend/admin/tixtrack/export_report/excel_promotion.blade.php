<!doctype html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <table>
            <tbody>
                <tr>
                    <td style="font-size: 36px;"><b>DAILY SALES REPORT BY PROMOTION</b></td>
                </tr>
            </tbody>
        </table>

        <table>
            <tbody>
                <tr></tr>
                <tr>
                    <td>Event:</td>
                    <td></td>
                    <td><b>{{ $event->title }}</b></td>
                </tr>
                <tr>
                    <td>Report Period:</td>
                    <td></td>
                    <td>{{ short_text_date($start_date) .' to '. short_text_date($end_date) }}</td>
                </tr>
            </tbody>
        </table>

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
                        <th></th>
                        <th></th>
                        <th></th>
                        @if($countPro > 0)
                            @foreach($promotions as $key => $pro)  
                                <th style="background:#e7e6e6;border:1px solid #000;">{{ $pro->promo_code }}</th>
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
                            <td align="right">{{ date('d-M-Y', strtotime($date->local_created)) }}</td>
                            <td align="right">{{ date('d-M-Y, g:ia', strtotime($date->event_date)) }}</td>
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
                            <td></td>
                            <td></td>
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
                            <td></td>
                            <td></td>
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
        @endif
    </body>
</html>
