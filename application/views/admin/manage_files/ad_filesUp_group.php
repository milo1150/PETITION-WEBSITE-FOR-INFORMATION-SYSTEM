<!DOCTYPE html>
<html lang="th">
<meta charset="utf8">
<head>
	<div class="wrapper">
	<?php $this->load->view('admin/admainEDIT');?>

<body>
	<main>
		<div class="table-responsive">
			<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">จัดการหมวดหมู่</p>
			<div class="func_grp">
				<div class="btn_pd_grp">
					<form method="post" action="<?php echo base_url().'Admin_upload'?>"><button class="btn btn-sm amber lighten-1 font-weight-bolder" id="editFile"><i class="fas fa-file-alt"></i>
						จัดการไฟล์
					</button></form>
					<form method="post" action="<?php echo base_url().'Admin_upload/category'?>"><button class="btn btn-sm green accent-3 font-weight-bolder" id="grpFile"><i class="fas fa-folder-open"></i>
						หมวดหมู่
					</button></form>				
					<!-- <button class="btn btn-sm red accent-2 font-weight-bolder" id="newFile"><i class="far fa-file-pdf"></i>
						อัพโหลดไฟล์
					</button> -->
					<button class="btn btn-sm red accent-2 font-weight-bolder" id="newGrp"><i class="fas fa-plus"></i>
						เพิ่มหมวดหมู่
					</button>
				</div>
			</div>
			<div id="pdf_table">
				<table class="table table-bordered table-hover text-nowrap mytable">
					<thead class="thead-light z-depth-1">
						<tr id="pdf_table_topic">
							<th class="text-center">#</th>
							<th class="text-center">หมวดหมู่</th>
							<th class="text-center">การจัดการ</th>
						</tr>
					</thead>
					<tbody id="pdf_table_body">
						<?php  foreach($grp_data as $row){?>
							<tr>
								<td class="red accent-3 pdf_id" id="fd_id"><?php echo $row->id; ?></td>
								<td class="pdf_category2" id="fd_name"><?php echo $row->category; ?></td>							
								<td class="text-center font-weight-bolder pdf_edit" id="fd_edit">
									<button class="btn teal accent-3 news_btn" onclick="edit_name(id = '<?php echo $row->id;?>' , grp_name = '<?php echo $row->category;?>')"><i class="fas fa-edit"></i></button></form>
									<button onclick="del(del_id = '<?php echo $row->id;?>', grp_name = '<?php echo $row->category;?>')" class="btn red accent-2"><i class="fas fa-trash-alt"></i></button></form>
								</td>
							</tr>
						<?php  } ?>
					</tbody>
				</table>
			</div>
		</div>
	</main>
	<!------------------------------------------------------------ Add New Category ------------------------------------------------------->
	<div class="modal fade " id="addGroup_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
			<div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
				<div class="modal-body text-center">
					<br />
					<i class="fas fa-folder-open" style="font-size: 23px;"></i><a class="font-weight-bolder" style="font-size:24px;"> เพิ่มหมวดหมู่</a>
				</div>
				<div class="modal-body text-center" id="grp_name">
					<p>ระบุชื่อ</p>
					<input class="form-control" id="grp_name_val" maxlength="24"></input>					
				</div>
				<span class="span_error_grp" id="span_error_grp"></span>
				<div class="modal-body text-center">
					<div class="row justify-content-center mb-3">
						<div class="col-4">
							<button id="confirm_btn" class="btn btn-md btn-block green accent-3 text-white" style="font-size:16px;">ยืนยัน</button>
						</div>
						<div class="col-4">
							<button id="dis_btn" class="btn btn-md btn-block red accent-4 text-white" style="font-size:16px;" id="closemodal">ยกเลิก</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!------------------------------------------------------------ Rename ------------------------------------------------------->
	<div class="modal fade " id="rename_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
			<div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
				<div class="modal-body text-center">
					<br />
					<i class="fas fas fa-edit" style="font-size: 23px;"></i><a class="font-weight-bolder" style="font-size:24px;"> แก้ไขชื่อ</a>
				</div>
				<div class="modal-body text-center" id="grp_name">
					<p>ระบุชื่อ</p>
					<input class="form-control" id="grp_rename_val"></input>					
				</div>
				<span class="span_error_grp" id="span_error_rename"></span>
				<div class="modal-body text-center">
					<div class="row justify-content-center mb-3">
						<div class="col-4">
							<button id="rename_conf_btn" class="btn btn-md btn-block green accent-3 text-white" style="font-size:16px;">ยืนยัน</button>
						</div>
						<div class="col-4">
							<button onclick="dis_modal()" class="btn btn-md btn-block red accent-4 text-white" style="font-size:16px;" id="closemodal">ยกเลิก</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!------------------------------------------------------------ Remove ------------------------------------------------------->
	<div class="modal fade " id="remove_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
			<div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
				<div class="modal-body text-center">
					<br />
					<i class="fas fa-trash" style="font-size: 23px;"></i><a class="font-weight-bolder" style="font-size:24px;"> ลบหมวดหมู่</a>
				</div>
				<div class="modal-body text-center">
					<div class="row justify-content-center mb-3">
						<div class="col-4">
							<button id="remove_conf_btn" class="btn btn-md btn-block green accent-3 text-white" style="font-size:16px;">ยืนยัน</button>
						</div>
						<div class="col-4">
							<button onclick="dis_modal()" class="btn btn-md btn-block red accent-4 text-white" style="font-size:16px;" id="closemodal">ยกเลิก</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!------------------------------------------------------------------------------------------------------------------------------->
</body>
<script src="<?php echo base_url().'miscit-js/uploadPdf_cate.js';?>"></script>
<script>







</script>

</html>