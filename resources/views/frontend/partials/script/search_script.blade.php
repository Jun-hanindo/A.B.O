@section('script')

<script type="text/javascript">
       var q = $(".input-search").val(); 
       var sort = $('#sort-search').val();
       var sort_mobile = $('#sort-search-mobile').val();

        $(document).ready(function(){

            $(".btnLoad").on('click', function(){
                var slug = $(this).attr('data-slug');
                loadCategory(slug);
            });

            $('#sort-search').on('change', function(){
                var val = $(this).val();
                $('#sort-search-mobile').val(val);
                resetFilterSearch();
                sortFilterResult(val);
            });

            $('#filter-venue').on('change', function(){
                var val = $(this).val();
                $('#filter-venue-mobile').val(val);
                sortFilterResult(sort);
            });

            $('#filter-period').on('change', function(){
                var val = $(this).val();
                $('#filter-period-mobile').val(val);
                sortFilterResult(sort);
            });

            $('.cat-filter').on('ifClicked', function(e){
                $(this).on('ifChecked', function(event){
                    var val = $(this).val();
                    console.log('check:'+val);
                    $('.cat-filter-mobile[value="'+val+'"]').iCheck('check');
                    sortFilterResult(sort);
                });
                $(this).on('ifUnchecked', function(event){
                    var val = $(this).val();
                    console.log('uncheck:'+val);
                    $('.cat-filter-mobile[value="'+val+'"]').iCheck('check');
                    sortFilterResult(sort);
                });
                // $(".cat-filter:checked").each(function(){
                //     var val = $(this).val();
                //     //console.log(val);
                //     $('.cat-filter-mobile[value="'+val+'"]').prop('checked', true);
                // });
                // $(".cat-filter:not(:checked)").each(function(){
                //     var val = $(this).val();
                //     $('.cat-filter-mobile[value="'+val+'"]').prop('checked', false);
                // });
            });

            $('.reset-filter').on('click', function(e){
                resetFilterSearch();
                sortFilterResult(sort);
                $('.collapse').removeClass('in');
                $('.collapse').attr('aria-expanded', false);
                $('.filter-search a').addClass('collapsed');
                $('.filter-search a').attr('aria-expanded', false);
            });


            $('#sort-search-mobile').on('change', function(){
                var val = $(this).val();
                $('#sort-search').val(val);
                resetFilterSearch();
                sortFilterResult(val);
            });

            $('#filter-venue-mobile').on('change', function(){
                var val = $(this).val();
                $('#filter-venue').val(val);
                sortFilterResult(sort_mobile);
            });

            $('#filter-period-mobile').on('change', function(){
                var val = $(this).val();
                $('#filter-period').val(val);
                sortFilterResult(sort_mobile);
            });

            $('.cat-filter-mobile').on('ifClicked', function(e){
                $(this).on('ifChecked', function(event){
                    var val = $(this).val();
                    $('.cat-filter[value="'+val+'"]').iCheck('check');
                    sortFilterResult(sort_mobile);
                });
                $(this).on('ifUnchecked', function(event){
                    var val = $(this).val();
                    $('.cat-filter[value="'+val+'"]').iCheck('check');
                    sortFilterResult(sort_mobile);
                });

                // $(".cat-filter-mobile:checked").each(function(){
                //     var val = $(this).val();
                //     $('.cat-filter[value="'+val+'"]').prop('checked', true);
                // });
                // $(".cat-filter-mobile:not(:checked)").each(function(){
                //     var val = $(this).val();
                //     $('.cat-filter[value="'+val+'"]').prop('checked', false);
                // });
            });

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
                    $('.search-list-mobile').html('');
                    var events = response.data.events;
                    if(events != ''){
                        $.each(events,function(key, val){
                            var uri = "{{ URL::route('event-detail', "::param") }}";
                            uri = uri.replace('::param', val.slug);
                            var html = '<tr class="bg-green tr-search" style="background-color:'+val.background_color+' !important">'
                                +'<td class="searchpic"><a href="'+uri+'"><img src="'+val.featured_image3_url+'"></a></td>'
                                +'<td class="jobs"><a href="'+uri+'">'+val.title+'</a></td>'
                                +'<td class="date"><a href="'+uri+'">'+val.schedule+'</a></td>'
                                +'<td class="place"><a href="'+uri+'">'+val.venue_name+val.city+'</a></td>'
                                +'<td class="type"><a href="'+uri+'">'+val.cat_name+'</a></td>'
                                +'</tr>';
                            //console.log(html);
                            $('.search-list table').append(html);

                            var html2 = '<div class="row">'
                                +'<div class="col-md-12">'
                                    +'<a href="'+uri+'" class="mobile-jobs-a">'
                                        +'<div class="mobile-job-list">'
                                            +'<div class="mobile-search-head bg-green" style="background-color:'+val.background_color+' !important">'
                                                +'<div class="row">'
                                                    +'<div class="col-xs-4">'
                                                        +'<img src="'+val.featured_image3_url+'">'
                                                    +'</div>'
                                                    +'<div class="col-xs-8">'
                                                        +'<div class="mobile-search-title">'
                                                            +'<h4>'+val.title+'</h4>'
                                                        +'</div>'
                                                    +'</div>'
                                                +'</div>'
                                            +'</div>'
                                            +'<div class="mobile-search-desc">'
                                                +'<ul>'
                                                    +'<li class="date">'+val.schedule+'</li>'
                                                    +'<li class="place">'+val.venue_name+val.city+'</li>'
                                                    +'<li class="type">'+val.cat_name+'</li>'
                                                +'</ul>'
                                            +'</div>'
                                        +'</div>'
                                    +'</a>'
                                +'</div>'
                            +'</div>';
                            $('.search-list-mobile').append(html2);
                        });
                    }else{
                        html = "<h3 class='text-center'>{{ trans('frontend/general.there_are_no_event') }}</h3>";
                        $('.search-list table').append(html);
                        $('.search-list-mobile').append(html);
                    }
                    HoldOn.close();

                },
                error: function(response){
                    response.responseJSON.message;
                    HoldOn.close();
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