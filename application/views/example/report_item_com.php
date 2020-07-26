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
					$admin_close_name = $this->session->report_item_data['admin_close_name'];	
					$admin_close_date = $this->session->report_item_data['admin_close_date'];	
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

						<!--////////////////////////////////////// SESSION ID CLOSE ORDER //////////////////////////////////////-->
						<?php 
							$accept_date = date("d/m/Y")." ".date("H:i:s");
							$ad_username = $this->session->userdata('username');
						?>
						<div class="mt-5 mb-5">
							<hr class="style5">
							<div class="form-group">
								<label>ผู้ปิดงาน</label>
								<input type="text" name="fixetc" class="form-control" value="<?php echo  $admin_close_name;?>"
									readonly>
							</div>
							<div class="form-group">
								<label>วันที่ปิดงาน</label>
								<input type="text" name="fixetc" class="form-control" value="<?php echo  $admin_close_date;?>"
									readonly>
							</div>
						</div>
						<div class="text-center">
							<div class="row justify-content-center pb-4">								
								<div class="col-sm-4">
									<button type="button" class="btn btn-lg btn-block red accent-4 text-white"
										onclick="history.back(-1)" style="font-size:20px;">ย้อนกลับ</button></div>
							</div>
						</div>
				</div>
		</main>		
</div>
</body>
</html>


