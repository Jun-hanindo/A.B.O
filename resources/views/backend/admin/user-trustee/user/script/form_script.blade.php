@section('scripts')

    <script>
    $(document).ready(function() {
        
        $('#create-form #email').keyup(function (e) {
        	var email = $(this).val();
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
        });

    });
    
    </script>
@endsection