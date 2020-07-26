<!DOCTYPE html>
<html lang="en">

<head>

	<style type="text/css">


	</style>
</head>
<div class="wrapper">
	<?php include 'admainEDIT.php'?>
	<body>
		<main>
		<div class="table-responsive">
				<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">รีพอร์ตรายบุคคล - <?php if($_GET['username']){$username = $_GET['username'];} echo $username;?></p>
				<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;"></p>										
				<table class="table table-bordered table-hover text-nowrap mytable" style="margin-top: 10px;" id="">
					<thead class="thead-light z-depth-1">
						<tr>
						<th class="text-center">หมายเลขงาน</th>
							<th class="text-center">ผู้รับงาน</th>
							<th class="text-center">งานที่รับ</th>
							<th class="text-center">วันที่รับงาน</th>
							<th class="text-center">วันที่ปิดงาน</th>
							<th class="text-center">ดูข้อมูล</th>
						</tr>
					</thead>	
				
				<!----------------------------------------------------- FIX  ------------------------------------------------------------------>			
				<?php				
					foreach($fix_list as $row){						 
				?>					
						<tr>
							
							<td class="text-center font-weight-bolder"><?php echo $row->id; ?></td>
							<td class="text-center font-weight-bolder"><?php echo $row->admin_close_name; ?></td>
							<td class="text-center font-weight-bolder"><?php echo $row->type?></td>
							<td class="text-center font-weight-bolder"><?php echo $row->admin_accept_date ?></td>
							<td class="text-center font-weight-bolder"><?php echo $row->admin_close_date ?></td>
							<td class="text-center font-weight-bolder"><i onclick="location.href='<?php echo base_url()?>ad_fix/report_fix_com?rq=<?php echo $row->id;?>'"  class="fas fa-search"></i></td>							
						</tr>					
				<?php }  ?>	

				<!-----------------------------------------------------  ITEM  ------------------------------------------------------------------>
				<?php				
					foreach($item_list as $row){						 
				?>					
						<tr>
							
							<td class="text-center font-weight-bolder"><?php echo $row->id; ?></td>
							<td class="text-center font-weight-bolder"><?php echo $row->admin_close_name; ?></td>
							<td class="text-center font-weight-bolder"><?php echo $row->type?></td>
							<td class="text-center font-weight-bolder"><?php echo $row->admin_accept_date ?></td>
							<td class="text-center font-weight-bolder"><?php echo $row->admin_close_date ?></td>
							<td class="text-center font-weight-bolder"><i onclick="location.href='<?php echo base_url()?>ad_item/report_item_com?rq=<?php echo $row->id;?>'"  class="fas fa-search"></i></td>							
						</tr>					
				<?php }  ?>	

				<!-----------------------------------------------------  EMAIL  ------------------------------------------------------------------>			
				<?php	    																
				    foreach($email_list as $row){						 
				?>						
						<tr>
							<td class="text-center font-weight-bolder"><?php echo $row->id;?></td>
							<td class="text-center font-weight-bolder"><?php echo $row->admin_close_name;?></td>
							<td class="text-center font-weight-bolder"><?php echo $row->type;?></td>
							<td class="text-center font-weight-bolder"><?php echo $row->admin_accept_date;?></td>
							<td class="text-center font-weight-bolder"><?php echo $row->admin_close_date;?></td>
							<td class="text-center font-weight-bolder"><i onclick="location.href='<?php echo base_url()?>ad_email/report_email_com?rq=<?php echo $row->id;?>' "class="fas fa-search"></i></td>							
						</tr>					
				<?php } ?>

				<!-----------------------------------------------------  FINGER  ------------------------------------------------------------------>			
				<?php	    																
				    foreach($finger_list as $row){						 
				?>						
						<tr>
							<td class="text-center font-weight-bolder"><?php echo $row->id;?></td>
							<td class="text-center font-weight-bolder"><?php echo $row->admin_close_name;?></td>
							<td class="text-center font-weight-bolder"><?php echo $row->type;?></td>
							<td class="text-center font-weight-bolder"><?php echo $row->admin_accept_date;?></td>
							<td class="text-center font-weight-bolder"><?php echo $row->admin_close_date;?></td>
							<td class="text-center font-weight-bolder"><i onclick="location.href='<?php echo base_url()?>ad_finger/report_finger_com?rq=<?php echo $row->id;?>' "class="fas fa-search"></i></td>							
						</tr>					
				<?php } ?>							
				</table>				
			</div>
		</main>
</div>

<script>
$('.mytable').dataTable({
		order:[[4,'desc']],			
	});	
</script>


</body>


</html>