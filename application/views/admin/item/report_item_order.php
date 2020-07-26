<!DOCTYPE html>
<html lang="en">

<head>
<title>รีพอร์ตยืมของ</title>

</head>

<div class="wrapper">
	<?php include 'admainEDIT.php'?>
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
						<label >รายการที่ขอยืม</label>	
							<?php $j=0; ?>						
							<?php foreach($item_list as $col) { ?>
							<div class="form-inline pb-1" >
								<input class="form-control col-2" value="<?php echo $col->item_type;?>" readonly></input>
								<input class="form-control col-8" value="<?php echo $col->item_name;?>" style="max-width:373px; margin-right:3px; margin-left:3px;"readonly></input>
								<input class="form-control col-2" value="<?php echo $col->item_unit;?>" id="unit_id<?php echo $j?>" oninput="max_number(id = 'unit_id<?php echo $j?>')" type="" max="<?php echo $col->item_unit;?>" <?php if($col->item_type == 'ครุภัณฑ์'){echo "readonly";};?>></input>
							</div>
							<?php $j++; } ?>
							
					</div>
					<div class="form-group" id="req_pd_id">						
						<div class="form-inline" ><label>รายการเลขครุภัณฑ์</label></div>
						<?php 	
							//---- คำนวณแถวที่ต้อง show และเก็บ item_type & item_name ไปแสดงผลในแต่ละแถว ----											
							$p_row = 0;
							$p_data = array();
							$i = 0;
							foreach($item_list as $col){								
								$item_type = $col->item_type;
								$item_name = $col->item_name;
								$item_unit = $col->item_unit; // item_unit use for max-select
								if($item_type == "ครุภัณฑ์"){									
									$p_data[$i][0] = $item_type;
									$p_data[$i][1] = $item_name;
									$p_data[$i][2] = $item_unit;
									$p_row = $p_row+1;
									$i = $i+1;							
								}								
							}
							//---- count แต่ละครุภัณฑ์ ว่ามี product_id กี่ตัว ใน array ที่ส่งมา ----
							$each_pd_id_count = array(); // calculate max data for fetch in each row
							$pd_id_data = count($product_id);
							//echo $pd_id_data;
							//if($product_id[1] == "null"){ echo '1';}
							//print_r($product_id);
							for($i=0;$i<$pd_id_data;$i++){
								$each_pd_id_count[$i] = count($product_id[$i]);
							}
							//---- fetch row ----
							for($i=0;$i<$p_row;$i++) { 														
						?>
							<!----- loop i = แถวยาว , loop k = product_id ใน selector ----->
							<div class="form-inline" style="margin-bottom: -8px;">
								<input class="form-control col-2"  value="<?php print_r($p_data[$i][0])?>"readonly></input>
								<input class="form-control col-8"  value="<?php print_r($p_data[$i][1])?>"style="max-width:263px; margin-left:5px;"readonly></input>
								<div class="row report_req_row" >
									<select multiple class="selectpicker" id="id_select<?php echo $i?>" data-width="200px" data-max-options="<?php print_r($p_data[$i][2])?>" data-style="btn-danger" data-live-search="true" data-selected-text-format="count" title="เลือกเลขครุภัณฑ์" multiple>
										<?php for($k=0;$k<$each_pd_id_count[$i];$k++) { ?>											
											<option class="multi_pd_id"><?php print_r($product_id[$i][$k]['item_id']);?></option>
										<?php } ?>
									</select>									
								</div>
								<span class="pd_id_error float-right" id="select_error<?php echo $i?>"></span>
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
					<br/>
						<!--------------------------------------------ACCEPT & BACK BUTTON ----------------------------------------------->						
						<div class="row justify-content-center pt-2">
							<div class="col-sm-5">																
								<button type="button" class="btn btn-lg btn-block mb-3 green accent-3 text-white" 									
									onclick="check_product_id()" style="font-size:20px;" data-toggle="modal" data-target="">
									อนุมัติการยืม
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

						<!------------------------------------------ CANCEL ORDER ---------------------------------------------->
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
						<!----------------------------------- CONFIRM when product_id not complete --------------------------------------->						
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
											<form action="<?php echo base_url();?>ad_item/ad_item_order">																			
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
				url:"<?php echo base_url(); ?>ad_item/watch_accept_status",
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

	//----------------------- Max unit (item_product) -----------------------
	function max_number(id){ // onkeyup is the best for this validate
		// const max_val = max;
		// const input_val = $('#'+id).val()
		// const sum = max_val-input_val;
		// if(sum < 0){
		// 	$('#'+id).val(max_val);
		// }

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
		if (sum == max) { // if max != 0 but user input 0 > set to max 
			$('#' + id).val(max)
			return
		}
	}	

	//--------------------------------------------------------------- Onload Page ------------------------------------------------------------
	window.onload = fetch_product_id();
	function fetch_product_id(){				
		//---- total children row in #req_list ----- 
		var count_product_id = document.getElementById('req_list').childNodes

		//---- p_row for count how many product_id have in this request
		var p_row = 0;
		for(i=3;i<=count_product_id.length-2;i=i+2){					
			let type = document.getElementById('req_list').childNodes[i].childNodes[1].value //item_type
			if(type == "ครุภัณฑ์"){
				p_row++;				
			}							
		}	

		//----- Hide รายการเลขครุภัณฑ์ ถ้ารายการนั้นไม่มีรายการครุภัณฑ์ -------
		if(p_row == 0){
			document.getElementById('req_pd_id').style.display = "none";
		}

			
		
	}
	//-------------------------------------------- Check product_id select (when click อนุมัติการยืม) -----------------------------------------------------
	function check_product_id(){
		//---- total children row in #req_list ----- 
		var count_product_id = document.getElementById('req_list').childNodes

		//---- p_row for count how many product_id have in #req_list
		var p_row = 0;
		for(i=3;i<=count_product_id.length-2;i=i+2){					
			let type = document.getElementById('req_list').childNodes[i].childNodes[1].value //item_type
			if(type == "ครุภัณฑ์"){
				p_row++;				
			}							
		}
		//----- loop i : row of product , loop m : position array of max_pd_id ------  ***find max value
		var max_pd_id = Array(); // 
		let m = 0;	
		for(i=3;i<=count_product_id.length-2;i=i+2){					
			var pd_id_type = document.getElementById('req_list').childNodes[i].childNodes[1].value //item_type
			var pd_id_unit = document.getElementById('req_list').childNodes[i].childNodes[5].value //item_unit
			if(pd_id_type == "ครุภัณฑ์"){											
				max_pd_id[m] = pd_id_unit
				m++;				
			}										
		}														
		//console.log(max_pd_id.length)

		//------ get selected product_id value -------
		var select_data = Array();
		for(let i=0;i<p_row;i++){
			let x = $('#id_select'+i).val();
			select_data[i] = x
		}
		
		//----- Check Error Value V2.0 ------
		var total_error = 0;
		for(let j=0;j<max_pd_id.length;j++){
			if(select_data[j].length != max_pd_id[j]){
				//$('#select_error'+j).html('โปรดระบุ');
				total_error++;				
			}else{
				//$('#select_error'+j).html('');
			}
		}
		//console.log(total_error)		
		//console.log(select_data)

		//------ get selected email_data value -------
		var email_data = Array();
		var email_data_name = Array();
		for(let i=0;i<p_row;i++){
			let x = $('#id_select'+i).val();
			let pdid_name = document.getElementById('id_select'+i).parentElement.parentElement.parentElement.childNodes[3].value
			email_data[i] = x
			if(email_data[i] != 0){
				email_data_name[i] = pdid_name // ถ้าไม่ได้เลือกเลข จะต้องทำให้ว่าง เพื่อไม่ให้ error ตอน fetch ข้อมูล @ad_item line 123
			}												
		}

		//----- Check Data before send ------
		/*var select_data_sum = 0;
		for(let k=0;k<max_pd_id.length;k++){
			if(select_data[k].length != max_pd_id[k]){
				select_data_sum++;
			}
		}*/
		
		/* -------------------------------------------------- SEND DATA ------------------------------------------------------------ */
		const acp_btn = document.getElementById('accept_order_btn').onclick = async function(){
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
					//console.log(select_data)
					//console.log(req_data)
					await $.ajax({
						url : "<?php echo base_url();?>ad_item/send_email_accept",
						method : "POST",
						data :	{"id": id , 'req_data':req_data , 'email_data':email_data , 'email_data_name':email_data_name},
					})
					await $.ajax({
						url : "<?php echo base_url();?>ad_item/report_item_order_update_accept",
						method : "POST",
						data :	{"id": id , 'ad_username' : ad_username , 'req_data':req_data , 'row_count':row_count , 'select_data':select_data},
						success : setTimeout(function(){window.history.back()},1000)									
					})					
				}
		//------------- if total_error != 0 -> popup confirm modal---------------
		if(total_error != 0){
			//console.log(email_data);
			$('#areyousure').modal('show');		
			$('#areyousure_btn').click(function(){
				$('#areyousure').modal('hide');
				$('#accept_order').modal('show');
				acp_btn			
			});				
		}
		
		//-------------------------------------- if total_error == 0 -> popup modal -----------------------------------------------
		if(total_error == 0){
			// console.log(email_data);
			$('#accept_order').modal('show');
			acp_btn	
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
				url : "<?php echo base_url();?>ad_item/email_cancle_order",
				method : "POST",
				data : {'id':id ,'cancle_detail':cancle_detail },				
		})
		await $.ajax({
			url : "<?php echo base_url();?>ad_item/cancle_order",
			method : "POST",
			data : {'id':id ,'cancle_detail':cancle_detail,'ad_username':ad_username},
			success : setTimeout(function(){window.history.back()},500)
			
		})
		
	}	

</script>
</html>


