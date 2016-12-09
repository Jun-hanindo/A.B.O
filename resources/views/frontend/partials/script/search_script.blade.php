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
                resetFilterSearch();
                sortFilterResult(val);
            });

            $('#filter-venue, #filter-period').on('change', function(){
                sortFilterResult(sort);
            });

            $('.cat-filter').on('click', function(e){
                sortFilterResult(sort);
            });

            $('.reset-filter').on('click', function(e){
                resetFilterSearch();
                sortFilterResult(sort);
                $('.collapse').removeClass('in');
                $('.collapse').attr('aria-expanded', false);
                $('.filter-search a').addClass('collapsed');
                $('.filter-search a').attr('aria-expanded', false);
            })

        });

        function sortFilterResult(sort)
        {
            modal_loader();
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
                    uri = "{{ URL::to('search/result')}}?"+uri;
                    //console.log(uri);
                    //window.location.href = uri;
                    window.history.pushState("string", response.status, uri);
                    $('.search-list table').html('');
                    var events = response.data.events;
                    $.each(events,function(key, val){
                        var uri = "{{ URL::route('event-detail', "::param") }}";
                        uri = uri.replace('::param', val.slug);
                        var html = '<tr class="bg-green tr-search" style="background-color:'+val.background_color+' !important">'
                            +'<td class="searchpic"><a href="'+uri+'"><img src="'+val.featured_image3_url+'"></a></td>'
                            +'<td class="jobs"><a href="'+uri+'">'+val.title+'</a></td>'
                            +'<td class="date"><a href="'+uri+'">'+val.date_set+'</a></td>'
                            +'<td class="place"><a href="'+uri+'">'+val.venue+'</a></td>'
                            +'<td class="type"><a href="'+uri+'">'+val.category+'</a></td>'
                            +'</tr>>';
                        //console.log(html);
                        $('.search-list table').append(html);
                    });
                    HoldOn.close();

                },
                error: function(response){
                    response.responseJSON.message
                }
            });
        }

        function resetFilterSearch(){
            $('.cat-filter').prop('checked', false);
            $('#filter-venue').val('all');
            $('#filter-period').val('all');
        }

</script>

@endsection