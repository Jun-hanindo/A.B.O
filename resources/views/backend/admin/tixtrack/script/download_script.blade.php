@section('scripts')

    <script>
    $(document).ready(function() {

        $('#button_download_import').click(function(){
            modal_loader();
        });
        // 
        
        $('.tixtrack-filter').on('click', '.delete-member', function(){
            var id = $(this).attr('data-id');
            if ($(this).parents('tr').is(":last-child")) {
                id2 = id -1;
                $('#member_tr_'+id).remove();
                $('#member_condition_tr_'+id2).remove();
            }else{
                $('#member_tr_'+id).remove();
                $('#member_condition_tr_'+id).remove();
            }
            // 
            // $('#member-table tr:nth-child(2)').remove();
            // $('#member-table tr:nth-child(1)').remove();
        });

        $('.tixtrack-filter').on('click', '.delete-transaction', function(){ 
            var id = $(this).attr('data-id');
            if ($(this).parents('tr').is(":last-child")) {
                id2 = id -1;
                $('#transaction_tr_'+id).remove();
                $('#transaction_condition_tr_'+id2).remove();
            }else{
                $('#transaction_tr_'+id).remove();
                $('#transaction_condition_tr_'+id).remove();
            }

            // $('#transaction-table tr:nth-child(2)').remove();
            // $('#transaction-table tr:nth-child(1)').remove();
        });

        $('.tixtrack-filter').on('change', '.attribute_member-filter', function(){
            var id = $(this).attr('data-id');
            var val = $(this).val();

            if(val == 'FraudStatus'){
                html = '<select name="member['+id+'][OperatorValue]" data-id="'+id+'" type="text" class="form-control operator_member-filter">'
                    +'<option label="=" value="=" selected="selected">=</option>';
                $('#operator_member_td_'+id).html(html);
                html2 = '<select name="member['+id+'][ConditionValue]" data-id="'+id+'" type="text" class="form-control condition_member-filter">'
                    +'<option label="Uncategorized" value="Uncategorized" selected="selected">Uncategorized</option>'
                    +'<option label="PendingReview" value="PendingReview">PendingReview</option>'
                    +'<option label="Valid" value="Valid">Valid</option>'
                    +'<option label="Fraud" value="Fraud">Fraud</option>'
                    +'<option label="Inconclusive" value="Inconclusive">Inconclusive</option>'
                $('#condition_member_td_'+id).html(html2);
            }else if(val == 'UserId'){
                html = '<select name="member['+id+'][OperatorValue]" data-id="'+id+'" type="text" class="form-control operator_member-filter">'
                    +'<option label="=" value="=" selected="selected">=</option>'
                    +'<option label=">=" value=">=">>=</option>'
                    +'<option label="<=" value="<="><=</option>'
                +'</select>';
                $('#operator_member_td_'+id).html(html);
                html2 = '<input name="member['+id+'][ConditionValue]" data-id="'+id+'" type="text" class="form-control condition_member-filter" value=""/>';
                $('#condition_member_td_'+id).html(html2);
            }else{
                html = '<select name="member['+id+'][OperatorValue]" data-id="'+id+'" type="text" class="form-control operator_member-filter">'
                    +'<option label="=" value="=" selected="selected">=</option>'
                    +'<option label="Contains" value="Contains">Contains</option>'
                    +'<option label="Has A Value" value="Has A Value">Has A Value</option>'
                    +'<option label="Starts With" value="Starts With">Starts With</option>'
                    +'<option label="Ends With" value="Ends With">Ends With</option>'
                +'</select>';
                $('#operator_member_td_'+id).html(html);
                html2 = '<input name="member['+id+'][ConditionValue]" data-id="'+id+'" type="text" class="form-control condition_member-filter" value=""/>';
                $('#condition_member_td_'+id).html(html2);
            }
        });

        $('.tixtrack-filter').on('change', '.attribute_transaction-filter', function(){
            var id = $(this).attr('data-id');
            var val = $(this).val();

            if(val == 'Customer.FraudStatus' || val == 'Event.AwayTeam.Sport' || val == 'Event.DayOfWeek' || 
                val == 'Event.TimePeriod' || val == 'OrderStatus' || val == 'SalesChannel' || val == 'Seller.FraudStatus'){
                html = '<select name="transaction['+id+'][OperatorValue]" data-id="'+id+'" type="text" class="form-control operator_transaction-filter">'
                    +'<option label="=" value="=" selected="selected">=</option>';
                $('#operator_transaction_td_'+id).html(html);
            }else if(val == 'Balance' || val == 'Customer.UserId' || val == 'Event.EventTemplate.ID' || val == 'Event.ID' ||
                val == 'Event.LocalDate' || val == 'Event.TimeOfDay' || val == 'Event.Venue.ID' || val == 'Event.VenueConfig.ID' ||
                val == 'EventID' || val == 'FraudScore' || val == 'ID' || val == 'LocalCreated' || val == 'Partner.ID' ||
                val == 'Partner.PartnerCategoryID' || val == 'Seller.UserId' || val == 'Total'){
                html = '<select name="transaction['+id+'][OperatorValue]" data-id="'+id+'" type="text" class="form-control operator_transaction-filter">'
                    +'<option label="=" value="=" selected="selected">=</option>'
                    +'<option label=">=" value=">=">>=</option>'
                    +'<option label="<=" value="<="><=</option>'
                +'</select>';
                $('#operator_transaction_td_'+id).html(html);
            }else if(val == 'Event.Active' || val == 'Event.HasProducts' || val == 'Event.RequireRecaptcha' || val == 'IsFraud'){
                html = '<select name="transaction['+id+'][OperatorValue]" data-id="'+id+'" type="text" class="form-control operator_transaction-filter">'
                    +'<option label="Is" value="Is" selected="selected">Is</option>'
                +'</select>';
                $('#operator_transaction_td_'+id).html(html);
            }else{
                html = '<select name="transaction['+id+'][OperatorValue]" data-id="'+id+'" type="text" class="form-control operator_transaction-filter">'
                    +'<option label="=" value="=" selected="selected">=</option>'
                    +'<option label="Contains" value="Contains">Contains</option>'
                    +'<option label="Has A Value" value="Has A Value">Has A Value</option>'
                    +'<option label="Starts With" value="Starts With">Starts With</option>'
                    +'<option label="Ends With" value="Ends With">Ends With</option>'
                +'</select>';
                $('#operator_transaction_td_'+id).html(html);
            }



            if(val == 'Customer.FraudStatus' || val == 'Seller.FraudStatus'){
                html2 = '<select name="transaction['+id+'][ConditionValue]" data-id="'+id+'" type="text" class="form-control condition_transaction-filter">'
                    +'<option label="Uncategorized" value="Uncategorized" selected="selected">Uncategorized</option>'
                    +'<option label="PendingReview" value="PendingReview">PendingReview</option>'
                    +'<option label="Valid" value="Valid">Valid</option>'
                    +'<option label="Fraud" value="Fraud">Fraud</option>'
                    +'<option label="Inconclusive" value="Inconclusive">Inconclusive</option>'
                $('#condition_transaction_td_'+id).html(html2);
            }else if(val == 'SalesChannel'){
                html2 = '<select name="transaction['+id+'][ConditionValue]" data-id="'+id+'" type="text" class="form-control condition_transaction-filter">'
                    +'<option label="Web" value="Web" selected="selected">Web</option>'
                    +'<option label="PointOfSale" value="PointOfSale">PointOfSale</option>'
                    +'<option label="StubHub" value="StubHub">StubHub</option>'
                    +'<option label="VividSeats" value="VividSeats">VividSeats</option>'
                    +'<option label="Outlet" value="Outlet">Outlet</option>'
                    +'<option label="API" value="API">API</option>'
                    +'<option label="HouseSeats" value="HouseSeats">HouseSeats</option>'
                $('#condition_transaction_td_'+id).html(html2);
            }else if(val == 'OrderStatus'){
                html2 = '<select name="transaction['+id+'][ConditionValue]" data-id="'+id+'" type="text" class="form-control condition_transaction-filter">'
                    +'<option label="Accepted" value="Accepted" selected="selected">Accepted</option>'
                    +'<option label="Cancelled" value="Cancelled">Cancelled</option>'
                $('#condition_transaction_td_'+id).html(html2);
            }else if(val == 'IsFraud' || val == 'Event.RequireRecaptcha' || val == 'Event.HasProducts' || val == 'Event.Active'){
                html2 = '<select name="transaction['+id+'][ConditionValue]" data-id="'+id+'" type="text" class="form-control condition_transaction-filter">'
                    +'<option label="True" value="True" selected="selected">True</option>'
                    +'<option label="False" value="False">False</option>'
                $('#condition_transaction_td_'+id).html(html2);
            }else if(val == 'Event.TimePeriod'){
                html2 = '<select name="transaction['+id+'][ConditionValue]" data-id="'+id+'" type="text" class="form-control condition_transaction-filter">'
                    +'<option label="Morning" value="Morning" selected="selected">Morning</option>'
                    +'<option label="Afternoon" value="Afternoon">Afternoon</option>'
                    +'<option label="Evening" value="Evening">Evening</option>'
                $('#condition_transaction_td_'+id).html(html2);
            }else if(val == 'Event.DayOfWeek'){
                html2 = '<select name="transaction['+id+'][ConditionValue]" data-id="'+id+'" type="text" class="form-control condition_transaction-filter">'
                    +'<option label="Sunday" value="Sunday" selected="selected">Sunday</option>'
                    +'<option label="Monday" value="Monday">Monday</option>'
                    +'<option label="Tuesday" value="Tuesday">Tuesday</option>'
                    +'<option label="Wednesday" value="Wednesday">Wednesday</option>'
                    +'<option label="Thursday" value="Thursday">Thursday</option>'
                    +'<option label="Friday" value="Friday">Friday</option>'
                    +'<option label="Saturday" value="Saturday">Saturday</option>'
                $('#condition_transaction_td_'+id).html(html2);
            }else if(val == 'Event.AwayTeam.Sport'){
                html2 = '<select name="transaction['+id+'][ConditionValue]" data-id="'+id+'" type="text" class="form-control condition_transaction-filter">'
                    +'<option label="Basketball" value="Basketball" selected="selected">Basketball</option>'
                    +'<option label="Baseball" value="Baseball">Baseball</option>'
                    +'<option label="Football" value="Football">Football</option>'
                    +'<option label="Soccer" value="Soccer">Soccer</option>'
                $('#condition_transaction_td_'+id).html(html2);
            }else if(val == 'LocalCreated' || val == 'Event.LocalDate'){
                html2 = '<input name="transaction['+id+'][ConditionValue]" data-id="'+id+'" type="text" class="form-control datepicker condition_transaction-filter" value=""/>';
                $('#condition_transaction_td_'+id).html(html2);
            }else if(val == 'Event.TimeOfDay'){
                html2 = '<input name="transaction['+id+'][ConditionValue]" data-id="'+id+'" type="text" class="form-control timepicker condition_transaction-filter" value=""/>';
                $('#condition_transaction_td_'+id).html(html2);
            }else{
                html2 = '<input name="transaction['+id+'][ConditionValue]" data-id="'+id+'" type="text" class="form-control condition_transaction-filter" value=""/>';
                $('#condition_transaction_td_'+id).html(html2);
            }

            $(".datepicker").datepicker( {
                format: "mm/dd/yyyy",
            });

            $('.timepicker').timepicker();
        });

    });

    var i = 1;
    function addMemberFilter(){
        if(i > 1 && $('#member-table tbody').html() != ''){
            var k = i - 1;
            html = '<tr id="member_condition_tr_'+k+'">'
                +'<td></td>'
                +'<td><select name="member['+k+'][ChainOperator]" data-id="'+k+'" type="text" class="form-control">'
                    +'<option label="AND" value="AND" selected="selected">AND</option>'
                    +'<option label="OR" value="OR">OR</option>'
                +'</select></td>'
                +'<td></td>'
                +'<td></td>'
                +'</tr>';
        }else{
            html = '';
        }
        html  += '<tr id="member_tr_'+i+'">'
            +'<td width="40%" id="attribute_member_td_'+i+'"><select name="member['+i+'][AttributeName]" data-id="'+i+'" type="text" class="form-control attribute_member-filter">'
                +'<option label="BillToAddress1" value="BillToAddress1" selected="selected">BillToAddress1</option>'
                +'<option label="BillToCity" value="BillToCity">BillToCity</option>'
                +'<option label="BillToCountryCode" value="BillToCountryCode">BillToCountryCode</option>'
                +'<option label="BillToPostalCode" value="BillToPostalCode">BillToPostalCode</option>'
                +'<option label="BillToState" value="BillToState">BillToState</option>'
                +'<option label="CCBrand" value="CCBrand">CCBrand</option>'
                +'<option label="Email" value="Email">Email</option>'
                +'<option label="FirstName" value="FirstName">FirstName</option>'
                +'<option label="FraudStatus" value="FraudStatus">FraudStatus</option>'
                +'<option label="LastName" value="LastName">LastName</option>'
                +'<option label="Phone" value="Phone">Phone</option>'
                +'<option label="UserId" value="UserId">UserId</option>'
                +'<option label="UserName" value="UserName">UserName</option>'
            +'</select></td>'
            +'<td width="20%" id="operator_member_td_'+i+'"><select name="member['+i+'][OperatorValue]" data-id="'+i+'" type="text" class="form-control operator_member-filter">'
                +'<option label="=" value="=" selected="selected">=</option>'
                +'<option label="Contains" value="Contains">Contains</option>'
                +'<option label="Has A Value" value="Has A Value">Has A Value</option>'
                +'<option label="Starts With" value="Starts With">Starts With</option>'
                +'<option label="Ends With" value="Ends With">Ends With</option>'
            +'</select></td>'
            +'<td id="condition_member_td_'+i+'"><input name="member['+i+'][ConditionValue]" data-id="'+i+'" type="text" class="form-control condition_member-filter" value=""/></td>'
            +'<td width="5%"><a class="delete-member" data-id="'+i+'"><i class="fa fa-times-circle fa-lg"></i></a></td>'
        +'</tr>';
        
        $('#member-table tbody').append(html);
        i++;
    }

    var j = 1;
    function addTransactionFilter(){
        if(j > 1 && $('#transaction-table tbody').html() != ''){
            var l = j - 1;
            html = '<tr id="transaction_condition_tr_'+l+'">'
                +'<td></td>'
                +'<td><select name="transaction['+l+'][ChainOperator]" data-id="'+l+'" type="text" class="form-control">'
                    +'<option label="AND" value="AND" selected="selected">AND</option>'
                    +'<option label="OR" value="OR">OR</option>'
                +'</select></td>'
                +'<td></td>'
                +'<td></td>'
                +'</tr>';
        }else{
            html = '';
        }
        html  += '<tr id="transaction_tr_'+j+'">'
            +'<td width="40%" id="attribute_transaction_td_'+j+'"><select name="transaction['+j+'][AttributeName]" data-id="'+j+'" type="text" class="form-control attribute_transaction-filter">'
                +'<option label="Balance" value="Balance">Balance</option>'
                +'<option label="BillToAddress1" value="BillToAddress1">BillToAddress1</option>'
                +'<option label="BillToAddress2" value="BillToAddress2">BillToAddress2</option>'
                +'<option label="BillToAddress3" value="BillToAddress3">BillToAddress3</option>'
                +'<option label="BillToCity" value="BillToCity">BillToCity</option>'
                +'<option label="BillToCountryCode" value="BillToCountryCode">BillToCountryCode</option>'
                +'<option label="BillToPostalCode" value="BillToPostalCode">BillToPostalCode</option>'
                +'<option label="BillToState" value="BillToState">BillToState</option>'
                +'<option label="Customer.BillToAddress1" value="Customer.BillToAddress1">Customer.BillToAddress1</option>'
                +'<option label="Customer.BillToCity" value="Customer.BillToCity">Customer.BillToCity</option>'
                +'<option label="Customer.BillToCountryCode" value="Customer.BillToCountryCode">Customer.BillToCountryCode</option>'
                +'<option label="Customer.BillToPostalCode" value="Customer.BillToPostalCode">Customer.BillToPostalCode</option>'
                +'<option label="Customer.BillToState" value="Customer.BillToState">Customer.BillToState</option>'
                +'<option label="Customer.CCBrand" value="Customer.CCBrand">Customer.CCBrand</option>'
                +'<option label="Customer.Email" value="Customer.Email">Customer.Email</option>'
                +'<option label="Customer.FirstName" value="Customer.FirstName">Customer.FirstName</option>'
                +'<option label="Customer.FraudStatus" value="Customer.FraudStatus">Customer.FraudStatus</option>'
                +'<option label="Customer.LastName" value="Customer.LastName">Customer.LastName</option>'
                +'<option label="Customer.Phone" value="Customer.Phone">Customer.Phone</option>'
                +'<option label="Customer.UserId" value="Customer.UserId">Customer.UserId</option>'
                +'<option label="Customer.UserName" value="Customer.UserName">Customer.UserName</option>'
                +'<option label="Email" value="Email">Email</option>'
                +'<option label="Event.Active" value="Event.Active">Event.Active</option>'
                +'<option label="Event.AwayTeam.Name" value="Event.AwayTeam.Name">Event.AwayTeam.Name</option>'
                +'<option label="Event.AwayTeam.Sport" value="Event.AwayTeam.Sport">Event.AwayTeam.Sport</option>'
                +'<option label="Event.DayOfWeek" value="Event.DayOfWeek">Event.DayOfWeek</option>'
                +'<option label="Event.EventTemplate.Code" value="Event.EventTemplate.Code">Event.EventTemplate.Code</option>'
                +'<option label="Event.EventTemplate.ID" value="Event.EventTemplate.ID">Event.EventTemplate.ID</option>'
                +'<option label="Event.EventTemplate.Name" value="Event.EventTemplate.Name">Event.EventTemplate.Name</option>'
                +'<option label="Event.HasProducts" value="Event.HasProducts">Event.HasProducts</option>'
                +'<option label="Event.ID" value="Event.ID">Event.ID</option>'
                +'<option label="Event.LocalDate" value="Event.LocalDate">Event.LocalDate</option>'
                +'<option label="Event.Name" value="Event.Name">Event.Name</option>'
                +'<option label="Event.RequireRecaptcha" value="Event.RequireRecaptcha">Event.RequireRecaptcha</option>'
                +'<option label="Event.TimeOfDay" value="Event.TimeOfDay">Event.TimeOfDay</option>'
                +'<option label="Event.TimePeriod" value="Event.TimePeriod">Event.TimePeriod</option>'
                +'<option label="Event.Venue.ID" value="Event.Venue.ID">Event.Venue.ID</option>'
                +'<option label="Event.Venue.Name" value="Event.Venue.Name">Event.Venue.Name</option>'
                +'<option label="Event.VenueConfig.ID" value="Event.VenueConfig.ID">Event.VenueConfig.ID</option>'
                +'<option label="Event.VenueConfig.Name" value="Event.VenueConfig.Name">Event.VenueConfig.Name</option>'
                +'<option label="EventID" value="EventID">EventID</option>'
                +'<option label="FirstName" value="FirstName">FirstName</option>'
                +'<option label="FraudScore" value="FraudScore">FraudScore</option>'
                +'<option label="ID" value="ID">ID</option>'
                +'<option label="IsFraud" value="IsFraud">IsFraud</option>'
                +'<option label="LastName" value="LastName">LastName</option>'
                +'<option label="LocalCreated" value="LocalCreated">LocalCreated</option>'
                +'<option label="OrderStatus" value="OrderStatus">OrderStatus</option>'
                +'<option label="Partner.CountryCode" value="Partner.CountryCode">Partner.CountryCode</option>'
                +'<option label="Partner.ID" value="Partner.ID">Partner.ID</option>'
                +'<option label="Partner.Name" value="Partner.Name">Partner.Name</option>'
                +'<option label="Partner.PartnerCategoryID" value="Partner.PartnerCategoryID">Partner.PartnerCategoryID</option>'
                +'<option label="Phone" value="Phone">Phone</option>'
                +'<option label="PriceTableName" value="PriceTableName">PriceTableName</option>'
                +'<option label="SalesChannel" value="SalesChannel">SalesChannel</option>'
                +'<option label="Seller.BillToAddress1" value="Seller.BillToAddress1">Seller.BillToAddress1</option>'
                +'<option label="Seller.BillToCity" value="Seller.BillToCity">Seller.BillToCity</option>'
                +'<option label="Seller.BillToCountryCode" value="Seller.BillToCountryCode">Seller.BillToCountryCode</option>'
                +'<option label="Seller.BillToPostalCode" value="Seller.BillToPostalCode">Seller.BillToPostalCode</option>'
                +'<option label="Seller.BillToState" value="Seller.BillToState">Seller.BillToState</option>'
                +'<option label="Seller.CCBrand" value="Seller.CCBrand">Seller.CCBrand</option>'
                +'<option label="Seller.Email" value="Seller.Email">Seller.Email</option>'
                +'<option label="Seller.FirstName" value="Seller.FirstName">Seller.FirstName</option>'
                +'<option label="Seller.FraudStatus" value="Seller.FraudStatus">Seller.FraudStatus</option>'
                +'<option label="Seller.LastName" value="Seller.LastName">Seller.LastName</option>'
                +'<option label="Seller.Phone" value="Seller.Phone">Seller.Phone</option>'
                +'<option label="Seller.UserId" value="Seller.UserId">Seller.UserId</option>'
                +'<option label="Seller.UserName" value="Seller.UserName">Seller.UserName</option>'
                +'<option label="Total" value="Total">Total</option>'
            +'</select></td>'
            +'<td width="20%" id="operator_transaction_td_'+j+'"><select name="transaction['+j+'][OperatorValue]" data-id="'+j+'" type="text" class="form-control operator_transaction-filter">'
                +'<option value="="> = </option>'
                +'<option value=">="> >= </option>'
                +'<option value="<="> <= </option>'
            +'</select></td>'
            +'<td id="condition_transaction_td_'+j+'"><input name="transaction['+j+'][ConditionValue]" data-id="'+j+'" type="text" class="form-control condition_transaction-filter" value=""/></td>'
            +'<td width="5%"><a class="delete-transaction" data-id="'+j+'"><i class="fa fa-times-circle fa-lg"></i></a></td>'
        +'</tr>';
        
        $('#transaction-table tbody').append(html);
        j++;
    }
        
    
    </script>
@endsection