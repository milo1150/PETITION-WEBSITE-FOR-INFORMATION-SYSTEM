<!DOCTYPE html>
<html lang="th">
<meta charset="utf8">
<head>
<title>คำร้องของยืมของ - กำลังดำเนินการ</title>
</head>
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
			<!-- /////////////////////////////////////////////// INPROC ////////////////////////////////////////////////////  -->
			<div class="table-responsive">
				<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">คำร้องของยืมของ - กำลังดำเนินการ</p>								
				<table class="table table-bordered table-hover text-nowrap mytable shadow" style="margin-top: 10px;">
					<thead class="thead-light z-depth-1">
						<tr>
							<th class="text-center" style="width:30px;">#</th>
							<th class="text-center" style="width:250px;">ชื่อ / นามสกุล</th>
							<th class="text-center" style="width:350px;">สังกัด / แผนก</th>
							<th class="text-center" style="width:350px;">วันที่แจ้ง / เวลา</th>
							<th class="text-center" style="width:50px;">ดูข้อมูล</th>		
						</tr>
					</thead>	
					<?php 				    
						foreach($item_inproc as $row){
					?>						
						<tr>
							<td class="text-center font-weight-bolder amber darken-1" style="padding-top:21px; font-size:16px;"><?php echo $row->id;?></td>
							<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;"><?php echo $row->firstname.' '.$row->lastname;?></td>
							<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;"><?php echo $row->section;?></td>
							<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;"><?php echo date('d-m-Y',strtotime($row->date_request));?> / <?php echo $row->time_request;?></td>
							<td class="text-center font-weight-bolder">	
							<form action="<?php echo base_url();?>ad_item/report_item_inproc" method="POST"><button value="<?php echo $row->id;?>" name="id"  type="submit" class="btn cyan lighten-3"><i class="fas fa-search" ></i></button></form>																								
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


