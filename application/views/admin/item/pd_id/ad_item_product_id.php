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
			<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">
				รายการครุภัณฑ์</p>
			<!---------------------------------------- ADD / DEL ITEM --------------------------------------------->
			<div class="row" style="margin-top:-20px; margin-bottom:20px; float:left;">
				<button id="addbtn" class="btn green accent-3 font-weight-bolder"
					style="margin-left: 18px; font-size: 16px;"><i class="fas fa-plus"></i> เพิ่มรายการ</button>
				<form action="<?php echo base_url()?>ad_item/item_product_id_editndel"><button
						class="btn warning-color font-weight-bolder" style="margin-left: 10px; font-size: 16px;"><i
							class="fas fa-edit"></i> แก้ไขรายการ</button></form>
				<form action="<?php echo base_url()?>ad_item/item_product_id_log"><button
						class="btn secondary-color font-weight-bolder" style="margin-left: 10px; font-size: 16px;"><i
							class="fas fa-tasks"></i> ประวัติรายการ</button></form>
			</div>
			<!---------------------------------------- Main Table --------------------------------------------->
			<table class="table table-bordered table-hover text-nowrap mytable shadow" style="margin-top: 10px;">
				<thead class="thead-light z-depth-1">
					<tr>
						<th class="text-center" style="width:30px;">id</th>
						<th class="text-center" style="width:600px;">รายการ</th>
						<th class="text-center" style="width:50px;">เลขครุภัณฑ์</th>
						<th class="text-center" style="width:50px;">สถานะ</th>
						<th class="text-center" style="width:50px;">ดูข้อมูล</th>
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
						<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;">
							<?php echo $row->item_id;?></td>
						<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;">
							<?php 
								$x = $row->item_status; 
								if($x==0){echo '<i class="fas fa-check-circle" style="font-size: 23px; color:green"></i>';}
								if($x==1){echo '<i class="fas fa-times-circle" style="font-size: 23px; color:red"></i>';}
							?>
						</td>
						<td class="text-center font-weight-bolder">
							<form action="<?php echo base_url();?>ad_item/history_pdid" method="GET"><button
									value="<?php echo $row->item_id;?>" name="item_id" type="submit"
									class="btn cyan lighten-3"><i class="fas fa-search"></i></button></form>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>



		<!----------------------------------------- Add item modal------------------------------------------->
		<div class="modal fade " id="add_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true" style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
			<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 590px;">
				<div class="modal-content z-depth-2 md-box">
					<div class="modal-body text-center">
						<br />
						<i class="fas fa-copy" style="font-size:25px;"></i><a class="font-weight-bolder"
							style="font-size:24px;"> เพิ่มรายการ</a>
					</div>
					<div class="modal-body">
						<div class="justify-content-center box1">
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
		$('#addbtn').click(function () {
			$('#add_item').modal('show');
		})
		$('#closemodal').click(function () {
			$('#add_item').modal('hide');
			$('#error_name').html('');
			$('#error_id').html('');
			$('#error_f_year').html('');
			$('#error_n_request').html('');
			$('#error_place').html('');
			document.getElementById('item_name').value = ""
			document.getElementById('item_id').value = ""
			document.getElementById('f_year').value = ""
			document.getElementById('n_request').value = ""
			document.getElementById('place').value = ""
		})

		function reV(id) {
			document.getElementById(id).innerHTML = ""
		}

		function add_item() {
			const ad_username = '<?php echo $this->session->userdata('
			username ');?>';
			const item_name = $('#item_name').val();
			const item_id = $('#item_id').val();
			const f_year = $('#f_year').val();
			const n_request = $('#n_request').val();
			const place = $('#place').val();
			$.ajax({
				url: "<?php echo base_url();?>ad_item/item_product_id_add",
				method: "POST",
				dataType: "JSON",
				data: {
					'item_name': item_name,
					'item_id': item_id,
					'ad_username': ad_username,
					'f_year': f_year,
					'n_request': n_request,
					'place': place
				},
				success: function (data) {
					$('#error_name').html(data.error_name);
					$('#error_id').html(data.error_id);
					$('#error_f_year').html(data.error_f_year);
					$('#error_n_request').html(data.error_n_request);
					$('#error_place').html(data.error_place);
					// console.log(data)
					if (data.item_name != null) {
						$(location).attr('href', '<?php echo base_url();?>ad_item/item_product_id')
					}
				}
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
