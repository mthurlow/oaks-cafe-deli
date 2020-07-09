$(document).ready(function(){
    // Activate tooltip
    $("[data-toggle='tooltip']").tooltip();
    
    // Select/Deselect checkboxes
    var checkbox = $("table tbody input[type='checkbox']");
    $("#selectAll").click(function(){
        if(this.checked){
            checkbox.each(function(){
                this.checked = true;                        
            });
        } else{
            checkbox.each(function(){
                this.checked = false;                        
            });
        } 
    });
    checkbox.click(function(){
        if(!this.checked){
            $("#selectAll").prop("checked", false);
        }
    });

    // Filtering
    $('.btn.btn-info').click(function(){
        $('.filterableHeading').each(function(){
            if($(this).prop('disabled')){
                $(this).prop('disabled', false);
            }
        });
        $('.filterableHeading').first().focus();
        $(this).hide();
    });

    $('.filterableHeading').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        console.log($rows);
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });

    // Populate edit modal with data
    var edits = $(".edit");
    for (let index = 0; index < edits.length; index++){
        const edit = edits[index];
        edit.addEventListener("click", function(){
            var menuItem = edit.parentNode.parentNode
            var menuItemId = menuItem.getAttribute("ID").substr("menuItem".length);
            var menuItemName = menuItem.children[1].innerText;
            var menuItemType = menuItem.children[2].innerText;
            var menuItemSubType = menuItem.children[3].innerText;
            var menuItemDescription = menuItem.children[4].innerText;
            var menuItemPrice = menuItem.children[5].innerText;
            var menuItemOrder = menuItem.children[6].innerText;
            FillEditMenuItemModal(menuItemId, menuItemName, menuItemType, menuItemSubType, menuItemDescription, menuItemPrice, menuItemOrder);
        });
    };

    // Populate delete modal with data
    var deletes = $(".delete");
    for (let index = 0; index < deletes.length; index++){
        const edit = deletes[index];
        edit.addEventListener("click", function(){
            var menuItem = edit.parentNode.parentNode
            var menuItemId = menuItem.getAttribute("ID").substr("menuItem".length);
            var menuItemName = menuItem.children[1].innerText;
            FillDeleteMenuItemModal(menuItemId, menuItemName);
        });
    };

});

function FillEditMenuItemModal(id, name, type, subtype, description, price, order){
    document.getElementById("editMenuItemModalItemId").value = id;
    document.getElementById("editMenuItemModalItemName").value = name;
    document.getElementById("editMenuItemModalItemType").value = type;
    document.getElementById("editMenuItemModalItemSubType").value = subtype;
    document.getElementById("editMenuItemModalItemDescription").value = description;
    document.getElementById("editMenuItemModalItemPrice").value = price;
    document.getElementById("editMenuItemModalItemOrder").value = order;
}

function FillDeleteMenuItemModal(id, name){
    document.getElementById("deleteMenuItemModalItemId").value = id;
    document.getElementById("deleteMenuItemModalItemName").value = name;
}