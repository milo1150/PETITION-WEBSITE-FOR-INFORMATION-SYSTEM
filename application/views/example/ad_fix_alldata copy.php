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
			<div class="table-responsive" style="overflow-x: hidden;">
				<!----------------------------------------------------Header-------------------------------------------------------->
				<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">ข้อมูลแจ้งซ่อม</p>

				<!-------------------------------------------------Filter Serch----------------------------------------------------->
				
					<div class="form-row pb-4 pt-4">
						<div class="col">
							<select id="fixlist"class="form-control z-depth-1">																
								<option value="">เลือกรายการแจ้ง</option>
								<option value="แจ้งปัญหาระบบอินเทอร์เน็ต">แจ้งปัญหาระบบอินเทอร์เน็ต</option>
								<option value="แจ้งปัญหาเว็บไซต์">แจ้งปัญหาเว็บไซต์</option>
								<option value="แจ้งปัญหาระบบเครือข่าย">แจ้งปัญหาระบบเครือข่าย</option>
								<option value="แจ้งปัญหาปริ้นเตอร์">แจ้งปัญหาปริ้นเตอร์</option>
								<option value="แจ้งอุปกรณ์ชำรุด">แจ้งอุปกรณ์ชำรุด</option>
								<option value="แจ้งปัญหาคอมพิวเตอร์">แจ้งปัญหาคอมพิวเตอร์</option>						
							</select>
						</div>
						<div class="col">
							<select id="building" class="form-control z-depth-1">
								<option value="">อาคาร</option>
								<option value="42">42</option>
								<option value="62">62</option>
								<option value="63">63</option>
								<option value="64">64</option>
								<option value="65">65</option>
								<option value="66">66</option>
								<option value="67">67</option>
								<option value="68">68</option>
								<option value="69">69</option>
								<option value="90">90</option>
								<option value="91">91</option>
								<option value="97">97</option>													
							</select>
						</div>
						<div class="col">
						<select id="floor" class="form-control z-depth-1">
								<option value="">ชั้น</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>			
							</select>
						</div>
						<div class="col">
							<input type="text" id="room" class="form-control z-depth-1"  placeholder="ห้อง">
						</div>
						
						<div class="col-0.5" style="margin-top: -6px;">
							<button class="btn cyan lighten-3" id="filter" onclick=""><i class="fas fa-search" ></i></button>
						</div>
					</div>			
							

				<!------------------------------------------------- Table Show Data------------------------------------------------->
				<table class="table table-bordered table-hover text-nowrap shadow" style="margin-top:10px;  ">
					<thead class="thead-light z-depth-1">
						<tr>
							<th class="text-center" style="width:10px;">#</th>
							<th class="text-center" style="width:250px;">ประเภท</th>
							<th class="text-center" style="width:350px;">สถานที่</th>
							<th class="text-center" style="width:10px;">ดูข้อมูล</th>
						</tr>
					</thead>	
						<tbody class="" id="output">
														
						</tbody>
							

							<!--
						<tbody>	
							<tr>
								<td class=""  id="idd">id</td>
								
								<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;">ตึก ชั้น  ห้อง </td>
								<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;">ดดดดด</td>						
								<td class="text-center font-weight-bolder">	
								<form action="<?php echo base_url();?>ad_fix/report_fix_com" method="POST"><button value="" name="id"  type="submit" class="btn cyan lighten-3"><i class="fas fa-search" ></i></button></form>													
								</td> 

							</tr>
						</tbody>
							
-->
																
				</table>
			</div>			
		</main>
</div>	
<script>
	$('#filter').on('click',function(e){
		var fixlist = $('#fixlist').val();
		var building = $('#building').val();
		var floor = $('#floor').val();
		var room = $('#room').val();
		$.ajax({
			url:"<?php echo base_url();?>ad_fix/filter_serch",
			method:"POST",
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
					console.log(dRow[i])
					//console.log(data[i].id)
					//$('#output').html(dRow[i].id)
				}
				$('#output').html(dRow)

/*
				data.forEach(data => {
					
					//$('#output').append('<tr><td>'+data.id+'<td><tr>')
					$('#output').html(data.id)
					console.log(data.id)
				});*/




				/*$.each(data,function(posi,value){
					console.log(data)
					console.log(posi)
					console.log(value.id)	
					//$('.output').html('<tr> <td class="text-center font-weight-bolder green accent-3" style="padding-top:21px; font-size:16px;" id="'+value.id+'">'+value.id+'</td></tr>')
									
				})*/
			}	
					
		})
	})
	
	$('.mytable').dataTable({
		order:[[0,'desc']],	
		'orderable': false, "targets": 1,
		"language": {
			"emptyTable": "ไม่มีข้อมูล",
		},
		"searching": false,
			
	});
</script>
</body>
</html>


