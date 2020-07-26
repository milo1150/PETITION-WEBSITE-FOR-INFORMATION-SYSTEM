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
					รีพอร์ตขอเปิดอีเมล์</p>
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
								<label>ชื่อ (ภาษาอังกฤษ)</label>
								<input class="form-control" value="<?php echo $firstname; ?>" readonly>
							</div>
							<div class="col">
								<label>นามสกุล (ภาษาอังกฤษ)</label>
								<input class="form-control" value="<?php echo $lastname; ?>" readonly>
							</div>
						</div>
						<div class="form-row pb-2">
							<div class="col">
								<label>ชื่อ (ภาษาไทย)</label>
								<input class="form-control" value="<?php echo $firstnameth; ?>" readonly>
							</div>
							<div class="col">
								<label>นามสกุล (ภาษาไทย)</label>
								<input class="form-control" value="<?php echo $lastnameth; ?>" readonly>
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
						<div class="mt-5 mb-5">
							<hr class="style5">
							<div class="form-group">
								<label>ผู้ปิดงาน</label>
								<input type="text" class="form-control" value="<?php echo  $admin_close_name;?>"
									readonly>
							</div>
							<div class="form-row pb-2">
								<div class="col">
									<label>วันที่ปิดงาน</label>
									<input class="form-control" value="<?php echo date('d-m-Y',strtotime($admin_close_date)); ?>" readonly>
								</div>
								<div class="col">
									<label>เวลา</label>
									<input class="form-control" value="<?php echo $admin_close_time; ?>" readonly>
								</div>
							</div>		
						</div>
						<div class="text-center">
							<div class="row justify-content-center pt-2">								
								<div class="col-sm-4 pb-4">
									<button type="button" class="btn btn-lg btn-block red accent-4 text-white"
										onclick="history.back(-1)" style="font-size:20px;">ย้อนกลับ</button></div>
							</div>
						</div>
				</div>
		</main>		
</div>
</body>
</html>


