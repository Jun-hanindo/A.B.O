@section('scripts')

    <script>
    $(document).ready(function() {
        
        loadTextEditor();

        $("#country").select2({
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

    });
        
    
    </script>
@endsection