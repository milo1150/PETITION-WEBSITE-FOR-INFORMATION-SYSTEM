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
							<label>ชื่อ</label>
							<input type="text" id="firstname" class="form-control z-depth-1" oninput="form_change_value(id)">
							<span class="error_data" id="firstname_error"></span>
						</div>
						<div class="col">
							<label>นามสกุล</label>
							<input type="text" id="lastname" class="form-control z-depth-1" oninput="form_change_value(id)">
							<span class="error_data" id="lastname_error"></span>
						</div>
					</div>
					<div class="form-group">
						<label>เบอร์ติดต่อ</label>
						<input type="text" id="phonenum" class="form-control z-depth-1" oninput="form_change_value(id)">
						<span class="error_data" id="phonenum_error"></span>
					</div>
					<div class="form-group">
						<label>อีเมลติดต่อ</label>
						<input type="text" id="email" class="form-control z-depth-1" oninput="form_change_value(id)"> 
						<span class="error_data" id="email_error"></span>
					</div>
					<div class="form-group">
						<label>รายการแจ้ง</label>
							<select class="form-control z-depth-1" id="fixlist" onchange="onchange_value(id)">																
								<option value="">เลือกรายการแจ้ง</option>
								<option>แจ้งปัญหาระบบอินเทอร์เน็ต</option>
								<option>แจ้งปัญหาเว็บไซต์</option>
								<option>แจ้งปัญหาระบบเครือข่าย</option>
								<option>แจ้งปัญหาปริ้นเตอร์</option>
								<option>แจ้งอุปกรณ์ชำรุด</option>
								<option>แจ้งปัญหาคอมพิวเตอร์</option>							
							</select>	
							<span class="error_data" id="fixlist_error"></span>													
					</div>
					
					<label>สถานที่</label>
					<div class="form-row pb-2">
						<div class="col">
							<select class="form-control z-depth-1" id="building" onchange="onchange_value(id)">
								<option value="">อาคาร</option>
								<option>42</option>
								<option>62</option>
								<option>63</option>
								<option>64</option>
								<option>65</option>
								<option>66</option>
								<option>67</option>
								<option>68</option>
								<option>69</option>
								<option>90</option>
								<option>91</option>
								<option>97</option>						
							</select>
							<span class="error_data" id="building_error"></span>
						</div>
						<div class="col">
						<select class="form-control z-depth-1" id="floor" onchange="onchange_value(id)">
								<option value="">ชั้น</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
								<option>7</option>
								<option>8</option>
								<option>9</option>
								<option>10</option>					
							</select>
							<span class="error_data" id="floor_error"></span>
						</div>
						<div class="col">
							<input type="text" id="room" class="form-control z-depth-1"  placeholder="ห้อง" oninput="form_change_value(id)">
							<span class="error_data" id="room_error"></span>
						</div>
					</div>
										
					<div class="form-group">
						<label>ลักษณะของปัญหา</label>
						<textarea class="form-control z-depth-1" rows="5" cols="9" id="fixprob" oninput="form_change_value(id)"></textarea>
						<span class="error_data" id="fixprob_error"></span>
					</div>
					<label>กำหนดเวลาซ่อม</label>
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
		let phonenum = $('#phonenum').val(); 
		let email = $('#email').val(); 
		let fixlist = $('#fixlist').val();
		let building = $('#building').val(); 
		let floor = $('#floor').val();
		let room = $('#room').val();
		let fixprob = $('#fixprob').val();
		let date = $('#datepicker').val();
		let time = $('#timepicker').val();

		$.ajax({
			url:"<?php echo base_url()?>request_fix/error",
			method:"post",
			dataType:"json",
			data:{
				'firstname':firstname,'lastname':lastname,'phonenum':phonenum,'email':email,
				'fixlist':fixlist,'building':building,'floor':floor,'room':room,'fixprob':fixprob,
				'date':date,'time':time
			},
			success:function(data){
				$('#firstname_error').html(data.firstname_error);
				$('#lastname_error').html(data.lastname_error);
				$('#phonenum_error').html(data.phonenum_error);
				$('#email_error').html(data.email_error);				
				$('#fixlist_error').html(data.fixlist_error);
				$('#building_error').html(data.building_error);
				$('#floor_error').html(data.floor_error);
				$('#room_error').html(data.room_error);
				$('#fixprob_error').html(data.fixprob_error);
				$('#datepicker_error').html(data.date_error);
				$('#timepicker_error').html(data.time_error);
				if(data.firstname != null){
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
					//--------------------- popup confirm modal-----------------
					let confirm = document.getElementById('confirm').onclick = async function(){
						/* ----------------- Popup Waiting Modal ------------ */
						// let x = function modal() {
						// 	$('#form_ready').modal('hide');
						// 	$('#wait_modal').modal('show');
						// 	console.log(0)
						// }
						// await x() // pop up modal first 
						/* ----------------- POST information to DB ------------ */
						// await $.ajax({
						// 	url:"<?php echo base_url()?>request_fix/accept_data",
						// 	method:"post",
						// 	dataType:"json",
						// 	data:{
						// 		'firstname':firstname,'lastname':lastname,'phonenum':phonenum,'email':email,
						// 		'fixlist':fixlist,'building':building,'floor':floor,'room':room,'fixprob':fixprob,
						// 		'date':date,'time':time
						// 	},						
						// })
						/* ----------------- Send Email ---------------- */
						let msg = 	'ข้อมูลยืนยันแบบฟอร์มแจ้งซ่อมที่คุณ'+firstname+' ได้แจ้งไว้ ณ วันที่ '+date+' เวลา '+time+'<br>'+
									'ชื่อ-นามสกุล : '+firstname+' '+lastname+'<br>'+
									'เบอร์ติดต่อ : '+phonenum+'\n'+
									'อีเมลติดต่อ : '+email+'\n'+
									'รายการแจ้ง : '+fixlist+'\n'+
									'สถานที่ : อาคาร '+building+' ชั้น '+floor+' ห้อง '+room+'\n'+
									'ลักษณะของปัญหา : '+fixprob+ '\n'+
									'กำหนดเวลาซ่อม : วันที่ '+date+' เวลา '+time+'\n';
						await $.ajax({
							url : "<?php echo base_url();?>request_fix/send_email_data",
							method : "POST",
							// data:{
							// 	'firstname':firstname,'lastname':lastname,'phonenum':phonenum,'email':email,
							// 	'fixlist':fixlist,'building':building,'floor':floor,'room':room,'fixprob':fixprob,
							// 	'date':date,'time':time
							// },
							dataType:'json',
							data:{'msg':msg,'email':email},
							success:console.log(2)
						})
						/* ------------------ LINE NOTI -------------------- */
						let msg_line = 	'ข้อมูลยืนยันแบบฟอร์มแจ้งซ่อมที่คุณ'+firstname+' ได้แจ้งไว้ ณ วันที่ '+date+' เวลา '+time+'\n'+
										'ชื่อ-นามสกุล : '+firstname+' '+lastname+'\n'+
										'เบอร์ติดต่อ : '+phonenum+'\n'+
										'อีเมลติดต่อ : '+email+'\n'+
										'รายการแจ้ง : '+fixlist+'\n'+
										'สถานที่ : อาคาร '+building+' ชั้น '+floor+' ห้อง '+room+'\n'+
										'ลักษณะของปัญหา : '+fixprob+ '\n'+
										'กำหนดเวลาซ่อม : วันที่ '+date+' เวลา '+time+'\n';
						await $.ajax({
							url:"<?php echo base_url();?>request_fix/line_noti",
							method:'post',
							dataType:'json',
							data:{'msg':msg_line},
							success:console.log(3)
						})												
					}
					confirm;
				}
			}
		});
		// console.log(date+'  '+time)
		const a = Array()
		a[1] = 2
		const y = 'eeee'
		fetch('./request_fix/xxx',{
			method:'post',
			headers: {
				// 'Content-Type': 'application/json',
				// 'Accept':'application/json',
			},
			body: JSON.stringify({
				x:a,
				y:'8888'
			}),
		})
			.then(res => {
				return res.json()
			})
			.then(data => console.log(data))

		$.ajax({
			url:'./request_fix/xxx',
			method:'post',
			dataType:'json',
			data:{'id':2}
		})
		
	}
	function dis_modal(){
		$('#form_ready').modal('hide');
	}
	































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