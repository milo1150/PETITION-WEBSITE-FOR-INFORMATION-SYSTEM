<!DOCTYPE html>
<html lang="en">

<head>
<title>รีพอร์ตเบิกของ</title>
</head>

<div class="wrapper">
<?php $this->load->view('admin/admainEDIT');?>
	<body>
		<main>
			<div class="table-responsive">
				<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">รีพอร์ตเบิกของ</p>			
				<div class="container z-depth-2 mb-4 pt-3" style="max-width:600px;">	
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
							<input class="form-control" value="<?php echo $firstname;?>" readonly>
						</div>
						<div class="col">
							<label>นามสกุล</label>
								<input class="form-control" value="<?php echo $lastname;?>" readonly>
						</div>
					</div>
					<div class="form-group">
						<label>เบอร์ติดต่อ</label>
							<input class="form-control" value="<?php echo $phonenum;?>" readonly>					
					</div>
					<div class="form-group">
						<label>อีเมลติดต่อ</label>
							<input type="email" name="email" class="form-control" value="<?php echo $email;?>" readonly> 
					</div>
					<div class="form-group">
						<label>สังกัด/แผนก</label>
							<input type="text" name="section" class="form-control" value="<?php echo $section;?>" readonly>
					</div>
					<div class="form-group" id="req_list">
						<label >รายการที่ขอเบิก</label>
							<?php $j=0; ?>
							<?php foreach($itemotp_list as $col) {?>
							<div class="form-inline pb-1" >
								<input class="form-control col-2" value="<?php echo $col->item_type;?>" readonly></input>
								<input class="form-control col-8" value="<?php echo $col->item_name;?>" style="max-width:373px; margin-right:3px; margin-left:3px;"readonly></input>
								<input class="form-control col-2" value="<?php echo $col->item_unit;?>" type="" max="<?php echo $col->item_unit;?>" id="unit_id<?php echo $j?>" oninput="max_number(id = 'unit_id<?php echo $j?>')"></input>
							</div>
							<?php $j++; } ?>
					</div>																		
					<br/>
						<!--////////////////////////////////////// ACCEPT & BACK BUTTON //////////////////////////////////////-->						
						<div class="row justify-content-center pt-2">
							<div class="col-sm-5">																
								<button type="button" class="btn btn-lg btn-block mb-3 green accent-3 text-white" 									
									onclick="fetch_product_id()" style="font-size:20px;" data-toggle="modal" data-target="">
									อนุมัติการเบิก
								</button>
							</div>				
							<!-- Modal -->
							<div class="modal fade" id="accept_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-body text-center">
											<a class="modal-body" id="exampleModalLabel">อนุมัติ<?php echo $type;?></a>
											<br/>
											<a>หมายเลขงาน : <?php echo $id;?></a>
											<br/>
											<a>ชื่อผู้แจ้ง : <?php echo $firstname;?> <?php echo $lastname;?></a>	
											<br/>
											<a>เบอร์ติดต่อ : <?php echo $phonenum;?></a>																					
										</div>																				
										<div class="modal-body row justify-content-center">
											<div class="col-5">
												<button type="button" class="btn btn-lg btn-block green accent-3 text-white" onclick="" id="accept_order_btn"  style="font-size:18px;">ใช่</button>
											</div>
											<div class="col-5">
												<button type="button" class="btn btn-lg btn-block red accent-4 text-white" data-dismiss="modal"  style="font-size:18px;">ไม่ใช่</button>	
											</div>										
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-sm-5">
								<button type="button" class="btn btn-lg btn-block red accent-4 text-white" onclick="history.back(-1)"
									style="font-size:20px;">ย้อนกลับ</button>
							</div>
						</div>

						<!-- ////////////////////////////////////////// CANCEL ORDER //////////////////////////////////////// -->
						<hr class="style5 mt-4">
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
						<!--////////////////////////////////////// CONFIRM when product_id not complete //////////////////////////////////////-->						
							<div class="modal fade" id="areyousure" tabindex="-1" role="dialog" aria-labelledby="areyousure" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-body text-center" style="padding-top: 30px; color: red; font-size: 17px;font-weight: bold;">
											<a class="modal-body" id="areyousure">รายการเลขครุภัณฑ์เลือกไม่ครบต้องการทำรายการต่อหรือไม่</a>
											<br/>																															
										</div>																				
										<div class="modal-body row justify-content-center">
											<div class="col-5">
												<button type="button" class="btn btn-lg btn-block green accent-3 text-white" onclick="" id="areyousure_btn"  style="font-size:18px;">ใช่</button>
											</div>
											<div class="col-5">
												<button type="button" class="btn btn-lg btn-block red accent-4 text-white" data-dismiss="modal"  style="font-size:18px;">ไม่</button>	
											</div>										
										</div>
									</div>
								</div>
							</div>
						<!-------------------------------------------------Watching in the same time------------------------------------------------>
						<div class="modal fade" id="watch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Kanit', sans-serif;" data-backdrop="static" data-keyboard="false" >
							<div class="modal-dialog modal-dialog-centered" id="exampleModalLabel" role="document">
								<div class="modal-content z-depth-2" style="box-shadow: 10px 10px 3px #aaaaaa;">
									<div class="modal-body text-center">
										<a class="modal-body font-weight-bolder"><br/>
											<!--------UPDATE ADMIN ACCEPT NAME------->
											<a class="font-weight-bolder" id="adname" style="font-size:20px;"></a>
											<a class="font-weight-bolder" style="font-size:20px;">อนุมัติงานแล้ว !</a>
										</a>
									</div>																				
									<div class="modal-body row justify-content-center">
										<div class="col-6">
											<form action="<?php echo base_url();?>ad_itemotp/ad_itemotp_order">																			
												<button type="submit" class="btn btn-lg btn-block mb-3 red accent-3 text-white" style="font-size:18px;">กลับสู่หน้าหลัก</button>
											</form>																								
										</div>
																			
									</div>
								</div>
							</div>
						</div>	
						<!---------------------------------------------------------------------------------------------------------------------------->	
							
		</main>		
</div>
</body>
<script>
	//----------------------------- Check ว่าใครกดรับงานระหว่างดู --------------------------
	$(document).ready(function(){			
		function watching(){
			var id = '<?php echo $id;?>';
			$.ajax({
				url:"<?php echo base_url(); ?>ad_itemotp/watch_accept_status",
				method:"POST",
				dataType:"JSON",
				data:{'id':id},
				success:function(data){				
					if(data[0].order_status == 2){
						setTimeout(function(){
							$('#watch').modal('show');							 
							$('#adname').html(data[0].admin_close_name);
						},1500)					
					}				
				}
			})
		}
		setInterval(function(){
			watching()
		},1500)
	})	
	//----------------------- Max unit (item_product) -----------------------
	function max_number(id){ // onkeyup is the best for this validate
		let max = document.getElementById(id).max;
		let val = document.getElementById(id).value;
		let sum = max - val;

		// ----------- Check item_unit input ------------
		const c = val.toString()
		const boo = /^\d+$/.test(c)
			// console.log(c)
			// console.log(boo)
		if (c == '' && boo == false) { // if input == null or nothing
			return
		}
		if (c.includes('.') && boo == false) { // if input has only dot
			$('#' + id).val(max)
			return
		}
		if (boo == false) { // if input not match regex
			$('#' + id).val(max)
			return
		}
		if (sum < 0 || sum > max) { // if input number more than max and less than 0	
			$('#' + id).val(max)
			return
		}
		// if (sum == max) { // if max != 0 but user input 0 > set to max 
		// 	$('#' + id).val(max)
		// 	return
		// }
	}	

	//--------------------------------------------------------------- Onload Page ------------------------------------------------------------
	function fetch_product_id(){				
			$('#accept_order').modal('show');
				document.getElementById('accept_order_btn').onclick = async function(){
					var id = '<?php echo $id;?>';	
					var ad_username = '<?php echo $this->session->userdata('username');?>';					
					//----- row มี text สลับ div จึงต้อง i=i+2 และ length-2 ----- 
					let row_count = document.getElementById('req_list').childNodes.length-2;
					let req_data = Array(); //---get data from request list
					for(let i=3; i<=row_count ; i=i+2){
						// i = childNode[]-row 
						let item_type = document.getElementById('req_list').childNodes[i].childNodes[1].value;
						let item_name = document.getElementById('req_list').childNodes[i].childNodes[3].value;
						let item_unit = document.getElementById('req_list').childNodes[i].childNodes[5].value;
						req_data[i] = [item_type,item_name,item_unit]				
					}					
					// console.log(req_data)
					await $.ajax({
						url : "<?php echo base_url();?>ad_itemotp/send_email",
						method : "POST",
						data : {'id':id },
					})
					await $.ajax({
						url : "<?php echo base_url();?>ad_itemotp/report_item_order_update_accept",
						method : "POST",
						data :	{"id": id , 'ad_username' : ad_username , 'req_data':req_data , 'row_count':row_count},
						success : setTimeout(function(){window.history.back()},300)									
					});
					
				}		
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
				url : "<?php echo base_url();?>ad_itemotp/email_cancle_order",
				method : "POST",
				data : {'id':id ,'cancle_detail':cancle_detail },
		})
		await $.ajax({
			url : "<?php echo base_url();?>ad_itemotp/cancle_order",
			method : "POST",
			data : {'id':id ,'cancle_detail':cancle_detail,'ad_username':ad_username},
			success : setTimeout(function(){window.history.back()},300)
		})
		
	}

</script>
</html>


