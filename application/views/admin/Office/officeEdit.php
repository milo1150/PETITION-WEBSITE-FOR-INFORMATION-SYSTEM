<!DOCTYPE html>
<html lang="th">
<head>
</head>
<meta charset="utf8">
<style>
table {
  border-collapse: collapse;
}
</style>

<head>
<div class="wrapper">
<?php $this->load->view('admin/admainEDIT');?>
<body> 
<main>
			<div class="table-responsive">
				<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">แก้ไขสำนักงาน</p>								
				<table class="table table-bordered table-hover text-nowrap mytable shadow" style="margin-top: 10px;" id="">
					<thead class="thead-light z-depth-1">
						<tr>
							<th class="text-center" style="width:10px;">#</th>
							<th class="text-center" style="width:250px;">หัวข้อ</th>
							<th class="text-center" style="width:50px;">แก้ไข</th>
						</tr>				
					</thead>						
				<?php 														                        
					foreach($office as $row){										 
				?>
						<tr>
							<td class="text-center font-weight-bolder red accent-3" style="padding-top:21px; font-size:16px; width: 6%;"><?php echo $row->id;?></td>
							<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;"><?php echo $row->title_th;?></td>						
							<td class="text-center font-weight-bolder" style="width: 15%;">														
							<form action="<?php echo base_url();?>office/content" method="POST"><button value="<?php echo $row->id;?>" name="id" type="submit" class="btn orange accent-2"><i class="fas fa-edit" ></i></button></form>																								
							</td>
						</tr>					
				<?php } ?>
				</tr>				
				</table>

</main>
</div>	
<script>	
	$('.mytable').dataTable({
		order:[[0,'asc']],	
		'orderable': false, "targets": 1		
	});
			
</script>
</body>
</html>
