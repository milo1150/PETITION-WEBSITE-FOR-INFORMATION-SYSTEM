//---------- On input form value change error to null -----------
function form_change_value(id) {
    let id_error = id + '_error';
    $('#' + id_error).html('');
}

function onchange_value(id) {
    let id_error = id + '_error';
    $('#' + id_error).html('');
}
//------------------------------------------------ Information Data ---------------------------------------------
document.getElementById('send_data').onclick = function () {
    let firstname = $('#firstname').val();
    let lastname = $('#lastname').val();
    let phonenum = $('#phonenum').val();
    let phonein = $('#phonein').val();
    let email = $('#email').val();
    let section = $('#section').val();
    let rank = $('#rank').val();
    let userid = $('#userid').val();

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
		hour: () => {
			const a = n_date.getHours().toString();
			if(a.length == 1){ return '0' + a }
            if(a.length == 2){ return a }
		},
		min: () => {
			const a = n_date.getMinutes().toString();
			if(a.length == 1){ return '0' + a }
            if(a.length == 2){ return a }
		},
    }
    let n_s = n_now.n_d() + '-' + n_now.n_m() + '-' + n_now.n_y
    let msg_line = '\nงาน : สแกนนิ้ว \n' +
                    'เวลาที่แจ้ง : ' + n_s + ' เวลา ' + n_now.hour() + ':' + n_now.min()
    // console.log(msg_line)

    //--------------------- Validate Data -----------------------
	$.ajax({
		url:"./request_finger/check_error",
		method:"post",
		dataType:"json",
		data:{	
                'firstname': firstname,
                'lastname': lastname,
                'phonenum': phonenum,
                'phonein': phonein,
                'email': email,
                'section': section,
                'rank': rank,
                'userid': userid
			},
		success:(data) => {
			// console.log(data)
                $('#firstname_error').html(data.firstname_error);
                $('#lastname_error').html(data.lastname_error);
                $('#phonenum_error').html(data.phonenum_error);
                $('#phonein_error').html(data.phonein_error);
                $('#email_error').html(data.email_error);
                $('#section_error').html(data.section_error);
                $('#rank_error').html(data.rank_error);
                $('#userid_error').html(data.userid_error);
				if (data.firstname != null) {
					//---------------------------------------- Send Data ------------------------------------------------
					$('#form_ready').modal('show');
					document.getElementById('confirm').addEventListener('click',() => {						
						$('#form_ready').modal('hide');
						$('#wait_modal').modal('show');						
						grecaptcha.ready(function() {
							grecaptcha.execute('6Lcxr7oZAAAAAGRAom_IazRhpHtZEEiiJjdnyPbO', {action: 'submit'}).then(async function(token) {
								await $.ajax({
									url:"./request_finger/check",
									method:"post",
									dataType:"json",
									data:{	
                                            'k':token,
                                            'firstname': firstname,
                                            'lastname': lastname,
                                            'phonenum': phonenum,
                                            'phonein': phonein,
                                            'email': email,
                                            'section': section,
                                            'rank': rank,
                                            'userid': userid,
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
    todayBtn: "linked",
    language: "th",
    todayHighlight: true,

});
// Time Picker Initialization
$('#timepicker').mdtimepicker({
    format: 'hh:mm tt'
});
