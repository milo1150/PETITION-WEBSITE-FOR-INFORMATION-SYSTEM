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
		n_d: n_date.getDate(),
		n_m: () => {
			let x = n_date.getMonth() + 1
			if (x < 10) {
				return '0' + x
			} else {
				return x
			}
		},
		n_y: n_date.getFullYear(),
	}
	let n_s = n_now.n_d + '-' + n_now.n_m() + '-' + n_now.n_y


	/* --- if someone crack value --- */
	const cat_val = {
		"fixlist": fixlist,
		"building": building,
		"floor": floor
	}
	if (cat_val.fixlist == 'เลือกรายการแจ้ง') {
		$('#fixlist_error').html('โปรดเลือกรายการ')
	}
	if (cat_val.building == 'อาคาร') {
		$('#building_error').html('โปรดระบุ')
	}
	if (cat_val.floor == 'ชั้น') {
		$('#floor_error').html('โปรดระบุ')
	}

	await $.ajax({
		url: "./request_fix/error",
		method: "post",
		dataType: "json",
		data: {
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
		success: function (data) {
			$('#firstname_error').html(data.firstname_error);
			$('#lastname_error').html(data.lastname_error);
			$('#phonenum_error').html(data.phonenum_error);
			$('#email_error').html(data.email_error);
			// $('#fixlist_error').html(data.fixlist_error);
			// $('#building_error').html(data.building_error);
			// $('#floor_error').html(data.floor_error);
			$('#room_error').html(data.room_error);
			$('#fixprob_error').html(data.fixprob_error);
			$('#datepicker_error').html(data.date_error);
			$('#timepicker_error').html(data.time_error);
			if (data.firstname != null) {
				//------------------- Clear โปรดระบุ ---------------------
				$('#firstname_error').html('');
				$('#lastname_error').html('');
				$('#phonenum_error').html('');
				$('#email_error').html('');
				$('#fixlist_error').html('');
				$('#building_error').html('');
				$('#floor_error').html('');
				$('#room_error').html('');
				$('#fixprob_error').html('');
				$('#datepicker_error').html('');
				$('#timepicker_error').html('');
				$('#form_ready').modal('show');
				// console.log(data)

				//--------------------- popup confirm modal-----------------
				let confirm = document.getElementById('confirm').onclick = async function () {
					/* ----------------- Popup Waiting Modal ------------ */
					$('#form_ready').modal('hide');
					$('#wait_modal').modal('show');

					/* ----------------- POST information to DB ------------ */
					let date_r = date.split('-')
					let new_date_format = date_r[2] + '-' + date_r[1] + '-' + date_r[0]
					await $.ajax({
						url: "./request_fix/accept_data",
						method: "post",
						dataType: "json",
						data: {
							'firstname': firstname,
							'lastname': lastname,
							'phonenum': phonenum,
							'email': email,
							'fixlist': fixlist,
							'building': building,
							'floor': floor,
							'room': room,
							'fixprob': fixprob,
							'date': new_date_format,
							'time': time
						},
						success: console.log(data)
					})

					/* --------------------------- Send Email ---------------------------- */
					let msg = 'ข้อมูลยืนยันแบบฟอร์มแจ้งซ่อมที่คุณ' + firstname + ' ได้แจ้งไว้ ณ วันที่ ' + n_s + ' เวลา ' + time + '<br>' +
						'ชื่อ-นามสกุล : ' + firstname + ' ' + lastname + '<br>' +
						'เบอร์ติดต่อ : ' + phonenum + '<br>' +
						'อีเมลติดต่อ : ' + email + '<br>' +
						'รายการแจ้ง : ' + fixlist + '<br>' +
						'สถานที่ : อาคาร ' + building + ' ชั้น ' + floor + ' ห้อง ' + room + '<br>' +
						'ลักษณะของปัญหา : ' + fixprob + '<br>' +
						'กำหนดเวลาซ่อม : วันที่ ' + date + ' เวลา ' + time + '<br>';
					await $.ajax({
						url: "./request_fix/send_email_data",
						method: "POST",
						dataType: 'json',
						data: {
							'msg': msg,
							'email': email
						},
						// success: console.log(2)
					})

					/* ----------------------- LINE NOTI ----------------------- */
					let msg_line = '\nงาน : แจ้งซ่อม \n' +
						'รายการแจ้ง : ' + fixlist + '\n' +
						'เวลาที่แจ้ง : ' + n_s + ' เวลา ' + time
					await $.ajax({
						url: "./request_fix/line_noti",
						method: 'post',
						dataType: 'json',
						data: {
							'msg': msg_line
						},
						success: () => {
							// console.log(3)
							$('#wait_modal').modal('hide')
							$('#done_modal').modal('show')
							setTimeout(function () {
								window.location = './request'
							}, 2000)
						}
					})
				}
				confirm;
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
