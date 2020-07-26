<!DOCTYPE html>
<html lang="en">

<head>
<title>รีพอร์ตยกเลิกคำร้อง - เบิกของ</title>
</head>

<div class="wrapper">
	<?php include 'admainEDIT.php'?>
	<body>
		<main>
			<div class="table-responsive">
				<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">รีพอร์ตยกเลิกคำร้อง - เบิกของ</p>				
				<div class="container z-depth-2 mb-4 pt-3" style="max-width:600px;">
					<div class="form-row pb-2">
						<div class="col">
							<label>วันที่แจ้ง</label>
							<input class="form-control" readonly value="<?php echo date('d-m-Y',strtotime($date_request));?>">
						</div>
						<div class="col">
							<label>เวลา</label>
							<input class="form-control" readonly value="<?php echo $time_request;?>">
						</div>
					</div>					
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
					<div class="form-group" id="req_list">
						<label >รายการที่ขอเบิก</label>
							<?php foreach($itemotp_list as $col) {?>
							<div class="form-inline pb-1" >
								<input class="form-control col-2" value="<?php echo $col->item_type;?>" readonly></input>
								<input class="form-control col-8" value="<?php echo $col->item_name;?>" style="max-width:373px; margin-right:3px; margin-left:3px;"readonly></input>
								<input class="form-control col-2" value="<?php echo $col->item_unit;?>" readonly></input>
							</div>
							<?php } ?>
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
					<div class="form-row pb-2">
						<div class="col">
							<label>วันที่ยกเลิก</label>
							<input class="form-control" readonly value="<?php echo date('d-m-Y',strtotime($cancle_date));?>">
						</div>
						<div class="col">
							<label>เวลา</label>
							<input class="form-control" readonly value="<?php echo $cancle_time;?>">
						</div>
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


