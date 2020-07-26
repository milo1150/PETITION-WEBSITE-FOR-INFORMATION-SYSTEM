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

			<div class="table-responsive" style="overflow-x:hidden;">
				<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">เบิกของ - รายการวัสดุ</p>
				<!---------------------------------------- ADD / DEL ITEM --------------------------------------------->		
					<div class="row" style="margin-top:-20px; margin-bottom:20px; float:left;">
						<button id="addbtn" class="btn green accent-3 font-weight-bolder" style="margin-left: 18px; font-size: 16px;"><i class="fas fa-plus"></i> เพิ่มรายการ</button>							
						<form action="<?php echo base_url()?>ad_itemotp/item_product_editndel"><button class="btn warning-color font-weight-bolder" style="margin-left: 10px; font-size: 16px;"><i class="fas fa-edit"></i> แก้ไขรายการ</button></form>
						<form action="<?php echo base_url()?>ad_itemotp/itemotp_product_log"><button class="btn secondary-color font-weight-bolder" style="margin-left: 10px; font-size: 16px;"><i class="fas fa-tasks"></i> ประวัติรายการ</button></form>
					</div>
				<!---------------------------------------- Main Table --------------------------------------------->						
				<table class="table table-bordered table-hover text-nowrap mytable shadow" style="margin-top: 10px;">
					<thead class="thead-light z-depth-1">
						<tr>
							<th class="text-center" style="width:30px;">id</th>
							<th class="text-center" style="width:600px;">รายการ</th>							
							<th class="text-center" style="width:50px;">จำนวน</th>
							<th class="text-center" style="width:50px;">ดูข้อมูล</th>		
						</tr>
					</thead>	
					<tbody>								
					<?php 				    
						foreach($itemotp_product as $row){
					?>						
						<tr>
							<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;"><?php echo $row->id;?></td>
							<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;"><?php echo $row->item_name;?></td>
							<td class="text-center font-weight-bolder " style="padding-top:21px; font-size:16px; color:#da1010;"><?php echo $row->item_unit_remain;?></td>
							<td class="text-center font-weight-bolder">	
								<form action="<?php echo base_url();?>ad_itemotp/history" method="GET"><button value="<?php echo $row->item_name;?>" name="item_name"  type="submit" class="btn cyan lighten-3"><i class="fas fa-search" ></i></button></form>																								
							</td>
						</tr>					
					<?php } ?>
					</tbody>				
				</table>
			</div>


						
			<!----------------------------------------- Add item model------------------------------------------->
			<div class="modal fade " id="add_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" 
				style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
					<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px;">
						<div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
							<div class="modal-body text-center">
								<br/>
								<i class="fas fa-copy" style="font-size:25px;"></i><a class="font-weight-bolder" style="font-size:24px;">   เพิ่มรายการ</a>																
							</div>		
																															
								<div class="modal-body text-center">
									
									<div class="row justify-content-center mb-3">
										<div class="col-3 form-inline">
											<div class="row">
												<label>ชื่อ&nbsp;&nbsp;</label>
												<input type="text" class="form-control" id="item_name" style="max-width: 209px; box-shadow: 5px 5px 1px #aaaaaa;" ></input>
													<span id="error_name" style="max-height: 0px; padding-left: 30px;"></span>
											</div>
										</div>
										<div class="col-4 form-inline">
										<div class="row" style="padding-inline-start:20px; padding-inline-end: 20px;">
												<label>จำนวน&nbsp;&nbsp;</label>
												<input type="text" class="form-control" id="item_unit" style="max-width: 209px; box-shadow: 5px 5px 1px #aaaaaa;"></input>
													<span id="error_unit" style="max-height: 0px; padding-left: 56px;"></span>
											</div>
										</div>
						
						
										
									</div>
								</div>
								<div class="modal-body text-center">
									<div class="row justify-content-center mb-3" style="padding-left: 200px; padding-right: 200px;">
										<div class="col-4">																													
											<button onclick="add_item()" class="btn btn-md btn-block green accent-3 text-white" style="font-size:16px;">ยืนยัน</button>																																		
										</div>	
										<div class="col-4">	
											<button type="button" class="btn btn-md btn-block red accent-4 text-white" style="font-size:16px;" id="closemodal">ยกเลิก</button>																															
										</div>	
									</div>
								</div>																												
							</div>
						</div>
					</div>
				
				<!-------------------------------------------------------------------------------------------------------------------->						

</main>
</div>	
<script>
$('#addbtn').click(function(){
	$('#add_item').modal('show');
})	
$('#closemodal').click(function(){
	$('#add_item').modal('hide');
	$('#error_name').html('');
	$('#error_unit').html('');
	var item_name = document.getElementById('item_name');
	item_name.value = "";
	var item_unit = document.getElementById('item_unit');
	item_unit.value = "";
})
function add_item(){
	var ad_username = '<?php echo $this->session->userdata('username');?>';	
	var item_name = $('#item_name').val();
	var item_unit = $('#item_unit').val();
	$.ajax({
		url:"<?php echo base_url();?>ad_itemotp/item_product_add",
		method:"POST",
		dataType:"JSON",
		data:{'item_name':item_name , 'item_unit':item_unit , 'ad_username':ad_username },
		success:function(data){
			$('#error_name').html(data.error_name);
			$('#error_unit').html(data.error_unit);
			console.log(data)
			if(data.item_name!=null){
				$(location).attr('href','<?php echo base_url();?>ad_itemotp/item_product')
			}
		}
	})
	
}



















	$('.mytable').dataTable({
		order:[[0,'asc']],			
	});
</script>	
</body>
</html>


