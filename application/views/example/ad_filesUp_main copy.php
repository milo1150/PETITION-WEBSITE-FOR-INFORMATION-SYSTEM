<!DOCTYPE html>
<html lang="th">
<meta charset="utf8">
<head>
	<div class="wrapper">
		<?php include 'admainEDIT.php' ?>

<body>
	<main>
		<div class="table-responsive">
			<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">เอกสารดาวน์โหลด</p>
			<div class="func_grp">
				<div class="btn_pd_grp">
					<button class="btn btn-sm amber lighten-1 font-weight-bolder" id="editFile"><i class="fas fa-file-alt"></i>
						จัดการไฟล์
					</button>
					<button class="btn btn-sm green accent-3 font-weight-bolder" id="grpFile"><i class="fas fa-folder-open"></i>
						หมวดหมู่
					</button>				
					<button class="btn btn-sm red accent-2 font-weight-bolder" id="newFile"><i class="far fa-file-pdf"></i>
						อัพโหลดไฟล์
					</button>
					<button class="btn btn-sm red accent-2 font-weight-bolder" id="newGrp" style="display:none;"><i class="fas fa-plus"></i>
						เพิ่มหมวดหมู่
					</button>
				</div>
				<!-- <div class="grp_select">
					<p></p>
					<select class="form-control">
						<option>ddd</option>

					</select>
				</div> -->
			</div>
			<div id="pdf_table">
				<table class="table table-bordered table-hover text-nowrap mytable">
					<thead class="thead-light z-depth-1">
						<tr id="pdf_table_topic">
							<th class="text-center">#</th>
							<th class="text-center">หมวดหมู่</th>
							<th class="text-center">ชื่อไฟล์</th>
							<th class="text-center">สถานะ</th>
							<th class="text-center">การจัดการ</th>
						</tr>
					</thead>
					<tbody id="pdf_table_body">
						<?php  ?>
							<tr>
								<td>1</td>
								<td>กอ</td>
								<td>10</td>
								<td>11</td>
								<td>12</td>
							</tr>
							<tr>
								<td>2</td>
								<td>จจ</td>
								<td>20</td>
								<td>22</td>
								<td>27</td>
							</tr>
						<?php  ?>
					</tbody>
				</table>
			</div>
		</div>
	</main>
	<!------------------------------------------------------------ Add File ------------------------------------------------------->
	<div class="modal fade " id="add_new_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
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
	<!------------------------------------------------------------------------------------------------------------------------------->
</body>

<script>

/* ----------------------------------------------- File ------------------------------------------------ */
document.getElementById('editFile').onclick = () => {
	let addGrpBtn = document.getElementById('newGrp')
	addGrpBtn.style.display = "none"

}
/* ----------------------------------------------- Category ------------------------------------------------ */
document.getElementById('grpFile').onclick = () => {


	// ---------------------- show addnewgroup Button --------------------
	const addGrpBtn = document.getElementById('newGrp')
	addGrpBtn.style.display = "inline-block" 
	addGrpBtn.style.animation = "fadeIn 1s"
	// reset innerHTML and set Fadein Table 
	const table_topic = document.getElementById('pdf_table_topic')
	const table_body = document.getElementById('pdf_table_body')
	// const table_mytable = table_topic.parentElement.parentElement.parentElement
	// table_mytable.style.animation = "fadeIn 1s"
	// console.log(table_mytable)
	// table_topic.innerHTML = '<th class="text-center">#</th>'+
	// 						'<th class="text-center">หมวดหมู่</th>'+
	// 						'<th class="text-center">สถานะ</th>'+
	// 						'<th class="text-center">การจัดการ</th>'



	// ------------------------ query Folder name ---------------------------
	const fold_url = '<?php echo base_url().'Admin_upload/fd_rw'?>'
	axios(fold_url)
	.then(data => {				
		let fd_data = data.data
		var row_folder = Array()
		const table_form_start = '<table class="table table-bordered table-hover text-nowrap mytable">'+
								'<thead class="thead-light z-depth-1">'+
									'<tr id="pdf_table_topic">'+
										'<th class="text-center">#</th>'+
										'<th class="text-center">หมวดหมู่</th>'+
										'<th class="text-center">สถานะ</th>'+
										'<th class="text-center">การจัดการ</th>'+
									'</tr>'+
								'</thead>'+
								'<tbody id="pdf_table_body">'
		for(let i=0;i<fd_data.length;i++){
			if(fd_data[i].status == 0){ var eye = '<td><button class="btn orange accent-2 waves-effect"><i class="fas fa-eye-slash"></i></button></td>'}
			if(fd_data[i].status == 1){ var eye = '<td><button class="btn orange accent-2 waves-effect"><i class="fas fa-eye"></i></button></td>'}
			row_folder[i] = 							
							'<tr>'+
								'<td id="fd_id">'+fd_data[i].id+'</td>'+
								'<td id="fd_name">'+fd_data[i].folder_name+'</td>'+
								eye+
								'<td>'+
									'<button class="btn teal accent-3 waves-effect"><i class="fas fa-edit"></i></button>'+
									'<button class="btn red accent-2 waves-effect"><i class="fas fa-trash-alt"></button></i>'+
								'</td>'+
							'</tr>'
						
		}
		const table_form_end = '</tbody></table>'
		$('#pdf_table_body').html(row_folder)
		console.log(row_folder)
		console.log(fd_data)
	})	
}





/*--------------------------- Modal Pop & Off ---------------------------- */
document.getElementById('newFile').onclick = function() {
    $('#add_new_modal').modal('show')
}
document.getElementById('dis_btn').onclick = function() {
    $('#add_new_modal').modal('hide');
}

/* ----------------------------- Upload PDF **Confirm Button ------------------------------ */
const conf_btn = document.getElementById('confirm_btn')
const url = '<?php echo base_url().'Admin_upload/pdf'?>'
const send_pdf = () => {
	const form_body = document.getElementById('form_file')
	const form_input = document.getElementById('file_input')
	const formData = new FormData()
	const hmny_file = form_input.files.length  // check how many files
	for(let i=0;i<hmny_file;i++){
		formData.append('pdf'+i,file_input.files[i])
	}
	$.ajax({
		url:url,
		dataType:'json',
		method:'post',		
		contentType: false,
		cache: false,
		processData:false,
		data:formData,
	})
	console.log(form_input.files.length)
}
conf_btn.addEventListener('click',send_pdf)

$('.mytable').dataTable({
	order: [
		[0, 'desc']
	],
});






</script>

</html>