/*--------------------------- Modal Pop & Off ---------------------------- */
document.getElementById('newGrp').onclick = function() {
    $('#addGroup_modal').modal('show')
}
document.getElementById('dis_btn').onclick = function() {
    $('#addGroup_modal').modal('hide');
    document.getElementById('grp_name_val').value = ""
    document.getElementById('span_error_grp').innerHTML = ""
}

function dis_modal() {
    $('#rename_modal').modal('hide')
    document.getElementById('span_error_rename').innerHTML = ""
    $('#remove_modal').modal('hide')
}



/* ---------------------------------------------- Add New Category Modal --------------------------------------------- */
// const base_url = window.location.origin + '/codeig'
const base_url = window.location.href.replace('/category','')
const conf_btn = document.getElementById('confirm_btn')
const grp_val = document.getElementById('grp_name_val')

/* ----------------------------- Check Category ------------------------------ */
const check_grp = () => {
    const url = base_url + '/val_grp_name'
    $.ajax({
        url: url,
        dataType: 'json',
        method: 'post',
        data: { 'grp_name': grp_val.value },
        success: (data) => {
            var error_grp = document.getElementById('span_error_grp')
                // if no error
            if (data == 0) {
                $(location).attr('href', base_url + '/category')
                error_grp.innerHTML = ""
                return
            }
            // if error										
            error_grp.innerHTML = data.error_name


        }
    })
}
conf_btn.addEventListener('click', check_grp)

/* ----------------------------- Rename Category ------------------------------ */
function edit_name(id, grp_name) {
    $('#rename_modal').modal('show')
    document.getElementById('grp_rename_val').value = grp_name
    document.getElementById('rename_conf_btn').onclick = () => {
        let t_url = base_url + '/rename_grp'
        let d_url = base_url + '/category'
        let old_grp_name = grp_name
        let new_grp_name = document.getElementById('grp_rename_val').value
        $.ajax({
            url: t_url,
            method: 'post',
            dataType: 'json',
            data: { 'id': id, 'n_grp_name': new_grp_name, 'o_grp_name': old_grp_name },
            success: (data) => {
                var error_grp = document.getElementById('span_error_rename')

                // if no error
                if (data == 0) {
                    $(location).attr('href', d_url)
                    error_grp.innerHTML = ""
                    return
                }
                // if error										
                error_grp.innerHTML = data.error_name
            }
        })
    }
}

/* ----------------------------- Delete Category ------------------------------ */
function del(id, grp_name) {
    $('#remove_modal').modal('show')
    document.getElementById('remove_conf_btn').onclick = function() {
        let url = base_url + '/del_grp'
        let g_name = grp_name
        $.ajax({
            url: url,
            method: 'post',
            dataType: 'json',
            data: { 'id': id, 'grp_name': g_name },
            success: setTimeout(function() {
                location.reload()
            }, 200)
        })
    }
}



$('.mytable').dataTable({
    order: [
        [0, 'asc']
    ],
    "columnDefs": [
        { "width": "5%", "targets": 0 },
        { "width": "80%", "targets": 1 },
        // { "width": "5%", "targets": 2 },
    ],
    responsive: true,
    responsive: {
        details: false
    }
});