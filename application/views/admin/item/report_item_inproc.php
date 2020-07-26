<!DOCTYPE html>
<html lang="en">

<head>
<title>รีพอร์ตยืมของ</title>
</head>

<div class="wrapper">
<?php $this->load->view('admin/admainEDIT');?>
	<body>
		<main>
			<div class="table-responsive">
				<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">รีพอร์ตยืมของ</p>
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
						<label >รายการขอยืม</label>
							<?php foreach($item_list as $col) {?>
							<div class="form-inline pb-1" >
								<input class="form-control col-2" value="<?php echo $col->item_type;?>" readonly></input>
								<input class="form-control col-8" value="<?php echo $col->item_name;?>" style="max-width:373px; margin-right:3px; margin-left:3px;"readonly></input>
								<input class="form-control col-2" value="<?php echo $col->item_unit;?>" readonly></input>
							</div>
							<?php } ?>
					</div>	
					<div class="form-group" id="req_list_detail">
						<label >รายการให้ยืม</label>
							<?php foreach($item_detail as $col) {?>
							<div class="form-inline pb-1" >
								<input class="form-control col-2" value="<?php echo $col->item_type;?>" readonly></input>
								<input class="form-control col-8" value="<?php echo $col->item_name;?>" style="max-width:373px; margin-right:3px; margin-left:3px;"readonly></input>
								<input class="form-control col-2" value="<?php if($col->item_type == "วัสดุ"){echo $col->item_unit;} if($col->item_type == "ครุภัณฑ์"){echo $col->item_id;}?>" readonly></input>
							</div>
							<?php } ?>
					</div>			
					<div class="form-row pb-2">
						<div class="col">
							<label>กำหนดคืน</label>
							<input class="form-control"placeholder="วันที่" value="<?php echo date('d-m-Y',strtotime($date)); ?>" readonly>						
						</div>
						<div class="col">
							<label>เวลา</label>
							<input class="form-control" placeholder="เวลา" value="<?php echo $time; ?>" readonly>						
						</div>
					</div>
					
						<div class="mt-5 mb-5">
							<hr class="style5">
							<div class="form-group">
								<label>ผู้รับงาน</label>
								<input type="text" name="fixetc" class="form-control" value="<?php echo $admin_accept_name;?>"
									readonly>
							</div>
							<div class="form-row pb-2">
								<div class="col">
									<label>วันที่รับงาน</label>
									<input class="form-control" readonly value="<?php echo date('d-m-Y',strtotime($admin_accept_date));?>">
								</div>
								<div class="col">
									<label>เวลา</label>
									<input class="form-control" readonly value="<?php echo $admin_accept_time;?>">
								</div>
							</div>
						</div>
						<!--////////////////////////////////////// BUTTON //////////////////////////////////////-->
						
						<div class="row justify-content-center pt-2">
							<div class="col-sm-4">																
							<button type="button" class="btn btn-lg btn-block mb-3 green accent-3 text-white" 									
								onclick="close_order()" style="font-size:20px;" data-toggle="modal" data-target="">
								ปิดงาน
							</button></div>

							<!-- Modal -->
							<div class="modal fade" id="close_order_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-body text-center">
											<a class="modal-body" id="close_order_modal">ปิดงาน<?php echo $type;?></a>
											<br/>
											<a>หมายเลขงาน : <?php echo $id;?></a>
											<br/>
											<a>ชื่อผู้แจ้ง : <?php echo $firstname;?> <?php echo $lastname;?></a>	
											<br/>
											<a>เบอร์ติดต่อ : <?php echo $phonenum;?></a>																					
										</div>																				
										<div class="modal-body row justify-content-center">
											<div class="col-5">
												<button type="button" id="send_data_btn" class="btn btn-lg btn-block green accent-3 text-white" style="font-size:18px;">ใช่</button>
											</div>
											<div class="col-5">
												<button type="button" class="btn btn-lg btn-block red accent-4 text-white" data-dismiss="modal"  style="font-size:18px;">ไม่ใช่</button>	
											</div>										
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-sm-4 pb-4">
								<button type="button" class="btn btn-lg btn-block red accent-4 text-white" onclick="history.back(-1)"
									style="font-size:20px;">ย้อนกลับ</button>
							</div>
						</div>
				</div>
		</main>		
</div>
</body>
<script>
	function close_order(){
		//------------------------ get value from each req_detail row ---------------------------
		let x = document.getElementById('req_list_detail').childNodes
		req_detail = Array();
		for(i=3,j=0;i<x.length;i=i+2,j++){
			let req_row_item_tpye = document.getElementById('req_list_detail').childNodes[i].childNodes[1].value;
			let req_row_item_name = document.getElementById('req_list_detail').childNodes[i].childNodes[3].value;
			let req_row_item_unit = document.getElementById('req_list_detail').childNodes[i].childNodes[5].value;
			req_detail[j] = [req_row_item_tpye,req_row_item_name,req_row_item_unit];			
		}
		//console.log(req_detail);
		
		//------- Send Data --------
		$('#close_order_modal').modal('show');
		const submit = document.getElementById('send_data_btn').onclick = async function(){
			var id = '<?php echo $id;?>';	
			var ad_username = '<?php echo $this->session->userdata('username');?>';
			await $.ajax({
				url : "<?php echo base_url();?>ad_item/send_email",
				method : "POST",
				data : {'id':id },				
			})
			await $.ajax({
				url : "<?php echo base_url();?>ad_item/report_item_order_update_close",
				method : "POST",
				data :	{'ad_username' : ad_username , 'id':id , 'req_detail':req_detail},
				success : setTimeout(function(){window.history.back()},100)									
			});			
		}
		submit;				
	}






/*
	function accept_order_item_inproc(){
			var id = '<?php echo $id;?>';	
			var ad_username = '<?php echo $this->session->userdata('username');?>';	  	

			let row_count = document.getElementById('req_list').childNodes.length-2;
			let req_data = Array();
			for(let i=3; i<=row_count ; i=i+2){
				// i = childNode[]-row 
				let item_type = document.getElementById('req_list').childNodes[i].childNodes[1].value;
				let item_name = document.getElementById('req_list').childNodes[i].childNodes[3].value;
				let item_unit = document.getElementById('req_list').childNodes[i].childNodes[5].value;
				req_data[i] = [item_type,item_name,item_unit]				
			}
			console.log(req_data)					
			$.ajax({
				url : "<?php echo base_url();?>ad_item/report_item_order_update_close",
				method : "POST",
				data :	{'ad_username' : ad_username , 'id':id , 'req_data':req_data , 'row_count':row_count},
				success : setTimeout(function(){window.history.back()},1000)									
			});
			
		}
*/
</script>
</html>


