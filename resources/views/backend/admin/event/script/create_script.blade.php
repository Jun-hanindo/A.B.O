@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}
    <script type="text/javascript">
        $(document).ready(function(){

            loadDataSchedule();
            loadSwitchButton('event_type-check')
            var event_id = $('#id_event').val();

            function loadDataSchedule()
            {
                var table = $('#event-schedule-datatables').DataTable();
                table.destroy();
                // $('#event-schedule-datatables').DataTable({
                //     processing: true,
                //     serverSide: true,
                //     ajax: '{!! URL::route("datatables-event-schedule") !!}' + event_id,
                //     columns: [
                //         {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
                //         {data: 'date_at', name: 'date_at'},
                //         {data: 'time_period', name: 'time_period'}
                //     ]
                // });
            }

            function showModal()
            {
                $('#modal-form').modal('show');
                $('#title-create').show();
                $('#title-update').hide();
                $('#button_update').hide();
                $('#button_save').show();
            }

            function showSubModal(){
                $('#submodal-form').modal('show');
                $('#title-create').show();
                $('#title-update').hide();
                $('#button_update').hide();
                $('#button_save').show();
            }

            $('.actAdd').on('click',function(){
                if($('#id_event').val() == ''){
                    autoSaveEvent();
                }
                showModal()
                loadDataScheduleCategory();

            });

            $('.actAddSub').on('click',function(){
                showSubModal();
            });

            $(".datepicker").datepicker( {
                format: "mm/dd/yyyy",
            });

            function autoSaveEvent()
            {
                var fd = new FormData();
                var silde_i = $('#featured_image1').prop('files')[0];
                var thumb_i = $('#featured_image2').prop('files')[0];
                var side_i = $('#featured_image3').prop('files')[0];
                if(silde_i != undefined){
                    fd.append('featured_image1',silde_i);
                }
                if(thumb_i != undefined){
                    fd.append('featured_image2',thumb_i);
                }
                if(side_i != undefined){
                    fd.append('featured_image3',side_i);
                }

                var other_data = $('#form-event').serializeArray();
                $.each(other_data,function(key,input){
                    fd.append(input.name,input.value);
                });
                $.ajax({
                    url: "{{ route('admin-auto-post-event') }}",
                    type: "POST",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: fd,
                    success: function (data) {
                        var id = data.last_insert_id;
                        $('#id_event').val(id);
                        $('#form-event').attr('action', "{{ URL::to('admin/event')}}"+'/'+id+'/edit');
                        // window.history.pushState("string", data.status, "{{ URL::to('admin/event')}}"+'/'+id+'/edit');
                    },
                    error: function(response){
                        $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
                    }
                });
            }

            $('#modal-form').on('show.bs.modal', function (e) {
                $(".tooltip-field").remove();
                $(".form-group").removeClass('has-error');
                $('.error').removeClass('alert alert-danger');
                $('.error').html('');

                $("#button_save_schedule").unbind('click').bind('click', function () {
                    saveEventSchedule();                
                });
                $("#button_update").unbind('click').bind('click', function () {
                    updateBankAccount();                
                });

                function saveEventSchedule()
                {
                    $(".tooltip-field").remove();
                    $(".form-group").removeClass('has-error');
                    $('.error').removeClass('alert alert-danger');
                    $('.error').html('');
                    console.log($('#form-event-schedule').serializeArray());
                    modal_loader();
                    $.ajax({
                        url: "{{ route('admin-post-event-schedule') }}",
                        type: "POST",
                        dataType: 'json',
                        data: $('#form-event-schedule').serializeArray(),
                        success: function (data) {
                            HoldOn.close();
                            loadData();
                            $('#modal-form').modal('hide');
                            $('.error').addClass('alert alert-success').html(data.message);
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

            function loadDataScheduleCategory()
            {
                var table = $('#schedule-category-datatables').DataTable();
                table.destroy();
                $('#schedule-category-datatables').DataTable({
                    columnDefs: [ {
                        orderable: false,
                        className: 'select-checkbox',
                        targets:   0
                    } ],
                    select: {
                        style:    'os',
                        selector: 'td:first-child'
                    },
                    order: [[ 1, 'asc' ]],
                    "paging":   false,
                    "info":     false,
                    "searching": false
                });
            }


        });
    </script>
@endsection