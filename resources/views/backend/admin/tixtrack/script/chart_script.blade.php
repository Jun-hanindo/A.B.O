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
            
        if(event_id > 0){
            chartCategory(event_id, start_date, end_date);
            chartPayment(event_id, start_date, end_date);
            chartPromotion(event_id, start_date, end_date);
        }

    });

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
                                //document.getElementById("category_chart_img").src=image;
                                var uriChart = "{{ URL::route('admin-report-tixtrack-image') }}";
                                $.ajax({
                                    url: uriChart,
                                    type: "post",
                                    dataType: 'json',
                                    data:{'event':event_id, 'start_date':start, 'end_date':end, 'category': image},
                                    success: function (response) {
                                        response.message;
                                    },
                                    error: function(response){
                                        $('.error-category').addClass('alert alert-danger').html(response.responseJSON.message);
                                    }
                                });
                            }
                        }

                    }
                });
                HoldOn.close();
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
                                //document.getElementById("payment_chart_img").src=image;
                                var uriChart = "{{ URL::route('admin-report-tixtrack-image') }}";
                                $.ajax({
                                    url: uriChart,
                                    type: "post",
                                    dataType: 'json',
                                    data:{'event':event_id, 'start_date':start, 'end_date':end, 'payment': image},
                                    success: function (response) {
                                        response.message;
                                    },
                                    error: function(response){
                                        $('.error-category').addClass('alert alert-danger').html(response.responseJSON.message);
                                    }
                                });
                            }
                        }
                    }
                });
                HoldOn.close();
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
                                    //document.getElementById("promotion_chart_img").src=image;
                                    var uriChart = "{{ URL::route('admin-report-tixtrack-image') }}";
                                    $.ajax({
                                        url: uriChart,
                                        type: "post",
                                        dataType: 'json',
                                        data:{'event':event_id, 'start_date':start, 'end_date':end, 'promotion': image},
                                        success: function (response) {
                                            response.message;
                                        },
                                        error: function(response){
                                            $('.error-category').addClass('alert alert-danger').html(response.responseJSON.message);
                                        }
                                    });
                                }
                            }
                        }
                    });
                }
                HoldOn.close();
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