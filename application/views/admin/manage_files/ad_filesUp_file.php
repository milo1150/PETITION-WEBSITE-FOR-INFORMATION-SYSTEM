<!DOCTYPE html>
<html lang="th">
<meta charset="utf8">
<head>
	<div class="wrapper">
	<?php $this->load->view('admin/admainEDIT');?>
<body>
	<main>
		<div class="table-responsive">
			<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">เอกสารดาวน์โหลด</p>
			<div class="func_grp">
				<div class="btn_pd_grp">
					<form method="post" action="<?php echo base_url().'Admin_upload'?>"><button class="btn btn-sm amber lighten-1 font-weight-bolder" id="editFile"><i class="fas fa-file-alt"></i>
						จัดการไฟล์
					</button></form>
					<form method="post" action="<?php echo base_url().'Admin_upload/category'?>"><button class="btn btn-sm green accent-3 font-weight-bolder" id="grpFile"><i class="fas fa-folder-open"></i>
						หมวดหมู่
					</button></form>			
					<button class="btn btn-sm red accent-2 font-weight-bolder" id="newFile"><i class="far fa-file-pdf"></i>
						อัพโหลดไฟล์
					</button>
				</div>
				<!-- <form id="formgrp"> -->
				<form class="filter">
					<label>หมวดหมู่</label>
					<select class="form-control" name="grp" id="filter_cate">
						<option value="0">ทั้งหมด</option>
						<?php						
							foreach($group_data as $row){
								echo '<option>'.$row->category.'</option>';
							}
						?>
					</select>
				<!-- </div> -->
				</form>
			</div>
			
			<div id="pdf_table">
				<table class="table table-bordered table-hover text-nowrap mytable">
					<thead class="thead-light z-depth-1">
						<tr id="pdf_table_topic">
							<th class="text-center">#</th>
							<th class="text-center">หมวดหมู่</th>
							<th class="text-center">ชื่อไฟล์</th>
							<th class="text-center">การจัดการ</th>
						</tr>
					</thead>
					<tbody id="pdf_table_body">
						<?php  foreach($file_data as $row){ ?>
							<tr>
								<td class="red accent-3 pdf_id" id="file_id"><?php echo $row->id; ?></td>
								<td class="pdf_category" id="file_cate"><?php echo $row->category;?></td>
								<td class="pdf_filename" id="file_name"><?php echo $row->file_name;?></td>
								<td class="text-center font-weight-bolder pdf_edit" id="file_edit">
									<div onclick="edit(id = '<?php echo $row->id;?>' , f_name = '<?php echo $row->file_name;?>' , cate = '<?php echo $row->category;?>')"><button class="btn teal accent-3 news_btn"><i class="fas fa-edit"></i></button></div>
									<div onclick="del(id = '<?php echo $row->id;?>' , f_name = '<?php echo $row->file_name;?>')"><button  class="btn red accent-2"><i class="fas fa-trash-alt"></i></button></div>
								</td>
							</tr>
						<?php  } ?>
					</tbody>
				</table>
			</div>
		</div>
	</main>
	<!------------------------------------------------------------ Add File ------------------------------------------------------->
	<div class="modal fade " id="add_pdf_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
			<div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
				<div class="modal-body text-center">
					<br />
					<i class="fas fa-file-pdf"></i><a class="font-weight-bolder" style="font-size:24px;"> อัพโหลดไฟล์</a>
				</div>
				<div class="modal-body text-center" id="form_upload">
					<form id="form_file" enctype="multipart/form-data">
						<p>เลือกไฟล์ :</p>
						<input type="file" accept="application/pdf" id="file_input" multiple></input>						
					</form>
				</div>
				<span id="f_null" value="0"></span>
				<div class="pdf_grp_sel">
					<p>หมวดหมู่ :</p>
					<div class="add_grp">
						<div class="grp_selector">
							<select class="form-control" id="grp_val">
								<?php foreach($group_data as $row){
									echo '<option>'.$row->category.'</option>';	
								}	
								?>
							</select>
							<div class="iPlus0"><i class="fas fa-plus-circle"></i></div>	
							<div class="iMinus0" style="display:none;"><i class="fas fa-minus-circle" onclick = "rmv(this)"></i></div>
						</div>
					</div>					
				</div>								
				<div class="modal-body text-center">
					<div class="row justify-content-center mb-3">
						<div class="col-4">
							<button id="confirm_btn" type="submit" class="btn btn-md btn-block green accent-3 text-white" style="font-size:16px;">ยืนยัน</button>
						</div>
						<div class="col-4">
							<button id="dis_btn" class="btn btn-md btn-block red accent-4 text-white" style="font-size:16px;" id="closemodal">ยกเลิก</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!------------------------------------------------------ waiting modal---------------------------------------------------->
	<div class="modal fade " id="wait_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"	data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
			<div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
				<div class="modal-body text-center" style="padding-bottom: 41px; font-weight: bold;">
					<br/>
					<h class="font-weight-bolder" style="font-size:24px;">กรุณารอสักครู่</h>																
				</div>																																																										
			</div>
		</div>
	</div>
	<!------------------------------------------------------------ Remove ------------------------------------------------------->
	<div class="modal fade " id="remove_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
			<div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
				<div class="modal-body modal_action">
					<i class="fas fa-trash"></i><p> ลบไฟล์</p>
				</div>
				<div class="modal-body text-center" style="padding-top: 0px;">
					<div class="row justify-content-center mb-3">
						<div class="col-4">
							<button id="remove_conf_btn" class="btn btn-md btn-block green accent-3 text-white" style="font-size:16px;">ยืนยัน</button>
						</div>
						<div class="col-4">
							<button id="dis_md_rm" class="btn btn-md btn-block red accent-4 text-white" style="font-size:16px;" id="closemodal">ยกเลิก</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!------------------------------------------------------------ Edit ------------------------------------------------------->
	<div class="modal fade " id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
			<div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
				<div class="modal-body modal_action">
					<i class="fas fa-file-pdf"></i><p> แก้ไขไฟล์</p>
				</div>
				<div class="modal-body pdf_edit_box">
					<div class="pdf_edit_box1">
						<label>ชื่อไฟล์ : </label>
						<input class="form-control" id="edit_name" maxlength="60"></input>						
					</div>
					<span id="n_err"></span>
					<div class="pdf_edit_box2">
						<label>หมวดหมู่ : </label>
						<div class="select1">
						</div>
					</div>
				</div>
				<div class="modal-body text-center">
					<div class="row justify-content-center mb-3">
						<div class="col-4">
							<button id="ed_conf_btn" class="btn btn-md btn-block green accent-3 text-white" style="font-size:16px;">ยืนยัน</button>
						</div>
						<div class="col-4">
							<button id="dis_md_ed" class="btn btn-md btn-block red accent-4 text-white" style="font-size:16px;" id="closemodal">ยกเลิก</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!------------------------------------------------------------------------------------------------------------------------------->
</body>
<script src="<?php echo base_url().'miscit-js/uploadPdf_file.js';?>"></script>
<script>
</script>

</html>