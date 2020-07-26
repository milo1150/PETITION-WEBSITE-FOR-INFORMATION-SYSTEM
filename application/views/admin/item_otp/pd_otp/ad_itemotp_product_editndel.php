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

			<div class="table-responsive" style="overflow-x:hidden;">
				<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">เบิกของ - แก้ไขรายการวัสดุ</p>		
				<div class="row" style="margin-top:-20px; margin-bottom:20px; float:left;">
					<form action="<?php echo base_url()?>ad_itemotp/item_product"><button class="btn red accent-2 font-weight-bolder" style="margin-left: 16px; font-size: 16px;"><i class="fas fa-arrow-circle-left"></i> ย้อนกลับ</button></form>						
				</div>				<!---------------------------------------- Main Table --------------------------------------------->						
				<table class="table table-bordered table-hover text-nowrap mytable shadow" style="margin-top: 10px;">
					<thead class="thead-light z-depth-1">
						<tr>
							<th class="text-center" style="width:30px;">id</th>
							<th class="text-center" style="width:600px;">รายการวัสดุ</th>							
							<th class="text-center" style="width:50px;">จำนวน</th>
							<th class="text-center" style="width:50px;">แก้ไข</th>
							<th class="text-center" style="width:50px;">ลบ</th>		
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
								<button onclick = "edit(td_id = <?php echo $row->id;?> , td_name = '<?php echo $row->item_name;?>' , td_unit = '<?php echo $row->item_unit_remain;?>')" 
								class="btn teal accent-3"><i class="fas fa-edit"></i></button>																								
							</td>
							<td class="text-center font-weight-bolder">
								<button onclick = "del(del_id = <?php echo $row->id;?> , td_name = '<?php echo $row->item_name;?>' , td_unit = '<?php echo $row->item_unit_remain;?>')" class="btn red accent-2"><i class="fas fa-trash-alt"></i></button>																							
							</td>					
					<?php } ?>
					</tbody>				
				</table>
			</div>


						
			<!----------------------------------------- Edit item modal------------------------------------------->
			<div class="modal fade " id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" 
				style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
					<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px;">
						<div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
							<div class="modal-body text-center">
								<br/>
								<i class="fas fa-edit" style="font-size:25px;"></i><a class="font-weight-bolder" style="font-size:24px;">   แก้ไขรายการ</a>																
							</div>																										
								<div class="modal-body text-center">
									<div class="row justify-content-center mb-3">
										<div class="col-3 form-inline">
											<div class="row" style="padding-inline-start:20px; padding-inline-end: 20px;">
												<label>id&nbsp;&nbsp;</label>
												<input type="text" class="form-control" id="edit_item_id" style="max-width: 173px; box-shadow: 5px 5px 1px #aaaaaa;"readonly></input>
											</div>
										</div>
										<div class="col-3 form-inline">
											<div class="row">
												<label>ชื่อ&nbsp;&nbsp;</label>
												<input type="text" class="form-control" id="edit_item_name" style="max-width: 209px; box-shadow: 5px 5px 1px #aaaaaa;"></input>
													<span id="error_name" style="max-height: 0px; padding-left: 30px;"></span>
											</div>
										</div>
										
										<div class="col-3 form-inline">											
											<div class="row" style="padding-inline-start:20px; padding-inline-end: 20px;">
												<label>จำนวน&nbsp;&nbsp;</label>
													<input type="text" class="form-control" id="edit_item_unit" style="max-width: 144px; box-shadow: 5px 5px 1px #aaaaaa;"></input>
														<span id="error_unit" style="max-height: 0px; padding-left: 56px;"></span>
											</div>
										</div>		
									</div>
								</div>
								<div class="modal-body text-center">
									<div class="row justify-content-center mb-3" style="padding-left: 200px; padding-right: 200px;">
										<div class="col-4">																													
											<button id="edit_done" class="btn btn-md btn-block green accent-3 text-white" style="font-size:16px;">ยืนยัน</button>																																		
										</div>
										<div class="col-4">	
											<button onclick = dis_modal() class="btn btn-md btn-block red accent-4 text-white" style="font-size:16px;" id="closemodal">ยกเลิก</button>																															
										</div>	
									</div>
								</div>																											
							</div>
						</div>
					</div>				
				<!---------------------------------------------------------------------------------------------------------------------------------->
				
				<!----------------------------------------- Del item modal------------------------------------------->
				<div class="modal fade " id="del_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" 
					style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
					<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
						<div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
							<div class="modal-body text-center">
								<br/>
								<i class="fas fa-trash-alt" style="font-size:25px;"></i><a class="font-weight-bolder" style="font-size:24px;">   ลบรายการ</a>																
							</div>																																
								<div class="modal-body text-center">
									<div class="row justify-content-center mb-3">
										<div class="col-4">																													
											<button  id="del_done" class="btn btn-md btn-block green accent-3 text-white" style="font-size:16px;">ยืนยัน</button>																																		
										</div>
										<div class="col-4">	
											<button  onclick="dis_modal()"class="btn btn-md btn-block red accent-4 text-white" style="font-size:16px;" id="closemodal">ยกเลิก</button>																															
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
function dis_modal(){
	document.getElementById('error_name').innerHTML = "";
	document.getElementById('error_unit').innerHTML = "";
	$('#edit_modal').modal('hide');
	$('#del_modal').modal('hide');
	
}



function edit(){
	$('#edit_modal').modal('show');	

	// Get and Set default modal value 
	document.getElementById('edit_item_id').value = td_id;
	document.getElementById('edit_item_name').value = td_name;
	document.getElementById('edit_item_unit').value = td_unit;
	

    // On click ยืนยัน
	$('#edit_done').click(function(){
		const ad_username = '<?php echo $this->session->userdata('username');?>';	
		const id = td_id;
		const name = td_name;
		const unit = td_unit;
		const new_name = document.getElementById('edit_item_name').value;
		const new_unit = document.getElementById('edit_item_unit').value;
		console.log()
		$.ajax({
			url:"<?php echo base_url();?>ad_itemotp/item_product_edit",
			method:"POST",
			dataType:"JSON",
			data:
			{
				'ad_username':ad_username,'item_id':id,
				'item_old_name':name,'item_old_unit':unit,
				'item_new_name':new_name,'item_new_unit':new_unit,
			},
			success:function(data){
				$('#error_name').html(data.error_name);
				$('#error_unit').html(data.error_unit);
				console.log(data)
				if(data.item_name!=null){
					$(location).attr('href','<?php echo base_url();?>ad_itemotp/item_product_editndel')
				}
			}
		})
	})
}



function del(){
	$('#del_modal').modal('show');
	$('#del_done').click(function(){
		var ad_username = '<?php echo $this->session->userdata('username');?>';	
		var id = del_id;
		var name = td_name;
		var unit = td_unit;
		$.ajax({
			url:"<?php echo base_url()?>ad_itemotp/item_product_del",
			method:"POST",
			data:{'item_id':id,'item_name':name,'item_unit':unit,'ad_username':ad_username},
			success:function(){
				$(location).attr('href','<?php echo base_url();?>ad_itemotp/item_product_editndel')
			}
		})
	})	
}



















	$('.mytable').dataTable({
		order:[[0,'asc']],			
	});
</script>	
</body>
</html>


