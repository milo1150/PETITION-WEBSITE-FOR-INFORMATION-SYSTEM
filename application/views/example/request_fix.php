<!doctype html>
<html lang="en">

<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>แจ้งซ่อม</title>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url();?>/mdbootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="<?php echo base_url();?>/mdbootstrap/css/mdb.min.css" rel="stylesheet">
	<!-- Your custom styles (optional) -->
	<link href="<?php echo base_url();?>/mdbootstrap/css/style.css" rel="stylesheet">		
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	<!-- Include Bootstrap Datepicker -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
	<!-- Include Bootstrap Timepicker -->
	<link href="<?php echo base_url();?>/timepicker/mdtimepicker.css" rel="stylesheet" >
	<!-- MIS.CIT CSS -->
	<link href="<?php echo base_url(); ?>/mdbootstrap/css/utility.css" rel="stylesheet">

</head>
<body>
	<div class="table-responsive text-center">
		<div class="container-fluid red ligthen-1 z-depth-1-half" style="width:100%; font-family: 'Kanit', sans-serif;">
			<h3 class="req_header">แบบฟอร์มแจ้งซ่อม</h3>
		</div>
	</div>

	<!---------------------------------------------------------------- FORM -------------------------------------------------------------------->
		<div class="table-responsive-md pb-4 pt-4" style="font-family: 'Kanit', sans-serif;">
			<div class="container z-depth-1 reqform">
				<form>
					<div class="form-row pb-2 ">
						<div class="col">
							<label>ชื่อ</label>
							<input type="text" name="firstname" class="form-control z-depth-1">
						</div>
						<div class="col">
							<label>นามสกุล</label>
							<input type="text" name="lastname" class="form-control z-depth-1">
						</div>
					</div>
					<div class="form-group">
						<label>เบอร์ติดต่อ</label>
						<input type="text" name="phonenum" class="form-control z-depth-1">
					</div>
					<div class="form-group">
						<label>อีเมลติดต่อ</label>
						<input type="text" name="email" class="form-control z-depth-1"> 
					</div>
					<div class="form-group">
						<label>รายการแจ้ง</label>
							<select class="form-control z-depth-1" name="fixlist">																
								<option value="">เลือกรายการแจ้ง</option>
								<option>แจ้งปัญหาระบบอินเทอร์เน็ต</option>
								<option>แจ้งปัญหาเว็บไซต์</option>
								<option <?php if($fixlist=="แจ้งปัญหาระบบเครือข่าย"){echo("selected");}?>>แจ้งปัญหาระบบเครือข่าย</option>
								<option <?php if($fixlist=="แจ้งปัญหาปริ้นเตอร์"){echo("selected");}?>>แจ้งปัญหาปริ้นเตอร์</option>
								<option <?php if($fixlist=="แจ้งอุปกรณ์ชำรุด"){echo("selected");}?>>แจ้งอุปกรณ์ชำรุด</option>
								<option <?php if($fixlist=="แจ้งปัญหาคอมพิวเตอร์"){echo("selected");}?>>แจ้งปัญหาคอมพิวเตอร์</option>							
							</select>
					</div>
					<label>สถานที่</label>
					<div class="form-row pb-2">
						<div class="col">
							<select class="form-control z-depth-1" name="building">
								<option <?php if($building==""){echo("selected");}?> value="">อาคาร</option>
								<option <?php if($building=="42"){echo("selected");}?>>42</option>
								<option <?php if($building=="62"){echo("selected");}?>>62</option>
								<option <?php if($building=="63"){echo("selected");}?>>63</option>
								<option <?php if($building=="64"){echo("selected");}?>>64</option>
								<option <?php if($building=="65"){echo("selected");}?>>65</option>
								<option <?php if($building=="66"){echo("selected");}?>>66</option>
								<option <?php if($building=="67"){echo("selected");}?>>67</option>
								<option <?php if($building=="68"){echo("selected");}?>>68</option>
								<option <?php if($building=="69"){echo("selected");}?>>69</option>
								<option <?php if($building=="90"){echo("selected");}?>>90</option>
								<option <?php if($building=="91"){echo("selected");}?>>91</option>
								<option <?php if($building=="97"){echo("selected");}?>>97</option>						
							</select>
						</div>
						<div class="col">
						<select class="form-control z-depth-1" name="floor">
								<option <?php if($floor==""){echo("selected");}?> value="">ชั้น</option>
								<option <?php if($floor=="1"){echo("selected");}?>>1</option>
								<option <?php if($floor=="2"){echo("selected");}?>>2</option>
								<option <?php if($floor=="3"){echo("selected");}?>>3</option>
								<option <?php if($floor=="4"){echo("selected");}?>>4</option>
								<option <?php if($floor=="5"){echo("selected");}?>>5</option>
								<option <?php if($floor=="6"){echo("selected");}?>>6</option>
								<option <?php if($floor=="7"){echo("selected");}?>>7</option>
								<option <?php if($floor=="8"){echo("selected");}?>>8</option>
								<option <?php if($floor=="9"){echo("selected");}?>>9</option>
								<option <?php if($floor=="10"){echo("selected");}?>>10</option>					
							</select>
						</div>
						<div class="col">
							<input type="text" name="room" class="form-control z-depth-1"  placeholder="ห้อง" value="<?php echo $room;?>">
							<?php echo form_error('room'); ?>
						</div>
					</div>
										
					<div class="form-group">
						<label>ลักษณะของปัญหา</label>
						<textarea class="form-control z-depth-1" rows="5" cols="9" name="fixprob"><?php echo $fixprob;?></textarea>
						<?php echo form_error('fixprob'); ?>
					</div>
					<label>กำหนดช่วงเวลาซ่อม</label>
					<div class="form-row pb-2">
						<div class="col">
							<input type="text" name="date" class="form-control z-depth-1" id="datepicker" placeholder="วันที่" value="<?php echo $date;?>">
							<?php echo form_error('date'); ?>
						</div>
						<div class="col">
							<input type="text" data-date-format="G:i" name="time" class="form-control z-depth-1" id="timepicker" placeholder="เวลา" style="background-color: #fff" value="<?php echo $time; ?>">
							<?php echo form_error('time'); ?>
						</div>
					</div>
				</form>
				<div class="text-center pb-4">
					<div class="row justify-content-center pt-2">
						<div class="col-sm-6 pb-2">
							<button type="submit" name="insert" value="Insert" class="btn btn-lg btn-success btn-block" data-toggle="modal" data-target="#momo"
								style="font-size:20px;">ยืนยัน</button>
						</div>
						<div class="col-sm-6">
							<a href="<?php echo base_url()?>request">
								<button type="button" class="btn btn-lg btn-danger btn-block" style="font-size:20px;">ย้อนกลับ</button>
							</a>
						</div>					
					</div>
				</div>
			</div>
		</div>	
	<!---------------------------------------------------------------------------------------------------------------------------------------------->
	

<!-- Datepicker -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.th.min.js"></script>
<!-- Timepicker -->
<script src="<?php echo base_url();?>/timepicker/mdtimepicker.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  

<script>
// Data Picker Initialization
$("#datepicker").datepicker({
	format: 'dd-mm-yyyy',
    startDate: "-Infinity",
    todayBtn: "linked",
    language: "th",
    todayHighlight: true,
	
});
// Time Picker Initialization
$('#timepicker').mdtimepicker({
	format: 'hh:mm tt'
});
</script>
</body>
</html>