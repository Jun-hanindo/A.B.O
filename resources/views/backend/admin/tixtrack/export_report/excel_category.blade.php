<!doctype html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <table>
            <tbody>
                <tr>
                    <td style="font-size: 36px;"><b>DAILY SALES REPORT BY CATEGORY</b></td>
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
                        <th></th>
                        <th></th>
                        <th></th>
                        @if($countCat > 0)
                            @foreach($categories as $key => $cat)  
                                <th style="background:#e7e6e6;border:1px solid #000;">{{ $cat->price_level_name }}</th>
                            @endforeach
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($dateCats as $key2 => $dateCat) 
                        <tr>
                            <td align="right">{{ date('d-M-Y', strtotime($dateCat->local_created)) }}</td>
                            <td align="right">{{ date('d-M-Y, g:ia', strtotime($dateCat->event_date)) }}</td>
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
                            <td></td>
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
        @endif
    </body>
</html>
