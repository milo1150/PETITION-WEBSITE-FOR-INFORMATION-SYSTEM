<!doctype html>
<html lang="en">

<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>แบบฟอร์มยืมของ</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url();?>/mdbootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="<?php echo base_url();?>/mdbootstrap/css/mdb.min.css" rel="stylesheet">
	<!-- Your custom styles (optional) -->
	<link href="<?php echo base_url();?>/mdbootstrap/css/style.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	<!-- Include Bootstrap Datepicker -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
	<!-- Include Bootstrap Timepicker -->
	<link href="<?php echo base_url();?>/timepicker/mdtimepicker.css" rel="stylesheet" >

	<link href="<?php echo base_url(); ?>/mdbootstrap/css/utility.css" rel="stylesheet">

	
	<?php date_default_timezone_set("Asia/Bangkok");?>
</head>

<div class="table-responsive text-center">
	<div class="container-fluid info-color z-depth-1-half" style="width:100%; font-family: 'Kanit', sans-serif;">
		<h3 class="req_header">แบบฟอร์มยืมของ</h3>
	</div>
</div>

	<div class="table-responsive-md pb-4 pt-4" style="font-family: 'Kanit', sans-serif;">
		<div class="container z-depth-1 reqform">
				<div class="form-row pb-2">
					<div class="col">
						<label>ชื่อ</label>
						<input type="text" id="firstname" class="form-control z-depth-1" oninput="form_change_value(id)">
						<span class="error_data" id="firstname_error"></span>
					</div>
					<div class="col">
						<label>นามสกุล</label>
						<input type="text" id="lastname" class="form-control z-depth-1" oninput="form_change_value(id)">
						<span class="error_data" id="lastname_error"></span>
					</div>
				</div>
				<div class="form-group">
					<label>เบอร์ติดต่อ</label>
					<input type="text" id="phonenum" class="form-control z-depth-1" oninput="form_change_value(id)">
					<span class="error_data" id="phonenum_error"></span>
				</div>
				<div class="form-group">
					<label>อีเมลติดต่อ</label>
					<input type="email" id="email" class="form-control z-depth-1" oninput="form_change_value(id)"> 
					<span class="error_data" id="email_error"></span>
				</div>
				<div class="form-group">
					<label>สังกัด/แผนก</label>
					<input type="text" id="section" class="form-control z-depth-1" oninput="form_change_value(id)">
					<span class="error_data" id="section_error"></span>
				</div>
				<div class="form-group">
					<label>รายการขอยืม</label>
						<div id="item_req"></div>						
						<div class="row justify-content-center">
							<button id="req_btn" value="-1" class="btn btn-sm amber accent-4 font-weight-bolder" style="margin-left: 18px; font-size: 16px;"><i class="fas fa-plus"></i> เพิ่มรายการ</button>
						</div>						
				</div>
																		
				<label>กำหนดคืน</label>
				<div class="form-row pb-2">
					<div class="col">
						<input type="text" class="form-control z-depth-1" id="datepicker" placeholder="วันที่" onchange="datetime_onchange_value(id)">
						<span class="error_data" id="datepicker_error"></span>
					</div>
					<div class="col">
						<input type="text" class="form-control z-depth-1" id="timepicker" placeholder="เวลา" style="background-color: #fff" onchange="datetime_onchange_value(id)">
						<span class="error_data" id="timepicker_error"></span>
					</div>
				</div>
				<div class="text-center pb-4">
					<div class="row justify-content-center pt-2">
						<div class="col-sm-6 pb-2">
							<button class="btn btn-lg btn-success btn-block" id="send_data"
								style="font-size:20px;">ยืนยัน</button>
						</div>
						<div class="col-sm-6">
							<a href="<?php echo base_url()?>request">
								<button type="button" class="btn btn-lg btn-danger btn-block" style="font-size:20px;">ย้อนกลับ</button>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	
			<!------------------------------------------------------ final modal---------------------------------------------------->
			<div class="modal fade " id="form_ready" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" 
				style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
					<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
						<div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
							<div class="modal-body text-center">
								<br/>
								<i class="fas fa-copy" style="font-size:25px;"></i><a class="font-weight-bolder" style="font-size:24px;">   ยืนยันแบบฟอร์ม</a>																
							</div>																																
								<div class="modal-body text-center">
									<div class="row justify-content-center mb-3">
										<div class="col-4">																													
											<button  id="confirm" class="btn btn-md btn-block green accent-3 text-white" style="font-size:16px;">ยืนยัน</button>																																		
										</div>
										<div class="col-4">	
											<button  onclick="dis_modal()" class="btn btn-md btn-block red accent-4 text-white" style="font-size:16px;">ยกเลิก</button>																															
										</div>	
									</div>
								</div>																											
							</div>
						</div>
					</div>				
				<!-------------------------------------------------------------------------------------------------------------------->	


<!-- Datepicker -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.th.min.js"></script>
<!-- Timepicker -->
<script src="<?php echo base_url();?>/timepicker/mdtimepicker.js"></script>




<script>
//---------- On input form value change error to null -----------
function form_change_value(id){
	let id_error = id+'_error';
	$('#'+id_error).html('');
	console.log(id_error)
}
function datetime_onchange_value(id){
	let id_error = id+'_error';
	$('#'+id_error).html('');
}

//-----------------------------------------------------APPEND ROW------------------------------------------------------
document.getElementById('req_btn').onclick = function(){req_row()}
function req_row(){
	// butoon value was -1 becuz we want to set array posiotion @zero
	x = $('#req_btn').val();
	x++;		
	$('#req_btn').val(x);	
	//console.log(x);
	$('#item_req').append('<div class="row item_row" id="req_row'+x+'" >'+
							//item_type
							'<div><select class="form form-control z-depth-1 item_type er_span" onchange="show_info_0(id)" id="item_type'+x+'">'+
									'<option value="0"></option>'+
									'<option value="product">วัสดุ</option>'+
									'<option value="product_id">ครุภัณฑ์</option>'+										
							'</select>'+
							'<span class="error_data" id="error_type'+x+'"></span></div>'+
							//item_name
							'<div class="col col_name"><select class="form-control z-depth-1 item_name" onchange="show_info_1(id)" id="item_name'+x+'">'+
								'<option value="0"></option>'+									
							'</select>'+
							'<span class="error_data" id="error_name'+x+'"></span></div>'+
							//item_unit
							'<div><input class="form-control z-depth-1 item_unit" type="number" id="item_unit'+x+'" oninput="check_val(id)" style="z-index: -1;"></input>'+
							'<span class="error_data" id="error_unit'+x+'"></span></div>'+
							//del
							'<i class="fas fa-minus-circle item_del" type="submit" id="item_del'+x+'" onclick="del_req(id)"></i>'+
						'</div><span class="error_row" id="error_row'+x+'"></span>');
	
}

//------------------------------------------------------DELETE ROW------------------------------------------------------
function del_req(id){
	// Delete row and -1 button value and return new value to req_btn
	let req_row = document.getElementById(id).parentElement.id
	let error_row = document.getElementById(id).parentElement.nextElementSibling.id
	//btn_value = document.getElementById('req_btn').value;
	//btn_value--
	//$('#req_btn').val(btn_value)

	$('#'+error_row).remove()
	$('#'+req_row).remove()
	
	console.log(error_row)
	console.log(req_row)
	//console.log(btn_value)
}
//---------------------------------------------------------SHOW INFORMATION-------------------------------------------------------
function show_info_0(id){
	var x = document.getElementById(id).value //item_type value
	var y = document.getElementById(id).parentElement.parentElement.childNodes[1].childNodes[0].id //item_name id
	var z = document.getElementById(id).parentElement.parentElement.childNodes[2].childNodes[0].id //item_unit id

	//var y = document.getElementById(id).parentElement.childNodes[1].id //item_name id
	//var z = document.getElementById(id).parentElement.childNodes[2].id //item_unit id
	//var a = document.getElementById(id).parentElement.parentElement.id
	//var b = document.getElementById(id).parentElement.parentElement.childNodes[2].id
	//console.log(id)
	//console.log(b)
	//console.log(y)
	//console.log(z)
	//console.log(a)
	//console.log(b)
	//------------------------ when item_type change value --------------------------
	if(x=="0"){
		$('#'+y).html('<option value="0"></option>')
		$('#'+z).val('') 
		document.getElementById(z).style.zIndex = -1;
	}

	if(x=='product'){
		$.ajax({
		url:"<?php echo base_url();?>request_item/product_item",
		method:"POST",
		dataType:"JSON",
		data:{'type':x,'name':null},
			success:function(data){
				//console.log(x+y)
				var product_list = Array();
				product_list[0] = '<option value="0"></option>';
				for(i=0;i<data.length;i++){
					product_list[i+1] = '<option>'+data[i].item_name+'</option>'
				}
				$('#'+y).html(product_list);
				$('#'+z).val('') 
				document.getElementById(z).style.zIndex = -1;
			}
		})
	};
	if(x=='product_id'){
		$.ajax({
		url:"<?php echo base_url();?>request_item/product_item",
		method:"POST",
		dataType:"JSON",
		data:{'type':x,'name':null},
			success:function(data){
				var product_id_list = Array();	
				product_id_list[0] = '<option value="0"></option>';				
				for(i=0;i<data.length;i++){
					product_id_list[i+1] = '<option>'+data[i].item_name+'</option>'
				}
				$('#'+y).html(product_id_list);
				$('#'+z).val('') 
				document.getElementById(z).style.zIndex = -1;
			}
		})
	}		
}
//------------------------------ when item_name value change -------------------------------
function show_info_1(id){		
		var x = document.getElementById(id).parentElement.parentElement.childNodes[0].childNodes[0].value // get value of item_type
		var y = document.getElementById(id).parentElement.parentElement.childNodes[1].childNodes[0].value // get value of item_name
		var z = document.getElementById(id).parentElement.parentElement.childNodes[2].childNodes[0].id // get id of item_unit for success

		//console.log(id)
		//console.log(x)
		//console.log(y)
		//console.log(z)
		
		
		if(x == "0"){
			document.getElementById(z).value = "";
			document.getElementById(z).style.zIndex = "-1";
		}	
		if(y == "0"){
			document.getElementById(z).value = "";
			document.getElementById(z).style.zIndex = "-1";
		}
		if(x == 'product'){			
			$.ajax({
					url:"<?php echo base_url();?>request_item/product_item",
					method:"POST",
					dataType:"JSON",
					data:{'type':x,'name':y},
					success:function(data){								
						$('#'+z).val(data[0].item_unit_remain);
						document.getElementById(z).max = data[0].item_unit_remain;						
					}
			})
		}		
		if(x == 'product_id'){
			$.ajax({
					url:"<?php echo base_url();?>request_item/product_item",
					method:"POST",
					dataType:"JSON",
					data:{'type':x,'name':y},
					success:function(data){			
						$('#'+z).val(data);
						document.getElementById(z).max = data;
					}
			})
		}	
		
	}
//------------------------------ Unit -------------------------------
function check_val(id){
		var max = document.getElementById(id).max;
	    var val = document.getElementById(id).value;
		var sum = max-val;
		console.log(val)
		if(sum < 0 || sum > max){		
			$('#'+id).val(max)
			//console.log('stop')
		}else{
			//console.log('ok')
		}
	}	

//-------------------------------------------------------SEND DATA--------------------------------------------------------
document.getElementById('send_data').onclick = function(){send_data()}
function send_data(){
	//-----------------count req_row---------------------
	var row_count = document.getElementById('item_req').childElementCount
	//console.log(row_count)
	
	//-------------get data in to Array------------------
	var req_data = Array();	
	// child[row].child[div].child[select].value
	//var a = document.getElementById('item_req').childNodes[1].childNodes[0].childNodes[0].value // item_type value
	//var b = document.getElementById('item_req').childNodes[1].childNodes[1].childNodes[0].value
	//var c = document.getElementById('item_req').childNodes[0].childNodes[2].value
	//var d = document.getElementById('item_req').childNodes[1].childNodes[0].childNodes[1].id

	//console.log(d)

	for(let i=0;i<row_count;i=i+2){
		let x = document.getElementById('item_req').childNodes[i].childNodes[0].childNodes[0].value // item_type value
		let y = document.getElementById('item_req').childNodes[i].childNodes[1].childNodes[0].value // item_name value
		let z = document.getElementById('item_req').childNodes[i].childNodes[2].childNodes[0].value // item_unit value
		 
		//var x = $('#item_type'+i).val();
		//var y = $('#item_name'+[i]).val();
		//var z = $('#item_unit'+[i]).val();
		//req_data[i] = new Array(x,y,z);
		//console.log(y)
		req_data[i] = [x,y,z]
	}

	//----------------------Check null value-------------------------
	var sum = 0;
	// i = req_row that get data , j = error_row for item that 0 remaining
	for(let i=0,j=1;i<row_count;i=i+2,j=j+2){
		let x = document.getElementById('item_req').childNodes[i].childNodes[0].childNodes[0].value // item_type value
		let y = document.getElementById('item_req').childNodes[i].childNodes[1].childNodes[0].value // item_name value
		let z = document.getElementById('item_req').childNodes[i].childNodes[2].childNodes[0].value // item_unit value
		let error_type = document.getElementById('item_req').childNodes[i].childNodes[0].childNodes[1].id //error_type id
		let error_name = document.getElementById('item_req').childNodes[i].childNodes[1].childNodes[1].id //error_name id
		let error_unit = document.getElementById('item_req').childNodes[i].childNodes[2].childNodes[1].id //error_unit id
		let error_row = document.getElementById('item_req').childNodes[j].id //error_row id
		//let req_row = document.getElementById('item_req').childNodes[i].id
		//console.log(error_row)
		if( x == "0"){
			$('#'+ error_type).html('โปรดระบุ');
			sum++;
		}else{
			$('#'+ error_type).html('')
		}
		if( y == "0"){
			$('#'+ error_name).html('โปรดระบุ');
			sum++;
		}else{
			$('#'+ error_name).html('')
		}
		if( z == ""){
			$('#'+ error_unit).html('โปรดระบุ');
			sum++;
		}else{
			$('#'+ error_unit).html('')
		}
		if( z == "0"){
			$('#'+ error_row).html('ของหมด');
			sum++;
		}else{
			$('#'+ error_row).html('');
		}
		/*if( x != "0" && y != "0" && z == "0"){
			$('#'+).
			//document.getElementById(error_name).style.paddingLeft = "119px";
			//$('#'+ error_name).html('ของหมด');
			sum++;
		}*/

	}
	
	console.log(req_data)
	console.log('sum ='+sum)

	/*if(sum == 0){
		console.log('data ok!')
	}*/
	
	//-------------------------------------------------------FORM DATA--------------------------------------------------------
	let firstname = $('#firstname').val();
	let lastname = $('#lastname').val(); 
	let phonenum = $('#phonenum').val(); 
	let email = $('#email').val(); 
	let section = $('#section').val(); 
	let date = $('#datepicker').val();
	let time = $('#timepicker').val();	 
	$.ajax({
		url:"<?php echo base_url()?>request_item/error",
		method:"post",
		dataType:"json",
		data:{'firstname':firstname,'lastname':lastname,'phonenum':phonenum,'email':email,'section':section,'date':date,'time':time},
		success:function(data){
			$('#firstname_error').html(data.firstname_error);
			$('#lastname_error').html(data.lastname_error);
			$('#phonenum_error').html(data.phonenum_error);
			$('#email_error').html(data.email_error);
			$('#section_error').html(data.section_error);
			$('#datepicker_error').html(data.date_error);
			$('#timepicker_error').html(data.time_error);
			console.log(data)
			if(data.firstname != null && sum == 0 && req_data != 0){
			//if(sum == 0){
			//console.log('data ready')
				//------------------- Clear โปรดระบุ ---------------------
				$('#firstname_error').html('');
				$('#lastname_error').html('');
				$('#phonenum_error').html('');
				$('#email_error').html('');
				$('#section_error').html('');
				$('#date_error').html('');
				$('#time_error').html('');
				$('#form_ready').modal('show');
				//--------------------- popup confirm modal-----------------
				let confirm = document.getElementById('confirm').onclick = function(){
						$.ajax({
						url:"<?php echo base_url()?>request_item/accept_data",
						method:"post",
						dataType:"json",
						data:{'firstname':firstname,'lastname':lastname,'phonenum':phonenum,'email':email,'section':section,'date':date,'time':time,'req_data':req_data},
						success:function(data){
							$(location).attr('href','<?php echo base_url();?>request_item/success')
						}
					})
				}
				confirm;				
			}
		}
	})	
}
function dis_modal(){
	$('#form_ready').modal('hide');
}
	
// Data Picker Initialization
$("#datepicker").datepicker({
	format: 'dd-mm-yyyy',
    startDate: "-Infinity",
    daysOfWeekHighlighted: "0,6",
    todayBtn: "linked",
    language: "th",
    todayHighlight: true
});
// Time Picker Initialization
$('#timepicker').mdtimepicker({
	format: 'hh:mm tt'
});
</script>
</body>

</html>