@section('scripts')

    <script>
    $(document).ready(function() {
        
        loadTinyMce();
        loadSwitchButton('discount_type-check');
        discountSwitch();

        $(".datepicker").datepicker( {
            format: "yyyy-mm-dd",
        });

        $('.image').change(function(){
            var name = $(this).attr('data-name');
            $("#div-preview_"+name).show();
            preview(this,$(this).data('type'),name);
        });

        $('#form-promotion').on('switchChange.bootstrapSwitch', '.discount_type-check', function(event, state) {
            discountSwitch();
        });

    });
    
    </script>
@endsection