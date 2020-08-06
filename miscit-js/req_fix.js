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
// ---- Max length Floor (Crack html)---- 
const r_n = document.getElementById('room')
r_n.addEventListener('keyup', () => {
	let x = r_n.value
	if (x.length > 4) {
		document.querySelector('#room').value = ''
	}
})

document.getElementById('send_data').onclick = async function () {
	let firstname = $('#firstname').val();
	let lastname = $('#lastname').val();
	let phonenum = $('#phonenum').val();
	let email = $('#email').val();
	let fixlist = $('#fixlist').val();
	let building = $('#building').val();
	let floor = $('#floor').val();
	let room = $('#room').val();
	let fixprob = $('#fixprob').val();
	let date = $('#datepicker').val();
	let time = $('#timepicker').val();

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
	let msg_line = '\nงาน : แจ้งซ่อม \n' +
					'รายการแจ้ง : ' + fixlist + '\n' +
					'เวลาที่แจ้ง : ' + n_s + ' เวลา ' + n_now.n_t
	// console.log(msg_line)
	
	//--------------------- Validate Data -----------------------
	$.ajax({
		url:"./request_fix/check_error",
		method:"post",
		dataType:"json",
		data:{	
				'firstname': firstname,
				'lastname': lastname,
				'phonenum': phonenum,
				'email': email,
				'fixlist': fixlist,
				'building': building,
				'floor': floor,
				'room': room,
				'fixprob': fixprob,
				'date': date,
				'time': time
			},
		success:(data) => {
			// console.log(data)
				$('#firstname_error').html(data.firstname_error);
				$('#lastname_error').html(data.lastname_error);
				$('#phonenum_error').html(data.phonenum_error);
				$('#email_error').html(data.email_error);
				if(data.fixlist_error != ""){$('#fixlist_error').html('โปรดระบุ');} else {$('#fixlist_error').html('');}
				if(data.building_error != ""){$('#building_error').html('โปรดระบุ');} else {$('#building_error').html('');}
				if(data.floor_error != ""){$('#floor_error').html('โปรดระบุ');} else {$('#floor_error').html('');}						
				$('#room_error').html(data.room_error);
				$('#fixprob_error').html(data.fixprob_error);
				$('#datepicker_error').html(data.date_error);
				$('#timepicker_error').html(data.time_error);
				if (data.firstname != null) {
					//---------------------------------------- Send Data ------------------------------------------------
					$('#form_ready').modal('show');
					$('#fixlist_error').html('');
					$('#building_error').html('');
					$('#floor_error').html('');
					document.getElementById('confirm').addEventListener('click',() => {						
						$('#form_ready').modal('hide');
						$('#wait_modal').modal('show');						
						grecaptcha.ready(function() {
							grecaptcha.execute('6Lcxr7oZAAAAAGRAom_IazRhpHtZEEiiJjdnyPbO', {action: 'submit'}).then(async function(token) {
								await $.ajax({
									url:"./request_fix/check",
									method:"post",
									dataType:"json",
									data:{	
											'k':token,
											'firstname': firstname,
											'lastname': lastname,
											'phonenum': phonenum,
											'email': email,
											'fixlist': fixlist,
											'building': building,
											'floor': floor,
											'room': room,
											'fixprob': fixprob,
											'date': date,
											'time': time,
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
