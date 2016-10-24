@section('scripts')

    <script>
    $(document).ready(function() {
        
        var typingTimer; 
        $('#create-form #email').on('input keypress', function(event) {
            var doneTypingInterval = 500;
            clearTimeout(typingTimer);

            var email = $(this).val();
            typingTimer = setTimeout(function(){

            	$.ajax({
                    url: "{{ route('admin-email-exist-user') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {'email':email},
                    success: function (response) {                	
                    	if (response.data.id > 0) {
    	                    $('#button_reactivate').show();
    	                    $('#button_save').hide();
    	                    var uri = "{{ URL::route('admin-reactivate-user') }}";
                            $('#create-form').attr('action', uri);
                    	}else{
    	                    $('#button_reactivate').hide();
    	                    $('#button_save').show();
                    	}
                    },
                    error: function(response){
                        $('#button_reactivate').hide();
                        $('#button_save').show();
                        if (response.status === 422) {
                            var data = response.responseJSON;
                        } else {
                            $('.error-modal').html('<div class="alert alert-danger">' +response.responseJSON.message + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                        }
                    }
                });
            }, doneTypingInterval);
        });

        $('#role').change(function(){
            var val = $(this).val();
            hideShowPromotorID(val);
        });

        var pro_name = $('#promoter_name').val();
        $("#promoter_id").attr('data-option', pro_name);

        var val = $('#role').val();
        hideShowPromotorID(val);

        $("#promoter_id").select2({
            ajax: {
                url: "{{route('list-combo-promoter')}}",
                dataType: 'json',
                type: "POST",
                data: function (term, page) {
                    return {
                        type: 'promoter_id',
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

    });

    function hideShowPromotorID(val){
        if(val == 2){
            $('#promotor_div').show();
        }else{
            $('#promotor_div').hide();
        }
        $("#promoter_id").select2("val", "0");
    }

    
    
    </script>
@endsection