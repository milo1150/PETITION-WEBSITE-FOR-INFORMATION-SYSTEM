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
			<button class="btn btn-primary btn-sm" id="newFile" name="newsadd" style="font-size: 15px; margin-bottom: 20px;">
				อัพโหลดไฟล์
			</button>
			<table class="table table-bordered table-hover text-nowrap mytable">
				<thead class="thead-light z-depth-1">
					<tr class="">
						<th class="text-center">#</th>
						<th class="text-center">ประเภทข่าว</th>
						<th class="text-center n_title">หัวข้อข่าว</th>
						<th class="text-center">วันที่ / เวลา</th>
						<th class="text-center">การจัดการ</th>
					</tr>
				</thead>
				<tbody>
					<?php  ?>
						<tr>
						</tr>
					<?php  ?>
				</tbody>
			</table>
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
<!-- <script src="<?php echo base_url().'miscit-js/admin_fileupload.js'?>"></script> -->
<script>
/*------------------------------ Modal Pop & Off ---------------------------- */
document.getElementById('newFile').onclick = function() {
    $('#add_new_modal').modal('show')
}
document.getElementById('dis_btn').onclick = function() {
    $('#add_new_modal').modal('hide');
}

/* ----------------------------- Confirm Button ------------------------------ */
/*
const conf_btn = document.getElementById('confirm_btn')
conf_btn.addEventListener('click', function(){
	const form_file = document.getElementById('form_file')
	const file_input = document.getElementById('file_input')
	const formData = new FormData();
	formData.append('pdFile',file_input.files[0]);

	// console.log(formData.get('pdFile'))
	// console.log(file_input.files)

	const url = '<?php echo base_url().'Ad_upload/pdf'?>';
	fetch(url,{
		method:'post',
		body:formData
	})
	let d = 1
	fetch(url,{
		method:'post',
		data:'d'
	})
	.then(function(data){
		console.log(data)
	})

})*/


const conf_btn = document.getElementById('confirm_btn')
const url = '<?php echo base_url().'Admin_upload/pdf'?>';
const sendHttpReq = (method,url,data) => {
	return fetch(url,{
		method:method,
		body:JSON.stringify(data),
		headers: { 'Content-Type' : 'application/json' }
	})
	.then(res => {
		return res.json()
	})
}
const conf_up = () => {
	sendHttpReq('POST',url,{
		email : 'oooooo'
	})
	.then(data =>{
		console.log(data)
	}) 
}


const sendPost = () => {
	const data = { name : '5' }
	fetch(url,{
		method: 'POST', // or 'PUT'
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify(data),
	})
	.then(res => res.json())
	.then(data => console.log(data))
	// .then(data => console.log(data))

}

const ajaxTest = async () => {
	await $.ajax({
		url:url,
		dataType:'json',
		method:'post',
		data:{'id':'1'}
	})
}

const axPost = () => {
	axios.post(url,{ firstname : 'kortoei' })
	.then(res => console.log(res.data))
}



// conf_btn.addEventListener('click',ajaxTest)
// conf_btn.addEventListener('click',sendPost)
conf_btn.addEventListener('click',axPost)


</script>

</html>