<!doctype html>
<html lang="en">

<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">	
	<title>แบบฟอร์มขอเปิดอีเมล์</title>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url();?>/mdbootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="<?php echo base_url();?>/mdbootstrap/css/mdb.min.css" rel="stylesheet">
	<!-- Your custom styles (optional) -->
	<link href="<?php echo base_url();?>/mdbootstrap/css/style.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	<!-- Include Bootstrap Datepicker -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
	<!-- Include Bootstrap Timepicker -->
	<link href="<?php echo base_url();?>/timepicker/mdtimepicker.css" rel="stylesheet" >

	<link href="<?php echo base_url(); ?>/mdbootstrap/css/utility.css" rel="stylesheet">

	
	<?php date_default_timezone_set("Asia/Bangkok");?>
	

</head>
<body>
		<div class="rq_email">
         	<h3 class="mrq_h">แบบฟอร์มขอเปิดอีเมล์</h3>
      	</div>
	<!---------------------------------------------------------------- FORM -------------------------------------------------------------------->
		<div class="table-responsive-md pb-4 pt-4 request_body">
			<div class="container z-depth-1 reqform">
					<div class="form-row pb-2">
						<div class="col">
							<label>ชื่อ (ภาษาอังกฤษ)</label>
							<input type="text" id="firstname" class="form-control z-depth-1" oninput="form_change_value(id)">
							<span class="error_data" id="firstname_error"></span>
						</div>
						<div class="col">
							<label>นามสกุล (ภาษาอังกฤษ)</label>
							<input type="text" id="lastname" class="form-control z-depth-1" oninput="form_change_value(id)">
							<span class="error_data" id="lastname_error"></span>
						</div>
					</div>
					<div class="form-row pb-2">
						<div class="col">
							<label>ชื่อ (ภาษาไทย)</label>
							<input type="text" id="firstnameth" class="form-control z-depth-1" oninput="form_change_value(id)">
							<span class="error_data" id="firstnameth_error"></span>
						</div>
						<div class="col">
							<label>นามสกุล (ภาษาไทย)</label>
							<input type="text" id="lastnameth" class="form-control z-depth-1" oninput="form_change_value(id)">
							<span class="error_data" id="lastnameth_error"></span>
						</div>
					</div>
					<div class="form-group">
						<label>เบอร์ติดต่อ (ส่วนตัว)</label>
						<input type="text" id="phonenum" class="form-control z-depth-1" oninput="form_change_value(id)" placeholder="ไม่จำเป็นต้องกรอก">
						<span class="error_data" id="phonenum_error"></span>
					</div>
					<div class="form-group">
						<label>เบอร์ติดต่อ (ภายใน)</label>
						<input type="text" id="phonein" class="form-control z-depth-1" oninput="form_change_value(id)" placeholder="ไม่จำเป็นต้องกรอก">
						<span class="error_data" id="phonein_error"></span>
					</div>
					<div class="form-group">
						<label>อีเมลติดต่อ</label>
						<input type="text" id="email" class="form-control z-depth-1" oninput="form_change_value(id)"> 
						<span class="error_data" id="email_error"></span>
					</div>
					<div class="form-group">
					<label>สังกัด/แผนก</label>
						<input type="text" id="section" class="form-control z-depth-1" oninput="form_change_value(id)">
						<span class="error_data" id="section_error"></span>
					</div>
					<div class="form-group">
					<label>ตำแหน่ง</label>
						<input type="text" id="rank" class="form-control z-depth-1" oninput="form_change_value(id)">
						<span class="error_data" id="rank_error"></span>
					</div>					
					<div class="text-center pb-4">
						<div class="row justify-content-center pt-2">
							<div class="col-sm-6 pb-2">
								<button id="send_data" class="btn btn-lg btn-success btn-block"
									style="font-size:20px;">ยืนยัน</button>
							</div>
							<div class="col-sm-6">
								<a href="<?php echo base_url()?>request">
									<button type="button" class="btn btn-lg btn-danger btn-block" style="font-size:20px;">ย้อนกลับ</button>
								</a>
							</div>					
						</div>
					</div>
				<!------------------------------------------------------ final modal---------------------------------------------------->
				<div class="modal fade " id="form_ready" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" 
					style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
						<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
							<div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
								<div class="modal-body text-center">
									<br/>
									<i class="fas fa-copy" style="font-size:25px;"></i><a class="font-weight-bolder" style="font-size:24px;">   ยืนยันแบบฟอร์ม</a>																
								</div>																																
									<div class="modal-body text-center">
										<div class="row justify-content-center mb-3">
											<div class="col-4">																													
												<button  id="confirm" class="btn btn-md btn-block green accent-3 text-white" style="font-size:16px;">ยืนยัน</button>																																		
											</div>
											<div class="col-4">	
												<button  onclick="dis_modal()" class="btn btn-md btn-block red accent-4 text-white" style="font-size:16px;">ยกเลิก</button>																															
											</div>	
										</div>
									</div>																											
								</div>
							</div>
						</div>				
					<!-------------------------------------------------------------------------------------------------------------------->
					<!------------------------------------------------------ waiting modal---------------------------------------------------->
					<div class="modal fade " id="wait_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"	data-backdrop="static" data-keyboard="false">
						<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
								<div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
									<div class="modal-body text-center" style="padding-bottom: 41px; font-weight: bold;">
										<br/>
										<h class="font-weight-bolder" style="font-size:24px;">กรุณารอสักครู่</h>																
									</div>																																																										
								</div>
							</div>
						</div>				
					<!-------------------------------------------------------------------------------------------------------------------->	
					<!------------------------------------------------------ Done modal---------------------------------------------------->
					<div class="modal fade " id="done_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" 
						style="font-family: 'Kanit', sans-serif;" data-backdrop="static" data-keyboard="false">
						<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
								<div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
									<div class="modal-body text-center req_done">
										<i class="fas fa-check-circle"></i><p>ทำรายการเสร็จสมบูรณ์</p>															
									</div>																																																										
								</div>
							</div>
						</div>				
					<!-------------------------------------------------------------------------------------------------------------------->
			</div>
		</div>	
	<!---------------------------------------------------------------------------------------------------------------------------------------------->
	

<!-- Datepicker -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.th.min.js"></script>
<!-- Timepicker -->
<script src="<?php echo base_url();?>/timepicker/mdtimepicker.js"></script>

<script>
	//---------- On input form value change error to null -----------
	function form_change_value(id){
		let id_error = id+'_error';
		$('#'+id_error).html('');
	}
	function onchange_value(id){
		let id_error = id+'_error';
		$('#'+id_error).html('');
	}
	//------------------------------------------------ Information Data ---------------------------------------------
	document.getElementById('send_data').onclick = function(){
		let firstname = $('#firstname').val();
		let lastname = $('#lastname').val(); 
		let firstnameth = $('#firstnameth').val(); 
		let lastnameth = $('#lastnameth').val(); 
		let phonenum = $('#phonenum').val();
		let phonein = $('#phonein').val(); 
		let email = $('#email').val();
		let section = $('#section').val();
		let rank = $('#rank').val();

		// --- NOW DATE ---
		let n_date = new Date();
		let n_now = {
			n_d: n_date.getDate(),
			n_m: () => {
				let x = n_date.getMonth() + 1
				if (x < 10) { return '0' + x } else { return x }
			},
			n_y: n_date.getFullYear(),
			t_h: n_date.getHours(),
			t_m: n_date.getMinutes(),
		}
		let n_s = n_now.n_d + '-' + n_now.n_m() + '-' + n_now.n_y
		let n_t = n_now.t_h + ':' + n_now.t_m


		$.ajax({
			url:"./request_email/error",
			method:"post",
			dataType:"json",
			data:{
				'firstname':firstname,'lastname':lastname,'firstnameth':firstnameth,'lastnameth':lastnameth,
				'phonenum':phonenum,'phonein':phonein,'email':email,'section':section,'rank':rank,
			},
			success:function(data){
				// console.log(data.firstname_error)
				$('#firstname_error').html(data.firstname_error);
				$('#lastname_error').html(data.lastname_error);
				$('#firstnameth_error').html(data.firstnameth_error);
				$('#lastnameth_error').html(data.lastnameth_error);				
				$('#phonenum_error').html(data.phonenum_error);
				$('#phonein_error').html(data.phonein_error);
				$('#email_error').html(data.email_error);
				$('#section_error').html(data.section_error);
				$('#rank_error').html(data.rank_error);
				if(data.firstname != null){
					$('#form_ready').modal('show');
					//--------------------- popup confirm modal-----------------
					let confirm = document.getElementById('confirm').onclick = async function(){
						/* ----------------- Popup Waiting Modal ------------ */
						$('#form_ready').modal('hide');
						$('#wait_modal').modal('show');
						
						/* ----------------- POST information to DB ------------ */
						await $.ajax({
							url:"./request_email/accept_data",
							method:"post",
							dataType:"json",
							data:{
								'firstname':firstname,'lastname':lastname,'firstnameth':firstnameth,'lastnameth':lastnameth,
								'phonenum':phonenum,'phonein':phonein,'email':email,'section':section,'rank':rank,
							},
						})

						/* ----------------------- LINE NOTI ----------------------- */
						let msg_line = '\nงาน : ขอเปิดอีเมล์ \n' +
                        'เวลาที่แจ้ง : ' + n_s + ' เวลา ' + n_t
						await $.ajax({
							url: "./request_email/line_noti",
							method: 'post',
							dataType: 'json',
							data: { 'msg': msg_line },
							success: () => {
								// console.log(3)
								$('#wait_modal').modal('hide')
								$('#done_modal').modal('show')
								setTimeout(function() {
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

	function dis_modal(){
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
</script>
</body>
</html>