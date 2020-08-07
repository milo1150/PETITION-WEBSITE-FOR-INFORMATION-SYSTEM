<!DOCTYPE html>
<html lang="en">

<head>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" integrity="sha512-nOQuvD9nKirvxDdvQ9OMqe2dgapbPB7vYAMrzJihw5m+aNcf0dX53m6YxM4LgA9u8e9eg9QX+/+mPu8kCNpV2A==" crossorigin="anonymous"></script>
</head>

<div class="wrapper">
<?php $this->load->view('admin/admainEDIT');?>

	<body>
		<main>
		<div class="table-responsive">
			<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight:bold;">เพิ่มสมาชิก</p>
			<!-- <form method="post" action="<?php echo base_url();?>ad_admanage/validation">  -->
			<form id="fData"> 
			<div style="text-align: -webkit-center; padding-right: 30%; padding-left: 30%;">
				<div class="table-responsive-md pb-4 pt-4 z-depth-2" style="text-align: left;margin-bottom: 5%;">
					<div class="container" style="max-width:400px;" >						
						<div class="form-group">
							<label>ฃื่อผู้ใช้ระบบ</label>
							<input type="text" name="username" class="form-control" id="usrN" style="box-shadow: 5px 5px 1px #aaaaaa;">
							<span class="text-danger" id="erUname"></span>
						</div>
						<div class="form-group">
							<label>รหัสผ่าน</label>
							<input type="password" name="password" class="form-control" id="pwd" style="box-shadow: 5px 5px 1px #aaaaaa;">
							<span class="text-danger" id="erPwd"></span>
						</div>
						<div class="form-group">
							<label>ไอดีพนักงาน</label>
							<input type="text" name="user_id" class="form-control"  id="usrId" style="box-shadow: 5px 5px 1px #aaaaaa;">
							<span class="text-danger" id="erUid"></span>
						</div>
						<div class="form-group">
							<label>อีเมล</label>
							<input type="text" name="email" class="form-control"  id="email" style="box-shadow: 5px 5px 1px #aaaaaa;">
							<span class="text-danger" id="erEmail"></span>
						</div>
						<div class="text-center pb-4">
							<div class="row justify-content-center pt-2">
								<div class="col-sm-6 pb-2">
									<button type="submit" class="btn btn-lg btn-success btn-block" id="btn_conf" style="font-size:20px;">ยืนยัน</button>
								</div>
								<div class="col-sm-6">
									<a href="<?php echo base_url()?>ad_admanage/ad_list">
										<button type="button" class="btn btn-lg btn-danger btn-block" style="font-size:20px;">ย้อนกลับ</button>
									</a>
								</div>				
							</div>
						</div>
					</div>
				</div>
			</div>
			</form>
		</div>
		</main>
	</body>	
<style>
.form-group{
	margin-bottom: 15px !important;
}
.text-danger p{
	padding-top: 7px;
	color:red;
	margin-bottom: 0px !important;
}
</style>
<script>
const btn = document.getElementById('btn_conf')
btn.addEventListener('click',(e)=>{
	e.preventDefault()
	// set value
	const a = document.getElementById('usrN').value
	const b = document.getElementById('pwd').value
	const c = document.getElementById('usrId').value
	const d = document.getElementById('email').value
	// let y = CryptoJS.HmacSHA512(b,'151').toString(CryptoJS.enc.Base64);
	if(b == ''){ y = ''} 
	// set formData
	const f = new FormData()
	f.append('username',a)
	f.append('password',b)
	f.append('user_id',c)
	f.append('email',d)
	// console.log(a+''+y+''+c+''+d)
	// console.log(y)
	// Send Data
	axios({
		method:'post',
		url:'./validation',
		data:f
	})
	.then((res)=>{
		// console.log(res.data)
		if(res.data.status == 0){ // if information error
			$('#erUname').html(res.data.error_username)
			$('#erPwd').html(res.data.error_password)
			$('#erUid').html(res.data.error_userid)
			$('#erEmail').html(res.data.error_email)
		}
		if(res.data == 1){ // if no error
			$(location).attr('href','./ad_list')
		}
	})
	
})

</script>
</html>