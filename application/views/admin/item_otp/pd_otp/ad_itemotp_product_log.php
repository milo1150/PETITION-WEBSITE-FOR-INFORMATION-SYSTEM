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
			<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">LOG -
				รายการเบิกวัสดุ</p>
			<!---------------------------------------- ADD / DEL ITEM --------------------------------------------->
			<div class="row" style="margin-top:-20px; margin-bottom:20px; float:left;">
				<form action="<?php echo base_url()?>ad_itemotp/item_product"><button
						class="btn red accent-2 font-weight-bolder" style="margin-left: 16px; font-size: 16px;"><i
							class="fas fa-arrow-circle-left"></i> ย้อนกลับ</button></form>
			</div>
			<!---------------------------------------- Main Table --------------------------------------------->
			<table class="table table-bordered table-hover text-nowrap mytable shadow" style="margin-top: 10px;">
				<thead class="thead-light z-depth-1">
					<tr>
						<th class="text-center" style="width:50px;">action</th>
						<th class="text-center" style="width:50px;">หมายเลข</th>
						<th class="text-center" style="width:px;">รายการ</th>
						<th class="text-center" style="width:px;">จำนวน</th>
						<th class="text-center" style="width:px;">โดย</th>
						<th class="text-center" style="width:px;">วันที่</th>
						<th class="text-center" style="width:px;">เวลา</th>
					</tr>
				</thead>
				<tbody>
					<?php 				    
						foreach($itemotp_log as $row){
					?>
					<tr>
						<td class="text-center font-weight-bolder" style="padding-top:15px; font-size:16px;">
							<?php echo $row->action;?></td>
						<td class="text-center font-weight-bolder" style="padding-top:15px; font-size:16px;">
							<?php echo $row->item_id;?></td>
						<td class="text-center font-weight-bolder " style="padding-top:15px; font-size:16px;">
							<?php echo $row->item_name;?></td>
						<td class="text-center font-weight-bolder " style="padding-top:15px; font-size:16px;">
							<?php echo $row->item_unit;?></td>
						<td class="text-center font-weight-bolder " style="padding-top:15px; font-size:16px;">
							<?php echo $row->ad_name;?></td>
						<td class="text-center font-weight-bolder " style="padding-top:15px; font-size:16px;">
							<?php echo date('Y-m-d',strtotime($row->date))?></td>
						<td class="text-center font-weight-bolder " style="padding-top:15px; font-size:16px;">
							<?php echo $row->time;?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>



		<!----------------------------------------- Add item model------------------------------------------->
		<div class="modal fade " id="add_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true" style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
			<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px;">
				<div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
					<div class="modal-body text-center">
						<br />
						<i class="fas fa-copy" style="font-size:25px;"></i><a class="font-weight-bolder"
							style="font-size:24px;"> เพิ่มรายการ</a>
					</div>

					<div class="modal-body text-center">

						<div class="row justify-content-center mb-3">
							<div class="col-3 form-inline">
								<div class="row">
									<label>ชื่อ&nbsp;&nbsp;</label>
									<input type="text" class="form-control" id="item_name"
										style="max-width: 209px; box-shadow: 5px 5px 1px #aaaaaa;"></input>
									<span id="error_name" style="max-height: 0px; padding-left: 30px;"></span>
								</div>
							</div>
							<div class="col-4 form-inline">
								<div class="row" style="padding-inline-start:20px; padding-inline-end: 20px;">
									<label>จำนวน&nbsp;&nbsp;</label>
									<input type="text" class="form-control" id="item_unit"
										style="max-width: 209px; box-shadow: 5px 5px 1px #aaaaaa;"></input>
									<span id="error_unit" style="max-height: 0px; padding-left: 56px;"></span>
								</div>
							</div>



						</div>
					</div>
					<div class="modal-body text-center">
						<div class="row justify-content-center mb-3" style="padding-left: 200px; padding-right: 200px;">
							<div class="col-4">
								<button onclick="add_item()" class="btn btn-md btn-block green accent-3 text-white"
									style="font-size:16px;">ยืนยัน</button>
							</div>
							<div class="col-4">
								<button type="button" class="btn btn-md btn-block red accent-4 text-white"
									style="font-size:16px;" id="closemodal">ยกเลิก</button>
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
		$('#addbtn').click(function () {
			$('#add_item').modal('show');
		})
		$('#closemodal').click(function () {
			$('#add_item').modal('hide');
			$('#error_name').html('');
			$('#error_unit').html('');
			var item_name = document.getElementById('item_name');
			item_name.value = "";
			var item_unit = document.getElementById('item_unit');
			item_unit.value = "";
		})

		function add_item() {
			var item_name = $('#item_name').val();
			var item_unit = $('#item_unit').val();
			$.ajax({
				url: "<?php echo base_url();?>ad_item/item_product_add",
				method: "POST",
				dataType: "JSON",
				data: {
					'item_name': item_name,
					'item_unit': item_unit
				},
				success: function (data) {
					$('#error_name').html(data.error_name);
					$('#error_unit').html(data.error_unit);
					console.log(data)
					if (data.item_name != null) {
						$(location).attr('href', '<?php echo base_url();?>ad_item/item_product')
					}
				}
			})

		}



















		$('.mytable').dataTable({
			order: [
				[5, 'desc']
			],
		});

	</script>
</body>

</html>
