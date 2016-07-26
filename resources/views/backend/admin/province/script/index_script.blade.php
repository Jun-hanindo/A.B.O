@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        
        loadData();

        function loadData()
        {
            var table = $('#provinces-table').DataTable();
            table.destroy();
            $('#provinces-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! URL::route("datatables-province") !!}',
                columns: [
                    {data: 'ProvinceCode', name: 'ProvinceCode'},
                    {data: 'Name', name: 'Name'},
                ]
            });
        }

        $("#button_submit").on('click', function(){
            submitProvince();
        });

        function submitProvince()
        {
            $(".tooltip-field").remove();
            $(".form-group").removeClass('has-error');
            modal_loader();
            $.ajax({
                url: "{{ route('admin-post-province') }}",
                type: "POST",
                dataType: 'json',
                data: $("#form-province").serialize(),
                success: function (data) {
                    HoldOn.close();
                    location.replace("{{ route('admin-index-province') }}"+'?message='+data.message);
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