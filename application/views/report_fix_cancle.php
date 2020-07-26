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
					รีพอร์ตยกเลิกคำร้อง - แจ้งซ่อม</p>
				<div class="container mb-4 pt-3 z-depth-2" style="max-width:600px;">	
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
								<label>เวลา</label>
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
						<!--////////////////////////////////////// BUTTON //////////////////////////////////////-->
						<br>
						<div class="row justify-content-center pt-2 pb-4">														
							<div class="col-sm-4">
								<button type="button" class="btn btn-lg btn-block red accent-4 text-white" onclick="history.back(-1)"
									style="font-size:20px;">ย้อนกลับ</button>
							</div>
						</div>
					</div>
			</div>
		</main>
</div>
</body>
</html>
