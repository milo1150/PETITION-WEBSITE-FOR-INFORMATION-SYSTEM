<!doctype html>
<html lang="en">

<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">


	<title>เบิกของ</title>

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

	<?php date_default_timezone_set("Asia/Bangkok");?>
</head>


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
	$firstname = $this->session->getItem_data['firstname'];
	$lastname = $this->session->getItem_data['lastname'];
	$phonenum = $this->session->getItem_data['phonenum'];
	$email = $this->session->getItem_data['email'];
	$section = $this->session->getItem_data['section'];
	$item_list = $this->session->getItem_data['item_list'];
	$date = $this->session->getItem_data['date'];
	$time = $this->session->getItem_data['time'];	

	//$item_list = preg_replace('/\s/','f', $this->session->getItem_data['item_list']);
	echo $item_list;
?>

<div class="table-responsive text-center">
	<div class="container-fluid info-color z-depth-1-half" style="width:100%; font-family: 'Kanit', sans-serif;">
		<h3>แบบฟอร์มเบิกของ</h3>
	</div>
</div>

<form method="post" action="<?php echo base_url()?>request_item/error" style="font-family: 'Kanit', sans-serif;">
	<div class="table-responsive-md pb-4 pt-4" style="background: #f5f3f3;">
		<div class="container" style="max-width:400px;">
			<div class="form-row pb-2">
				<div class="col">
					<label>ชื่อ</label>
					<input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
					<?php echo form_error('firstname'); ?>
				</div>
				<div class="col">
					<label>นามสกุล</label>
					<input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
					<?php echo form_error('lastname'); ?>
				</div>
			</div>
			<div class="form-group">
				<label>เบอร์โทรติดต่อ</label>
				<input type="text" name="phonenum" class="form-control" value="<?php echo $phonenum; ?>">
				<?php echo form_error('phonenum'); ?>
			</div>
			<div class="form-group">
				<label>อีเมลติดต่อ</label>
				<input type="email" name="email" class="form-control" value="<?php echo $email; ?>"> 
				<?php echo form_error('email'); ?>
			</div>
			<div class="form-group">
				<label>สังกัด/แผนก</label>
				<input type="text" name="section" class="form-control" value="<?php echo $section; ?>">
				<?php echo form_error('section'); ?>
			</div>
			<div class="form-group">
				<label>ของที่เบิก</label>
				<textarea class="form-control" rows="5" cols="9" name="item_list" ><?php echo $item_list;?></textarea>
				<?php echo form_error('item_list'); ?>
			</div>				
			<label>กำหนดคืน</label>
			<div class="form-row pb-2">
				<div class="col">
					<input type="text" name="date" class="form-control" id="datepicker" placeholder="วันที่" value="<?php echo $date; ?>">
					<?php echo form_error('date'); ?>
				</div>
				<div class="col">
					<input type="text" name="time" class="form-control" id="timepicker" placeholder="เวลา" style="background-color: #fff" value="<?php echo $time; ?>">
						<?php echo form_error('time'); ?>
				</div>
			</div>
			<div class="text-center pb-4">
				<div class="row justify-content-center pt-2">
					<div class="col-sm-6 pb-2">
						<button type="submit" name="insert" value="Insert" class="btn btn-lg btn-success btn-block" style="font-size:20px;">ยืนยัน</button>
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
<!-- ////////////////////////////////////////////////// MODAL //////////////////////////////////////////////////////// -->
	<div class="modal fade" id="fd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Kanit', sans-serif;">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-body text-center">
					<a class="modal-body" id="exampleModalLabel"><br/>ยืนยันแบบฟอร์มเบิกของ</a>
				</div>																				
				<div class="modal-body row justify-content-center">
					<div class="col-5">
						<form action="<?php echo base_url();?>request_item/accept_data" method="POST">							
							<input type="hidden" name="firstname" value="<?php echo $firstname;?>"></input>
							<input type="hidden" name="lastname"  value="<?php echo $lastname;?>"></input>
							<input type="hidden" name="phonenum"  value="<?php echo $phonenum;?>"></input>
							<input type="hidden" name="email"  value="<?php echo $email;?>"></input>
							<input type="hidden" name="section" value="<?php echo $section;?>"></input>
							<input type="hidden" name="item_list" value="<?php echo $item_list;?>"></input>
							<input type="hidden" name="date"  value="<?php echo $date;?>"></input>
							<input type="hidden" name="time"  value="<?php echo $time;?>"></input>
						<button type="submit" class="btn btn-lg btn-success btn-block" style="font-size:18px;">ใช่</button>
						</form>																								
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
// Data Picker Initialization
$("#datepicker").datepicker({
	format: 'dd-mm-yyyy',
    startDate: "-Infinity",
    daysOfWeekHighlighted: "0,6",
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