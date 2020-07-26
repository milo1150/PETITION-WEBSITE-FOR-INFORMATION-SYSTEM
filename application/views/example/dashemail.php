
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
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

<div class="table-responsive text-center">
	<div class="container-fluid warning-color z-depth-1-half" style="width:100%; height:250px; font-family: 'Kanit', sans-serif;">
		<h3>แบบฟอร์มขอเปิดอีเมล์</h3>
	</div>
</div>

<form method="post" action="<?php echo base_url()?>index.php/dash_fix/dashtest" style="font-family: 'Kanit', sans-serif;">
	<div class="table-responsive-md pb-4 pt-4">
		<div class="container" style="max-width:400px;">
			<form class="" method="" action="">
				<div class="form-row pb-2">
					<div class="col">
						<label>วันที่</label>
						<input type="text" name="" class="form-control" placeholder="<?php echo "".date("d/m/Y")?>">
					</div>
					<div class="col">
						<label>เวลา</label>
						<input type="text" name="" class="form-control" placeholder="<?php echo "".date("H:i:s")?>">
					</div>
				</div>
				<div class="form-row pb-2">
					<div class="col">
						<label>ชื่อ</label>
						<input type="text" name="firstname" class="form-control" placeholder="">
						<span class="text-danger"><?php echo form_error("firstname")?></span>
					</div>
					<div class="col">
						<label>นามสกุล</label>
						<input type="text" name="lastname" class="form-control" placeholder="">
						<span class="text-danger"><?php echo form_error("lastname")?></span>
					</div>
				</div>
				<div class="form-group">
					<label>เบอร์โทรติดต่อ</label>
					<input type="text" name="phonenum" class="form-control" placeholder="" maxlength="15">
					<span class="text-danger"><?php echo form_error("phonenum")?></span>
				</div>
				<div class="form-group">
					<label>สังกัด/แผนก</label>
					<input type="text" name="place" class="form-control" placeholder="" maxlength="10">
					<span class="text-danger"><?php echo form_error("place")?></span>
				</div>
				<div class="form-group">
					<label>ชื่ออีเมล์ที่ขอเปิดใช้</label>
					<input type="text" name="fixlist" class="form-control" placeholder="">
					<span class="text-danger"><?php echo form_error("fixlist")?></span>
				</div>
				<div class="form-group">
					<label>ตำแหน่ง</label>
					<input type="text" name="fixprob" class="form-control" placeholder="">
					<span class="text-danger"><?php echo form_error("fixprob")?></span>
				</div>
				<div class="form-group">
					<label>เบอร์ติดต่อภายใน</label>
					<input type="text" name="fixetc" class="form-control" placeholder="">
					<span class="text-danger"><?php echo form_error("fixetc")?></span>
				</div>
				<div>
				</div>
			</form>
			<div class="text-center pb-4">
				<div class="row justify-content-center pt-2">
					<div class="col-sm-6">
						<button type="submit" name="insert" value="Insert" class="btn btn-lg btn-success btn-block"
							style="font-size:20px;">ยืนยัน</button></div>
				</div>
			</div>
		</div>
		<?php if($this->uri->segment(2)=="inserted"){echo '<p>ส่งคำขอเรียบร้อย</P>';}?>
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
