@section('script')

<script type="text/javascript">
       var val = $('#department-filter').val();

        $(document).ready(function(){

            $('#department-filter').on('change', function(){
                var val = $(this).val();
                filterResult(val);
            });

        });

        function filterResult(val)
        {

            $.ajax({
                url: "{{ route('careers') }}",
                type: "GET",
                dataType: 'json',
                data: {'department': val},
                success: function (response) {
                    $('.job-body').html('');
                    $('.job-body-mobile').html('');
                    var careers = response.data.careers;
                    $('#count-job').html(response.data.count_job);;
                    $.each(careers,function(key, val){
                        var head = '';
                        if(key == 0){
                            var head = 'job-list-head';
                        }
                        var html = '<div class="job-list '+head+'">'
                                +'<table>'
                                    +'<tr>'
                                        +'<td class="jobs">'+val.job+'</td>'
                                        +'<td class="divisions">'+val.dept+'</td>'
                                        +'<td class="job-type">'+val.type+'</td>'
                                        +'<td class="payroll">'+val.currency_symbol_left+val.salary+val.currency_symbol_right+'</td>'
                                    +'</tr>'
                                +'</table>'
                            +'</div>';
                        $('.job-body').append(html);

                        var html_mobile = '<div class="row">'
                            +'<div class="col-md-12">'
                                +'<a href="#" class="mobile-jobs-a">'
                                    +'<div class="mobile-job-list">'
                                        +'<div class="mobile-job-head">'
                                            +'<h4>'+val.job+'</h4>'
                                        +'</div>'
                                        +'<div class="mobile-job-desc">'
                                            +'<ul>'
                                                +'<li class="divisions">'+val.dept+'</li>'
                                                +'<li class="job-type">'+val.type+'</li>'
                                                +'<li class="payroll">'+val.currency_symbol_left+val.salary+val.currency_symbol_right+'</li>'
                                            +'</ul>'
                                        +'</div>'
                                    +'</div>'
                                +'</a>'
                            +'</div>'
                        +'</div>';
                        $('.job-body-mobile').append(html_mobile);
                    });

                },
                error: function(response){
                    response.responseJSON.message
                }
            });
        }

</script>

@endsection