@section('scripts')

    <script>
    $(document).ready(function() {
        
        loadTextEditor();
        getDepartment();

        $('.addDepartment').on('click',function(){
            $('#modal-form').modal('show');
            $('#title-create').show();
            $('#title-update').hide();
            $('#button_update').hide();
            $('#button_save').show();
        });

        $('#modal-form').on('show.bs.modal', function (e) {
            $(".tooltip-field").remove();
            $(".form-group").removeClass('has-error');
            $('.error').removeClass('alert alert-danger');
            $('.error').html('');
            
            $("#button_save").unbind('click').bind('click', function () {
                saveDepartment();                
            });
            clearInput();
            saveTrailModal('Department Form');

        });

        // $( "#position" ).autocomplete({
        //     minLength: 2,
        //     source: function( request, response ) {
        //         $.ajax( {
        //             url: "{{ route('admin-career-autocomplete-position') }}",
        //             dataType: "json",
        //             data: {
        //                 term: request.term
        //             },
        //             success: function( data ) {
        //                 response($.map(data, function(v){
        //                     return {
        //                       value: v.value
        //                     };
        //                 }));
        //             }
        //         });
        //     },
        //     select: function( event, ui ) {
        //         console.log(ui.item.value);
        //         $('#position').val(ui.item.value);
        //     }
        // });
        
        var options = {
            url: "{{ route('admin-career-autocomplete-position') }}",

            getValue: "value",

            list: {
                match: {
                    maxNumberOfElements: 10,
                    enabled: true
                }
            },
        };

        $("#position").easyAutocomplete(options);

    });

    function getDepartment(){

        var uri = "{{route('list-combo-department')}}"

        $("#department").select2({
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
        $("#name").val('');
    }

    function saveDepartment()
    {
        $(".tooltip-field").remove();
        $(".form-group").removeClass('has-error');
        $('.error').removeClass('alert alert-danger');
        $('.error').html('');
        modal_loader();
        var name = $("#name").val();
        $.ajax({
            url: "{{ route('admin-post-department') }}",
            type: "POST",
            dataType: 'json',
            data: {'name':name},
            success: function (data) {
                HoldOn.close();
                $('#modal-form').modal('hide');
                $('.error').html('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
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
                    $('.error-modal').html('<div class="alert alert-danger">' +response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                }
            }
        });
    }
    
    </script>
@endsection