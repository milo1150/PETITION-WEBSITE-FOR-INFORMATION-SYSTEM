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
					รีพอร์ตรายการยกเลิก</p>
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
					$cancle_detail = $this->session->report_item_data['cancle_detail'];
					$cancle_admin = $this->session->report_item_data['cancle_admin'];
					$ad_username = $this->session->userdata('username');							
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
						<label>ของที่เบิก</label>w
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
					<hr class="style5 mt-4">
					<div class="form-group">
						<label>ผู้ยกเลิกรายการ</label>
							<input type="text" name="section" class="form-control" value="<?php echo $cancle_admin;?>" readonly>
					</div>
					<div class="form-group">
						<label>เหตุผลการยกเลิกรายการ</label>
								<textarea class="form-control" rows="5" cols="9" readonly><?php echo $cancle_detail;?></textarea>
						</div>
					<hr class="style5 mt-4">						
						<div class="text-center">
							<div class="row justify-content-center pt-2">								
								<div class="col-sm-4 pb-4">
									<button type="button" class="btn btn-lg btn-danger btn-block"
										onclick="history.back(-1)" style="font-size:20px;">ย้อนกลับ</button></div>
							</div>
						</div>
				</div>
		</main>		
</div>
</body>
</html>


