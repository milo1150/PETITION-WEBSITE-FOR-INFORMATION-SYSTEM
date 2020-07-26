<!DOCTYPE html>
<html lang="th">
<meta charset="utf8">
<style>
table {
  border-collapse: collapse;
}
</style>

<head>
<div class="wrapper">
<?php include 'admainEDIT.php'?>
<body> 
<main>
			<!-- /////////////////////////////////////////////// ORDER ////////////////////////////////////////////////////  -->	
			<div class="table-responsive">
				<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">รีพอร์ตเวลางาน</p>		
								
				<table class="table table-bordered table-hover text-nowrap mytable shadow" style="margin-top: 10px;">
					<thead class="thead-light z-depth-1">
						<tr>
							<th class="text-center" style="width:100px;">ID SCAN</th>
							<th class="text-center" style="width:250px;">ชื่อ / นามสกุล</th>
							<th class="text-center" style="width:350px;">สังกัด / แผนก</th>
							<th class="text-center" style="width:350px;">ตำแหน่ง</th>
							<th class="text-center" style="width:50px;">ดูข้อมูล</th>		
						</tr>
					</thead>
				<?php 																								
					foreach($finger_report as $row){						
				?>						
						<tr>
							<td class="text-center font-weight-bolder" style="padding-top: 21px; font-size:16px;"><?php echo $row->id_scan;?></td>
							<td class="text-center font-weight-bolder" style="padding-top: 21px; font-size:16px;"><?php echo $row->firstname.' '.$row->lastname;?></td>
							<td class="text-center font-weight-bolder" style="padding-top: 21px; font-size:16px;"><?php echo $row->section;?></td>
							<td class="text-center font-weight-bolder" style="padding-top: 21px; font-size:16px;"><?php echo $row->rank;?></td>
							<td class="text-center font-weight-bolder">	
							<form action="<?php echo base_url();?>ad_finger/report_finger_com" method="POST"><button value="<?php echo $row->id;?>" name="id"  type="submit" class="btn cyan lighten-3" style="height:40px;"><i class="fas fa-search" ></i></button></form>																										
							</td>
						</tr>					
				<?php } ?>									
				</table>
			</div>
</main>
</div>
<script>
	$('.mytable').dataTable({
		order:[[0,'desc']],				
	});
</script>	
</body>
</html>


