modal_loader = function(){
    HoldOn.open({
        theme:"sk-circle",
        message:"<h4>Proccessing....</h4>"
    });
};
var slug = function(str) {
    var $slug = '';
    var trimmed = $.trim(str);
    $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
    replace(/-+/g, '-').
    replace(/^-|-$/g, '');
    return $slug.toLowerCase();
}

preview = function(me,type,elementId){
  if (me.files && me.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          // $('#image')
          //     .attr('src', e.target.result);
          $("#preview_"+elementId).attr('src',e.target.result);
      };
    
      reader.readAsDataURL(me.files[0]);
  }
}

$(".number-only").keydown(function (e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
         // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
         // Allow: Ctrl+C
        (e.keyCode == 67 && e.ctrlKey === true) ||
         // Allow: Ctrl+X
        (e.keyCode == 88 && e.ctrlKey === true) ||
         // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
             // let it happen, don't do anything
             return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});

$(".percent").keydown(function (e) {
    
    if (this.value.length == 0 && e.which == 48 ){
      return false;
    }

    if(this.value.length == 2 && e.which == 190){
        $(this).attr('maxlength','5');
    }

    if(this.value.length == 1 && e.which == 190){
        $(this).attr('maxlength','4');
    }

    if((this.value.charAt(1) == '.' || this.value.charAt(2) == '.') && e.which == 190){
        return false;
    }

    if(this.value.length == 2 && this.value.charAt(1) != '.' && e.which != 190){
        $(this).attr('maxlength','2');
    }

    if(this.value == 99){
        $(this).attr('maxlength','2');
    }
});


$(".nominal").keydown(function (e) {
    if (this.value.length == 0 && e.which == 48 ){
      return false;
    }
});



function loadTextEditor()
{
    // tinymce.init({
    //     selector: "textarea.tinymce",
    //     menubar: false,
    //     plugins: ["textcolor code paste"],
    //     paste_text_sticky: true,
    //     paste_text_sticky_default: true,
    //     toolbar: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor| code"
    // });

    $( 'textarea.tinymce' ).ckeditor();
}

function loadTextEditor2()
{
    CKEDITOR.replace( 'content', {
        customConfig: '../ckeditor/config2.js'
    });
}

function loadSwitchButton($class){
    $("."+$class).bootstrapSwitch();

}

function saveTrailModal(desc){
    $.ajax({
        url: urlPostTrail,
        type: "POST",
        dataType: 'json',
        data: {'desc': desc},
        success: function (data) {
            data.message
        },
        error: function(response){
            response.responseJSON.message
        }
    });
}

function discountSwitch(){
    var val = $('.discount_type-check').is(":checked") ? true : false;
    if(val){
        $('#discount-percent').show();
        $('#discount-nominal').hide();
    }else{
        $('#discount-percent').hide();
        $('#discount-nominal').show();
    }
}

function datatablesSelectAll(table)
{
    var $table             = table.table().node();
    var $chkbox_all        = $('tbody .item-checkbox', $table);
    var $chkbox_select_all_checked  = $('thead .select_all-checkbox:checked', $table);
    console.log($table);
    //if select all checked
    if($chkbox_select_all_checked.length === 1){
        $($chkbox_all).each(function(){ 
            this.checked = true; 
        });
    // If select all unchecked
    }else{
        $($chkbox_all).each(function(){ 
            this.checked = false; 
        });
    }
}

function datatablesCheckbox(table){
    var $table             = table.table().node();
    var $chkbox_all        = $('tbody .item-checkbox', $table);
    var $chkbox_checked    = $('tbody .item-checkbox:checked', $table);
    var $chkbox_select_all_checked  = $('thead .select_all-checkbox:checked', $table)
    var get_chkbox_select_all = $('thead .select_all-checkbox', $table).get(0);
    // If none of the checkboxes are checked
    if($chkbox_checked.length === 0)
    {
        get_chkbox_select_all.checked = false;
        if('indeterminate' in get_chkbox_select_all){
            get_chkbox_select_all.indeterminate = false;
        }
    // If all of the checkboxes are checked
    }else if ($chkbox_checked.length === $chkbox_all.length){
        get_chkbox_select_all.checked = true;
        if('indeterminate' in get_chkbox_select_all){
            get_chkbox_select_all.indeterminate = false;
        }
    // If some of the checkboxes are checked
    } else {
        get_chkbox_select_all.checked = true;
        if('indeterminate' in get_chkbox_select_all){
            get_chkbox_select_all.indeterminate = true;
        }
    }
}

$('#show-message').on('click',function(){
    $.ajax({
        url: urlCountMessageUnread,
        type: "GET",
        dataType: 'json',
        success: function (data) {
            $('#inbox-unread').html(data);
        },
        error: function(response){
            response.responseJSON.message
        }
    });
});

// $('.menu-disabled').on('click mouseover', function (e) {
//     var title = $(this).attr('title');
//     if(title != 'Events' && title != 'Accounts Management' && title != 'Homepage' && title != 'Venue' && 
//         title != 'Trail' && title != 'System Log' && title != 'Logout' && title != 'TixTrack'){
//         $(this).css('cursor','default');
//         e.preventDefault();
//         return false;
//     }else{
//         $(this).css('cursor','pointer');
//     }
// });

