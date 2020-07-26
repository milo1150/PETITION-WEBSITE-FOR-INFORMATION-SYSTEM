<!DOCTYPE html>
<html lang="th">

<head>
</head>
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
		<div class="table-responsive" style="overflow-x: hidden;">
			<!----------------------------------------------------Header-------------------------------------------------------->
			<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">รายการข้อมูล
			</p>
			<!---------------------------------------- ฺBACK Btn --------------------------------------------->
			<div class="row" style="margin-top:-20px; float:left; width: 100%;">
				<form action="<?php echo base_url()?>ad_item/item_product_id"><button
						class="btn red accent-2 font-weight-bolder" style="margin-left: 16px; font-size: 16px;"><i
							class="fas fa-arrow-circle-left"></i> ย้อนกลับ</button></form>
			</div>
			<!------------------------------------------------- Item Info ------------------------------------------------->

			<div class="box1">
				<hr>
				<div class="form-group form-a">
					<div class="form-group form-b">
						<label>ชื่อครุภัณฑ์</label>
						<input class="form-control" value="<?php echo $item_info[0]['item_name']?>" readonly>
					</div>
					<div class="form-group form-b">
						<label>เลขครุภัณฑ์</label>
						<input class="form-control" value="<?php echo $item_info[0]['item_id']?>" readonly>
					</div>
					<div class="form-group form-b">
						<label>ผู้เบิก</label>
						<input class="form-control" value="<?php echo $item_info[0]['n_request']?>" readonly>
					</div>
				</div>
				<div class="form-group form-a">
					<div class="form-group form-b">
						<label>ปีงบประมาณ</label>
						<input class="form-control" value="<?php echo $item_info[0]['f_year']?>" readonly>
					</div>
					<div class="form-group form-b">
						<label>สถานที่ติดตั้ง</label>
						<input class="form-control" value="<?php echo $item_info[0]['place']?>" readonly>
					</div>
				</div>
				<hr class="c2">
			</div>

			<!------------------------------------------------- Table Show Data------------------------------------------------->
			<table class="table table-bordered table-hover mytable text-nowrap shadow" style="margin-top:10px;  ">
				<thead class="thead-light z-depth-1">
					<tr>
						<th class="text-center" style="width:10px;">#</th>
						<th class="text-center" style="width:10px;">สถานะ</th>
						<th class="text-center" style="width:10px;">ชื่อ / นามสกุล</th>
						<th class="text-center" style="width:10px;">วันที่แจ้ง / เวลา</th>
						<th class="text-center" style="width:10px;">รายการที่เจาะจง</th>
						<th class="text-center" style="width:10px;">ดูข้อมูล</th>
					</tr>
				</thead>
				<tbody>
					<?php													                        
								if($history_list != null){
									$count = count(($history_list));
									for($i=0;$i<$count;$i++){
										foreach($history_list[$i] as $row){										 
							?>
					<tr>
						<td class="text-center font-weight-bolder <?php if($row->order_status == 0){echo "red accent-3";}if($row->order_status == 1){echo "amber darken-1";}if($row->order_status == 2){echo "green accent-3";}?>"
							style="padding-top:21px; font-size:16px;"><?php echo $row->id;?></td>
						<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;">
							<?php if($row->order_status==0){echo 'ยังไม่ได้ดำเนินการ';} if($row->order_status==1){echo 'กำลังดำเนินการ';} if($row->order_status==2){echo 'เสร็จสมบูรณ์';}?>
						</td>
						<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;">
							<?php echo $row->firstname.' '.$row->lastname;?></td>
						<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;">
							<?php echo date('d-m-Y',strtotime($row->date_request));?> / <?php echo $row->time_request;?>
						</td>
						<td class="text-center font-weight-bolder" style="padding-top:21px; font-size:16px;">
							<?php echo $item_id;?></td>
						<td class="text-center font-weight-bolder">
							<form
								action="<?php if($row->order_status == 1){echo base_url().'ad_item/report_item_inproc';}if($row->order_status == 2){echo base_url().'ad_item/report_item_com';}?>"
								method="POST"><button value="<?php echo $row->id;?>" name="id" type="submit"
									class="btn cyan lighten-3"><i class="fas fa-search"></i></button></form>
						</td>

					</tr>
					<?php }}} ?>

				</tbody>

			</table>
		</div>
	</main>
	</div>
	<style>
		.box1 {
			margin-top: 52px;
		}

		hr.c2 {
			margin-top: 4px;
		}

		.form-a {
			margin-bottom: 0px;
		}

		.form-b {
			display: inline-flex;
		}

		.form-b label {
			width: 33%;
			position: relative;
			top: 7px;
			left: 6px;
			font-weight: bold;
		}

		.form-b input {
			width: 280px;
			box-shadow: 3px 3px 1px #aaaaaa;
		}

	</style>
	<script>
		$('.mytable').dataTable({
			order: [
				[0, 'desc']
			],
			'orderable': false,
			"targets": 1,
			"language": {
				"emptyTable": "ไม่มีข้อมูล",
			},
			"searching": true,

		});

	</script>
</body>

</html>
