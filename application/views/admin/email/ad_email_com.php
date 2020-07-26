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
<?php $this->load->view('admin/admainEDIT');?>
<body> 
<main>
			<!-- /////////////////////////////////////////////// COMPLETE ////////////////////////////////////////////////////  -->			
			<div class="table-responsive">
				<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">รายการขอเปิดอีเมล์ - เสร็จสมบูรณ์</p>		
								
				<table class="table table-bordered table-hover text-nowrap mytable shadow" style="margin-top: 10px;">
					<thead class="thead-light z-depth-1">
						<tr>
							<th class="text-center" style="width:10px;">#</th>
							<th class="text-center" style="width:250px;">ชื่อ / นามสกุล</th>
							<th class="text-center" style="width:350px;">สังกัด / แผนก</th>
							<th class="text-center" style="width:350px;">วันที่ปิดงาน / เวลา</th>
							<th class="text-center" style="width:50px;">ดูข้อมูล</th>		
						</tr>
					</thead>									
					<?php 				    
						foreach($email_com as $row){
					?>						
						<tr>
							<td class="text-center font-weight-bolder green accent-3" style="padding-top:21px; font-size:16px;"><?php echo $row->id;?></td>
							<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;"><?php echo $row->firstname.' '.$row->lastname;?></td>
							<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;"><?php echo $row->section;?></td>
							<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;"><?php echo date('d-m-Y',strtotime($row->admin_close_date));?> / <?php echo $row->admin_close_time;?></td>
							<td class="text-center font-weight-bolder">
							<form action="<?php echo base_url();?>ad_email/report_email_com" method="POST"><button value="<?php echo $row->id;?>" name="id"  type="submit" class="btn cyan lighten-3"><i class="fas fa-search" ></i></button></form>							
							</td>
							</tr>					
					<?php } ?>
				</tr>				
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


