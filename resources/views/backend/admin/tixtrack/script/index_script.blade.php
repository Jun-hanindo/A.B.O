@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        loadDataMember();
        loadDataTransaction();

        var start_date = $('input[name=start_date]').val();
        var end_date = $('input[name=end_date]').val();
        var event_id = $('#event').val();

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
            endDate: end_date,
        }).on('changeDate', function(){
            $('#start_date').datepicker('setEndDate', new Date($('#end_date').val()));
            var start_date = $('input[name=start_date]').val();
            var end_date = $('input[name=end_date]').val();
            //loadData(start_date, end_date);
        });

        $('#account_id_member').on('change', function () {
            loadDataMember();
        });

        $('#account_id_order').on('change', function () {
            loadDataTransaction();
        });

        $('#btn_apply_report').click(function(){
            modal_loader();
        });
            
        chartCategory(event_id, start_date, end_date);
        chartPayment(event_id, start_date, end_date);
        chartPromotion(event_id, start_date, end_date);

    });

    function loadDataMember()
    {
        var account_id = $('select[name=account_id_member]').val();
        $.fn.dataTable.ext.errMode = 'none';
        $('#member-datatables').on('error.dt', function(e, settings, techNote, message) {
            $.ajax({
                url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
                type: "POST",
                dataType: 'json',
                data: "message= Tixtrack Member "+message,
                success: function (data) {
                    data.message;
                },
                error: function(response){
                    response.responseJSON.message
                }
            });
        });

        var table = $('#member-datatables').DataTable();
        table.destroy();
        $('#member-datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! URL::route("datatables-tixtrack-member") !!}',
                data: {
                    'account_id': account_id,
                }
            },
            columns: [
                {data: 'customer_id', name: 'customer_id'},
                {data: 'email', name: 'email'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                // {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
            ],
        });

        return table;
    }

    function loadDataTransaction()
    {
        var account_id = $('select[name=account_id_order]').val();

        $.fn.dataTable.ext.errMode = 'none';
        $('#transaction-datatables').on('error.dt', function(e, settings, techNote, message) {
            $.ajax({
                url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
                type: "POST",
                dataType: 'json',
                data: "message= Tixtrack Transaction "+message,
                success: function (data) {
                    data.message;
                },
                error: function(response){
                    response.responseJSON.message
                }
            });
        });

        var table = $('#transaction-datatables').DataTable();
        table.destroy();
        $('#transaction-datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! URL::route("datatables-tixtrack-transaction") !!}',
                data: {
                    'account_id': account_id,
                }
            },
            columns: [
                {data: 'order_id', name: 'order_id'},
                {data: 'event_name', name: 'event_name'},
                {data: 'customer', name: 'customer'},
                {data: 'price', name: 'price'},
                // {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
            ],
        });

        return table;
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
                var catChart = new Chart(cat, {
                    type: 'line',
                    data: data,
                    options: {
                        responsive: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true,
                                }
                            }]
                        },
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                fontColor: 'rgb(255, 99, 132)'
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
                var cat = document.getElementById("payment_chart");
                var data = response.data;
                var catChart = new Chart(cat, {
                    type: 'line',
                    data: data,
                    options: {
                        responsive: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true,
                                }
                            }]
                        },
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                fontColor: 'rgb(255, 99, 132)'
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
                    var cat = document.getElementById("promotion_chart");
                    var data = response.data;
                    var catChart = new Chart(cat, {
                        type: 'line',
                        data: data,
                        options: {
                            responsive: true,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true,
                                    }
                                }]
                            },
                            legend: {
                                display: true,
                                position: 'bottom',
                                labels: {
                                    fontColor: 'rgb(255, 99, 132)'
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