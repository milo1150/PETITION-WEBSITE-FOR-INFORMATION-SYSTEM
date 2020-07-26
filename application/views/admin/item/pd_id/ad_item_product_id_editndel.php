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
			<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">
				แก้ไขรายการครุภัณฑ์</p>
			<div class="row" style="margin-top:-20px; margin-bottom:20px; float:left;">
				<form action="<?php echo base_url()?>ad_item/item_product_id"><button
						class="btn red accent-2 font-weight-bolder" style="margin-left: 16px; font-size: 16px;"><i
							class="fas fa-arrow-circle-left"></i> ย้อนกลับ</button></form>
			</div>
			<!---------------------------------------- Main Table --------------------------------------------->
			<table class="table table-bordered table-hover text-nowrap mytable shadow" style="margin-top: 10px;">
				<thead class="thead-light z-depth-1">
					<tr>
						<th class="text-center" style="width:30px;">id</th>
						<th class="text-center" style="width:600px;">รายการวัสดุ</th>
						<th class="text-center" style="width:50px;">เลขครุภัณฑ์</th>
						<th class="text-center" style="width:50px;">สถานะ</th>
						<th class="text-center" style="width:50px;">แก้ไข</th>
						<th class="text-center" style="width:50px;">ลบ</th>
					</tr>
				</thead>
				<tbody>
					<?php 				    
						foreach($item_product_id as $row){
					?>
					<tr>
						<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;">
							<?php echo $row->id;?></td>
						<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;">
							<?php echo $row->item_name;?></td>
						<td class="text-center font-weight-bolder " style="padding-top:21px; font-size:16px;">
							<?php echo $row->item_id;?></td>
						<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;">
							<?php 
								$x = $row->item_status; 
								if($x==0){echo '<i class="fas fa-check-circle" style="font-size: 23px; color:green"></i>';}
								if($x==1){echo '<i class="fas fa-times-circle" style="font-size: 23px; color:red"></i>';}
							?>
						</td>
						<td class="text-center font-weight-bolder">
							<button
								onclick="edit(td_status = <?php echo $row->item_status;?> , td_id = <?php echo $row->id;?> , td_name = '<?php echo $row->item_name;?>' , product_id = '<?php echo $row->item_id;?>' , f_year = '<?php echo $row->f_year;?>' , n_request = '<?php echo $row->n_request;?>' , place = '<?php echo $row->place;?>')"
								class="btn teal accent-3" <?php $x = $row->item_status; if($x==1){echo 'disabled';}?>><i
									class="fas fa-edit"></i></button></form>
						</td>
						<td class="text-center font-weight-bolder">
							<button
								onclick="del(del_id = <?php echo $row->id;?> , td_name = '<?php echo $row->item_name;?>' , product_id = '<?php echo $row->item_id;?>')"
								class="btn red accent-2" <?php $x = $row->item_status; if($x==1){echo 'disabled';}?>><i
									class="fas fa-trash-alt"></i></button></form>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>



		<!----------------------------------------- Edit item model------------------------------------------->
		<div class="modal fade " id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true" style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
			<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 590px;">
				<div class="modal-content z-depth-2 md-box">
					<div class="modal-body text-center">
						<br />
						<i class="fas fa-edit" style="font-size:25px;"></i><a class="font-weight-bolder"
							style="font-size:24px;"> แก้ไขรายการครุภัณฑ์</a>
					</div>
					<div class="modal-body">
						<div class="justify-content-center box1">
						<div class="row row-input">
								<label>ID</label>
								<input type="text" class="form-control input-shd" id="iid" readonly></input>
							</div>
							<div class="row row-input">
								<label>ชื่อ</label>
								<input type="text" class="form-control input-shd" id="item_name"
									oninput="reV(tp = 'error_name')"></input>
							</div>
							<span class="err_text" id="error_name"></span>
							<div class="row row-input">
								<label>เลขครุภัณฑ์</label>
								<input type="text" class="form-control input-shd" id="item_id"
									oninput="reV(tp = 'error_id')"></input>
							</div>
							<span class="err_text" id="error_id"></span>
							<div class="row row-input">
								<label>ปีงบประมาณ</label>
								<input type="text" class="form-control input-shd" id="f_year" maxlength="4"
									oninput="reV(tp = 'error_f_year')"></input>
							</div>
							<span class="err_text" id="error_f_year"></span>
							<div class="row row-input">
								<label>ผู้เบิก</label>
								<input type="text" class="form-control input-shd" id="n_request"
									oninput="reV(tp = 'error_n_request')"></input>
							</div>
							<span class="err_text" id="error_n_request"></span>
							<div class="row row-input">
								<label>สถานที่ติดตั้ง</label>
								<input type="text" class="form-control input-shd" id="place"
									oninput="reV(tp = 'error_place')"></input>
							</div>
							<span class="err_text" id="error_place"></span>
						</div>
					</div>
					<div class="modal-body text-center">
						<div class="row justify-content-center mb-3">
							<div class="col-4">
								<button id="edit_done" class="btn btn-md btn-block green accent-3 text-white"
									style="font-size:16px;">ยืนยัน</button>
							</div>
							<div class="col-4">
								<button onclick="dis_modal()" class="btn btn-md btn-block red accent-4 text-white"
									style="font-size:16px;" id="closemodal">ยกเลิก</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		
		<!---------------------------------------------------------------------------------------------------------------------------------->

		<!----------------------------------------- Del item model------------------------------------------->
		<div class="modal fade " id="del_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true" style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
			<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
				<div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
					<div class="modal-body text-center">
						<br />
						<i class="fas fa-trash-alt" style="font-size:25px;"></i><a class="font-weight-bolder"
							style="font-size:24px;"> ลบรายการ</a>
					</div>
					<div class="modal-body text-center">
						<div class="row justify-content-center mb-3">
							<div class="col-4">
								<button id="del_done" class="btn btn-md btn-block green accent-3 text-white"
									style="font-size:16px;">ยืนยัน</button>
							</div>
							<div class="col-4">
								<button onclick="dis_modal()" class="btn btn-md btn-block red accent-4 text-white"
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
	<style>
		.md-box {
			padding-inline-end: 20px;
			padding-inline-start: 20px;
		}

		.box1 {
			display: grid;
		}

		.row-input {
			place-content: flex-end;
			padding-bottom: 9px;
			width: 350px;
		}

		.row-input label {
			position: relative;
			padding-right: 14px;
			font-weight: bold;
			top: 7px;

		}

		.input-shd {
			max-width: 209px;
			box-shadow: 3px 3px 1px #aaaaaa;
			max-width: 250px;
		}

		.err_text {
			/* justify-self: center; */
			padding-left: 32%;
			position: relative;
			bottom: 7px;
			right: 14px;
			margin-bottom: -6px;
		}

		.err_text p {
			margin-bottom: 0px;
			color: red;
			font-size: 1rem;
		}

	</style>
	<script>
		function dis_modal() {
			$('#edit_modal').modal('hide');
			$('#del_modal').modal('hide');
			$('#error_name').html('');
			$('#error_id').html('');
			$('#error_f_year').html('');
			$('#error_n_request').html('');
			$('#error_place').html('');
			document.getElementById('iid').value = ""
			document.getElementById('item_name').value = ""
			document.getElementById('item_id').value = ""
			document.getElementById('f_year').value = ""
			document.getElementById('n_request').value = ""
			document.getElementById('place').value = ""
		}

		function reV(id) {
			document.getElementById(id).innerHTML = ""
		}

		function edit() {
			$('#edit_modal').modal('show');

			//----- Get and Set modal value ----- 
			document.getElementById('iid').value = td_id
			document.getElementById('item_name').value = td_name
			document.getElementById('item_id').value = product_id
			document.getElementById('f_year').value = f_year
			document.getElementById('n_request').value = n_request
			document.getElementById('place').value = place
			var df_name = td_name;
			var df_item_id = product_id;

			//------ On click ยืนยัน ------
			$('#edit_done').click(function () {
				var ad_username = '<?php echo $this->session->userdata('username');?>';
				var id = td_id;
				var new_name = document.getElementById('item_name').value;
				var new_product_id = document.getElementById('item_id').value;
				var new_f_year = document.getElementById('f_year').value;
				var new_n_request = document.getElementById('n_request').value;
				var new_place = document.getElementById('place').value;
				$.ajax({
					url: "<?php echo base_url();?>ad_item/item_product_id_edit",
					method: "POST",
					dataType: "JSON",
					data: {
						'id': id,
						'item_name': new_name,
						'df_name': df_name,
						'item_id': new_product_id,
						'df_item_id': df_item_id,
						'ad_username': ad_username,
						'f_year':new_f_year,
						'n_request':new_n_request,
						'place':new_place
					},
					success: function (data) {
						$('#error_name').html(data.error_name);
						$('#error_id').html(data.error_id);
						$('#error_f_year').html(data.error_f_year);
						$('#error_n_request').html(data.error_n_request);
						$('#error_place').html(data.error_place);
						console.log(data)
						if (data.item_name != null) {
							$(location).attr('href',
								'<?php echo base_url();?>ad_item/item_product_id_editndel')
						}
					}
				})
			})
		}

		function del() {
			$('#del_modal').modal('show');
			$('#del_done').click(function () {
				var ad_username = '<?php echo $this->session->userdata('
				username ');?>';
				var id = del_id;
				var item_name = td_name;
				var item_id = product_id;
				$.ajax({
					url: "<?php echo base_url()?>ad_item/item_product_id_del",
					method: "POST",
					data: {
						'id': id,
						'ad_username': ad_username,
						'item_name': item_name,
						'item_id': item_id
					},
					success: function () {
						$(location).attr('href',
							'<?php echo base_url();?>ad_item/item_product_id_editndel')
					}
				})
			})
		}
		$('.mytable').dataTable({
			order: [
				[0, 'asc']
			],
		});

	</script>
</body>

</html>
