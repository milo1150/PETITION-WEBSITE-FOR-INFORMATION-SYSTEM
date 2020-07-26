<!DOCTYPE html>
<html lang="th">
<head>
<title>ข้อมูลแจ้งซ่อม</title>
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
<?php //print_r($_SESSION)
	//print_r($output);
	//print_r($num)
	//echo $floor;
?>
<body> 
<main>
			<div class="table-responsive" style="overflow-x: hidden;">
				<!----------------------------------------------------Header-------------------------------------------------------->
				<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">ข้อมูลแจ้งซ่อม</p>

				<!-------------------------------------------------Filter Serch----------------------------------------------------->
				<form action="<?php echo base_url()?>ad_fix/filter_serch" method="GET">
					<div class="form-row pb-4 pt-4">
						<div class="col">
							<select id="fixlist" name="fixlist" class="form-control z-depth-1">
								<option value="">เลือกรายการแจ้ง</option>															
								<option>แจ้งปัญหาระบบอินเทอร์เน็ต</option>
								<option>แจ้งปัญหาเว็บไซต์</option>
								<option>แจ้งปัญหาระบบเครือข่าย</option>
								<option>แจ้งปัญหาปริ้นเตอร์</option>
								<option>แจ้งอุปกรณ์ชำรุด</option>
								<option>แจ้งปัญหาคอมพิวเตอร์</option>						
							</select>
						</div>
						<div class="col">
							<select id="building" name="building" class="form-control z-depth-1">
								<option value="">อาคาร</option>
								<option>42</option>
								<option>62</option>
								<option>63</option>
								<option>64</option>
								<option>65</option>
								<option>66</option>
								<option>67</option>
								<option>68</option>
								<option>69</option>
								<option>90</option>
								<option>91</option>
								<option>97</option>													
							</select>
						</div>
						<div class="col">
						<select id="floor" name="floor" class="form-control z-depth-1">
								<option value="">ชั้น</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
								<option>7</option>
								<option>8</option>
								<option>9</option>
								<option>10</option>			
							</select>
						</div>
						<div class="col">
							<input type="text" id="room" name="room" class="form-control z-depth-1" placeholder="ห้อง" value=""></input>
						</div>
						
						<div class="col-0.5" style="margin-top: -6px;">
							<button class="btn cyan lighten-3" id="" type="submit"><i class="fas fa-search" ></i></button>
						</div>
					</div>	
				</form>		
							

				<!------------------------------------------------- Table Show Data------------------------------------------------->
				<table class="table table-bordered table-hover mytable text-nowrap shadow" style="margin-top:10px;  ">
					<thead class="thead-light z-depth-1">
						<tr>
							<th class="text-center" style="width:10px;">#</th>
							<th class="text-center" style="width:10px;">สถานะ</th>
							<th class="text-center" style="width:250px;">ประเภท</th>
							<th class="text-center" style="width:350px;">สถานที่</th>
							<th class="text-center" style="width:10px;">ดูข้อมูล</th>
						</tr>
					</thead>	
						<tbody>
							<?php													                        
								foreach($output as $row){										 
							?>						
								<tr>
									<td class="text-center font-weight-bolder <?php if($row->order_status == 0){echo "red accent-3";}if($row->order_status == 1){echo "amber darken-1";}if($row->order_status == 2){echo "green accent-3";}if($row->order_status == 3){echo "purple lighten-1";}?>" style="padding-top:21px; font-size:16px;" ><?php echo $row->id;?></td>
									<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;"><?php if($row->order_status==0){echo 'ยังไม่ได้ดำเนินการ';} if($row->order_status==1){echo 'กำลังดำเนินการ';} if($row->order_status==2){echo 'เสร็จสมบูรณ์';}if($row->order_status==3){echo 'ยกเลิกรายการ';}?></td>
									<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;"><?php echo $row->fixlist;?></td>
									<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;">อาคาร <?php echo $row->building;?> ชั้น <?php echo $row->floor;?> ห้อง <?php echo $row->room;?></td>						
									<td class="text-center font-weight-bolder">									
									<form action="<?php if($row->order_status == 0){echo base_url().'ad_fix/report_fix_order';}if($row->order_status == 1){echo base_url().'ad_fix/report_fix_inproc';}if($row->order_status == 2){echo base_url().'ad_fix/report_fix_com';}if($row->order_status == 3){echo base_url().'ad_fix/report_fix_cancle';}?>" method="POST"><button value="<?php echo $row->id;?>" name="id"  type="submit" class="btn cyan lighten-3"><i class="fas fa-search" ></i></button></form>																		
									</td>

								</tr>					
						<?php } ?>
														
						</tbody>
													
				</table>
			</div>			
		</main>
</div>	
<script>
	// SET fixlist filter (ดึง element ทั้งก้อนมาแล้วเปลี่ยน value)
	a = document.getElementById('fixlist');
	a.value = '<?php echo $fixlist;?>';

	// SET building filter
	b = document.getElementById('building');
	b.value = '<?php echo $building?>';

	// SET building filter
	c = document.getElementById('floor');
	c.value = '<?php echo $floor?>';

	// SET building filter
	d = document.getElementById('room');
	d.value = '<?php echo $room?>';

	/*
	$('#filter').on('click',function(e){
		var fixlist = $('#fixlist').val();
		var building = $('#building').val();
		var floor = $('#floor').val();
		var room = $('#room').val();
		$.ajax({
			url:"<?php echo base_url();?>ad_fix/filter_serch",
			method:"GET",
			dataType:"json",
			data:{'fixlist':fixlist,'building':building,'floor':floor,'room':room},
			success:
			function(data){
				dRow = Array();				
				for(i=0;i<data.length;i++){
					dRow[i] = '<tr>'+
								'<td class="text-center font-weight-bolder green accent-3" style="padding-top:px; font-size:18px;">'+data[i].id+'</td>'+
							  	'<td class="text-center font-weight-bolder" style="padding-top:px; font-size:18px;">'+data[i].fixlist+'</td>'+
								'<td class="text-center font-weight-bolder" style="padding-top:px; font-size:18px;"> อาคาร '+data[i].building+' ชั้น '+data[i].floor+' ห้อง '+data[i].room+'</td>'+
								'<td class="text-center font-weight-bolder">'+
									'<form action="<?php echo base_url();?>ad_fix/report_fix_com" method="POST" style="margin-top:-10px; margin-bottom:-10px;">'+
										'<button value="'+data[i].id+'"name="id" type="submit" class="btn cyan lighten-3"><i class="fas fa-search"></i></button>'
									'</form>'
								'<td>'
							  '</tr>'
				}
				$('#output').html(dRow)
			}	
					
		})
	})
	*/
	$('.mytable').dataTable({
		order:[[0,'desc']],	
		'orderable': false, "targets": 1,
		"language": {
			"emptyTable": "ไม่มีข้อมูล",
		},
		"searching": true,
			
	});
</script>
</body>
</html>


