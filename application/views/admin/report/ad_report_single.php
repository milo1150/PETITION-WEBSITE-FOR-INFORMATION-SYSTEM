<!DOCTYPE html>
<html lang="en">
<head>
</head>
<div class="wrapper">
<?php $this->load->view('admin/admainEDIT');?>
	<?php 
	//print_r($_SESSION);
	?>
	<body>
		<main>
		<div class="table-responsive">			
				<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">รีพอร์ตรายบุคคล</p>										
				<table class="table table-bordered table-hover text-nowrap mytable" style="margin-top: 10px;" id="">
					<thead class="thead-light z-depth-1">
						<tr>
							<th class="text-center" style="width:100px;">ID</th>
							<th class="text-center" style="width:2000px;">Name</th>							
							<th class="text-center">ดูข้อมูล</th>
						</tr>
					</thead>										
				<?php 																								
					foreach($ad_list as $row){						
				?>						
						<tr>
							<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;"><?php echo $row->id;?></td>
							<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;"><?php echo $row->username;?></td>
							<td class="text-center font-weight-bolder">
							<form action="<?php echo base_url();?>ad_report/admin_report" method="POST"><button value="<?php echo $row->username;?>" name="username"  type="submit" class="btn cyan lighten-3"><i class="fas fa-search" ></i></button></form>													
							<!-- <button onclick="sendid(id = '<?php echo $row->id;?>')" type="submit" class="btn cyan lighten-3" style=""><i class="fas fa-search" ></i></button>-->									
							</td>
						</tr>					
				<?php } ?>
				</tr>			
				</table>				
			</div>
		</main>
</div>

<script>/*
	function test(){
		//$(location).attr('href','<?php echo base_url();?>ad_report/report_ad_single_detail');
		//$(location).attr('href','<?php echo base_url();?>ad_report/report_ad_single_detail');
		//window.location.href = "<?php echo base_url();?>ad_report/report_ad_single_detail";
	}
	function sendid(id = 'id'){		
		$.ajax({
			url: "<?php echo base_url();?>ad_report/report_single",
			method: "POST",
			data: {	'id': id },
			success:$(location).attr('href','<?php echo base_url();?>ad_report/report_ad_single_detail'),			
		})
	};
	*/
	$('.mytable').dataTable({
		order:[[0,'asc']],	
		'orderable': false, "targets": 1		
	});	
</script>


</body>


</html>