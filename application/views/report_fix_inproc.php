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
					รีพอร์ตแจ้งซ่อม</p>
				<div class="container z-depth-2 mb-4 pt-3" style="max-width:600px;">
						<div class="form-group">
							<label>หมายเลขงาน</label>
							<input class="form-control" readonly value="<?php echo $id;?>">
						</div>
						<div class="form-row pb-2">
							<div class="col">
								<label>วันที่แจ้ง</label>
								<input class="form-control" readonly value="<?php echo date('d-m-Y',strtotime($date_request));?>">
							</div>
							<div class="col">
								<label>เวลาที่แจ้ง</label>
								<input class="form-control" readonly value="<?php echo $time_request;?>">
							</div>
						</div>
						<div class="form-row pb-2">
							<div class="col">
								<label>ชื่อ</label>
								<input class="form-control" readonly value="<?php echo $firstname;?>">
							</div>
							<div class="col">
								<label>นามสกุล</label>
								<input class="form-control" readonly value="<?php echo $lastname;?>">
							</div>
						</div>
						<div class="form-group">
							<label>เบอร์ติดต่อ</label>
							<input class="form-control" readonly value="<?php echo $phonenum;?>">
						</div>
						<div class="form-group">
							<label>อีเมลติดต่อ</label>
							<input class="form-control" readonly value="<?php echo $email;?>"> 
						</div>
						<div class="form-group">
							<label>รายการแจ้งซ่อม</label>
							<input class="form-control" readonly value="<?php echo $fixlist;?>">
						</div>
						<div class="form-row pb-2">
							<div class="col">อาคาร
								<input class="form-control" readonly value="<?php echo $building;?>">
							</div>
							<div class="col">ชั้น
								<input class="form-control" readonly value="<?php echo $floor;?>">
							</div>
							<div class="col">ห้อง
								<input class="form-control" readonly value="<?php echo $room;?>">
							</div>
						</div>
						<div class="form-group">
							<label>ลักษณะของปัญหา</label>
							<textarea class="form-control" rows="8" cols="9" readonly><?php echo $fixprob;?></textarea>
						</div>
						<div class="form-row pb-2">
							<div class="col">
								<label>เริ่มดำเนินการ</label>
								<input class="form-control" readonly value="<?php echo date('d-m-Y',strtotime($date));?>">
							</div>
							<div class="col">
								<label>เวลา</label>
								<input class="form-control" readonly value="<?php echo $time; ?>">
							</div>
						</div>
						<div class="mb-4">
							<hr class="style5 mt-5">							
							<div class="form-group">
								<label>ผู้รับงาน</label>
								<input type="text" class="form-control" value="<?php echo $admin_accept_name;?>"
									readonly>
							</div>
							<div class="form-row pb-2">
								<div class="col">
									<label>วันที่รับงาน</label>
									<input class="form-control" value="<?php echo date('d-m-Y',strtotime($admin_accept_date)); ?>" readonly>
								</div>
								<div class="col">
									<label>เวลา</label>
									<input class="form-control" value="<?php echo $admin_accept_time; ?>" readonly>
								</div>
							</div>	
						</div>
						<hr class="style5 mt-5">
						<div class="form-group">
							<label>คอมเมนต์งาน</label>
								<textarea class="form-control" rows="5" cols="9" id="ad_comment" placeholder="ไม่จำเป็นต้องกรอก"></textarea>
						</div>
						<!--////////////////////////////////////// BUTTON //////////////////////////////////////-->
						
						<div class="row justify-content-center pt-2">
							<div class="col-sm-4">																
							<button type="button" class="btn btn-lg btn-block mb-3 green accent-3 text-white" 									
								onclick="" style="font-size:20px;" data-toggle="modal" data-target="#basicExampleModal">
								ปิดงาน
							</button></div>

							<!-- Modal -->
							<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-body text-center">
										<a class="modal-body" id="exampleModalLabel">ปิดงาน<?php echo $type;?></a>
											<br/>
											<a>หมายเลขงาน : <?php echo $id;?></a>
											<br/>
											<a>ชื่อผู้แจ้ง : <?php echo $firstname;?> <?php echo $lastname;?></a>	
											<br/>
											<a>เบอร์ติดต่อ : <?php echo $phonenum;?></a>																					
										</div>																				
										<div class="modal-body row justify-content-center">
											<div class="col-5">
												<button type="button" class="btn btn-lg btn-block green accent-3 text-white" onclick="accept_order_fix_inproc()"  style="font-size:18px;">ใช่</button>
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
		</main>		
</div>
</body>
<script>
	/*----------------------------------- Close Order ---------------------------------*/
	function accept_order_fix_inproc(){
			var id = '<?php echo $id;?>';	
			var ad_username = '<?php echo $this->session->userdata('username');?>';	 	
			var ad_comment = document.getElementById('ad_comment').value;						
			$.ajax({
				url : '<?php echo base_url();?>ad_fix/report_fix_order_update_close',
				method : 'POST',
				data : {'ad_username' : ad_username , 'id':id , 'ad_comment':ad_comment},	
				success : setTimeout(function(){window.history.back()},1000)													
			})
			$.ajax({
				url : "<?php echo base_url();?>ad_fix/send_email_com",
				method : "POST",
				data : {'id':id },
			})
		}
</script>
</html>


