@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        loadData();

        $('#visa-checkout-datatables').on('switchChange.bootstrapSwitch', '.availability_homepage-check', function(event, state) {
            var id = $(this).attr('data-id');
            var uri = "{{ URL::route('admin-update-visa-checkout-avaibility-homepage', "::param") }}";
            uri = uri.replace('::param', id);
            var val = $(this).is(":checked") ? true : false;
            $.ajax({
                    url: uri,
                    type: "POST",
                    dataType: 'json',
                    data: "availability_homepage="+val,
                    success: function (data) {
                        $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                        loadData();
                    },
                    error: function(response){
                        $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                        loadData();
                    }
                });
        });

        $('#visa-checkout-datatables tbody').on('click', '.sort_asc',function(){
            var id_current = $(this).attr('data-id');
            var order = 'asc';
            saveSortOrder(order, id_current);
        });

        $('#visa-checkout-datatables tbody').on('click', '.sort_desc',function(){
            var id_current = $(this).attr('data-id');
            var order = 'desc';
            saveSortOrder(order, id_current);

        });

    });

    function loadData()
    {
        $.fn.dataTable.ext.errMode = 'none';
        $('#visa-checkout-datatables').on('error.dt', function(e, settings, techNote, message) {
            $.ajax({
                url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
                type: "POST",
                dataType: 'json',
                data: "message= Visa Checkout "+message,
                success: function (data) {
                    data.message;
                },
                error: function(response){
                    response.responseJSON.message
                }
            });
        });

        var table = $('#visa-checkout-datatables').DataTable();
        table.destroy();
        $('#visa-checkout-datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! URL::route("datatables-visa-checkout") !!}',
            columns: [
                {data: 'sort_order', name: 'sort_order', class: 'center-align', searchable: false, orderable: false},
                {data: 'title', name: 'title'},
                {data: 'banner_image', name: 'banner_image'},
                {data: 'availability_homepage', name: 'availability_homepage', class: 'center-align', searchable: false, orderable: false},
                {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
            ],
            "fnDrawCallback": function() {
                //Initialize checkbos for enable/disable user
                $(".availability_homepage-check").bootstrapSwitch({onText: "{{ trans('backend/general.enabled') }}", offText:"{{ trans('backend/general.disabled') }}", animate: false});
            }
        });

        return table;
    }

    function saveSortOrder(order, id_current){
        $('.error').html('');
        $.ajax({
            url: "{{ route('admin-visa-checkout-sort-order') }}",
            type: "POST",
            dataType: 'json',
            data: "id_current=" + id_current + "&order=" + order,
            success: function (data) {
                $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                loadData();
            },
            error: function(response){
                $('.error').html('<div class="alert alert-danger">' + response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                loadData();
            }
        });
    }
    </script>
    @include('backend.delete-modal-datatables')
@endsection