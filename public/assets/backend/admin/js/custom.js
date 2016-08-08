var slug = function(str) {
    var $slug = '';
    var trimmed = $.trim(str);
    $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
    replace(/-+/g, '-').
    replace(/^-|-$/g, '');
    return $slug.toLowerCase();
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




function loadTinyMce()
{
    tinymce.init({
        selector: "textarea.tinymce",
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });
}

function loadSwitchButton($class){
    $("."+$class).bootstrapSwitch();

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

