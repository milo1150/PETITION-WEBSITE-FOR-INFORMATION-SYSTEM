<!DOCTYPE html>
<html lang="th">
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
	<meta charset="utf-8">
	<!---------- Font Awesome ----------->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

	<!-------- JS + Bootstrap JS ---------->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

	<!------- Bootstrap + MDBootstrap------>
	<link href="<?php echo base_url(); ?>/mdbootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/mdbootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/mdbootstrap/css/mdb.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.15.0/js/mdb.min.js"></script>

	<!-------- Sidebar CSS + Custom CSS ------------>
	<link href="<?php echo base_url(); ?>/mdbootstrap/css/mis-mainpage.css" rel="stylesheet">

	<!---------- datatable js ----------->
	<link href="<?php echo base_url(); ?>/datatable/table/css/jquery.dataTables.css" rel="stylesheet">
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

</head>
<header>
	<!------------------------------------------------ TopBanner ---------------------------------------------------->
	<div class="banner-box">
		<img src="https://sv1.picz.in.th/images/2019/06/19/1UDsvS.png" class="img-fluid" alt="Responsive image">
		<div class="banner-text">
			<p class="p1">หน่วยสารสนเทศและประชาสัมพันธ์ วิทยาลัยเทคโนโลยีอุตสาหกรรม</p>
			<p class="p2">Institute of Computer and Information Technology</p>
		</div>
	</div>
	<!------------------------------------------------ TopNavbar ---------------------------------------------------->
	<div class="navbar-box">
		<div class="navbar-content">
			<div class="ali-crop" id="ali-cropy"><button class="btn btn-lg"><i class="fas fa-align-left"></i></button>
			</div>
			<ul class="crop-box">
				<li class="content-item"><a href="<?php echo base_url();?>">หน้าแรก</a></li>
				<li class="content-item" id="ct1""><a>แนะนำสำนัก</a>
                    <ul class=" content-item-row" id="content-item-1">
				<li><a href="http://icit.kmutnb.ac.th/main/about/">เกี่ยวกับสำนัก</a>
					<hr>
				</li>
				<li><a>โครงสร้างองค์กร</a>
					<hr>
				</li>
				<li><a>นโยบาย</a>
					<hr>
				</li>
				<li><a>บุคลากร</a></li>
			</ul>
			</li>
			<li class="content-item" id="ct2"><a>งานบริการ</a>
				<ul class="content-item-row" id="content-item-2">
					<li><a>หัวข้อการให้บริการ</a>
						<hr>
					</li>
					<li><a>แบบฟอร์มขอใช้บริการ</a>
						<hr>
					</li>
					<li><a>เอกสารและคู่มือการใช้งาน</a>
						<hr>
					</li>
					<li><a>รายงานประจำปี</a></li>
				</ul>
			</li>
			<li class="content-item" id="ct3"><a>FAQ</a>
				<ul class="content-item-row" id="content-item-3">
					<li><a>สำหรับนักศึกษา</a>
						<hr>
					</li>
					<li><a>สำหรับบุคลากร</a>
						<hr>
					</li>
					<li><a>สำหรับบุคลากรภายใน</a></li>
				</ul>
			</li>
			<li class="content-item"><a href="<?php echo base_url();?>request">คำร้องแจ้งเรื่องสารสนเทศ</a></li>
			<li class="content-item"><a href="<?php echo base_url();?>news/files">ดาวน์โหลด</a></li>
			</ul>
		</div>
	</div>
</header>
<script>
	let win_media = window.matchMedia("(max-width:600px)")
	$(document).ready(function () {
		if (win_media.matches == true) {
			/* ----------------------- onclick ali-icon top-nav (responsive) ------------------- */
			let num = 0
			let box_ele = document.querySelector('.crop-box')
			document.getElementById('ali-cropy').addEventListener('click', function () {
				if (num == 0) {
					box_ele.style = "height:273px !important"
					box_ele.style.transition = "ease 0.3s"
					num = 1
					return
				}
				if (num == 1) {
					box_ele.style = "height:0px !important"
					box_ele.style.transition = "ease 0.3s"
					num = 0
					return
				}
			})
			/* ----------------------- onclick top-nav-li (responsive) ------------------- */
			let li_row = {
				ct1: '0',
				ct2: '0',
				ct3: '0'
			}
			document.getElementById('ct1').addEventListener('click', function () {
				if (li_row.ct1 == 1) {
					document.getElementById('content-item-1').style.display = "none"
					li_row.ct1 = 0
					return
				} else {
					document.getElementById('content-item-1').style.display = "block"
					li_row.ct1 = 1
					return
				}
			})
			document.getElementById('ct2').addEventListener('click', function () {
				if (li_row.ct2 == 1) {
					document.getElementById('content-item-2').style.display = "none"
					li_row.ct2 = 0
					return
				} else {
					document.getElementById('content-item-2').style.display = "block"
					li_row.ct2 = 1
					return
				}
			})
			document.getElementById('ct3').addEventListener('click', function () {
				if (li_row.ct3 == 1) {
					document.getElementById('content-item-3').style.display = "none"
					li_row.ct3 = 0
					return
				} else {
					document.getElementById('content-item-3').style.display = "block"
					li_row.ct3 = 1
					return
				}
			})
		}
    })
    /* ------------------------------------------------ On Hover Topnav --------------------------------------------- */
    //----------------------- content 1 ------------------------
	const ct1 = document.getElementById('ct1');
	ct1.onmouseenter = function () {
		//$('#content-item-1').fadeIn(400)   // BUG 
		$('#content-item-1').css("display", "block")
	}
	ct1.onmouseleave = function () {
		$('#content-item-1').css("display", "none")
	}
	//----------------------- content 2 ------------------------
	const ct2 = document.getElementById('ct2');
	ct2.onmouseenter = function () {
		$('#content-item-2').css("display", "block")
	}
	ct2.onmouseleave = function () {
		$('#content-item-2').css("display", "none")
	}
	//----------------------- content 3 ------------------------
	const ct3 = document.getElementById('ct3');
	ct3.onmouseenter = function () {
		$('#content-item-3').css("display", "block")
	}
	ct3.onmouseleave = function () {
		$('#content-item-3').css("display", "none")
	}

</script>

</html>
