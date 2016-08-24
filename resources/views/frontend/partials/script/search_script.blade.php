@section('script')

<script type="text/javascript">
       var q = $(".input-search").val(); 
       var sort = $('#sort-search').val();
       var venue = $('#filter-venue').val();

        $(document).ready(function(){

            $(".btnLoad").on('click', function(){
                var slug = $(this).attr('data-slug');
                loadCategory(slug);
            });

            $('#sort-search').on('change', function(){
                var val = $(this).val();
                sortFilterResult(val);
            });

            $('#filter-venue, #filter-period').on('change', function(){
                sortFilterResult(sort);
            });

            $('.cat-filter').on('click', function(e){
                sortFilterResult(sort);
            });

        });

        function sortFilterResult(sort)
        {
            var data = $('#filter-form').serializeArray();
            data.push({name: 'q', value: q});
            data.push({name: 'sort', value: sort});
            $.ajax({
                url: "{{ route('event-search-get') }}",
                type: "GET",
                dataType: 'json',
                data: data,
                success: function (response) {
                    var val = $('#filter-form').serialize();
                    var uri = 'q='+q+'&sort='+sort+'&'+val;
                    uri = "{{ URL::to('search')}}?"+uri;
                    //console.log(uri);
                    window.location.href = uri;
                },
                error: function(response){
                    response.responseJSON.message
                }
            });
        }

        function filterCategory(cat){
        }

        function filterVenue(venue){
           
        }

</script>

@endsection