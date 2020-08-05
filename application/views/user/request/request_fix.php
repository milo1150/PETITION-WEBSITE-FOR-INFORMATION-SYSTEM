<!doctype html>
<html lang="en">

<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>แบบฟอร์มแจ้งซ่อม</title>
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

	<!-------- Sidebar CSS + Custom CSS ------------>    
    <link href="<?php echo base_url(); ?>/mdbootstrap/css/utility.css" rel="stylesheet">	
	<?php date_default_timezone_set("Asia/Bangkok");?>

	<!-------- Axios --------->
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<!-------- Capcha --------->
	<script src="https://www.google.com/recaptcha/api.js?render=6Lcxr7oZAAAAAGRAom_IazRhpHtZEEiiJjdnyPbO"></script>
	

</head>
<body>
		<div class="rq_fix">
         	<h3 class="mrq_h">แบบฟอร์มแจ้งซ่อม</h3>
		</div>	
	<!---------------------------------------------------------------- FORM -------------------------------------------------------------------->
		<div class="table-responsive-md pb-4 pt-4 request_body">
			<div class="container z-depth-1 reqform" id="req_form">
					<div class="form-row pb-2 ">
						<div class="col">
							<label>ชื่อ<a style="color:red">*</a></label>
							<input type="text" id="firstname" class="form-control z-depth-1" oninput="form_change_value(id)">
							<span class="error_data" id="firstname_error"></span>
						</div>
						<div class="col">
							<label>นามสกุล<a style="color:red">*</a></label>
							<input type="text" id="lastname" class="form-control z-depth-1" oninput="form_change_value(id)">
							<span class="error_data" id="lastname_error"></span>
						</div>
					</div>
					<div class="form-group">
						<label>เบอร์ติดต่อ<a style="color:red">*</a></label>
						<input type="text" id="phonenum" class="form-control z-depth-1" oninput="form_change_value(id)">
						<span class="error_data" id="phonenum_error"></span>
					</div>
					<div class="form-group">
						<label>อีเมลติดต่อ<a style="color:red">*</a></label>
						<input type="text" id="email" class="form-control z-depth-1" oninput="form_change_value(id)"> 
						<span class="error_data" id="email_error"></span>
					</div>
					<div class="form-group">
						<label>รายการแจ้ง<a style="color:red">*</a></label>
							<select class="form-control z-depth-1" id="fixlist" onchange="onchange_value(id)">	
							<?php
								foreach($fixlist as $row){
										echo '<option value="'.$row->fixlist.'">'.$row->fixlist.'</option>';
									}																
							?>
							</select>	
							<span class="error_data" id="fixlist_error"></span>													
					</div>
					
					<label>สถานที่<a style="color:red">*</a></label>
					<div class="form-row pb-2">
						<div class="col">
							<select class="form-control z-depth-1" id="building" onchange="onchange_value(id)">
								<?php
									foreach($building as $row){
											echo '<option value="'.$row->building.'">'.$row->building.'</option>';																			
									}							
								?>						
							</select>
							<span class="error_data" id="building_error"></span>
						</div>
						<div class="col">
						<select class="form-control z-depth-1" id="floor" onchange="onchange_value(id)">
							<?php
								foreach($floor as $row){
										echo '<option value="'.$row->floor.'">'.$row->floor.'</option>';
									}																						
							?>				
						</select>
						<span class="error_data" id="floor_error"></span>
						</div>
						<div class="col">
							<input type="text" id="room" class="form-control z-depth-1" maxlength="4" placeholder="ห้อง" oninput="form_change_value(id)">
							<span class="error_data" id="room_error"></span>
						</div>
					</div>
										
					<div class="form-group">
						<label>ลักษณะของปัญหา<a style="color:red">*</a></label>
						<textarea class="form-control z-depth-1" rows="5" cols="9" id="fixprob" oninput="form_change_value(id)"></textarea>
						<span class="error_data" id="fixprob_error"></span>
					</div>
					<label>กำหนดเวลาซ่อม<a style="color:red">*</a></label>
					<div class="form-row pb-2">
						<div class="col">
							<input type="text" class="form-control z-depth-1" id="datepicker" placeholder="วันที่" onchange="onchange_value(id)">
							<span class="error_data" id="datepicker_error"></span>
						</div>
						<div class="col">
							<input type="text" data-date-format="G:i" class="form-control z-depth-1" id="timepicker" placeholder="เวลา" style="background-color: #fff" onchange="onchange_value(id)">
							<span class="error_data" id="timepicker_error"></span>
						</div>
					</div>
				<div class="text-center pb-4">
					<div class="row justify-content-center pt-2">
						<div class="col-sm-6 pb-2">
							<button id="send_data" class="btn btn-lg btn-success btn-block "
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
									<i class="fas fa-copy" style="font-size:25px;"></i><h class="font-weight-bolder" style="font-size:24px;">   ยืนยันแบบฟอร์ม</h>																
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
					<!------------------------------------------------------ waiting modal---------------------------------------------------->
					<div class="modal fade " id="wait_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" 
						style="font-family: 'Kanit', sans-serif;" data-backdrop="static" data-keyboard="false">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.15.0/js/mdb.min.js"></script>

<script src="<?php echo base_url().'miscit-js/req_fix.js';?>"></script>
<script>
	































// Data Picker Initialization
$("#datepicker").datepicker({
	format: 'dd/mm/yyyy',
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