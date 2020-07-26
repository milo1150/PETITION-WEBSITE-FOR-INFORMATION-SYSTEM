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
<?php include 'admainEDIT.php'?>
<body> 
<main>
				<!------------------------------------------------- Table Show Data------------------------------------------------->
				<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">รายการที่แจ้ง</p>
				<div class="table-responsive">
				<table class="table table-bordered table-hover mytable text-nowrap shadow" style="margin-top:10px;  ">
					<thead class="thead-light z-depth-1">
						<tr>
							<th class="text-center" style="width:10px;">#</th>			
							<th class="text-center" style="width:200px;">ประเภท</th>					
							<th class="text-center" style="width:200px;">สถานะ</th>	
							<th class="text-center" style="width:200px;">วันที่แจ้ง</th>
																														
							<th class="text-center" style="width:10px;">ดูข้อมูล</th>
						</tr>
					</thead>	
						<tbody>
							<?php							                        	
								for($i=0;$i<count($remain);$i++) //เข้า array ทีละตำแหน่ง และวน foreach ใล่ ข้างในอีกที
									foreach($remain[$i] as $row){					 
							?>						
								<tr>
									<td class="text-center font-weight-bolder <?php if($row->order_status == 0){echo "red accent-3";}if($row->order_status == 1){echo "amber darken-1";}?>" style="padding-top:21px; font-size:16px;" ><?php echo $row->id;?></td>
									<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;"><?php echo $row->type;?></td>
									<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;"><?php if($row->order_status==0){echo 'ยังไม่ได้ดำเนินการ';} if($row->order_status==1){echo 'กำลังดำเนินการ';} if($row->order_status==2){echo 'เสร็จสมบูรณ์';}?></td>
									<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;"><?php echo date('Y-m-d',strtotime($row->date_request));?></td>																				
									<td class="text-center font-weight-bolder">									
										<form 
											action="
												<?php if($row->order_status==0 && $row->type=='แจ้งซ่อม')echo base_url().'ad_fix/report_fix_order';?>
												<?php if($row->order_status==1 && $row->type=='แจ้งซ่อม')echo base_url().'ad_fix/report_fix_inproc';?>
												<?php if($row->order_status==0 && $row->type=='ยืมของ')echo base_url().'ad_item/report_item_order';?>
												<?php if($row->order_status==1 && $row->type=='ยืมของ')echo base_url().'ad_item/report_item_inproc';?>
												<?php if($row->order_status==0 && $row->type=='ขอเปิดอีเมล์')echo base_url().'ad_email/report_email_order';?>
												<?php if($row->order_status==0 && $row->type=='สแกนนิ้ว')echo base_url().'ad_finger/report_finger_order';?>
												<?php if($row->order_status==0 && $row->type=='เบิกของ')echo base_url().'ad_itemotp/report_itemotp_order';?>
											" method="POST">
										<button value="<?php echo $row->id;?>" name="id"  type="submit" class="btn cyan lighten-3"><i class="fas fa-search" ></i></button></form>																		
									</td>

								</tr>						
							<?php  } ?>														
						</tbody>													
				</table>
				</div>
</main>
</div>	
<script>	
	$('.mytable').dataTable({
		order:[[3,'asc']],	
		'orderable': false, "targets": 1		
	});
			
</script>
</body>
</html>
