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
				<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">รีพอร์ตรายบุคคล</p>										
				<table class="table table-bordered table-hover text-nowrap mytable" style="margin-top: 10px;" id="">
					<thead class="thead-light z-depth-1">
						<tr>
							<th class="text-center" style="width:5px;">ID</th>
							<th class="text-center" style="width:700px;">Name</th>
							<th class="text-center" style="width:5px;">ดูข้อมูล</th>
						</tr>
					</thead>	
				
					
				<?php			    
					$mysqli = new mysqli('localhost','root','','project');		
					$mysqli->set_charset('utf8mb4'); 	
					$result = $mysqli->query('SELECT * FROM admin_login WHERE 1');						
					while($row = mysqli_fetch_array($result)):
						$id = $row['id'];
						//$username = $row['username'];	 
				?>						
						<tr>
							<td class="text-center font-weight-bolder"><?php echo $row['id'] ?></td>
							
							<td class="text-center font-weight-bolder"><a href="<?php echo base_url()?>ad_list/ad_list_report?username=<?php echo $row['username']?>" onclick="">Click</a></td>
						</tr>					
				<?php endwhile;?>
				</tr>				
				</table>
			</div>
									
	</main>
</div>

<script>
	function ad_list_show(){
		var id = '<?php echo $id; ?>';
		alert(id);
	}

</script>


</body>


</html>