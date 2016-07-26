@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){

        getCountry();
        getProvince();
        $("#countries").on('change',function(){
            $("#provinces").prop("disabled", false);
            getProvince();
        });

        function getCountry(){
            $("#countries").select2({
                ajax: {
                    url: "{{route('list-combo-country')}}",
                    dataType: 'json',
                    type: "POST",
                    data: function (term, page) {
                        return {
                            type: 'country',
                            q: term
                        };
                    },
                    results: function (data, page) {
                        return { results: data.results };
                    }

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
        };

        function getProvince(prmID)
        {
            var vID = $("#countries").val();
            $("#provinces").select2('val', '');
            $("#provinces").select2({
                ajax: {
                    url: "{{route('list-combo-country')}}",
                    dataType: 'json',
                    type: "POST",
                    data: function (term, page) {
                        return {
                            type: 'province',
                            id: prmID > 0 ? prmID : vID,
                            q: term
                        };
                    },
                    results: function (data, page) {
                        return { results: data.results };
                    }

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

        $("#button_submit").on('click', function(){
            submitCity();
        });

        $("#button_update").on('click', function(){
            updateCity();
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

        function updateCity()
        {
            $(".tooltip-field").remove();
            $(".form-group").removeClass('has-error');
            var id = $("#id").val();
            modal_loader();
            $.ajax({
                url: "{{ URL::to('admin/master/city')}}"+'/'+id+'/update',
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
@endsection