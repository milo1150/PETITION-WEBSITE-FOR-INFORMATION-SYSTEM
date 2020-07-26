<!DOCTYPE html>
<html lang="en">

<head>
<title>รีพอร์ตยืมของ</title>
</head>

<div class="wrapper">
<?php $this->load->view('admin/admainEDIT');?>
	<body>
		<main>
			<div class="table-responsive">
				<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">รีพอร์ตยืมของ</p>
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
						<label >รายการขอยืม</label>
							<?php foreach($item_list as $col) {?>
							<div class="form-inline pb-1" >
								<input class="form-control col-2" value="<?php echo $col->item_type;?>" readonly></input>
								<input class="form-control col-8" value="<?php echo $col->item_name;?>" style="max-width:373px; margin-right:3px; margin-left:3px;"readonly></input>
								<input class="form-control col-2" value="<?php echo $col->item_unit;?>" readonly></input>
							</div>
							<?php } ?>
					</div>	
					<div class="form-group" id="req_list_detail">
						<label >รายการให้ยืม</label>
							<?php foreach($item_detail as $col) {?>
							<div class="form-inline pb-1" >
								<input class="form-control col-2" value="<?php echo $col->item_type;?>" readonly></input>
								<input class="form-control col-8" value="<?php echo $col->item_name;?>" style="max-width:373px; margin-right:3px; margin-left:3px;"readonly></input>
								<input class="form-control col-2" value="<?php if($col->item_type == "วัสดุ"){echo $col->item_unit;} if($col->item_type == "ครุภัณฑ์"){echo $col->item_id;}?>" readonly></input>
							</div>
							<?php } ?>
					</div>				
					<div class="form-row pb-2">
						<div class="col">
							<label>กำหนดคืน</label>
							<input class="form-control"placeholder="วันที่" value="<?php echo date('d-m-Y',strtotime($date)); ?>" readonly>						
						</div>
						<div class="col">
							<label>เวลา</label>
							<input class="form-control" placeholder="เวลา" value="<?php echo $time; ?>" readonly>						
						</div>
					</div>

						<div class="mt-5 mb-5">
							<hr class="style5">
							<div class="form-group">
								<label>ผู้รับงาน</label>
								<input type="text" name="fixetc" class="form-control" value="<?php echo $admin_accept_name;?>"
									readonly>
							</div>
							<div class="form-row pb-2">
								<div class="col">
									<label>วันที่รับงาน</label>
									<input class="form-control" readonly value="<?php echo date('d-m-Y',strtotime($admin_accept_date));?>">
								</div>
								<div class="col">
									<label>เวลา</label>
									<input class="form-control" readonly value="<?php echo $admin_accept_time;?>">
								</div>
							</div>
						</div>
						<div class="mt-5 mb-5">
							<hr class="style5">
							<div class="form-group">
								<label>ผู้ปิดงาน</label>
								<input type="text" name="fixetc" class="form-control" value="<?php echo  $admin_close_name;?>"
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


