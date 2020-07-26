<!DOCTYPE html>
<html lang="en">

<head>
</head>

<div class="wrapper">
	<?php include 'admainEDIT.php'?>

	<body>
		<main>
		<div class="table-responsive">
			<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">ข้อมูลสมาชิก</p>
			<div style="text-align: -webkit-center;">
				<div class="table-responsive-md pb-4 pt-4 z-depth-2" style="text-align: left; width: 34%; margin-left: 20%; margin-bottom: 5%; margin-right: 20%;">
					<div class="container" style="max-width:400px;">						
						<div class="form-group">
							<label>ฃื่อผู้ใช้ระบบ</label>
							<input type="text" name="username" class="form-control" value="<?php echo $username?>" disabled>
							
						</div>
						<div class="form-group">
							<label>ไอดีพนักงาน</label>
							<input type="text" name="user_id" class="form-control" value="<?php echo $user_id?>" disabled>
							
						</div>
						<div class="form-group">
							<label>อีเมล</label>
							<input type="text" name="email" id="email" class="form-control" value="<?php echo $email?>" style="box-shadow: 5px 5px 1px #aaaaaa;">
							
						</div>
						<div class="form-group">
							<label>ระดับ</label>
							<select class="form-control" id="rank" style="box-shadow: 5px 5px 1px #aaaaaa;">
								<option>super_admin</option>
								<option>admin</option>
							</select>
							
						</div>
						<div class="text-center" style="padding-top: 13px;">
							<div class="row justify-content-center pt-2">
								<div class="col-sm-6 pb-2">
									<button type="submit" name="edit" value="Insert" class="btn btn-lg btn-success btn-block edit" style="font-size:20px;" data-toggle="modal">แก้ไข</button>
								</div>
								<div class="col-sm-6">
									<a href="<?php echo base_url()?>ad_admanage/ad_list">
										<button type="button" class="btn btn-lg btn-danger btn-block" style="font-size:20px;">ย้อนกลับ</button>
									</a>
								</div>				
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		</main>
		<div class="modal fade" id="fd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Kanit', sans-serif;">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body text-center">
						<a class="modal-body" style="font-weight: bold; font-size: 1.4rem;"><br/>ยืนยันการแก้ไขข้อมูล</a>
					</div>
					<div class="modal-body row justify-content-center" style="padding-bottom: 30px;">
						<div class="col-5">
							<button type="button" class="btn btn-lg btn-success btn-block" id="conf" style="font-size:18px;">ใช่</button>
						</div>
						<div class="col-5">
							<button type="button" class="btn btn-lg btn-danger btn-block" data-dismiss="modal"  style="font-size:18px;">ไม่ใช่</button>
						</div>										
					</div>
				</div>
			</div>
		</div>
	</body>
<script>
	document.getElementById("rank").value = "<?php echo $rank?>";

	var id = <?php echo $id;?>;
	$('.edit').on('click', function(){	
		$('#fd').modal('show');
		// console.log(id+ email + rank);
	});

	$('#conf').on('click', function(){
		var email = document.getElementById("email").value;
		var rank = document.getElementById("rank").value;
		$.ajax({
			url: "<?php echo base_url('ad_admanage/update'); ?>",
			type: "POST",
			data: {'id':id,
				'email':email,
				'rank':rank
			},
			dataType: "json",
			success: function(data){
				$(location).attr('href', '<?php echo base_url();?>ad_admanage/ad_list');
			},
		});
	});
	$('.mytable').dataTable({
		order:[[4,'desc']],			
	});
</script>
</html>