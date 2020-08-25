<!DOCTYPE html>
<html lang="th">

<head>
	<title>MIS.CIT</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<?php date_default_timezone_set("Asia/Bangkok");?>
	
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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.15.0/js/mdb.min.js"></script>

	<!---------- datatable js ----------->
	<link href="<?php echo base_url(); ?>/datatable/table/css/jquery.dataTables.css" rel="stylesheet">
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>	

	<!---------- bootstrap-select plugin ----------->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.12/js/bootstrap-select.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.12/css/bootstrap-select.min.css" /> 
		
	<!-------- Sidebar CSS + Custom CSS ------------>
	<link href="<?php echo base_url(); ?>/mdbootstrap/css/dashboard.css" rel="stylesheet">	
	<link href="<?php echo base_url(); ?>/mdbootstrap/css/utility.css" rel="stylesheet">	

	<!-------- Axios --------->
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	
	<!--------------- print to PDF ------------->
	<!-- <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
	<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script> -->

</head>
<style>
</style>
<body>
<div class="wrapper">
	<!-- Sidebar  -->	
	<nav id="sidebar">
		<div class="sidebar-header text-center" onclick="homeicon()">
			<img type="submit" src="https://mis-cit.com/files_download/isVLx8.png"
				style="width: 110px;" onclick="homeicon()">
		</div>		
		<ul class="list-unstyled components">
			<li>
				<a href="<?php echo base_url();?>ad_main"><i class="fas fa-home"></i>   หน้าแรก</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>ad_main/remain"><i class="fas fa-exclamation-triangle"></i>   งานที่แจ้ง<span class="badge badge-pill badge-danger sidenav-badge" id="sidenav_num_allorder"></span></a>
			</li>
			<li>
				<a href="<?php echo base_url();?>ad_main/timeout_order"><i class="far fa-clock"></i>   งานเกินเวลา<span class="badge badge-pill sidenav-badge" style="background-color:#fb9304" id="sidenav_timeout"></span></a>
			</li>
			<li>
				<a href="#fixmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-hammer"></i>   แจ้งซ่อม<span class="badge badge-pill badge-danger sidenav-badge" id="sidenav_fix_order1"></span><span class="badge badge-pill sidenav-badge" style="margin-left: 1px; background-color:#fb9304"id="sidenav_fix_inproc1"></span></a>
				<ul class="collapse list-unstyled" id="fixmenu">
					<li>
						<a href="<?php echo base_url() ?>ad_fix/ad_fix_order">รายการแจ้งซ่อม<span class="badge badge-pill badge-danger sidenav-badge" id="sidenav_fix_order2"></span></a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>ad_fix/ad_fix_inproc">กำลังดำเนินการ<span class="badge badge-pill sidenav-badge" style="background-color:#fb9304" id="sidenav_fix_inproc2"></span></a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>ad_fix/ad_fix_com">ดำเนินการเสร็จสิ้น</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>ad_fix/ad_fix_cancle">รายการยกเลิก</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>ad_fix/ad_fix_alldata">ข้อมูลการแจ้งซ่อม</a>
					</li>
				</ul>
			</li>

			<li>				
			<a href="#itemmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-box-open"></i>   ยืมของ<span class="badge badge-pill badge-danger sidenav-badge" id="sidenav_item_order1"></span><span class="badge badge-pill sidenav-badge" style="margin-left: 1px; background-color:#fb9304"id="sidenav_item_inproc1"></span></a>
				<ul class="collapse list-unstyled" id="itemmenu">
					<li>
						<a href="<?php echo base_url() ?>ad_item/ad_item_order">คำร้องขอยืม<span class="badge badge-pill badge-danger sidenav-badge" id="sidenav_item_order2"></span></a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>ad_item/ad_item_inproc">อยู่ระหว่างการยืม<span class="badge badge-pill sidenav-badge" style="background-color:#fb9304" id="sidenav_item_inproc2"></span></a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>ad_item/ad_item_com">ดำเนินการเสร็จสิ้น</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>ad_item/ad_item_cancle">รายการยกเลิก</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>ad_item/item_product">รายการ - วัสดุ</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>ad_item/item_product_id">รายการ - ครุภัณฑ์</a>
					</li>
				</ul>
			</li>

			<li>				
			<a href="#itemmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fab fa-dropbox"></i>   เบิกของ<span class="badge badge-pill badge-danger sidenav-badge" id="sidenav_itemotp_all"></span></a>
				<ul class="collapse list-unstyled" id="itemmenu2">
					<li>
						<a href="<?php echo base_url() ?>ad_itemotp/ad_itemotp_order">คำร้องเบิกของ<span class="badge badge-pill badge-danger sidenav-badge" id="sidenav_itemotp_order"></span></a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>ad_itemotp/ad_itemotp_com">เสร็จสมบูรณ์</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>ad_itemotp/ad_itemotp_cancle">รายการยกเลิก</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>ad_itemotp/item_product">รายการ - วัสดุ</a>
					</li>
				</ul>
			</li>

			<li>				
			<a href="#emailmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-envelope"></i>   ขอเปิดอีเมล์<span class="badge badge-pill badge-danger sidenav-badge" id="sidenav_email_all"></span></a>
				<ul class="collapse list-unstyled" id="emailmenu">
					<li>
						<a href="<?php echo base_url() ?>ad_email/ad_email_order">รายการเปิดอีเมล์<span class="badge badge-pill badge-danger sidenav-badge" id="sidenav_email_order"></span></a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>ad_email/ad_email_com">เสร็จสมบูรณ์</a>
					</li>					
				</ul>
			</li>

			<li>				
			<a href="#fingermenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-fingerprint"></i>   สแกนนิ้ว<span class="badge badge-pill badge-danger sidenav-badge" id="sidenav_finger_all"></span></a>
				<ul class="collapse list-unstyled" id="fingermenu">
					<li>
						<a href="<?php echo base_url() ?>ad_finger/ad_finger_order">รายการสแกนนิ้ว<span class="badge badge-pill badge-danger sidenav-badge" id="sidenav_finger_order"></span></a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>ad_finger/ad_finger_com">เสร็จสมบูรณ์</a>
					</li>
<!--
					<li>
						<a href="<?php echo base_url();?>ad_finger/finger_report">รีพอร์ตเวลางาน</a>
					</li>	
-->				
				</ul>
			</li>
								
			<li>
				<a href="#admenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-copy"></i>   รีพอร์ต</a>
				<ul class="collapse list-unstyled" id="admenu">
					<li>
						<a href="<?php echo base_url();?>ad_report/ad_list">รายบุคคล</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>ad_report_overall">ภาพรวม</a>
					</li>					
				</ul>
			</li>						
			<li name="member" id="member">
				<a href="<?php echo base_url();?>ad_admanage/ad_list"><i class="fas fa-user-edit"></i>   จัดการสมาชิก</a>
			</li>
			<!--	
			<li>
				<a href="<?php echo base_url();?>updatelog">   Update Log</a>
			</li>
				  -->
			<li>
				<a href="<?php echo base_url();?>Image"><i class="fas fa-image"></i></i>   รูปภาพ</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>ad_news"><i class="fas fa-globe"></i>   อัพเดทหน้าข่าว</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>Admin_upload"><i class="fas fa-file-pdf"></i>   เอกสารดาวน์โหลด</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>office/edit"><i class="far fa-building"></i>   สำนักงาน</a>
			</li>

			
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('ad_login/logout')?>">ออกจากระบบ
				<i class="fas fa-sign-out-alt"></i> </a>
			</li>
		</ul>
	</nav>
	<!-- Navbar  -->
	<div id="content">
		<nav class="navbar navbar-expand rounded mb-0 admainedit_nav">
			<div class="container-fluid float-left">
				<button type="button" id="sidebarCollapse" class="btn btn-dark" style="margin-right:max;">
					<i class="fas fa-align-left"></i>
					<span></span>
				</button>
				<div class="navbar-nav ml-auto pr-2 ">		
					<li>	
						<span class="count badge badge-pill badge-danger noticss"></span>
						<li type="submit" class="nav-item dropdown no-arrow fas fa-bell dropleft clearpop" data-toggle="dropdown" style="font-size:25px;">
							
							<ul class="dropdown-menu dropstyle notiData z-depth-2">
							<li class="noti-banner">แจ้งเตือน</li>
							
							</ul>
						</li>
					</li>
					<li class="ml-3 bbb">
						<a class="pr-3" ><?php echo $this->session->userdata('username')?></a>
					</li>
				</div>
		</nav>	

		<script>
		//---------------------- Sidenav Order Number ----------------------------
		$(document).ready(function(){
			$.ajax({
				url:'<?php echo base_url()?>ad_main/sidenav_order_count',
				dataType:'JSON',
				success:function(data){
					//console.log(data)
					//------------------- รายการที่แจ้ง ------------------------
					$('#sidenav_num_allorder').html(data.request_all_order); if(data.request_all_order == 0){ $('#sidenav_num_allorder').html('') };					
					//--------------------- เกินเวลา --------------------------
					$('#sidenav_timeout').html(data.request_timeout); if(data.request_timeout == 0){ $('#sidenav_timeout').html('') };
					//--------------------- แจ้งซ่อม --------------------------
					$('#sidenav_fix_order1').html(data.fix_order); if(data.fix_order == 0){ $('#sidenav_fix_order1').html('') };
					$('#sidenav_fix_inproc1').html(data.fix_inproc); if(data.fix_inproc == 0){ $('#sidenav_fix_inproc1').html('') };	
					$('#sidenav_fix_order2').html(data.fix_order); if(data.fix_order == 0){ $('#sidenav_fix_order2').html('') };
					$('#sidenav_fix_inproc2').html(data.fix_inproc); if(data.fix_inproc == 0){ $('#sidenav_fix_inproc2').html('') };										
					//--------------------- ยืมของ ---------------------------
					$('#sidenav_item_order1').html(data.item_order); if(data.item_order == 0){ $('#sidenav_item_order1').html('') };
					$('#sidenav_item_inproc1').html(data.item_inproc); if(data.item_inproc == 0){ $('#sidenav_item_inproc1').html('') };	
					$('#sidenav_item_order2').html(data.item_order); if(data.item_order == 0){ $('#sidenav_item_order2').html('') };
					$('#sidenav_item_inproc2').html(data.item_inproc); if(data.item_inproc == 0){ $('#sidenav_item_inproc2').html('') };															
					//--------------------- เบิกของ ---------------------------
					$('#sidenav_itemotp_all').html(data.itemotp_order); if(data.itemotp_order == 0){ $('#sidenav_itemotp_all').html('') };
					$('#sidenav_itemotp_order').html(data.itemotp_order); if(data.itemotp_order == 0){ $('#sidenav_itemotp_order').html('') };
					//--------------------- email ---------------------------
					$('#sidenav_email_all').html(data.email_order); if(data.email_order == 0){ $('#sidenav_email_all').html('') };
					$('#sidenav_email_order').html(data.email_order); if(data.email_order == 0){ $('#sidenav_email_order').html('') };
					//--------------------- Finger ---------------------------
					$('#sidenav_finger_all').html(data.finger_order); if(data.finger_order == 0){ $('#sidenav_finger_all').html('') };
					$('#sidenav_finger_order').html(data.finger_order); if(data.finger_order == 0){ $('#sidenav_finger_order').html('') };					
				}
			})
		})





















		//-------------------- Set Sidebar no collapse -------------------
		window.onload = function(){
			localStorage.removeItem('permaSidebar2');
			// if(localStorage.permaSidebar2 != null){
			// 	$('.wrapper').click(function(){					
			// 		localStorage.permaSidebar2 = $('#sidebar').html();					
			// 	})
			// 	$('#sidebar').html(localStorage.permaSidebar2)				
			// }
			// if(localStorage.permaSidebar2 == null){
			// 	localStorage.permaSidebar2 = $('#sidebar').html()
			// 	//console.log(localStorage.permaSidebar1)
			// }
			
		}

		/*--------------------------------------------------- NOTIFICATION -------------------------------------------------*/
		$(document).ready(function(){
			function showNotification(){
				var ad_username = '<?php echo $this->session->userdata('username')?>';
				$.ajax({
					url:"<?php echo base_url();?>notification/noti_val",
					method:'POST',
					dataType:'json',
					data:{'ad_username': ad_username},
					success:function(data){
						$('.notiData').html(data.notification);
						if(data.unreadnoti > 0){
							$('.count').html(data.unreadnoti);
						}
					}										
				})				
			}	
			showNotification();	

			$('.dropdown').click(function(){
				$('.count').html('');											
				$.ajax({
					url:'<?php echo base_url();?>notification/set_one',						
				});
			});

			setInterval(function(){
				showNotification();
			},10000);		
		});		


		/*---------------------------SIDEBAR----------------------------*/
		$(document).ready(function () {
			$('#sidebarCollapse').on('click', function () {
				$('#sidebar').toggleClass('active');
			});
		});

		/*----------------------ON CLICK HOME ICON-----------------------*/
		function homeicon(){
			$(location).attr('href','<?php echo base_url();?>ad_main');			
		};


		/*---------------------------TEST---------------------------*/
		var x = '<?php echo $this->session->userdata('rank')?>';
		if(x=='super_admin'){
			document.getElementById('member').style.display = 'block';
		}else{
			document.getElementById('member').style.display = 'none' ;
		}

		/*----------------------------------------------------------ON CLICK NOTIFICATION---------------------------------------------------------*/
		function noti_info(id){
			var ad_username = '<?php echo $this->session->userdata('username')?>';
			$.ajax({
				url:"<?php echo base_url();?>notification/show_info",
				method:"POST",
				dataType:"JSON",
				data:{'reqid':id,'ad_username':ad_username},
				success:function(data){
					//--------------------------------------- DATA FROM FIX --------------------------------------------
					if(data.data_fix[0]!=null && data.data_fix[0].order_status == '0'){
						var fix_data = data.data_fix[0];
						$.ajax({							
							url:"<?php echo base_url();?>notification/request_fix_report",
							method:"POST",
							data:{'data':fix_data},
							success: 
							//NEED TO SET TIMEOUT BECAUSE url shd be done before success  
							setTimeout(function(data){
								$(location).attr('href','<?php echo base_url();?>notification/report_fix_order')
							},100)														
						})
					}if(data.data_fix[0]!=null && data.data_fix[0].order_status == '1'){
						$(location).attr('href','<?php echo base_url();?>ad_fix/ad_fix_inproc')
					}
					if(data.data_fix[0]!=null && data.data_fix[0].order_status == '2'){
						$(location).attr('href','<?php echo base_url();?>ad_fix/ad_fix_com')
					}
					//----------------------------------------- DATA FROM ITEM -----------------------------------------
					if(data.data_item[0]!=null && data.data_item[0].order_status == '0'){
						var item_data = data.data_item[0];
						$.ajax({							
							url:"<?php echo base_url();?>notification/request_item_report",
							method:"POST",
							data:{'data':item_data},
							success: 
							//NEED TO SET TIMEOUT BECAUSE url shd be done before success  
							setTimeout(function(data){
								$(location).attr('href','<?php echo base_url();?>notification/report_item_order')
							},100)														
						})
					}if(data.data_item[0]!=null && data.data_item[0].order_status == '1'){
						$(location).attr('href','<?php echo base_url();?>ad_item/ad_item_inproc')
					}
					if(data.data_item[0]!=null && data.data_item[0].order_status == '2'){
						$(location).attr('href','<?php echo base_url();?>ad_item/ad_item_com')
					}
					//------------------------------------- DATA FROM EMAIL -------------------------------------------
					if(data.data_email[0]!=null && data.data_email[0].order_status == '0'){
						var email_data = data.data_email[0];
						$.ajax({							
							url:"<?php echo base_url();?>notification/request_email_report",
							method:"POST",
							data:{'data':email_data},
							success: 
							//NEED TO SET TIMEOUT BECAUSE url shd be done before success  
							setTimeout(function(data){
								$(location).attr('href','<?php echo base_url();?>notification/report_email_order')
							},100)														
						})
					}if(data.data_email[0]!=null && data.data_email[0].order_status == '2'){
						$(location).attr('href','<?php echo base_url();?>ad_email/ad_email_com')
					}
					//-------------------------------------- DATA FROM FINGER -----------------------------------------
					if(data.data_finger[0]!=null && data.data_finger[0].order_status == '0'){
						var finger_data = data.data_finger[0];
						var max_id = data.max_id[0];
						$.ajax({							
							url:"<?php echo base_url();?>notification/request_finger_report",
							method:"POST",
							data:{'data':finger_data,'max_id':max_id},
							success: 
							//NEED TO SET TIMEOUT BECAUSE url shd be done before success  
							setTimeout(function(data){
								$(location).attr('href','<?php echo base_url();?>notification/report_finger_order')
							},100)														
						})
					}if(data.data_finger[0]!=null && data.data_finger[0].order_status == '2'){
						$(location).attr('href','<?php echo base_url();?>ad_finger/ad_finger_com')
					}
					//--------------------------------------- DATA FROM ITEMOTP ----------------------------------------
					if(data.data_itemotp[0]!=null && data.data_itemotp[0].order_status == '0'){
						var item_dataotp = data.data_itemotp[0];
						$.ajax({							
							url:"<?php echo base_url();?>notification/request_itemotp_report",
							method:"POST",
							data:{'data':item_dataotp},
							success: 
							//NEED TO SET TIMEOUT BECAUSE url shd be done before success  
							setTimeout(function(data){
								$(location).attr('href','<?php echo base_url();?>notification/report_itemotp_order')
							},100)													
						})
					}if(data.data_itemotp[0]!=null && data.data_itemotp[0].order_status == '2'){
						$(location).attr('href','<?php echo base_url();?>ad_itemotp/ad_itemotp_com')
					}	
							
				},				
			})
		
		
		}

</script>




		<!-- <script type="text/javascript" src="mdbootstrap/js/adminpage.js"></script> -->

</body>


</html>
