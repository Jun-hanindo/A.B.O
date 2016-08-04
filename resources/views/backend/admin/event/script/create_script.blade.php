@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}
    <script type="text/javascript">
        $(document).ready(function(){

            loadData();

            function loadData()
            {
                var table = $('#price-detail-datatables').DataTable();
                table.destroy();
                $('#price-detail-datatables').DataTable({
                    columnDefs: [ {
                        orderable: false,
                        className: 'select-checkbox',
                        targets:   0
                    } ],
                    select: {
                        style:    'os',
                        selector: 'td:first-child'
                    },
                    order: [[ 1, 'asc' ]],
                    "paging":   false,
                    "info":     false,
                    "searching": false
                });
            }

            $('.actAdd').on('click',function(){
                $('#modal-form').modal('show');
                $('#title-create').show();
                $('#title-update').hide();
                $('#button_update').hide();
                $('#button_save').show();
            });


        });
    </script>
@endsection