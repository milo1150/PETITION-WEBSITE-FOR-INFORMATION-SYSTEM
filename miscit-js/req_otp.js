//---------- On input form value change error to null -----------
function form_change_value(id) {
    let id_error = id + '_error';
    $('#' + id_error).html('');
    // console.log(id_error)
}

function datetime_onchange_value(id) {
    let id_error = id + '_error';
    $('#' + id_error).html('');
}

//-----------------------------------------------------APPEND ROW------------------------------------------------------
document.getElementById('req_btn').onclick = function() { req_row() }

function req_row() {
    // butoon value was -1 becuz we want to set array posiotion @zero
    x = $('#req_btn').val();
    x++;
    $('#req_btn').val(x);
    //console.log(x);
    $('#item_req').append('<div class="row item_row" id="req_row' + x + '" >' +
        //item_type
        '<div class="col_type_otp"><select class="form form-control z-depth-1 item_type er_span" onchange="show_info_0(id)" id="item_type' + x + '">' +
        '<option value="0"></option>' +
        '<option value="product">วัสดุ</option>' +
        '</select>' +
        '<span class="error_data" id="error_type' + x + '"></span></div>' +
        //item_name
        '<div class="row col_name_otp"><select class="form-control z-depth-1 item_name" onchange="show_info_1(id)" id="item_name' + x + '" disabled>' +
        '<option value="0"></option>' +
        '</select>' +
        '<span class="error_data" id="error_name' + x + '"></span></div>' +
        //item_unit
        '<div class="col_unit_otp"><input class="form-control z-depth-1 item_unit col_unit_otp" type="" id="item_unit' + x + '" oninput="check_val(id)" style="z-index: -1;" disabled></input>' +
        '<span class="error_data" id="error_unit' + x + '"></span></div>' +
        //del
        '<i class="fas fa-minus-circle item_del" type="submit" id="item_del' + x + '" onclick="del_req(id)"></i>' +
        '</div><span class="error_row" id="error_row' + x + '"></span>');

}

//------------------------------------------------------DELETE ROW------------------------------------------------------
function del_req(id) {
    // Delete row and -1 button value and return new value to req_btn
    let req_row = document.getElementById(id).parentElement.id
    let error_row = document.getElementById(id).parentElement.nextElementSibling.id
    $('#' + error_row).remove()
    $('#' + req_row).remove()
}
//---------------------------------------------------------SHOW INFORMATION-------------------------------------------------------
function show_info_0(id) {
    var x = document.getElementById(id).value //item_type value
    var y = document.getElementById(id).parentElement.parentElement.childNodes[1].childNodes[0].id //item_name id
    var z = document.getElementById(id).parentElement.parentElement.childNodes[2].childNodes[0].id //item_unit id

    //------------------------ when item_type change value --------------------------
    if (x == "0") {
        $('#' + y).html('<option value="0"></option>')
        $('#' + z).val('')
        document.getElementById(y).disabled = true
        document.getElementById(z).disabled = true
    }

    if (x == 'product') {
        $.ajax({
            url: "./request_itemotp/product_item",
            method: "POST",
            dataType: "JSON",
            data: { 'type': x, 'name': null },
            success: function(data) {
                var product_list = Array();
                product_list[0] = '<option value="0"></option>';
                for (i = 0; i < data.length; i++) {
                    product_list[i + 1] = '<option>' + data[i].item_name + '</option>'
                }
                $('#' + y).html(product_list);
                $('#' + z).val('')
                document.getElementById(y).disabled = false
            }
        })
    };
}
//------------------------------ when item_name value change -------------------------------
function show_info_1(id) {
    var x = document.getElementById(id).parentElement.parentElement.childNodes[0].childNodes[0].value // get value of item_type
    var y = document.getElementById(id).parentElement.parentElement.childNodes[1].childNodes[0].value // get value of item_name
    var z = document.getElementById(id).parentElement.parentElement.childNodes[2].childNodes[0].id // get id of item_unit for success

    /*------------------------------------- check ว่าเลือกรายการซ้ำ ---------------------------------*/
    const h1 = (document.getElementById('item_req').childElementCount) - 2; // จำของแถวที่มีทั้งหมด 
    const this_value = document.getElementById(id).value; // item_name value ของแถวที่เลือก
    var dup_itempd_name = 0;
    for (let k = 0; k <= h1; k = k + 2) { //loop for check every row
        let c_k_type = document.getElementById('item_req').childNodes[k].childNodes[0].childNodes[0].value;
        let c_k_name = document.getElementById('item_req').childNodes[k].childNodes[1].childNodes[0].value;
        let err_row = document.getElementById(id).parentElement.parentElement.nextElementSibling.id; // get id of error_row
        if (c_k_type == 'product') {
            if (c_k_name == this_value) {
                dup_itempd_name++;
            }
        }
        //-------------- Duplicate ---------------
        if (dup_itempd_name == 2) {
            $('#' + id).val('')
            document.getElementById(z).value = "";
            document.getElementById(z).style.zIndex = "-1";
            $('#' + err_row).html('คุณเลือกรายการนี้ไปแล้ว')

            //---------------- remove โปรดระบุ -----------------
            let err_name_id = document.getElementById(id).nextElementSibling.id;
            let err_unit_id = document.getElementById(id).parentElement.nextElementSibling.childNodes[1].id
            $('#' + err_name_id).html('');
            $('#' + err_unit_id).html('');
            return;
        }
        if (dup_itempd_name == 1) {
            $('#' + err_row).html('')
        }
    }

    if (x == "0") {
        document.getElementById(z).value = "";
        document.getElementById(z).style.zIndex = "-1";
    }
    if (y == "0") {
        document.getElementById(z).value = "";
        document.getElementById(z).style.zIndex = "-1";
    }
    if (x == 'product') {
        $.ajax({
            url: "./request_itemotp/product_item",
            method: "POST",
            dataType: "JSON",
            data: { 'type': x, 'name': y },
            success: function(data) {
                $('#' + z).val(data[0].item_unit_remain);
                document.getElementById(z).max = data[0].item_unit_remain;
                document.getElementById(z).disabled = false
            }
        })
    }
}
//------------------------------ Unit Check -------------------------------
function check_val(id) {
    let max = document.getElementById(id).max;
    let val = document.getElementById(id).value;
    let sum = max - val;

    // ----------- Check item_unit input ------------
    const c = val.toString()
    const boo = /^\d+$/.test(c)
        // console.log(c)
        // console.log(boo)
    if (c == '' && boo == false) { // if input == null or nothing
        return
    }
    if (c.includes('.') && boo == false) { // if input has only dot
        $('#' + id).val(max)
        return
    }
    if (boo == false) { // if input not match regex
        $('#' + id).val(max)
        return
    }
    if (sum < 0 || sum > max) { // if input number more than max and less than 0	
        $('#' + id).val(max)
        return
    }
    if (sum == max) { // if max != 0 but user input 0 > set to max 
        $('#' + id).val(max)
        return
    }
}

//-------------------------------------------------------SEND DATA--------------------------------------------------------
document.getElementById('send_data').onclick = function() { send_data() }
async function send_data() {
    //-----------------count req_row---------------------
    var row_count = document.getElementById('item_req').childElementCount

    //-------------get data in to Array------------------
    var req_data = Array();
    var check_data = Array();
    for (let i = 0, j = 0; i < row_count; i = i + 2, j++) { // j = new concept coding
        let x = document.getElementById('item_req').childNodes[i].childNodes[0].childNodes[0].value // item_type value
        let y = document.getElementById('item_req').childNodes[i].childNodes[1].childNodes[0].value // item_name value
        let z = document.getElementById('item_req').childNodes[i].childNodes[2].childNodes[0].value // item_unit value
        req_data[i] = [x, y, z]
        check_data[j] = [x, y, z]
    }
    // console.log(check_data)

    //----------------------Check null value-------------------------
    var sum = 0;
    // i = req_row that get data , j = error_row for item that 0 remaining
    for (let i = 0, j = 1; i < row_count; i = i + 2, j = j + 2) {
        let x = document.getElementById('item_req').childNodes[i].childNodes[0].childNodes[0].value // item_type value
        let y = document.getElementById('item_req').childNodes[i].childNodes[1].childNodes[0].value // item_name value
        let z = document.getElementById('item_req').childNodes[i].childNodes[2].childNodes[0].value // item_unit value
        let error_type = document.getElementById('item_req').childNodes[i].childNodes[0].childNodes[1].id //error_type id
        let error_name = document.getElementById('item_req').childNodes[i].childNodes[1].childNodes[1].id //error_name id
        let error_unit = document.getElementById('item_req').childNodes[i].childNodes[2].childNodes[1].id //error_unit id
        let error_row = document.getElementById('item_req').childNodes[j].id //error_row id
        if (x == "0") {
            $('#' + error_type).html('โปรดระบุ');
            sum++;
        } else {
            $('#' + error_type).html('')
        }
        if (y == "0") {
            $('#' + error_name).html('โปรดระบุ');
            sum++;
        } else {
            $('#' + error_name).html('')
        }
        if (z == "") {
            $('#' + error_unit).html('โปรดระบุ');
            sum++;
        } else {
            $('#' + error_unit).html('')
        }
        if (z == "0") {
            $('#' + error_row).html('ของหมด');
            sum++;
        } else {
            $('#' + error_row).html('');
        }
    }
    //---------------------------------- Edit Html.exe --------------------------------
    // console.log(check_data)
    await axios.post('./request_itemotp/item_v', check_data)
        .then((data) => {
            // console.log(data.data)
            if (data.data != 0) {
                window.location.reload()
                return
            }
        })

    //-------------------------------------------------------FORM DATA--------------------------------------------------------
    let firstname = $('#firstname').val();
    let lastname = $('#lastname').val();
    let phonenum = $('#phonenum').val();
    let email = $('#email').val();
    let section = $('#section').val();

    // --- NOW DATE ---
    let n_date = new Date();
    let n_now = {
        n_d: () => {
            const a = n_date.getDate().toString();
            if(a.length == 1){ return '0' + a }
            if(a.length == 2){ return a }
        },
        n_m: () => {
            let x = n_date.getMonth() + 1
            if (x < 10) { return '0' + x } else { return x }
        },
        n_y: n_date.getFullYear(),
        n_t: n_date.getHours() + ':' + n_date.getMinutes()
    }
    let n_s = n_now.n_d() + '-' + n_now.n_m() + '-' + n_now.n_y
    let msg_line = '\nงาน : เบิกของ \n' +
                    'เวลาที่แจ้ง : ' + n_s + ' เวลา ' + n_now.n_t
    // console.log(msg_line)
    
    //--------------------- Validate Data -----------------------
	$.ajax({
		url:"./request_itemotp/check_error",
		method:"post",
		dataType:"json",
		data:{	
                'firstname': firstname, 
                'lastname': lastname, 
                'phonenum': phonenum, 
                'email': email, 
                'section': section
			},
		success:(data) => {
			// console.log(data)
                $('#firstname_error').html(data.firstname_error);
                $('#lastname_error').html(data.lastname_error);
                $('#phonenum_error').html(data.phonenum_error);
                $('#email_error').html(data.email_error);
                $('#section_error').html(data.section_error);
				if (data.firstname != null && sum == 0 && req_data != 0) {
					//---------------------------------------- Send Data ------------------------------------------------
					$('#form_ready').modal('show');
					document.getElementById('confirm').addEventListener('click',() => {						
						$('#form_ready').modal('hide');
						$('#wait_modal').modal('show');						
						grecaptcha.ready(function() {
							grecaptcha.execute('6Lcxr7oZAAAAAGRAom_IazRhpHtZEEiiJjdnyPbO', {action: 'submit'}).then(async function(token) {
								await $.ajax({
									url:"./request_itemotp/check",
									method:"post",
									dataType:"json",
									data:{	
                                            'k':token,
                                            'firstname': firstname, 
                                            'lastname': lastname, 
                                            'phonenum': phonenum, 
                                            'email': email, 
                                            'section': section,
                                            'req_data': req_data,
											'msg':msg_line
										},
									success:() => {
										window.location = './request'
									}
								})
							});
						})
					})		
				}
		}
	});
}

function dis_modal() {
    $('#form_ready').modal('hide');
}

// Data Picker Initialization
$("#datepicker").datepicker({
    format: 'dd-mm-yyyy',
    startDate: "-Infinity",
    daysOfWeekHighlighted: "0,6",
    todayBtn: "linked",
    language: "th",
    todayHighlight: true
});
// Time Picker Initialization
$('#timepicker').mdtimepicker({
    format: 'hh:mm tt'
});