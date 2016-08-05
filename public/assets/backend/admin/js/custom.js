var slug = function(str) {
    var $slug = '';
    var trimmed = $.trim(str);
    $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
    replace(/-+/g, '-').
    replace(/^-|-$/g, '');
    return $slug.toLowerCase();
}

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