<!DOCTYPE html>
<html lang="en">

<head>
<script src="https://cdn.tiny.cloud/1/euqkscw1tml3lks8z6j25kln7wli1altgkncqfia6vlb3rzd/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

</head>

<div class="wrapper">
	<?php include 'admainEDIT.php'?>

	<body>
		<main>
		<div class="table-responsive">
			<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">เขียนข่าว</p>
			<form id="form-test" enctype="multipart/form-data">
				<div class="table-responsive-md pb-4 pt-4">
					<div class="container" style="max-width:1000px;">
						<div class="form-group">
							<label style="padding-left: 4px;">ประเภท</label>							
							<select class="form-control" name="ntype" style="border-color: black;">
		            			<?php 
		            				foreach($ntype as $row){ 
		              					echo '<option value="'.$row->type.'">'.$row->type.'</option>';
		           					}
		            			?>
		            		</select>
						</div>
						<div class="form-group">
							<label>หัวข้อ</label>
							<input type="text" name="title" id="title_v" class="form-control" style="border-color: black; ">
							<span style="color:red" id="error_title"></span>
						</div>
			

						<div class="form-group">
							<label>เลือกรูป</label>						
							<div class="form-group">							
								<input type='file' name="n_image" id="imgInp" />   							
							</div>
							<div class="form-group" >						
								<img id="blah" src="https://www.teamgroup.co.th/wp-content/themes/consultix/images/no-image-found-360x260.png" />
							</div>
							<span style="color:red" id="error_img"></span><br>
							<span style="color:red" id="error_img_now"></span>
						</div>



						<div class="form-group">
							<label>เนื้อหา</label>
							<textarea class="form-control" id="txtEditor" name="txtEditor" rows="12" ></textarea>
							<span style="color:red" id="error_txt"></span>
						</div>

						<div class="text-center pb-4">
							<div class="row justify-content-center pt-2">
								<div class="col-sm-4">
									<button type="submit" class="btn btn-md btn-block green accent-3 text-white" style="font-size:20px;">ยืนยัน</button>
								</div>
								<div class="col-sm-4">
									<a href="<?php echo base_url()?>ad_news/ad_news_all">
										<button type="button" class="btn btn-md btn-block red accent-4 text-white" style="font-size:20px;">ย้อนกลับ</button>
									</a>
								</div>			
							</div>
						</div>
					</div>
				</div>
			</form>
				<!----------------------------------------- Del item modal------------------------------------------->
				<div class="modal fade " id="conf_modal" tabindex="-1" role="dialog"  aria-hidden="true" 
					style="font-family: 'Kanit', sans-serif;" data-backdrop="static">
					<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
						<div class="modal-content z-depth-2" style="padding-inline-end: 20px;  padding-inline-start: 20px;">
							<div class="modal-body text-center">
								<br/>
								<i class="fas fa-file-alt" style="font-size:25px;"></i><a class="font-weight-bolder" style="font-size:24px;">   ยืนยันข้อมูล</a>																
							</div>																																
								<div class="modal-body text-center">
									<div class="row justify-content-center mb-3">
										<div class="col-4">																													
											<button  id="send_inf" class="btn btn-md btn-block green accent-3 text-white" style="font-size:16px;">ยืนยัน</button>																																		
										</div>
										<div class="col-4">	
											<button  id="dis_modal" class="btn btn-md btn-block red accent-4 text-white" style="font-size:16px;" id="closemodal">ยกเลิก</button>																															
										</div>	
									</div>
								</div>																											
							</div>
						</div>
					</div>				
				<!-------------------------------------------------------------------------------------------------------------------->	

		</div>
		</main>
	</body>
<script>


$('#form-test').on('submit',function(e){
	e.preventDefault();



	const title_v = document.getElementById('title_v').value
	const img_h = document.getElementById('blah').clientHeight
	const img_w = document.getElementById('blah').clientWidth	
	const img_n = document.getElementById('blah').src.split('/').pop().split('.')[0] // default img name -> use to check error
	const txt_inner = document.getElementById('txtEditor').parentNode.childNodes[4].childNodes[0].childNodes[1].childNodes[0].childNodes[0].contentWindow.document.childNodes[1].childNodes[1].innerHTML
	//console.log(img_n)
	//console.log(title_v)
	//console.log(img_w+'x'+img_h)
	console.log(txt_inner)



	let total_err = 0;
	if(title_v == 0){
		$('#error_title').html('โปรดระบุหัวข้อ')
		total_err++
	}else{
		$('#error_title').html('')
	}

	

	if(img_w <= 1024 && img_h <= 1024 && img_n != 'no-image-found-360x260'){
		$('#error_img').html('')
		$('#error_img_now').html('')
	}else{
		$('#error_img').html('ขนาดของรูปภาพไม่ถูกต้อง [กว้าง x ยาว = 1024 x 1024] ')
		$('#error_img_now').html('**ขนาดของรูปภาพปัจจุบัน '+img_w+' x '+img_h)
		total_err++
	}
	if(img_n == 'no-image-found-360x260'){
		$('#error_img').html('โปรดเลือกรูปภาพ')
		$('#error_img_now').html('')
	}

	if(txt_inner == '<p><br data-mce-bogus="1"></p>'){
		$('#error_txt').html('โปรดระบุเนื้อหา')
		total_err++
	}else{
		$('#error_txt').html('')
	}	
	//console.log(total_err)


	if(total_err == 0 ){
		$('#conf_modal').modal('show')		
	}
	$('#dis_modal').on('click',function(){
		$('#conf_modal').modal('hide')
	})


})



$('#send_inf').click(function(){
		setTimeout(function(){	 // settimeout because found BUG when send data . content in textEditor not update immediately
		let form_d = document.getElementById('form-test')
		let x1 = new FormData(form_d)
			$.ajax({
				url:"<?php echo base_url()?>Ad_news/do_upload",
				method: 'POST',
				data: x1,
				dataType: 'json',
				contentType: false,
				cache: false,
				processData:false,
				success:function(data){
					$(location).attr('href','<?php echo base_url();?>ad_news')
				}				
			})
		}) 
		//console.log('send !!')
	})









/*
	let x = document.getElementById('v_img')
	$.ajax({
		url:"<?php echo base_url()?>Ad_news/do_upload",
		method:"POST",
		data:{'v_img':x.value}
	})
	console.log(x.value)
	*/













tinymce.init({
    selector: '#txtEditor',
    plugins: 'print preview fullpage paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
	imagetools_cors_hosts: ['picsum.photos'],
	menubar: 'file edit view insert format tools table help',
	toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
	toolbar_sticky: true,
	autosave_ask_before_unload: true,
	autosave_interval: "30s",
	autosave_prefix: "{path}{query}-{id}-",
	autosave_restore_when_empty: false,
	autosave_retention: "2m",
	image_advtab: true,
	content_css: [
    	'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    	'//www.tiny.cloud/css/codepen.min.css'
  	],
  	importcss_append: true,
  	height: 400,
  	file_picker_callback: function (callback, value, meta) {
    /* Provide file and text for the link dialog */
    	if (meta.filetype === 'file') {
    		callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
    	}

    /* Provide image and alt text for the image dialog */
    	if (meta.filetype === 'image') {
    		callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
    	}

    /* Provide alternative source and posted for the media dialog */
	    if (meta.filetype === 'media') {
	    	callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
	    }
	},
  	templates: [
        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
    	{ title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
    	{ title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
  	],
  	template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
  	template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
 	height: 600,
  	image_caption: true,
  	quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
  	noneditable_noneditable_class: "mceNonEditable",
  	toolbar_drawer: 'sliding',
  	contextmenu: "link image imagetools table",
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function(){
    readURL(this);
});







</script>
</html>