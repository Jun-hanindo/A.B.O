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
                sortFilterResult(val, venue)
            });

            $('#filter-venue').on('change', function(){
                var val = $(this).val();
                sortFilterResult(sort, val)
            });

            $('.cat-filter').on('click', function(){
                var val = $(this).val();
            });

        });

        function sortFilterResult(sort, venue)
        {
            $.ajax({
                url: "{{ route('event-search-get') }}",
                type: "GET",
                dataType: 'json',
                data: {'sort':sort,'q':q, 'venue':venue},
                success: function (response) {

                    var uri = "{{ URL::to('search')}}?q="+q+'&sort='+sort+'&venue='+venue;
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