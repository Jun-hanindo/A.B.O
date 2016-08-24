@section('script')

<script type="text/javascript">
        $(document).ready(function(){

            $(".btnLoad").on('click', function(){
                var slug = $(this).attr('data-slug');
                loadCategory(slug);
            });

            $('#sort-search').on('change', function(){
                var val = $(this).val();
                sortResult(val)
            });

            $('.cat-filter').on('click', function(){
                var val = $(this).val();
            });

        });


       var q = $(".input-search").val(); 
       var sort = $('#sort-search').val();
       var venue = $('#sort-search').val();

        function sortResult(sort)
        {
            $.ajax({
                url: "{{ route('event-search-get') }}",
                type: "GET",
                dataType: 'json',
                data: {'sort':sort,'q':q},
                success: function (response) {

                    var uri = "{{ URL::to('search')}}?q="+q+'&sort='+sort;
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