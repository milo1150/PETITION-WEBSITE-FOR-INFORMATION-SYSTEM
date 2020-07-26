<!DOCTYPE html>
<html lang="en">

<head>
<title>รีพอร์ตแจ้งซ่อม</title>
</head>

<div class="wrapper">
	<?php include 'admainEDIT.php'?>
	<body>
		<main>
			<div class="table-responsive">
				<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">
					รีพอร์ตแจ้งซ่อม</p>
				<div class="container mb-4 pt-3 z-depth-2" style="max-width:600px;">	
						<div class="form-group">
							<label>หมายเลขงาน</label>
							<input class="form-control" readonly value="<?php echo $id;?>">
						</div>					
						<div class="form-row pb-2">
							<div class="col">
								<label>วันที่แจ้ง</label>
								<input class="form-control" readonly value="<?php echo date('d-m-Y',strtotime($date_request));?>">
							</div>
							<div class="col">
								<label>เวลา</label>
								<input class="form-control" readonly value="<?php echo $time_request;?>">
							</div>
						</div>
						<div class="form-row pb-2">
							<div class="col">
								<label>ชื่อ</label>
								<input class="form-control" readonly value="<?php echo $firstname;?>">
							</div>
							<div class="col">
								<label>นามสกุล</label>
								<input class="form-control" readonly value="<?php echo $lastname;?>">
							</div>
						</div>
						<div class="form-group">
							<label>เบอร์ติดต่อ</label>
							<input class="form-control" readonly value="<?php echo $phonenum;?>">
						</div>
						<div class="form-group">
							<label>อีเมลติดต่อ</label>
							<input class="form-control" readonly value="<?php echo $email;?>"> 
						</div>
						<div class="form-group">
							<label>รายการแจ้งซ่อม</label>
							<input class="form-control" readonly value="<?php echo $fixlist;?>">
						</div>
						<div class="form-row pb-2">
							<div class="col">อาคาร
								<input class="form-control" readonly value="<?php echo $building;?>">
							</div>
							<div class="col">ชั้น
								<input class="form-control" readonly value="<?php echo $floor;?>">
							</div>
							<div class="col">ห้อง
								<input class="form-control" readonly value="<?php echo $room;?>">
							</div>
						</div>						
						<div class="form-group">
							<label>ลักษณะของปัญหา</label>
							<textarea class="form-control" rows="8" cols="9" readonly><?php echo $fixprob;?></textarea>
						</div>
						
						<div class="form-row pb-2">
							<div class="col">
								<label>เริ่มดำเนินการ</label>
								<input class="form-control" readonly value="<?php echo date('d-m-Y',strtotime($date));?>">
							</div>
							<div class="col">
								<label>เวลา</label>
								<input class="form-control" readonly value="<?php echo $time; ?>">
							</div>
						</div>													
						<!--////////////////////////////////////// BUTTON //////////////////////////////////////-->
						<br>
						<div class="row justify-content-center pt-2 pb-4">
							<div class="col-sm-4" id="repage">																
							<button id="" type="button" class="btn btn-lg btn-block mb-3 green accent-3 text-white" 									
								onclick=""  reload="01" style="font-size:20px;" data-toggle="modal" data-target="#basicExampleModal">
								<a id="">รับงาน</a>
							</button></div>

							<!-- Modal -->
							<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-body text-center">
											<a class="modal-body" id="exampleModalLabel">รับงาน<?php echo $type;?></a>
											<br/>
											<a>หมายเลขงาน : <?php echo $id;?></a>
											<br/>
											<a>ชื่อผู้แจ้ง : <?php echo $firstname;?> <?php echo $lastname;?></a>	
											<br/>
											<a>เบอร์ติดต่อ : <?php echo $phonenum;?></a>																				
										</div>																				
										<div class="modal-body row justify-content-center">
											<div class="col-5">
												<button type="button" class="btn btn-lg btn-block green accent-3 text-white" onclick="accept_order_fix()" id="" style="font-size:18px;">ใช่</button>
											</div>
											<div class="col-5">
												<button type="button" class="btn btn-lg btn-block red accent-4 text-white" data-dismiss="modal" onclick="" id="" style="font-size:18px;">ไม่ใช่</button>	
											</div>										
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-sm-4">
								<button type="button" class="btn btn-lg btn-block red accent-4 text-white" onclick="history.back(-1)"
									style="font-size:20px;">ย้อนกลับ</button>
							</div>
						</div>
						<!-------------------------------------------------- CANCEL ORDER ------------------------------------------------>
						<hr class="style5 mt-1">
						<div style="text-align:center; padding-bottom: 20px;">  
							<button type="button" class="btn btn-lg btn-warning font-weight-bolder mb-1"  data-toggle="collapse" data-target="#cancle"
								aria-expanded="false" aria-controls="collapseExample" style="font-size:20px;">
								ยกเลิกรายการ
							</button>
						</div>
						<div class="collapse" id="cancle">						
							<div class="form-group">
								<label>อีเมลติดต่อ</label>
									<input type="email" name="email" class="form-control" value="<?php echo $email;?>" readonly> 
							</div>
							<div class="form-group">
								<label>รายละเอียด</label>
									<textarea class="form-control" rows="5" cols="9" id="cancleDetail"></textarea>
							</div>							
							<div class="row justify-content-center pt-2">
								<div class="col-sm-4">																
									<button type="button" class="btn btn-lg btn-block mb-3 green accent-3 text-white" 									
										onclick="" style="font-size:20px;" data-toggle="modal" data-target="#cancleOrder">
										ยืนยัน
									</button>
								</div>				
							<!-- Modal -->
								<div class="modal fade" id="cancleOrder" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-body text-center">
												<a class="modal-body" id="cancleOrder">ยกเลิกรายการ<?php echo $type;?></a>
													<br/>
													<a>หมายเลขงาน : <?php echo $id;?></a>
													<br/>
													<a>ชื่อผู้แจ้ง : <?php echo $firstname;?> <?php echo $lastname;?></a>	
													<br/>
													<a>เบอร์ติดต่อ : <?php echo $phonenum;?></a>																					
											</div>																				
											<div class="modal-body row justify-content-center">
												<div class="col-5">
													<button type="button" class="btn btn-lg btn-block green accent-3 text-white" onclick="cancle_order()"  style="font-size:18px;">ใช่</button>
												</div>
												<div class="col-5">
													<button type="button" class="btn btn-lg btn-block red accent-4 text-white" data-dismiss="modal"  style="font-size:18px;">ไม่ใช่</button>	
												</div>										
											</div>
										</div>
									</div>
								</div>							
								<div class="col-sm-4 pb-4">
									<button type="button" class="btn btn-lg btn-block red accent-4 text-white" onclick="swipe()"
										style="font-size:20px;">ยกเลิก</button>
								</div>
							</div>				
						</div>
						<!-------------------------------------------------Watching in the same time------------------------------------------------>
						<div class="modal fade" id="watch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabe" aria-hidden="true" 
						style="font-family: 'Kanit', sans-serif;" data-backdrop="static" data-keyboard="false" >
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content z-depth-2" style="box-shadow: 10px 10px 3px #aaaaaa;">
									<div class="modal-body text-center">
										<a class="modal-body font-weight-bolder" id="exampleModalLabel"><br/>
											<!--------UPDATE ADMIN ACCEPT NAME------->
											<a class="font-weight-bolder" id="adname" style="font-size:20px;"></a>
											<a class="font-weight-bolder" style="font-size:20px;">รับงานแล้ว !</a>
										</a>
									</div>																				
									<div class="modal-body row justify-content-center">
										<div class="col-6">
											<form action="<?php echo base_url();?>ad_fix/ad_fix_order">																			
												<button type="submit" class="btn btn-lg btn-block mb-3 red accent-3 text-white" style="font-size:18px;">กลับสู่หน้าหลัก</button>
											</form>																								
										</div>
																			
									</div>
								</div>
							</div>
						</div>
						<!--------------------------------------------------------------------------------------------------------------------------->						
				</div>
			</div>
		</main>
</div>
</body>

<script>	
	//----------------------------- Check ว่าใครกดรับงานระหว่างดู --------------------------
	$(document).ready(function(){		
		function watching(){
			var id = '<?php echo $id;?>';
			$.ajax({
				url:"./watch_accept_status",
				method:"POST",
				dataType:"JSON",
				data:{'id':id},
				success:function(data){				
					if(data[0].order_status == 1){
						setTimeout(function(){
							$('#watch').modal('show'); 
							$('#adname').html(data[0].admin_accept_name);
						},1500)					
					}				
				}
			})
		}
		setInterval(function(){
			watching()
		},1500)
	})	
	/////////////////////////////////////// Accept Order /////////////////////////////////////////
	async function accept_order_fix() {
		var id = '<?php echo $id;?>';
		var ad_username = '<?php echo $this->session->userdata('username');?>';		
					
		await $.ajax({
			url : "./send_email_accept",
			method : "POST",
			data : {'id':id},			
		})
		await $.ajax({
			url : './report_fix_order_update_accept',
			method : 'POST',
			data : {'ad_username' : ad_username , 'id':id },
			success : setTimeout(function(){window.history.back()},500)												
		})
	}

	/////////////////////////////////////// CANCLE /////////////////////////////////////////
	function swipe(){
		$('#cancle').collapse('hide');
	}		
	async function cancle_order(){
		var id = '<?php echo $id;?>';
		var ad_username = '<?php echo $this->session->userdata('username');?>';	
		var cancle_detail = $('textarea[id="cancleDetail"]').val();
		await $.ajax({
			url : "./cancle_order",
			method : "POST",
			data : {'id':id ,'cancle_detail':cancle_detail,'ad_username':ad_username},
			
		})
		await $.ajax({
			url : "./email_cancle_order",
			method : "POST",
			data : {'id':id ,'cancle_detail':cancle_detail },
			success : setTimeout(function(){window.history.back()},500)
		})
	}	
</script>

</html>
