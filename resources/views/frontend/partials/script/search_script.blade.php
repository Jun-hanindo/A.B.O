@section('script')

<script type="text/javascript">
       var q = $(".input-search").val(); 
       //var sort = $('#sort-search').val();
       //var sort_mobile = $('#sort-search-mobile').val();
        var sort = '';
        var sort_mobile = '';

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


            $('.cat-filter-all').on('ifClicked', function(e){
                var val = $(this).val();
                var check = $('.cat-filter-all').iCheck('toggle')[0].checked;

                if(check){
                    $('.cat-filter, .cat-filter-mobile, .cat-filter-mobile-all').iCheck('check');
                    sortFilterResult(sort);
                }else{
                    $('.cat-filter, .cat-filter-mobile, .cat-filter-mobile-all').iCheck('uncheck');
                    sortFilterResult(sort);
                }
            });

            $('.cat-filter-mobile-all').on('ifClicked', function(e){
                var val = $(this).val();
                var check = $('.cat-filter-all').iCheck('toggle')[0].checked;

                if(check){
                    $('.cat-filter, .cat-filter-mobile, .cat-filter-all').iCheck('check');
                    sortFilterResult(sort_mobile);
                }else{
                    $('.cat-filter, .cat-filter-mobile, .cat-filter-all').iCheck('uncheck');
                    sortFilterResult(sort_mobile);
                }
            });

            $('.cat-filter').on('ifClicked', function(e){
                var val = $(this).val();
                var check = $('.cat-filter[value="'+val+'"]').iCheck('toggle')[0].checked;
                if(check){
                    $('.cat-filter[value="'+val+'"], .cat-filter-mobile[value="'+val+'"]').iCheck('check');
                    sortFilterResult(sort);
                }else{
                    $('.cat-filter[value="'+val+'"], .cat-filter-mobile[value="'+val+'"], .cat-filter-all, .cat-filter-mobile-all').iCheck('uncheck');
                    sortFilterResult(sort);

                }
            });

            $('.cat-filter-mobile').on('ifClicked', function(e){
                var val = $(this).val();
                var check = $('.cat-filter-mobile[value="'+val+'"]').iCheck('toggle')[0].checked;
                if(check){
                    $('.cat-filter[value="'+val+'"], .cat-filter-mobile[value="'+val+'"]').iCheck('check');
                    sortFilterResult(sort);
                }else{
                    $('.cat-filter[value="'+val+'"], .cat-filter-mobile[value="'+val+'"], .cat-filter-all, .cat-filter-mobile-all').iCheck('uncheck');
                    sortFilterResult(sort);

                }
            });
            
            // $('.cat-filter').on('ifChecked', function(e){
            //     sortFilterResult(sort);
            //     var val = $(this).val();
            //     $('.cat-filter-mobile[value="'+val+'"]').iCheck('check');
            //     // if(val == 'all'){
            //     //     $('.cat-filter, .cat-filter-mobile').iCheck('check');
            //     // }
            // }).on('ifUnchecked', function(event){
            //     sortFilterResult(sort);
            //     var val = $(this).val();
            //     $('.cat-filter-mobile[value="'+val+'"]').iCheck('uncheck');
            //     // if(val == 'all'){
            //     //     $('.cat-filter, .cat-filter-mobile').iCheck('uncheck');
            //     // }
            // });
            // $('.cat-filter-mobile').on('ifChecked', function(e){
            //     sortFilterResult(sort_mobile);
            //     var val = $(this).val();
            //     $('.cat-filter[value="'+val+'"]').iCheck('check');
            //     // if(val == 'all'){
            //     //     $('.cat-filter, .cat-filter-mobile').iCheck('check');
            //     // }
            // }).on('ifUnchecked', function(event){
            //     sortFilterResult(sort_mobile);
            //     var val = $(this).val();
            //     $('.cat-filter[value="'+val+'"]').iCheck('uncheck');
            //     // if(val == 'all'){
            //     //     $('.cat-filter, .cat-filter-mobile').iCheck('uncheck');
            //     // }
            // });

        });

        function sortFilterResult(sort)
        {
            modal_loader();
            var data = $('#filter-form').serializeArray();
            data.push({name: 'q', value: q});
            //data.push({name: 'sort', value: sort});
            console.log(data);
            $.ajax({
                url: "{{ route('event-search-get') }}",
                type: "GET",
                dataType: 'json',
                data: data,
                success: function (response) {
                    var val = $('#filter-form').serialize();
                    //var uri = 'q='+q+'&sort='+sort+'&'+val;
                    var uri = 'q='+q+'&'+val;
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