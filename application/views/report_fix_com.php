<!DOCTYPE html>
<html lang="en">

<head>
<title>รีพอร์ตแจ้งซ่อม</title>
</head>

<div class="wrapper">
	<?php include 'admainEDIT.php'?>
	<body>
		<main>
			<div class="table-responsive">
				<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">
					รีพอร์ตแจ้งซ่อม</p>
				
				<div class="container z-depth-2 mb-4 pt-3" id="box-info" style="max-width:600px;">
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
								<input type="text" name="fixetc" class="form-control" value="<?php echo $admin_accept_name;?>"
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
							<div class="form-group pt-2">
							<label>คอมเมนต์งานโดย <?php echo $admin_close_name;?></label>
								<textarea class="form-control" rows="5" cols="9" id="ad_comment" readonly><?php echo $admin_comment;?></textarea>
						</div>
						</div>
						
						
						<hr class="style5 mt-5">
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
<script>
// const filename  = 'ThisIsYourPDFFilename.pdf';

// html2canvas(document.querySelector('#box-info')).then(canvas => {
// 	let pdf = new jsPDF('p', 'mm', 'a4');
// 	pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, 211, 298);
// 	pdf.save(filename);
// });

// html2canvas(document.querySelector('#box-info')).then(canvas => {
// 	// let x = document.body.appendChild(canvas)
// 	let pdf = new jsPDF('p', 'mm', 'a4');
// 	pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, 211, 298);
// 	const name = 'ddd.pdf'
// 	pdf.save(name)
// });
	
</script>
</body>

</html>


