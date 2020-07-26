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

	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

	<?php date_default_timezone_set("Asia/Bangkok");?>
</head>


<style>	
h1{
    font-size:40px;
	font-weight:bold;
    padding-bottom:20px;	
	text-shadow:1px 1px 2px;
}
</style>
	<?php	
			//print_r($_SESSION);
			//echo $firstname;
		?>
<form action="<?php echo base_url()?>request" style="font-family: 'Kanit', sans-serif;">
	<div class="table-responsive-md pb-4 pt-4">
		<div class="container text-center" style="max-width:800px; padding-top:200px;">
			<h1>ทำรายการเสร็จสมบูรณ์</h1>
			<div class="text-center">
				<div class="row justify-content-center pt-2">
					<div class="col-sm-5" style="max-width:350px;">
						<button class="btn btn-lg btn-success btn-block"
							style="font-size:20px;">กลับไปหน้าแรก</button>
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