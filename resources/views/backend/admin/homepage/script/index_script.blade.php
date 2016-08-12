@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        
        loadDataSlider();
        loadDataEvent();
        getEvent();

        function loadDataSlider()
        {
            var table = $('#homepage-sliders-table').DataTable();
            table.destroy();
            $('#homepage-sliders-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! URL::route("datatables-homepage-slider") !!}',
                columns: [
                    {data: 'event', name: 'event'},
                    // {data: 'category', name: 'category'},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ]
            });
        }

        function loadDataEvent()
        {
            var table = $('#homepage-events-table').DataTable();
            table.destroy();
            $('#homepage-events-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! URL::route("datatables-homepage-event") !!}',
                columns: [
                    {data: 'event', name: 'event'},
                    // {data: 'category', name: 'category'},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ]
            });
        }

        $('.actAddEvent').on('click',function(){
            $('#modal-form-event').modal('show');
            $('#title-create-event').show();
            $('#title-update-event').hide();
            $('#button_update-event').hide();
            $('#button_save-event').show();
        });

        $('.actAddSlider').on('click',function(){
            $('#modal-form-slider').modal('show');
            $('#title-create-slider').show();
            $('#title-update-slider').hide();
            $('#button_update-slider').hide();
            $('#button_save-slider').show();
        });

        $('#homepage-events-table tbody').on( 'click', '.actEditEvent', function () {
            $('#modal-form-event').modal('show');
            $('#title-create-event').hide();
            $('#title-update-event').show();
            $('#button_update-event').show();
            $('#button_save-event').hide();

            var id = $(this).data('id');
            getDataEvent(id);

        });

        $('#homepage-sliders-table tbody').on( 'click', '.actEditSlider', function () {
            $('#modal-form-slider').modal('show');
            $('#title-create-slider').hide();
            $('#title-update-slider').show();
            $('#button_update-slider').show();
            $('#button_save-slider').hide();

            var id = $(this).data('id');
            getDataSlider(id);

        });

        $('#modal-form-slider').on('show.bs.modal', function (e) {
            clearInput();
            $(".tooltip-field").remove();
            $(".form-group").removeClass('has-error');
            $('.error-slider').removeClass('alert alert-danger');
            $('.error-slider').html('');

            $("#button_save-slider").unbind('click').bind('click', function () {
                saveSlider();                
            });
            $("#button_update-slider").unbind('click').bind('click', function () {
                updateSlider();                
            });


            function saveSlider()
            {
                $(".tooltip-field").remove();
                $(".form-group").removeClass('has-error');
                $('.error-slider').removeClass('alert alert-danger');
                $('.error-slider').html('');
                modal_loader();
                $.ajax({
                    url: "{{ route('admin-post-homepage') }}",
                    type: "POST",
                    dataType: 'json',
                    data: $("#form-slider").serialize(),
                    success: function (data) {
                        HoldOn.close();
                        loadDataSlider();
                        $('#modal-form-slider').modal('hide');
                        $('.error-slider').addClass('alert alert-success').html(data.message);
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
                            $('.error-slider').addClass('alert alert-danger').html(response.responseJSON.message);
                        }
                    }
                });
            }

            function updateSlider()
            {
                $(".tooltip-field").remove();
                $(".form-group").removeClass('has-error');
                $('.error-slider').removeClass('alert alert-danger');
                $('.error-slider').html('');
                var id = $("#id_slider").val();
                modal_loader();

                var uri = "{{ URL::route('admin-update-homepage', "::param") }}";
                uri = uri.replace('::param', id);
                $.ajax({
                    url: uri,
                    type: "POST",
                    dataType: 'json',
                    data: $("#form-slider").serialize(),
                    success: function (data) {
                        HoldOn.close();
                        loadDataSlider();
                        $('#modal-form-slider').modal('hide');
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

        $('#modal-form-event').on('show.bs.modal', function (e) {
            clearInput();
            $(".tooltip-field").remove();
            $(".form-group").removeClass('has-error');
            $('.error-event').removeClass('alert alert-danger');
            $('.error-event').html('');

            $("#button_save-event").unbind('click').bind('click', function () {
                saveEvent();                
            });
            $("#button_update-event").unbind('click').bind('click', function () {
                updateEvent();                
            });


            function saveEvent()
            {
                $(".tooltip-field").remove();
                $(".form-group").removeClass('has-error');
                $('.error-slider').removeClass('alert alert-danger');
                $('.error-slider').html('');
                modal_loader();
                $.ajax({
                    url: "{{ route('admin-post-homepage') }}",
                    type: "POST",
                    dataType: 'json',
                    data: $("#form-event").serialize(),
                    success: function (data) {
                        HoldOn.close();
                        loadDataEvent();
                        $('#modal-form-event').modal('hide');
                        $('.error-event').addClass('alert alert-success').html(data.message);
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
                            $('.error-event').addClass('alert alert-danger').html(response.responseJSON.message);
                        }
                    }
                });
            }

            function updateEvent()
            {
                $(".tooltip-field").remove();
                $(".form-group").removeClass('has-error');
                $('.error-slider').removeClass('alert alert-danger');
                $('.error-slider').html('');
                var id = $("#id_event").val();
                modal_loader();

                var uri = "{{ URL::route('admin-update-homepage', "::param") }}";
                uri = uri.replace('::param', id);
                $.ajax({
                    url: uri,
                    type: "POST",
                    dataType: 'json',
                    data: $("#form-event").serialize(),
                    success: function (data) {
                        HoldOn.close();
                        loadDataEvent();
                        $('#modal-form-event').modal('hide');
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
                            $('.error-event').addClass('alert alert-danger').html(response.responseJSON.message);
                        }
                    }
                });
            }


        });


        function getDataSlider(id){
            var uri = "{{ URL::route('admin-edit-homepage', "::param") }}";
            uri = uri.replace('::param', id);
            $.ajax({
                    url: uri,
                    type: "get",
                    dataType: 'json',
                    success: function (response) {
                        if(response.data.active == false) {
                            response.data.active = 'false';
                        } else {
                            response.data.active = 'true';
                        }
                        var data = response.data;
                        $('#modal-form-slider #event_id_slider').val(data.event_id);
                        $('#modal-form-slider #id_slider').val(data.id);
                    },
                    error: function(response){
                        loadData();
                        $('#modal-form-slider').modal('hide');
                        $('.error-slider').addClass('alert alert-success').html(response.responseJSON.message);
                    }
                });
        }


        function getDataEvent(id){
            var uri = "{{ URL::route('admin-edit-homepage', "::param") }}";
            uri = uri.replace('::param', id);
            $.ajax({
                    url: uri,
                    type: "get",
                    dataType: 'json',
                    success: function (response) {
                        if(response.data.active == false) {
                            response.data.active = 'false';
                        } else {
                            response.data.active = 'true';
                        }
                        var data = response.data;
                        $('#modal-form-event #event_id_event').val(data.event_id);
                        $('#modal-form-event #id_event').val(data.id);
                    },
                    error: function(response){
                        loadData();
                        $('#modal-form-event').modal('hide');
                        $('.error-event').addClass('alert alert-success').html(response.responseJSON.message);
                    }
                });
        }

        function getEvent(){
            $("#event_id_event").select2({
                ajax: {
                    url: "{{route('list-combo-event')}}",
                    dataType: 'json',
                    type: "get",
                    data: function (term, page) {
                        return {
                            q: term
                        };
                    },
                    results: function (data, page) {
                        return { results: data.results };
                    },

                },
                initSelection: function (item, callback) {
                    var id = item.val();
                    var text = item.data('option');
                    if(id > 0){

                        var data = { id: id, text: text };
                        callback(data);
                    }
                },
                formatAjaxError:function(a,b,c){return"Not Found .."}
            });
            $("#event_id_slider").select2({
                ajax: {
                    url: "{{route('list-combo-event')}}",
                    dataType: 'json',
                    type: "get",
                    data: function (term, page) {
                        return {
                            q: term
                        };
                    },
                    results: function (data, page) {
                        return { results: data.results };
                    },

                },
                initSelection: function (item, callback) {
                    var id = item.val();
                    var text = item.data('option');
                    if(id > 0){

                        var data = { id: id, text: text };
                        callback(data);
                    }
                },
                formatAjaxError:function(a,b,c){return"Not Found .."}
            });
        }

        function clearInput(){
            
        }

    });
    
    </script>
    @include('backend.delete-modal-datatables')
@endsection