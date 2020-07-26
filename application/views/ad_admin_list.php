<!DOCTYPE html>
<html lang="en">

<head>
</head>

<div class="wrapper">
	<?php include 'admainEDIT.php'?>

	<body>
		<main>
		<div class="table-responsive">
			<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold; margin-bottom: -40px;">จัดการสมาชิก</p>
			<form action="./ad_add"><button class="btn green accent-3 font-weight-bolder btn-add"><i class="fas fa-user-plus fa-lg"></i> เพิ่มผู้ใช้งาน</button></form>
			<div class="t-data">
			<table class="table table-bordered table-hover text-nowrap mytable z-depth-1-half" style="margin-top: 10px;">
				<thead class="thead-light z-depth-1">
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">ไอดีพนักงาน</th>
						<th class="text-center">ผู้ใช้งาน</th>
						<th class="text-center">อีเมล</th>
						<th class="text-center">ระดับ</th>
						<th class="text-center">การจัดการ</th>
					</tr>
				</thead>	
				<tbody>
				<?php foreach ($query as $rows) { ?>

					<tr>						
						<td class="text-center font-weight-bolder" style="vertical-align: middle; font-size:16px;"><?php echo $rows->id;?></td>
						<td class="text-center font-weight-bolder" style="vertical-align: middle; font-size:16px;"><?php echo $rows->user_id;?></td>
						<td class="text-center font-weight-bolder"	style="vertical-align: middle; font-size:16px;"><?php echo $rows->username;?></td>
						<td class="text-center font-weight-bolder" style="vertical-align: middle; font-size:16px;"><?php echo $rows->email;?></td>
						<td class="text-center font-weight-bolder" style="vertical-align: middle; font-size:16px;"><?php echo $rows->rank;?></td>
						<td class="text-center" style="display:flex; justify-content: center;">
							<form action="<?php echo base_url();?>ad_admanage/edit" method="POST">
								<button value="<?php echo $rows->id;?>" name="id"  type="submit" class="btn teal accent-3">
									<i class="fas fa-edit"></i>
								</button>
							</form>
							<button type="submit" class="btn red accent-2 bdel" value="<?php echo $rows->id;?>" data-toggle="modal">
								<i class="fas fa-trash-alt"></i>
							</button>
						</td>
					</tr>	
					
				<?php } ?>
				</tbody>	
			</table>
			</div>				
		</div>
		</main>
 
		<div class="modal fade" id="fd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Kanit', sans-serif;">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body text-center">
						<a class="modal-body" style="font-weight: bold; font-size: 1.4rem;"><br/>ยืนยันการลบผู้ใช้</a>
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
<style>
.btn-add{
	margin-left: 16px; 
	font-size: 16px; 
	margin-top: 34px;
}
.t-data{
	padding-top: 7px;
	padding-left: 1%;
	padding-right: 1%;
}
</style>
<script>
	function sendid(id = 'id'){
		$.ajax({
			url: "<?php echo base_url();?>ad_min/edit",
			method: "POST",
			dataType: 'json',
			data: {	'id': id },
			success:function(data){
				$(location).attr('href', '<?php echo base_url();?>ad_min/edit_detail');	
			},
		})
	};
	$('.bdel').on('click', function(){
		var id = $(this).attr('value');
		//alert(id);
		$('#fd').data('id',id).modal('show');
		//$('#fd').modal('show');
	});
	$('#conf').on('click', function(){
		var id = $('#fd').data('id');
		//alert(id);
		$.ajax({
			url: "<?php echo base_url('ad_admanage/del'); ?>",
			type: "POST",
			data: {id:id},
			dataType: "json",
			success: function(data){
				//alert("ลบผู้ใช้เรียบร้อย...");
				$('#fd').modal('hide');
				location.reload();
			},
			error: function(){
				alert("เกิดข้อผิดพลาด...");
				$('#fd').modal('hide');
				location.reload();
			}
		});
	});
	$('.mytable').dataTable({
		order:[[0,'asc']],				
	});
</script>
</html>