<!doctype html>
<html lang="en">

<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">


	<title></title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url();?>/mdbootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="<?php echo base_url();?>/mdbootstrap/css/mdb.min.css" rel="stylesheet">
	<!-- Your custom styles (optional) -->
	<link href="<?php echo base_url();?>/mdbootstrap/css/style.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="dashboard.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

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
	$firstname = $this->session->getFinger_data['firstname'];
	$lastname = $this->session->getFinger_data['lastname'];
	$phonenum = $this->session->getFinger_data['phonenum'];
	$phonein = $this->session->getFinger_data['phonein'];
	$email = $this->session->getFinger_data['email'];
	$section = $this->session->getFinger_data['section'];
	$rank = $this->session->getFinger_data['rank'];
?>

<div class="table-responsive text-center">
	<div class="container-fluid success-color z-depth-1-half" style="width:100%; font-family: 'Kanit', sans-serif;">
		<h3>แบบฟอร์มสแกนนิ้ว</h3>
	</div>
</div>
<form method="post" action="<?php echo base_url()?>index.php/request_finger/error" style="font-family: 'Kanit', sans-serif;">
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
				<label>เบอร์ติดต่อ (ส่วนตัว)</label>
				<input type="text" name="phonenum" class="form-control" value="<?php echo $phonenum; ?>">
				<?php echo form_error('phonenum'); ?>
			</div>
			<div class="form-group">
				<label>เบอร์ติดต่อ (ภายใน)</label>
				<input type="text" name="phonein" class="form-control" value="<?php echo $phonein; ?>">
				<?php echo form_error('phonein'); ?>
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
				<label>ตำแหน่ง</label>
				<input type="text" name="rank" class="form-control" value="<?php echo $rank; ?>">
				<?php echo form_error('rank'); ?>
			</div>			
			<div class="text-center pb-4">
				<div class="row justify-content-center pt-2">	
					<div class="col-sm-6 pb-2">
						<button type="submit" name="insert" value="Insert" class="btn btn-lg btn-success btn-block"
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
	integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
	integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
	integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
</body>

</html>