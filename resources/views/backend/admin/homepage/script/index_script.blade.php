@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
    $(document).ready(function() {
        
        loadDataSlider();
        loadDataEvent();
        loadDataPromotion();
        
        $('.actAdd').on('click',function(){
            var category = $(this).attr('data-category');
            $('#form').attr('data-category', category);
            $('#modal-form').modal('show');
            $('#title-create').show();
            $('#title-update').hide();
            $('#button_update').hide();
            $('#button_save').show();

            // var uri = "{{ URL::route('admin-count-category-homepage', "::param") }}";
            // uri = uri.replace('::param', category);
            // $.ajax({
            //     url: uri,
            //     type: "get",
            //     dataType: 'json',
            //     success: function (response) {
            //         if(response.data.active == false) {
            //             response.data.active = 'false';
            //         } else {
            //             response.data.active = 'true';
            //         }
            //         var data = response.data;
            //         if(data >= 3){
            //             $('.error-add-'+category).addClass('text-danger').html(response.message);
                        
            //         }else{
            //             $('#modal-form').modal('show');
            //             $('#title-create').show();
            //             $('#title-update').hide();
            //             $('#button_update').hide();
            //             $('#button_save').show();
            //         }
                    
            //     },
            //     error: function(response){
            //         response.responseJSON.message;
            //         $('#modal-form').modal('show');
            //         $('#title-create').show();
            //         $('#title-update').hide();
            //         $('#button_update').hide();
            //         $('#button_save').show();
            //     }
            // });
        });

        $('#homepage-events-table tbody, #homepage-sliders-table tbody').on( 'click', '.actEdit', function () {
            var category = $(this).attr('data-category');
            $('#form').attr('data-category', category);
            $('#modal-form').modal('show');
            $('#title-create').hide();
            $('#title-update').show();
            $('#button_update').show();
            $('#button_save').hide();

            var id = $(this).data('id');
            getDataHomepage(id, category);

        });

        $('#modal-form').on('show.bs.modal', function (e) {
            var category = $('#form').attr('data-category');
            clearInput();
            $(".tooltip-field").remove();
            $(".form-group").removeClass('has-error');
            $('.error').removeClass('alert alert-danger');
            $('.error').html('');
            getEvent(category);
            saveTrailModal('Homepage Form');

            $("#button_save").unbind('click').bind('click', function () {
                saveHomepage(category);                
            });
            $("#button_update").unbind('click').bind('click', function () {
                updateHomepage(category);                
            });


        });

    });

    function loadDataSlider()
    {
        var table = $('#homepage-sliders-table').DataTable();
        table.destroy();
        $('#homepage-sliders-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! URL::route("datatables-homepage") !!}',
                data: {
                    'category': 'slider'
                },
            },
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
            ajax: {
                url: '{!! URL::route("datatables-homepage") !!}',
                data: {
                    'category': 'event'
                },
            },
            columns: [
                {data: 'event', name: 'event'},
                // {data: 'category', name: 'category'},
                {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
            ]
        });
    }

    function loadDataPromotion()
    {
        var table = $('#homepage-promotions-table').DataTable();
        table.destroy();
        $('#homepage-promotions-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! URL::route("datatables-homepage") !!}',
                data: {
                    'category': 'promotion'
                },
            },
            columns: [
                {data: 'event', name: 'event'},
                // {data: 'category', name: 'category'},
                {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
            ]
        });
    }


    function saveHomepage(category)
    {
        $(".tooltip-field").remove();
        $(".form-group").removeClass('has-error');
        $('.error').removeClass('alert alert-danger');
        $('.error').html('');
        modal_loader();
        $.ajax({
            url: "{{ route('admin-post-homepage') }}",
            type: "POST",
            dataType: 'json',
            data: $("#form").serialize() + "&category=" + category,
            success: function (data) {
                HoldOn.close();
                if(category == 'slider'){
                    loadDataSlider();
                }else if(category == 'event'){
                    loadDataEvent();
                }else{
                    loadDataPromotion();
                }
                $('#modal-form').modal('hide');
                $('.error-'+category).html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
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

    function updateHomepage(category)
    {
        $(".tooltip-field").remove();
        $(".form-group").removeClass('has-error');
        $('.error').removeClass('alert alert-danger');
        $('.error').html('');
        var id = $("#id").val();
        modal_loader();

        var uri = "{{ URL::route('admin-update-homepage', "::param") }}";
        uri = uri.replace('::param', id);
        $.ajax({
            url: uri,
            type: "POST",
            dataType: 'json',
            data: $("#form").serialize() + "&category=" + category,
            success: function (data) {
                HoldOn.close();
                if(category == 'slider'){
                    loadDataSlider();
                }else if(category == 'event'){
                    loadDataEvent();
                }else{
                    loadDataPromotion();
                }

                $('#modal-form').modal('hide');
                $('.error-'+category).html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
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


    function getDataHomepage(id, category){
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
                $('#id').val(data.id);
                $("#event_id").select2('data', { id:data.event_id, text: data.event_title});
            },
            error: function(response){
                if(category == 'slider'){
                    loadDataSlider();
                }else if(category == 'event'){
                    loadDataEvent();
                }else{
                    loadDataPromotion();
                }
                $('#modal-form').modal('hide');
                $('.error-'+category).addClass('alert alert-success').html(response.responseJSON.message);
            }
        });
    }

    function getEvent(category){

        if(category == 'promotion'){
            var uri = "{{route('list-combo-event-promotion')}}";
        }else{
            var uri = "{{route('list-combo-event')}}"
        }

        $("#event_id").select2({
            ajax: {
                url: uri,
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
        $("#id").val('');
        $("#event_id").select2("val", "");
    }
    
    </script>
    @include('backend.delete-modal-datatables')
@endsection