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
					รีพอร์ตเบิกของ</p>
				<?php
					$id = $this->session->report_item_data['id'];					
					$firstname = $this->session->report_item_data['firstname'];	
					$lastname = $this->session->report_item_data['lastname'];												
					$phonenum = $this->session->report_item_data['phonenum'];
					$email = $this->session->report_item_data['email'];
					$section = $this->session->report_item_data['section'];
					$item_list = $this->session->report_item_data['item_list'];
					$date = $this->session->report_item_data['date'];
					$time = $this->session->report_item_data['time'];
					$date_request = $this->session->report_item_data['date_request'];
					$time_request = $this->session->report_item_data['time_request'];
					$type = $this->session->report_item_data['type'];	
					$ad_username = $this->session->userdata('username');	
					$admin_accept_name = $this->session->report_item_data['admin_accept_name'];	
					$admin_accept_date = $this->session->report_item_data['admin_accept_date'];	
				?>
				
				<div class="container z-depth-2 mb-4 pt-3" style="max-width:600px;">					
					<div class="form-row pb-2">
						<div class="col">
							<label>ชื่อ</label>
							<input class="form-control" value="<?php echo $firstname;?>" readonly>
						</div>
						<div class="col">
							<label>นามสกุล</label>
								<input class="form-control" value="<?php echo $lastname;?>" readonly>
						</div>
					</div>
					<div class="form-group">
						<label>เบอร์ติดต่อ</label>
							<input class="form-control" value="<?php echo $phonenum;?>" readonly>					
					</div>
					<div class="form-group">
						<label>อีเมลติดต่อ</label>
							<input type="email" name="email" class="form-control" value="<?php echo $email;?>" readonly> 
					</div>
					<div class="form-group">
						<label>สังกัด/แผนก</label>
							<input type="text" name="section" class="form-control" value="<?php echo $section;?>" readonly>
					</div>
					<div class="form-group">
						<label>ของที่เบิก</label>
							<textarea class="form-control" rows="5" cols="9" readonly><?php echo $item_list;?></textarea>
					</div>				
					<div class="form-row pb-2">
						<div class="col">
							<label>กำหนดคืน</label>
							<input class="form-control"placeholder="วันที่" value="<?php echo $date; ?>" readonly>						
						</div>
						<div class="col">
							<label>เวลา</label>
							<input class="form-control" placeholder="เวลา" value="<?php echo $time; ?>" readonly>						
						</div>
					</div>

						<!--////////////////////////////////////// SESSION ID ACCEPT ORDER //////////////////////////////////////-->

						<div class="mt-5 mb-5">
							<hr class="style5">
							<div class="form-group">
								<label>ผู้รับงาน</label>
								<input type="text" name="fixetc" class="form-control" value="<?php echo $admin_accept_name;?>"
									readonly>
							</div>
							<div class="form-group">
								<label>วันที่รับงาน</label>
								<input type="text" name="fixetc" class="form-control" value="<?php echo $admin_accept_date?>"
									readonly>
							</div>
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
												<button type="button" class="btn btn-lg btn-block green accent-3 text-white" onclick="accept_order_item_inproc()"  style="font-size:18px;">ใช่</button>
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
	function accept_order_item_inproc(){
			var id = '<?php echo $id;?>';	
			var ad_username = "<?php echo $ad_username;?>";	 						
			$.ajax({
				url : "<?php echo base_url();?>ad_item/report_item_inproc_update",
				method : "POST",
				data :	{"id": id },
				success : function(data){
					$(location).attr('href','<?php echo base_url();?>ad_item/ad_item_inproc');
				}									
			});
			$.ajax({
				url : '<?php echo base_url();?>ad_item/report_item_inproc_update_session',
				method : 'POST',
				data : {'ad_username' : ad_username ,'id':id},
			});
			$.ajax({
				url : "<?php echo base_url();?>ad_item/send_email",
				method : "POST",
				data : {'id':id },
			})
		}
</script>
</html>


