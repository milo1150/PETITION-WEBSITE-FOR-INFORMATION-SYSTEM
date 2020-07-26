/*--------------------------- Modal Pop & Off ---------------------------- */

/* -------- Upload File Modal ------- */
document.getElementById('newFile').onclick = function() {
    $('#add_pdf_modal').modal('show')
}
document.getElementById('dis_btn').onclick = function() {
    $('#add_pdf_modal').modal('hide')

    /* Reset Base Input except category */
    document.getElementById('file_input').value = ""
    document.getElementById('f_null').innerHTML = ""
    let x = document.querySelector('.grp_selector')
    $('.add_grp').html(x)
}

/* -------- Edit File (Cancle Button) ------- */
document.getElementById('dis_md_ed').onclick = function() {
    $('#edit_modal').modal('hide')
    $('.select1').html('')
    $('#n_err').html('')
}


/* -------- Delete File (Cancle Button) ------- */
document.getElementById('dis_md_rm').onclick = function() {
    $('#remove_modal').modal('hide')
}


/* ---------------------------------------------------------- (Upload PDF) Onclick Confirm Button -------------------------------------------------- */
const conf_btn = document.getElementById('confirm_btn')
// const base_url = window.location.origin + '/codeig'
const base_url = window.location.href
const send_pdf = () => {
    const form_body = document.getElementById('form_file')
    const form_input = document.getElementById('file_input')

    /* ------------------------------- Check Input ------------------------------ */
    const input_f = form_input.files.length
    let span = document.getElementById('f_null')
    if (input_f == 0) {
        span.innerHTML = "โปรดเลือกไฟล์"
        return
    } else {
        span.innerHTML = ""
    }

    /* -------------------------- Check Duplicate File Name ------------------------- */

    /* ------ Function Get multi filename in INPUT ** Names Array in file select input ------ */
    const getFileName = () => {
        const files_n_count = form_input.files.length
        var files_n_data = Array()
        for (let i = 0; i < files_n_count; i++) {
            files_n_data.push(file_input.files[i].name)
        }
        return files_n_data
    }

    // ---- Send Data ---- // First Time Callback
    let a_name_check = getFileName();

    check_pdf_name(pdf_name_err)

    function check_pdf_name(callback) {
        $.ajax({
            url: base_url + '/check_pdf',
            method: 'post',
            dataType: 'json',
            data: { 'pdf_name': a_name_check },
            success: (data) => {
                let dup_name = 0
                let y = Array() // for span innerHTML
                for (let i = 0; i < data.length; i++) {
                    if (data[i][0] == 1) {
                        let t = data[i][1] + '<br>มีในระบบแล้ว<br>'
                        y[i] = t
                        dup_name++
                    }
                }
                if (dup_name != 0) {
                    $('#f_null').html(y)
                }
                callback(dup_name)
            }
        })
    }

    async function pdf_name_err(dup_name) {
        // dup_name == 0 mean there is no file target in target folder that mean these files can be upload 
        if (dup_name == 0) {
            /* ------------------------------- Send PDF File ------------------------------ */
            const formData = new FormData()
            const hmny_file = form_input.files.length // check how many files
            for (let i = 0; i < hmny_file; i++) {
                formData.append('pdf' + i, file_input.files[i])
            }
            await $.ajax({
                    url: base_url + '/pdf',
                    dataType: 'json',
                    method: 'post',
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: formData,                   
                })
                // console.log(form_input.files.length)

            /* ------------------------------ Count Child (category row) and Get Value  ------------------------------ */

            // Loop get all row Category value
            const child_count = document.querySelector('.add_grp').childElementCount
            var cate_data = Array()
            for (let i = 0; i < child_count; i++) {
                const parent = document.querySelector('.add_grp').children[i].children[0].value
                cate_data.push(parent)
            }

            /* ----- Send Category & Filesname ----- */
            var files_name_db = getFileName()
            await $.ajax({
                url: base_url + '/file_name_cate',
                method: 'post',
                dataType: 'json',
                data: { 'cate_data': cate_data, 'files_n_data': files_name_db },
                success: function() {
                    window.location.reload()
                }

            })
        } else {
            // console.log(dup_name)
        }
    }

}
conf_btn.addEventListener('click', send_pdf)

/* ------------------------------------- Add more Category (iPlus) ----------------------------------- */
const i_plus = document.querySelector('.iPlus0')
const moreSelector = () => {

    // step 1 span copy selector
    const parent = document.querySelector('.add_grp')
    const new_child = parent.children[0].outerHTML
    $('.add_grp').append(new_child)

    // step 2 hide iPlus then show iMinus
    document.querySelector('.add_grp').lastChild.children[1].style.display = "none"
    document.querySelector('.add_grp').lastChild.children[2].style.display = "inline-block"
}
i_plus.addEventListener('click', moreSelector)

/* ---------------- (Upload New Pdf File) category row remove ------------- */
function rmv() {
    const p = event.path[2].remove()
        // console.log(p)
}

/* -------------------------------------------------------- Edit Function ---------------------------------------------------------- */

/* ------------------- Edit File ----------------------- */
function edit(id, f_name, cate) {
    $('#edit_modal').modal('show')

    // setup Data in input
    document.getElementById('edit_name').value = f_name

    // get Cate from DB and append row
    let url = base_url + '/get_grp'
    axios(url)
        .then(data => {
            const d = data.data

            // loop cate from DB to string
            const a = Array()
            for (let i of d) {
                a.push('<option>' + i.category + '</option>')
            }

            // append Select row with category array
            let cate_count = cate.split(',').length // count category from input
                // console.log(cate)
            for (let i = 0; i < cate_count; i++) {
                $('.select1').append('<div class="grp_selector"><select class="form-control" id="edit_grp">' + a.join('') + '</select></div>') // a.join mean -> get array a to string and join element with string type
            }

            // set default value in each select row
            const c = document.querySelector('.select1')
            for (let i = 0; i < c.children.length; i++) { // loop howmany row in .select1
                let s = c.children[i].children[0]
                    // console.log(s)
                for (let j = 0; j < s.children.length; j++) { // loop option in each row
                    if (s.children[j].value == cate.split(',')[i]) { // set element that have same value to selected *cate.split is key of this loop
                        s.children[j].selected = 'true'
                            // console.log(s.children[j])
                    }
                }
            }
            const s_row = document.querySelector('.select1') // ------ Pass new html element for this state to other func -----
            x1(s_row)
        });

    // --------------------- Onclick Confirm Button -------------------------
    function x1(s_row) {
        const row = s_row
        for (let i = 0; i < row.children.length; i++) {
            if (i == 0) {
                let x = row.children[i]
                $(x).append('<div><i class="fas fa-plus-circle iPlus"></i></div>')
            } else {
                let y = row.children[i]
                $(y).append('<div><i class="fas fa-minus-circle iMinus" onclick="d9()"></i></div>')

            }
            // console.log(i)
        }
        //------------ Add Category Row ------------
        $('.iPlus').on('click', function() {
            let parent = event.path[3]
            let row_ele = event.path[2]
            let inner_text = '<div class="grp_selector">' + row_ele.children[0].outerHTML + '<div class="iMinus0"><i class="fas fa-minus-circle" onclick="d9()"></i></div></div>'
            $(parent).append(inner_text)
        })
    }




    // --------------------- Onclick Confirm Button -------------------------
    document.getElementById('ed_conf_btn').onclick = () => {
        let url = base_url + '/u_file_info'
        let n = document.querySelector('#edit_name').value
        let r = document.querySelector('.select1')
        let cate_v = Array()
        for (let i = 0; i < r.children.length; i++) {
            cate_v.push(r.children[i].children[0].value)
                // console.log(r.children[i].value)
        }
        // console.log(id) 
        // console.log(r.children.length)
        // console.log(cate_v)
        // console.log(url)

        // check file name Correct or not (include .pdf at the end of file)
        if (n.substr(n.length - 4) == '.pdf') {
            $.ajax({
                url: url,
                method: 'post',
                dataType: 'json',
                data: { 'id': id, 'f_name': n, 'cate_v': cate_v },
                success: () => {
                    $('#n_err').html('')
                    setInterval(function() {
                        window.location.reload()
                    }, 100)

                }
            })
        } else {
            $('#n_err').html('ไฟล์จำเป็นต้องลงท้ายด้วย .pdf')
            return
        }


    }
}

//---------------- Remove Category Row (While in Edit Statement) -----------
function d9() {
    event.path[2].remove()
}

/* ------------------- Remove File ----------------------- */
function del(id, f_name) {
    $('#remove_modal').modal('show')
    document.getElementById('remove_conf_btn').onclick = () => {
        $.ajax({
            url: base_url + '/del_file',
            method: 'post',
            dataType: 'json',
            data: { 'id': id, 'f_name': f_name },
            success: setInterval(function() {
                window.location.reload()
            }, 100)


        })
    }
}

/* ----------------------------------- Filter Category -------------------------------- */
const fv = document.querySelector('#filter_cate')
fv.onchange = () => {
    let v = fv.value
    $(location).attr('href', base_url + '/fil_grp?grp=' + v)
        // console.log(v)
}

// --------------------------------- GET value ------------------------------
// ---- set Filter selected ----
window.onload = () => {
    let x = window.location.search
    let getUrl = new URLSearchParams(x) // Web APIs
    if (getUrl.has('grp') == false) { // if url has GET value
        return
    } else {
        let getVal = getUrl.get('grp')
        let e = document.querySelector('#filter_cate')
        for (let i of e.children) {
            if (i.value == getVal) {
                i.selected = 'true'
            }
        }
    }
}




$('.mytable').dataTable({
    order: [
        [0, 'desc']
    ],
    "columnDefs": [
        { "width": "5%", "targets": 0 },
        { "width": "40%", "targets": 1 },
        { "width": "60%", "targets": 2 },
        { "width": "5%", "targets": 3 }
    ],
    responsive: true,
    responsive: {
        details: false
    }
});