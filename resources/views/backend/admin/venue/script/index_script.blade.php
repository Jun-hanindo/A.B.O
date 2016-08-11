@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        loadData();

        function loadData()
        {
            var table = $('#venue-datatables').DataTable();
            table.destroy();
            $('#venue-datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! URL::route("datatables-venue") !!}',
                columns: [
                    // {data: 'id', name: 'id', searchable: false, orderable: false},
                    {data: 'name', name: 'name'},
                    {data: 'address', name: 'address'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'avaibility', name: 'avaibility', searchable: false, orderable: false}
                ],
                "fnDrawCallback": function() {
                    //Initialize checkbos for enable/disable user
                    $(".avaibility-check").bootstrapSwitch({onText: "Enabled", offText:"Disabled", animate: false});
                }
            });

            return table;
        }
        
        $('.select_all-checkbox').on('click', function(){
            datatablesSelectAll(loadData());
        });

        $('.item-checkbox').on('click', function(){
            datatablesCheckbox(loadData());
        });

        // $('.avaibility-check').on( 'click', function () {
        //     var id = $(this).attr('data-id');
        //     console.log(1);
        //     $.ajax({
        //             url: "{{ URL::to('admin/venue')}}"+'/'+id+'/avaibility-edit',
        //             type: "POST",
        //             dataType: 'json',
        //             data: $("#form").serialize(),
        //             success: function (data) {
        //                 HoldOn.close();
        //                 loadData();
        //                 $('#modal-form').modal('hide');
        //                 $('.error').addClass('alert alert-success').html(data.message);
        //             },
        //             error: function(response){
        //                 HoldOn.close();
        //                 if (response.status === 422) {
        //                     var data = response.responseJSON;
        //                     $.each(data,function(key,val){
        //                         $('<span class="text-danger tooltip-field"><span>'+val+'</span>').insertAfter($('#'+key));
        //                         $('.'+key).addClass('has-error');
        //                     });
        //                 } else {
        //                     $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
        //                 }
        //             }
        //         });
        // });

    });
    </script>
    @include('backend.delete-modal-datatables')
@endsection