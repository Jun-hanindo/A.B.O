@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        
        loadData();

        function loadData()
        {
            var table = $('#cities-table').DataTable();
            table.destroy();
            $('#cities-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! URL::route("datatables-city") !!}',
                columns: [
                    {data: 'ProvinceCode', name: 'ProvinceCode'},
                    {data: 'CityCode', name: 'CityCode'},
                    {data: 'Name', name: 'Name'},
                ]
            });
        }

        $("#button_submit").on('click', function(){
            submitCity();
        });

        function submitCity()
        {
            $(".tooltip-field").remove();
            $(".form-group").removeClass('has-error');
            modal_loader();
            $.ajax({
                url: "{{ route('admin-post-city') }}",
                type: "POST",
                dataType: 'json',
                data: $("#form-city").serialize(),
                success: function (data) {
                    HoldOn.close();
                    location.replace("{{ route('admin-index-city') }}"+'?message='+data.message);
                },
                error: function(response){
                    HoldOn.close();
                    if (response.status === 422) {
                        var data = response.responseJSON;
                        $.each(data,function(key,val){
                            $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#'+key));
                            $('.'+key).addClass('has-error');
                        });
                    } else {
                        $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
                    }
                }
            });
        }

    });
    </script>
    @include('backend.delete-modal-datatables')
@endsection