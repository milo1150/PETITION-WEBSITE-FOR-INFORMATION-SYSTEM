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

</head>
<body>
	<style>	
	div div h3{
		font-size:40px;
		padding-top:50px;
		padding-bottom:50px;
		font-weight:bold;	
		text-shadow:1px 1px 2px;
	}
	</style>
	<?php	
		$firstname = $this->session->getFix_data['firstname'];
		$lastname = $this->session->getFix_data['lastname'];
		$phonenum = $this->session->getFix_data['phonenum'];
		$email = $this->session->getFix_data['email'];
		$building = $this->session->getFix_data['building'];
		$floor = $this->session->getFix_data['floor'];
		$room = $this->session->getFix_data['room'];
		$fixlist = $this->session->getFix_data['fixlist'];
		$fixprob = $this->session->getFix_data['fixprob'];
		$date = $this->session->getFix_data['date'];
		$time = $this->session->getFix_data['time'];
		$fixetc = $this->session->getFix_data['fixetc'];
	?>
<?php ?>
	<div class="table-responsive text-center">
		<div class="container-fluid red ligthen-1 z-depth-1-half" style="width:100%; font-family: 'Kanit', sans-serif;">
			<h3>แบบฟอร์มแจ้งซ่อม</h3>
		</div>
	</div>

	
	 <form method="POST" action="<?php echo base_url('request_fix/error');?>" id="fix_form" style="font-family: 'Kanit', sans-serif;"> 
		<div class="table-responsive-md pb-4 pt-4" style="background: #f5f3f3;">
			<div class="container" style="max-width:400px;">
				<form>
					<div class="form-row pb-2">
						<div class="col">
							<label>ชื่อ</label>
							<input type="text" name="firstname" class="form-control" id="fname"value="<?php echo $firstname; ?>">
							<?php echo form_error('firstname'); ?>
						</div>
						<div class="col">
							<label>นามสกุล</label>
							<input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
							<?php echo form_error('lastname'); ?>
						</div>
					</div>
					<div class="form-group">
						<label>เบอร์ติดต่อ</label>
						<input type="text" name="phonenum" class="form-control" value="<?php echo $phonenum; ?>">
						<?php echo form_error('phonenum'); ?>
					</div>
					<div class="form-group">
						<label>อีเมลติดต่อ</label>
						<input type="text" name="email" class="form-control" value="<?php echo $email; ?>"> 
						<?php echo form_error('email'); ?>
					</div>
					<label>สถานที่</label>
					<div class="form-row pb-2">
						<div class="col">
							<input type="text" name="building" class="form-control" placeholder="ตึก" value="<?php echo $building; ?>">
							<?php echo form_error('building'); ?>
						</div>
						<div class="col">
							<input type="text" name="floor" class="form-control" placeholder="ชั้น" value="<?php echo $floor; ?>">
							<?php echo form_error('floor'); ?>
						</div>
						<div class="col">
							<input type="text" name="room" class="form-control" placeholder="ห้อง" value="<?php echo $room; ?>">
							<?php echo form_error('room'); ?>
						</div>
					</div>
					<div class="form-group">
						<label>รายการแจ้งซ่อม</label>
						<input type="text" name="fixlist" class="form-control" value="<?php echo $fixlist; ?>">
						<?php echo form_error('fixlist'); ?>
					</div>
					<div class="form-group">
						<label>ลักษณะของปัญหา</label>
						<input type="text" name="fixprob" class="form-control" value="<?php echo $fixprob; ?>">
						<?php echo form_error('fixprob'); ?>
					</div>
					<label>กำหนดช่วงเวลาซ่อม</label>
					<div class="form-row pb-2">
						<div class="col">
							<input type="text" name="date" class="form-control" id="datepicker" placeholder="วันที่" value="<?php echo $date; ?>">
							<?php echo form_error('date'); ?>
						</div>
						<div class="col">
							<input type="text" data-date-format="G:i" name="time" class="form-control" id="timepicker" placeholder="เวลา" style="background-color: #fff" value="<?php echo $time; ?>">
							<?php echo form_error('time'); ?>
						</div>
					</div>
					<div class="form-group">
						<label>แนะนำเพิ่มเติม</label>
						<textarea class="form-control" rows="5" cols="9" name="fixetc"><?php echo $fixetc;?></textarea>
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
	</form>
	<!--</form>-->
	
	<!-- ////////////////////////////////////////////////// MODAL //////////////////////////////////////////////////////// -->							
		<div class="modal fade" id="fd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Kanit', sans-serif;">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body text-center">
						<a class="modal-body" id="exampleModalLabel"><br/>ยืนยันแบบฟอร์มแจ้งซ่อม</a>																																								
					</div>																				
					<div class="modal-body row justify-content-center">
						<div class="col-5">
							<button type="button" class="btn btn-lg btn-success btn-block" onclick="success()" id="redirect" style="font-size:18px;">ใช่</button>
						</div>
					<div class="col-5">
						<button type="button" class="btn btn-lg btn-danger btn-block" data-dismiss="modal"  style="font-size:18px;">ไม่ใช่</button>	
					</div>										
				</div>
			</div>
		</div>
	</div>
	

<!-- Datepicker -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.th.min.js"></script>
<!-- Timepicker -->
<script src="<?php echo base_url();?>/timepicker/mdtimepicker.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  

<script>
//SEND DATA
$(document).ready(function(){
	$('#fd').modal('show');
});
function success(){
	var firstname = "<?php echo $firstname;?>",
	lastname = "<?php echo $lastname;?>",	
	phonenum = "<?php echo $phonenum;?>",
	email = "<?php echo $email;?>",
	building = "<?php echo $building;?>",
	floor = "<?php echo $floor;?>",
	room = "<?php echo $room;?>",
	fixlist = "<?php echo $fixlist;?>",
	fixprob = "<?php echo $fixprob;?>",
	date = "<?php echo $date;?>",
	time = "<?php echo $time;?>",
	fixetc = "<?php echo $fixetc;?>"	
	$.ajax({
			url: "<?php echo base_url();?>request_fix/accept_data",
			method: "POST",
			data: {
			'firstname':firstname,
            'lastname':lastname,
            'phonenum':phonenum,
            'email':email,
            'building':building,
            'floor':floor,
            'room':room,
            'fixlist':fixlist,
            'fixprob':fixprob,
            'date':date,
            'time':time,
            'fixetc':fixetc
			},		
			dataType:JSON,			
		});
}
$(document).on('click','#redirect',function(){
	$(location).attr('href', '<?php echo base_url();?>request_fix/success');
});
// Data Picker Initialization
$("#datepicker").datepicker({
	format: 'dd-mm-yyyy',
    startDate: "-Infinity",
    todayBtn: "linked",
    language: "th",
    todayHighlight: true
});
// Time Picker Initialization
$('#timepicker').mdtimepicker({
	format: 'hh:mm tt'
});
</script>
</body>
</html>