<!doctype html>
<html lang="en">

<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>MIS.CIT Login</title>
	<!-- Bootstrap -->
	<link href="<?php echo base_url();?>/mdbootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>/mdbootstrap/css/mdb.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>/mdbootstrap/css/style.css" rel="stylesheet">

	<!--------  Custom CSS ------------>
	<link href="<?php echo base_url(); ?>/mdbootstrap/css/dashboard.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/mdbootstrap/css/utility.css" rel="stylesheet">
	<?php date_default_timezone_set("Asia/Bangkok");?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"
		integrity="sha512-nOQuvD9nKirvxDdvQ9OMqe2dgapbPB7vYAMrzJihw5m+aNcf0dX53m6YxM4LgA9u8e9eg9QX+/+mPu8kCNpV2A=="
		crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
	</script>
</head>

<body id="bLogin">

	<?php 
	// print_r($_SESSION);
	// $this->session->sess_destroy();
	
?>
	<div class="table-responsive" id="tLogin">
		<div class="text-center z-depth-4" id="dLogin">
			<form id="fData">
				<div class="text-center">
					<label class="font-weight-bolder" id="lLogin">MIS.CIT</label>
				</div>
				<div class="form-group">
					<label class="font-weight-bolder">Username</label>
					<input type="text" id="usr" class="form-control iLogin">
				</div>
				<span class="text-danger" id="er_usr"></span>

				<div class="form-group">
					<label class="font-weight-bolder">Password</label>
					<input type="password" id="pwd" class="form-control iLogin" autocomplete="off">
					<span class="text-danger" id="er_pwd"></span>
				</div>
				<div class="text-danger" id="er_msg"><?php echo $this->session->flashdata("error");?></div>
				<div class="form-group">
					<input type="submit" class="btn btn-info" id="btnconf">
				</div>
			</form>
		</div>
	</div>
</body>
<!-------- Axios --------->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
	document.getElementById('btnconf').onclick = (e) => {
		e.preventDefault() // because we use form input @line34
		const a = document.getElementById('usr').value
		const b = document.getElementById('pwd').value
		const x = CryptoJS.HmacSHA512(b, '151').toString(CryptoJS.enc.Base64);
		const d = new FormData()
		d.append('username', a)
		d.append('password', x)
		axios({
				method: 'post',
				url: './Ad_login/vertify',
				data: d
			})
			.then((data) => {
				if (data.data == false) {
					$('#er_msg').html('ข้อมูลไม่ถูกต้อง')
				} else {
					$(location).attr('href', './ad_main')
				}
			})
	}

</script>

</html>
