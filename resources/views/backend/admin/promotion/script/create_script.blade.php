@section('scripts')

    <script>
    $(document).ready(function() {
        
        loadTinyMce();

        $(".datepicker").datepicker( {
            format: "yyyy-mm-dd",
        });

        $('.image').change(function(){
            var name = $(this).attr('data-name');
            $("#div-preview_"+name).show();
            preview(this,$(this).data('type'),name);
        });

    });
    
    </script>
@endsection