<!doctype html>
<html lang="en">

<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>แบบประเมินงาน</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<link href="<?php echo base_url();?>/mdbootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>/mdbootstrap/css/mdb.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>/mdbootstrap/css/style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	<script  src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/starrating/src/css/star-rating-svg.css">
	<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script> -->
	<script src="<?php echo base_url();?>/starrating/src/jquery.star-rating-svg.js"></script>

	<!-------- Sidebar CSS + Custom CSS ------------>    
    <link href="<?php echo base_url(); ?>/mdbootstrap/css/utility.css" rel="stylesheet">	
	<?php date_default_timezone_set("Asia/Bangkok");?>
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

	<div class="table-responsive text-center">
		<div class="container-fluid" style="width:100%; height:180px; font-family: 'Kanit', sans-serif;">
			<h3>แบบประเมินผลการทำงาน</h3>
		</div>
	</div>

	<?php 
	//print_r($this->session->email_data);
	//print_r($_COOKIE);
	//echo $id;
	?>
	 <div id="fix_form" style="font-family: 'Kanit', sans-serif;"> 
		<div class="table-responsive-md pb-4">
			<div class="container" style="max-width:500px;">
				<div class="form-group z-depth-1" style="padding: 22px;">
					<div class="form-group text-center">
						<label class="" style="font-size:30px;">ให้คะแนนผลงาน</label>
							<div class="my-rating pt-4 pb-4">
								
							</div>
					</div>
					<div class="form-group">
						<label>แนะนำเพิ่มเติม</label>
						<textarea class="form-control" rows="5" cols="9" name="fixetc"></textarea>
					</div>
					<div class="text-center pb-4">
						<div class="row justify-content-center pt-2">
							<div class="col-sm-8 pb-2">
								<button type="submit" name="insert" value="Insert" class="btn btn-lg btn-success btn-block"
									style="font-size:20px;">ยืนยันการประเมิน</button>
							</div>
							<!-- <div class="col-sm-6">
								<a href="<?php echo base_url()?>request">
									<button type="button" class="btn btn-lg btn-danger btn-block" style="font-size:20px;">ย้อนกลับ</button>
								</a>
							</div>					 -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>

// Rating Initialization
$(".my-rating").starRating({
    starSize: 40,
	useFullStars: true,
	starShape: 'rounded',
    emptyColor: 'lightgray',
	hoverColor: 'salmon',
	activeColor: 'crimson',
    disableAfterRate: false,
    callback: function(currentRating, $el){
    	$t = currentRating;
	    //alert($t);
  	}
});
$(document).on('click','button[name="insert"]',function(){
	var comment = $('textarea[name="fixetc"]').val();
	var rating = $t;
	var reqid = '<?php echo $_GET['reqid'];?>';
	$.ajax({
			url: "<?php echo base_url();?>rating/rated",
			method: "POST",
			data: {
			'rating':rating,
            'comment':comment,
			'reqid':reqid,
			},	
			success: $(location).attr('href', '<?php echo base_url();?>request'),				
		});
});

</script>
</body>
</html>