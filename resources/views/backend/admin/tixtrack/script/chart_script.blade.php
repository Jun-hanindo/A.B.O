@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}
    <script>
    $(document).ready(function() {

        var start_date = $('input[name=start_date]').val();
        var end_date = $('input[name=end_date]').val();
        var event_id = $('#event').val();

        var current_date = "{{ date('Y-m-d') }}";

        $('#start_date').datepicker({
            format: "yyyy-mm-dd",
            endDate: end_date,
        }).on('changeDate', function(){
            $('#end_date').datepicker('setStartDate', new Date($('#start_date').val()));
            var start_date = $('input[name=start_date]').val();
            var end_date = $('input[name=end_date]').val();
            //loadData(start_date, end_date);
        });

        $('#end_date').datepicker({
            format: "yyyy-mm-dd",
            startDate: start_date,
            endDate: current_date,
        }).on('changeDate', function(){
            $('#start_date').datepicker('setEndDate', new Date($('#end_date').val()));
            var start_date = $('input[name=start_date]').val();
            var end_date = $('input[name=end_date]').val();
            //loadData(start_date, end_date);
        });

        $('#btn_apply_report').click(function(){
            modal_loader();
        });
        // $("#btn-print").click(function () {
        //     var divContents = $("#report-page").html();
        //     var printWindow = window.open('', '', 'height=400,width=800');
        //     printWindow.document.write('<html><head><title>DIV Contents</title>');
        //     printWindow.document.write('</head><body >');
        //     printWindow.document.write(divContents);
        //     printWindow.document.write('</body></html>');
        //     printWindow.document.close();
        //     printWindow.print();
        // });

        $("#btn-print").click(function () {
            var contents = $("#report-page").html();
            var frame1 = $('<iframe />');
            frame1[0].name = "frame1";
            frame1.css({ "position": "absolute", "top": "-1000000px" });
            $("body").append(frame1);
            var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
            frameDoc.document.open();
            //Create a new HTML document.
            frameDoc.document.write('<html><head><title>ABO - DailySummaryReport-Category-V1.0.0</title>');
            frameDoc.document.write('</head><body>');
            //Append the external CSS file.
            
            frameDoc.document.write('<style type="text/css">'
                +'body{'
                    +'font-family: "Source Sans Pro",Helvetica,Arial,sans-serif;'
                    +'margin: 30px;'
                +'}'
                +'.logo-title{'
                    +'text-align: center;'
                    +'margin-bottom: 20px;'
                +'}'
                +'.logo-title img{'
                    +'width: 180px;'
                +'}'
                +'.title-report{'
                    +'border-bottom: 1px solid #000;'
                    +'font-size: 18px;'
                    +'margin: 0;'
                    +'padding:0;'
                    +'clear: both;'
                +'}'
                +'.table-title tr td{'
                    +'border: 0 !important;'
                    +'text-align: left !important;'
                +'}'
                +'table tbody tr td.column-1 {'
                    +'width: 120px;'
                +'}'
                +'table{'
                    +'width: 100%;'
                +'}'
                +'table tbody tr td{'
                    +'border: 0;'
                +'}'
                +'table tr th, table tr td{'
                    +'vertical-align: bottom;'
                    +'padding: 1px 2px;'
                    +'line-height: normal;'
                    +'font-size: 11px;'
                +'}'
                +'table tr th{'
                    +'text-align: center;'
                    +'font-weight: bold;'
                +'}'
                +'table thead tr th, table tfoot tr td{'
                    +'background-color: #e7e6e6;'
                    +'-webkit-print-color-adjust: exact;'
                +'}'
                +'table tbody tr td{'
                    +'text-align: right;'
                +'}'
                +'table tfoot{'
                    +'border-top: 1px solid #000;'
                +'}'
                +'table tfoot tr td{'
                    +'text-align: right;'
                +'}'
                +'.chart-report{'
                    +'margin-top: 5px;'
                +'}'
                +'.align-right{'
                    +'text-align: right !important;'
                +'}'
                +'.bold{'
                    +'font-weight: bold !important;'
                +'}'
                +'.border{'
                    +'border: 1px solid #000 !important;'
                +'}'
                +'.border-top{'
                    +'border-top: 1px solid #000 !important;'
                +'}'
                +'.border-bottom{'
                    +'border-bottom: 1px solid #000 !important;'
                +'}'
                +'table{'
                    +'border-collapse: collapse;'
                    +'width: 100%;'
                    +'max-width: 100%;'
                +'}'
                +'@media all {'
                    +'.page-break-print { display: none; }'
                +'}'
                +'@media print {'
                    +'.page-break-print { display: block; page-break-before: always; }'
                    +'tfoot { visibility: hidden; }'
                +'}'
                +'.width-70{'
                    +'width: 70px;'
                +'}'
                +'.vertical-top{'
                    +'vertical-align: top;'
                +'}'
                +'#footer {'
                    +'position: fixed;' 
                    +'left: 30px;' 
                    +'bottom: 40px;' 
                    +'right: 30px;' 
                    +'border-top: 1px solid #000;'
                +'}'
                +'#footer p {'
                    +'font-size: 10px !important;'
                +'}'
            +'</style></head><body>');
            //Append the DIV contents.
            frameDoc.document.write($('.report-header').html());
            frameDoc.document.write($('#category_table').html());
            frameDoc.document.write($('#payment_table').html());
            frameDoc.document.write($('#promotion_table').html());
            frameDoc.document.write($('#allsale_table').html());
            frameDoc.document.write($('#footer').html());
            //frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                frame1.remove();
            }, 500);
        });
            
        if(event_id > 0){
            chartCategory(event_id, start_date, end_date);
            chartPayment(event_id, start_date, end_date);
            chartPromotion(event_id, start_date, end_date);
            //savePdf(event_id, start_date, end_date);
        }

    });

    function savePdf(event_id, start_date, end_date){
        modal_loader();
        var uri = "{{ URL::route('admin-report-tixtrack-pdf-save') }}";
        $.ajax({
            url: uri,
            type: "get",
            dataType: 'json',
            data:{'event':event_id, 'start_date':start_date, 'end_date':end_date},
            success: function (response) {
                //$('#pdf-frame').attr('src', response.data);
                $('#pdf-frame').attr('src', response.data+'#zoom=100');
                //$('#pdf-frame').attr('src', 'http://docs.google.com/gview?url='+response.data+'&embedded=true')
                HoldOn.close();
            },
            error: function(response){
                HoldOn.close();
            }
        });
    }

    function bgChart(){
        Chart.plugins.register({
            beforeDraw: function(chartInstance) {
                var ctx = chartInstance.chart.ctx;
                ctx.fillStyle = "white";
                ctx.strokeStyle = "black";
                ctx.fillRect(0, 0, chartInstance.chart.width, chartInstance.chart.height);
                ctx.strokeRect(0, 0, chartInstance.chart.width, chartInstance.chart.height);
            }
        });
    }

    function showTooltips(){
        Chart.pluginService.register({
            beforeRender: function(chart) {
                if (chart.config.options.showAllTooltips) {
                    // create an array of tooltips
                    // we can't use the chart tooltip because there is only one tooltip per chart
                    chart.pluginTooltips = [];
                    chart.config.data.datasets.forEach(function(dataset, i) {
                        chart.getDatasetMeta(i).data.forEach(function(sector, j) {
                            chart.pluginTooltips.push(new Chart.Tooltip({
                                _chart: chart.chart,
                                _chartInstance: chart,
                                _data: chart.data,
                                _options: chart.options.tooltips,
                                _active: [sector]
                            }, chart));
                        });
                    });

                    // turn off normal tooltips
                    chart.options.tooltips.enabled = false;
                }
            },
            afterDraw: function(chart, easing) {
                if (chart.config.options.showAllTooltips) {
                    // we don't want the permanent tooltips to animate, so don't do anything till the animation runs atleast once
                    if (!chart.allTooltipsOnce) {
                        if (easing !== 1)
                            return;
                            chart.allTooltipsOnce = true;
                    }

                    // turn on tooltips
                    chart.options.tooltips.enabled = true;
                    Chart.helpers.each(chart.pluginTooltips, function(tooltip) {
                        tooltip.initialize();
                        tooltip.update();
                        // we don't actually need this since we are not animating tooltips
                        tooltip.pivot();
                        tooltip.transition(easing).draw();
                    });
                    chart.options.tooltips.enabled = false;
                }
            }
        });
    }

    function chartCategory(event_id, start, end){
        modal_loader();
        var uri = "{{ URL::route('admin-report-tixtrack-chart-category') }}";
        $.ajax({
            url: uri,
            type: "get",
            dataType: 'json',
            data:{'event':event_id, 'start_date':start, 'end_date':end},
            success: function (response) {
                var cat = document.getElementById("category_chart").getContext("2d");
                var data = response.data;
                bgChart();
                //showTooltips();
                var catChart = new Chart(cat, {
                    type: 'line',
                    data: data,
                    options: {
                        responsive: true,
                        // showAllTooltips: true,
                        // tooltips: {
                        //     callbacks: {
                        //         title: function (tooltipItem, data) { 
                        //             return ''; 
                        //         },
                        //         label: function(tooltipItem, data) {
                        //             return tooltipItem.yLabel;
                        //         }
                        //     }
                        // },
                        layout:{
                            padding: 20,
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true,
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    autoSkip: false,
                                }
                            }]
                        },
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                fontColor: 'rgb(0, 0, 0)'
                            }
                        },
                        animation: {
                            onComplete: function (animation) { 

                                var image = this.toBase64Image();
                                document.getElementById("category_chart_img").src=image;
                                var uriChart = "{{ URL::route('admin-report-tixtrack-image') }}";
                                $.ajax({
                                    url: uriChart,
                                    type: "post",
                                    dataType: 'json',
                                    data:{'event':event_id, 'start_date':start, 'end_date':end, 'category': image},
                                    success: function (response) {
                                        response.message;
                                        HoldOn.close();
                                    },
                                    error: function(response){
                                        $('.error-category').addClass('alert alert-danger').html(response.responseJSON.message);
                                        HoldOn.close();
                                    }
                                });
                            }
                        }

                    }
                });
                //HoldOn.close();
            },
            error: function(response){
                HoldOn.close();
                $('.error-category').addClass('alert alert-danger').html(response.responseJSON.message);
            }
        });
    }

    function chartPayment(event_id, start, end){
        modal_loader();
        var uri = "{{ URL::route('admin-report-tixtrack-chart-payment') }}";
        $.ajax({
            url: uri,
            type: "get",
            dataType: 'json',
            data:{'event':event_id, 'start_date':start, 'end_date':end},
            success: function (response) {
                var cat = document.getElementById("payment_chart").getContext("2d");
                var data = response.data;
                bgChart();
                //showTooltips();
                var catChart = new Chart(cat, {
                    type: 'line',
                    data: data,
                    options: {
                        responsive: true,
                        // showAllTooltips: true,
                        // tooltips: {
                        //     callbacks: {
                        //         title: function (tooltipItem, data) { 
                        //             return ''; 
                        //         },
                        //         label: function(tooltipItem, data) {
                        //             return tooltipItem.yLabel;
                        //         }
                        //     }
                        // },
                        layout:{
                            padding: 20,
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true,
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    autoSkip: false,
                                }
                            }]
                        },
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                fontColor: 'rgb(0, 0, 0)'
                            }
                        },
                        animation: {
                            onComplete: function (animation) { 
                                var image = this.toBase64Image();
                                document.getElementById("payment_chart_img").src=image;
                                var uriChart = "{{ URL::route('admin-report-tixtrack-image') }}";
                                $.ajax({
                                    url: uriChart,
                                    type: "post",
                                    dataType: 'json',
                                    data:{'event':event_id, 'start_date':start, 'end_date':end, 'payment': image},
                                    success: function (response) {
                                        response.message;
                                        HoldOn.close();
                                    },
                                    error: function(response){
                                        $('.error-category').addClass('alert alert-danger').html(response.responseJSON.message);
                                        HoldOn.close();
                                    }
                                });
                                savePdf(event_id, start, end);
                            }
                        }
                    }
                });
                //HoldOn.close();
            },
            error: function(response){
                HoldOn.close();
                $('.error-category').addClass('alert alert-danger').html(response.responseJSON.message);
            }
        });
    }

    function chartPromotion(event_id, start, end){
        modal_loader();
        var uri = "{{ URL::route('admin-report-tixtrack-chart-promotion') }}";
        $.ajax({
            url: uri,
            type: "get",
            dataType: 'json',
            data:{'event':event_id, 'start_date':start, 'end_date':end},
            success: function (response) {
                if(response.data != ''){
                    var cat = document.getElementById("promotion_chart").getContext("2d");
                    var data = response.data;
                    bgChart();
                    //showTooltips();
                    var catChart = new Chart(cat, {
                        type: 'line',
                        data: data,
                        options: {
                            responsive: true,
                            // showAllTooltips: true,
                            // tooltips: {
                            //     callbacks: {
                            //         title: function (tooltipItem, data) { 
                            //             return ''; 
                            //         },
                            //         label: function(tooltipItem, data) {
                            //             return tooltipItem.yLabel;
                            //         }
                            //     }
                            // },
                            layout:{
                                padding: 20,
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true,
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        autoSkip: false,
                                    }
                                }]
                            },
                            legend: {
                                display: true,
                                position: 'bottom',
                                labels: {
                                    fontColor: 'rgb(0, 0, 0)'
                                }
                            },
                            animation: {
                                onComplete: function (animation) { 
                                    var image = this.toBase64Image();
                                    document.getElementById("promotion_chart_img").src=image;
                                    var uriChart = "{{ URL::route('admin-report-tixtrack-image') }}";
                                    $.ajax({
                                        url: uriChart,
                                        type: "post",
                                        dataType: 'json',
                                        data:{'event':event_id, 'start_date':start, 'end_date':end, 'promotion': image},
                                        success: function (response) {
                                            response.message;
                                            HoldOn.close();
                                        },
                                        error: function(response){
                                            $('.error-category').addClass('alert alert-danger').html(response.responseJSON.message);
                                            HoldOn.close();
                                        }
                                    });
                                    savePdf(event_id, start, end);
                                }
                            }
                        }
                    });
                }
                //HoldOn.close();
            },
            error: function(response){
                HoldOn.close();
                $('.error-category').addClass('alert alert-danger').html(response.responseJSON.message);
            }
        });
    }

    </script>
    @include('backend.delete-modal-datatables')
@endsection