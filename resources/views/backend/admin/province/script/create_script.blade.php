@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
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

        $("#button_submit").on('click', function(){
            submitProvince();
        });

        $("#button_update").on('click', function(){
            updatePovince();
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

        function updatePovince()
        {
            $(".tooltip-field").remove();
            $(".form-group").removeClass('has-error');
            var id = $("#id").val();
            console.log(id);
            modal_loader();
            $.ajax({
                url: "{{ URL::to('admin/master/province')}}"+'/'+id+'/update',
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
@endsection