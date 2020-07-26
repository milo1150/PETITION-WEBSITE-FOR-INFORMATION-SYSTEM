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
				<div class="container" style="max-width:600px;">
					<form class="" method="" action="">
						<div class="form-row pb-2">
							<div class="col">
								<label>วันที่</label>
								<input type="text" name="name" class="form-control"
									placeholder="<?php echo "".date("d/m/Y")?>" readonly>
							</div>
							<div class="col">
								<label>เวลา</label>
								<input type="text" name="name" class="form-control"
									placeholder="<?php echo "".date("H:i:s")?>" readonly>
							</div>
						</div>
						<div class="form-row pb-2">
							<div class="col">
								<label>ชื่อ</label>
								<input type="text" name="name" class="form-control" placeholder="กอเตย" readonly>
							</div>
							<div class="col">
								<label>นามสกุล</label>
								<input type="text" name="name" class="form-control" placeholder="ทองมณี" readonly>
							</div>
						</div>
						<div class="form-group">
							<label>เบอร์โทรติดต่อ</label>
							<input type="text" name="pNum" class="form-control" placeholder="081-1033362" maxlength="15"
								readonly>
						</div>
						<div class="form-group">
							<label>สังกัด/แผนก</label>
							<input type="text" name="place" class="form-control" placeholder="EnET-C" maxlength="10"
								readonly>
						</div>
						<div class="form-group">
							<label>ชื่ออีเมล์ที่ขอเปิดใช้</label>
							<input type="text" name="item" class="form-control" placeholder="minitoei@kmutnb.ac.th"
								readonly>
						</div>
						<div class="form-group">
							<label>ตำแหน่ง</label>
							<input type="text" name="info" class="form-control" placeholder="Student" readonly>
						</div>
						<div class="form-group">
							<label>เบอร์ติดต่อภายใน</label>
							<input type="text" name="comment" class="form-control" placeholder="01-111-111" readonly>
						</div>
						<div>
						</div>
					</form>
					<div class="text-center">
						<div class="row justify-content-center pt-2">
							
							<div class="col-sm-4">
								<button type="button" class="btn btn-lg btn-danger btn-block" onclick="history.back(-1)"
									style="font-size:20px;">ย้อนกลับ</button></div>
						</div>
					</div>
				</div>







		</main>





</div>






</body>


</html>