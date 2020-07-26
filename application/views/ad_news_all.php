<!DOCTYPE html>
<html lang="th">
<meta charset="utf8">
<style>
	.test {
		padding-top: 60px;
		font-size: 16px;
	}

	table {
		border-collapse: collapse;
	}
</style>

<head>
	<div class="wrapper">
		<?php include 'admainEDIT.php' ?>

<body>
	<main>
		<div class="table-responsive">
			<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">รายการข่าว</p>
			<button class="btn btn-primary btn-sm" id="newsadd" name="newsadd" style="font-size: 15px; margin-bottom: 20px;">
				เพิ่มข่าวใหม่
			</button>
			<table class="table table-bordered table-hover text-nowrap mytable">
				<thead class="thead-light z-depth-1">
					<tr class="">
						<th class="text-center">#</th>
						<th class="text-center">ประเภทข่าว</th>
						<th class="text-center n_title">หัวข้อข่าว</th>
						<th class="text-center">วันที่ / เวลา</th>
						<th class="text-center">สถานะ</th>
						<th class="text-center">การจัดการ</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($ndata as $row) { ?>
						<tr>
							<td class="text-center font-weight-bolder red accent-3 n_data_sty1"><?php echo $row->id; ?></td>
							<td class="text-center font-weight-bolder n_data_sty1"><?php echo $row->type; ?></td>
							<td class="text-center font-weight-bolder n_data_sty1 n_title"><?php echo $row->title; ?></td>
							<td class="text-center font-weight-bolder n_data_sty1"><?php echo date('d-m-Y', strtotime($row->post_date)) . ' / ' . $row->post_time; ?></td>
							<td class="text-center font-weight-bolder">
								<button class="btn orange accent-2 news_btn" value="<?php echo $row->status; ?>" onclick="status(<?php echo $row->id ?>,this)"><i class="fas <?php if ($row->status == 1) { echo 'fa-eye';	};
																																												   if ($row->status == 0) { echo 'fa-eye-slash'; }; ?>"></i></button>
							</td>
							<td class="text-center font-weight-bolder edit_n_del">
								<form action="<?php echo base_url() ?>ad_news/news_edit" method="POST"><button type="submit" value="<?php echo $row->id; ?>" name="id" class="btn teal accent-3 news_btn"><i class="fas fa-edit"></i></button></form>
								<button onclick="del(del_id = '<?php echo $row->id; ?>')" class="btn red accent-2"><i class="fas fa-trash-alt"></i></button></form>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</main>
	<!----------------------------------------- Del item model------------------------------------------->
	<div class="modal fade " id="del_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
			<div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
				<div class="modal-body text-center">
					<br />
					<i class="fas fa-trash-alt" style="font-size:25px;"></i><a class="font-weight-bolder" style="font-size:24px;"> ลบข่าว</a>
				</div>
				<div class="modal-body text-center">
					<div class="row justify-content-center mb-3">
						<div class="col-4">
							<button id="del_done" class="btn btn-md btn-block green accent-3 text-white" style="font-size:16px;">ยืนยัน</button>
						</div>
						<div class="col-4">
							<button onclick="dis_modal()" class="btn btn-md btn-block red accent-4 text-white" style="font-size:16px;" id="closemodal">ยกเลิก</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-------------------------------------------------------------------------------------------------------------------->
</body>
<script>
	$(document).on('click', '#newsadd', function() {
		$(location).attr('href', '<?php echo base_url(); ?>ad_news/ad_news_add');
	});


	//----------------------- Change News Status -----------------------
	function status(id, element) {
		if (element.value == 1) {
			//console.log(element.value)
			element.value = 0;
			let new_s_value = element.value
			element.childNodes[0].classList.remove('fa-eye')
			element.childNodes[0].classList.add('fa-eye-slash')
			//console.log(element.value)
			$.ajax({
				url: '<?php echo base_url(); ?>Ad_news/news_status',
				method: 'post',
				datatype: 'json',
				data: {
					'id': id,
					'u_status': new_s_value
				}
			})
			return;
		}
		if (element.value == 0) {
			//console.log(element.value)
			element.value = 1;
			let new_s_value = element.value
			element.childNodes[0].classList.remove('fa-eye-slash')
			element.childNodes[0].classList.add('fa-eye')
			//console.log(element.value)
			$.ajax({
				url: '<?php echo base_url(); ?>Ad_news/news_status',
				method: 'post',
				datatype: 'json',
				data: {
					'id': id,
					'u_status': new_s_value
				}
			})
			return;
		}
	}

	//--------------------------------- Delete ------------------------------
	function del() {
		$('#del_modal').modal('show')
	}
	$('#del_done').click(function() {
		var id = del_id;
		console.log(id)
		$.ajax({
			url: "<?php echo base_url() ?>Ad_news/news_del",
			method: "POST",
			data: {
				'id': id
			},
			success: function() {
				$(location).attr('href', '<?php echo base_url(); ?>Ad_news')
			}
		})
	})

	function dis_modal() {
		$('#del_modal').modal('hide')
	}

	$('.mytable').dataTable({
		order: [
			[0, 'desc']
		],
		'orderable': false,
		"targets": 1,
		
	});
</script>

</html>