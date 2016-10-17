@section('scripts')

    <script>
    $(document).ready(function() {
        
        $('.tixtrack-filter').on('click', '.delete-member', function(){
            var id = $(this).attr('data-id');
            $('#member_tr_'+id).remove();
        });

        $('.tixtrack-filter').on('click', '.delete-transaction', function(){
            var id = $(this).attr('data-id');
            $('#transaction_tr_'+id).remove();
        })

    });

    var i = 1;
    function addMemberFilter(){
        html  = '<tr id="member_tr_'+i+'">'
            +'<td><input name="member['+i+'][AttributeName]" type="text" class="form-control" value=""/></td>'
            +'<td><select name="member['+i+'][OperatorValue]" type="text" class="form-control">'
                +'<option value="="> = </option>'
                +'<option value=">="> >= </option>'
                +'<option value="<="> <= </option>'
            +'</select></td>'
            +'<td><input name="member['+i+'][ConditionValue]" type="text" class="form-control" value=""/></td>'
            +'<td><a class="delete-member" data-id="'+i+'"><i class="fa fa-times-circle fa-lg"></i></a></td>'
        +'</tr>';
        
        $('#member-table tbody').append(html);
        i++;
    }

    var j = 1;
    function addTransactionFilter(){
        html  = '<tr id="transaction_tr_'+j+'">'
            +'<td><input name="transaction['+j+'][AttributeName]" type="text" class="form-control" value=""/></td>'
            +'<td><select name="transaction['+j+'][OperatorValue]" type="text" class="form-control">'
                +'<option value="="> = </option>'
                +'<option value=">="> >= </option>'
                +'<option value="<="> <= </option>'
            +'</select></td>'
            +'<td><input name="transaction['+j+'][ConditionValue]" type="text" class="form-control" value=""/></td>'
            +'<td><a class="delete-transaction" data-id="'+j+'"><i class="fa fa-times-circle fa-lg"></i></a></td>'
        +'</tr>';
        
        $('#transaction-table tbody').append(html);
        j++;
    }
        
    
    </script>
@endsection