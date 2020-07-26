<!DOCTYPE html>
<html lang="en">
<head>
</head>
<div class="wrapper">
	<?php include 'admainEDIT.php'?>
	<body>
		<main>
			<div class="table-responsive">
				<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">
					รีพอร์ตสแกนนิ้ว</p>								
					<div class="container z-depth-2 mb-4 pt-3" style="max-width:600px;">	
						<div class="form-row pb-2">
							<div class="col">
								<label>วันที่แจ้ง</label>
								<input class="form-control" value="<?php echo date('d-m-Y',strtotime($date_request)); ?>" readonly>
							</div>
							<div class="col">
								<label>เวลา</label>
								<input class="form-control" value="<?php echo $time_request; ?>" readonly>
							</div>
						</div>										
						<div class="form-row pb-2">
							<div class="col">
								<label>ชื่อ</label>
								<input class="form-control" value="<?php echo $firstname; ?>" readonly>
							</div>
							<div class="col">
								<label>นามสกุล</label>
								<input class="form-control" value="<?php echo $lastname; ?>" readonly>
							</div>
						</div>					
						<div class="form-group">
							<label>เบอร์ติดต่อ (ส่วนตัว)</label>
							<input class="form-control" value="<?php echo $phonenum; ?>" readonly>
						</div>
						<div class="form-group">
							<label>เบอร์ติดต่อ (ภายใน)</label>
							<input class="form-control" value="<?php echo $phonein; ?>" readonly>
						</div>
						<div class="form-group">
							<label>หมายเลขบัตรประชาชน</label>
							<input class="form-control" value="<?php echo $userid; ?>" readonly> 
						</div>
						<div class="form-group">
							<label>อีเมลติดต่อ</label>
							<input class="form-control" value="<?php echo $email; ?>" readonly> 
						</div>
						<div class="form-group">
							<label>สังกัด/แผนก</label>
							<input class="form-control" value="<?php echo $section; ?>" readonly>
						</div>
						<div class="form-group">
							<label>ตำแหน่ง</label>
							<input class="form-control" value="<?php echo $rank; ?>" readonly>
						</div>
						<div class="form-group">
							<label>ID SCAN</label>
							<input class="form-control" value="<?php echo $max_id; ?>" id="id_scan">
							<div class="pt-2"><span id="id_error" style="color:#CC0000;"></span></div>
						</div>
						<!--////////////////////////////////////// BUTTON //////////////////////////////////////-->
						<hr class="style5 mt-4">
						<div class="row justify-content-center pt-2">
							<div class="col-sm-4">																
							<button type="button" class="btn btn-lg btn-block mb-3 green accent-3 text-white" 									
								onclick="check_id_scan()" style="font-size:20px;">
								ปิดงาน
							</button></div>

							<!-- Modal -->
							<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-body text-center">
											<a class="modal-body" id="exampleModalLabel">ปิดงาน<?php echo $type;?></a>
											<br/>
											<a>หมายเลขงาน : <?php echo $id;?></a>
											<br/>
											<a>ชื่อผู้แจ้ง : <?php echo $firstname;?> <?php echo $lastname;?></a>	
											<br/>
											<!-- <a>เบอร์ติดต่อ : <?php echo $phonenum;?></a>																				 -->
										</div>																				
										<div class="modal-body row justify-content-center">
											<div class="col-5">
												<button type="button" class="btn btn-lg btn-block green accent-3 text-white" onclick="accept_order_finger()"  style="font-size:18px;">ใช่</button>
											</div>
											<div class="col-5">
												<button type="button" class="btn btn-lg btn-block red accent-4 text-white" data-dismiss="modal"  style="font-size:18px;">ไม่ใช่</button>	
											</div>										
										</div>
									</div>
								</div>
							</div>								
								<div class="col-sm-4 pb-4">
									<button type="button" class="btn btn-lg btn-block red accent-4 text-white" onclick="history.back(-1)"
										style="font-size:20px;">ย้อนกลับ</button>
								</div>
							</div>
						</div>
					</div>
						<!-------------------------------------------------Watching in the same time------------------------------------------------>
						<div class="modal fade" id="watch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Kanit', sans-serif;" data-backdrop="static" data-keyboard="false" >
							<div class="modal-dialog modal-dialog-centered" id="exampleModalLabel" role="document">
								<div class="modal-content z-depth-2" style="box-shadow: 10px 10px 3px #aaaaaa;">
									<div class="modal-body text-center">
										<a class="modal-body font-weight-bolder"><br/>
											<!--------UPDATE ADMIN ACCEPT NAME------->
											<a class="font-weight-bolder" id="adname" style="font-size:20px;"></a>
											<a class="font-weight-bolder" style="font-size:20px;">ปิดงานแล้ว !</a>
										</a>
									</div>																				
									<div class="modal-body row justify-content-center">
										<div class="col-6">
											<form action="<?php echo base_url();?>ad_finger/ad_finger_order">																			
												<button type="submit" class="btn btn-lg btn-block mb-3 red accent-3 text-white" style="font-size:18px;">กลับสู่หน้าหลัก</button>
											</form>																								
										</div>
																			
									</div>
								</div>
							</div>
						</div>	
						<!---------------------------------------------------------------------------------------------------------------------------->					

</main>		
</div>
</body>
<script>
	//----------------------------- Check ว่าใครกดรับงานระหว่างดู --------------------------
	$(document).ready(function(){			
		function watching(){
			var id = '<?php echo $id;?>';
			$.ajax({
				url:"<?php echo base_url(); ?>ad_finger/watch_accept_status",
				method:"POST",
				dataType:"JSON",
				data:{'id':id},
				success:function(data){				
					if(data[0].order_status == 2){
						setTimeout(function(){
							$('#watch').modal('show');							 
							$('#adname').html(data[0].admin_close_name);
						},3000)					
					}				
				}
			})
		}
		setInterval(function(){
			watching()
		},1000)
	})

	function check_id_scan(){			
		var id_scan = document.getElementById('id_scan').value;
			$.ajax({
				url:'<?php echo base_url();?>ad_finger/check_id_scan',
				method:'POST',
				data:{'id_scan':id_scan},
				success:function(data){
					var x = data;
					if(x == 'false'){
						$('#id_error').html('มี ID นี้อยู๋ในระบบแล้ว');
					}else{
						$('#id_error').html('');
						$('#modal').modal('show');
					}
				}
			});										
	}

	async function accept_order_finger(){
		var id = '<?php echo $id;?>';	
		var ad_username = '<?php echo $this->session->userdata('username');?>';	 
		var id_scan = document.getElementById('id_scan').value;			
		await $.ajax({
			url : "<?php echo base_url();?>ad_finger/send_email",
			method : "POST",
			data : {'id':id },
		});	
		await $.ajax({
			url : '<?php echo base_url();?>ad_finger/report_finger_order_update_accept',
			method : 'POST',
			data : {'ad_username' : ad_username , 'id':id , 'id_scan':id_scan},	
			success : setTimeout(function(){window.history.back()},200)												
		});
	}
</script>
</html>


