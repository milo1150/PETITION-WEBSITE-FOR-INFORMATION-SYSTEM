<?php include 'news_mainEDIT.php'?>
<main>
	<div class="">
		<!------------------------------------------------ Carousel slider ---------------------------------------------------->
		<div class="slide-carousel">
			<!--Carousel Wrapper-->
			<div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
				<!--Indicators-->
				<ol class="carousel-indicators">
					<li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-example-1z" data-slide-to="1"></li>
					<li data-target="#carousel-example-1z" data-slide-to="2"></li>
				</ol>
				<!--/.Indicators-->
				<!--Slides-->
				<div class="carousel-inner" role="listbox">
				<?php foreach($carousel as $row){?>
					
					<div class="carousel-item <?php if($row->slide_order == 'order1'){echo 'active';}?>">
						<img class="d-block w-100" style="
                        background-image:url('<?php echo $row->img_name;?>');						
                        background-size:cover;
                        background-position: center;
                    ">			
				</div>
				<?php } ?>
				<!------- Controls ------->
				<a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
			<!--/.Carousel Wrapper-->
		</div>
		<!----------------------------------------------------------- NEWS -------------------------------------------------------->
		<!-------------------------------- LABEL --------------------------------->
		<div class="news-box-label">
			<ul id="ul-labelx">
				<li id="nlabel0" onclick="label_active(id)" class="news-label-active">ข่าวทั้งหมด</li>
				<li id="nlabel1" onclick="label_active(id)">ข่าวทั่วไป</li>
				<li id="nlabel2" onclick="label_active(id)">ข่าวมหาวิทยาลัย</li>
				<li id="nlabel3" onclick="label_active(id)">ข่าวสารสนเทศ</li>
				<li id="nlabel4" onclick="label_active(id)">อื่นๆ</li>
			</ul>

		</div>
		<!-------------------------------- Box to Box --------------------------------->
		<!------------------------ row Content  *** fetch ประเภทข่าวทีเดียว 5 ประเภท ------------------------>
		<div class="news-body table-responsive" id="news_content">
			<div class="row" id="r_new0" style="display:flex">
				<div id="t1"></div>
				<?php foreach($data0 as $row){ ?>
				<div class="col-lg-3 box-content">
					<form class="news_content" onclick="go2_cont(this)">
						<div class="inside">
							<div class="b-img"><img src="<?php echo base_url().'uploads/'.$row->img_name;?>"></div>
							<span class="b-head"><?php echo $row->title;?></span>
							<hr>
							<i class="far fa-calendar-alt"></i>&nbsp;<span
								class="b-time"><?php echo date('d/M/Y',strtotime($row->post_date))?></span>
							<input name="title" value="<?php echo $row->title;?>" hidden></input>
						</div>
					</form>
				</div>
				<?php } ?>
			</div>
			<div class="row" id="r_new1" style="display:none">
				<div id="t1"></div>
				<?php foreach($data1 as $row){ ?>
				<div class="col-lg-3 box-content">
					<form class="news_content" onclick="go2_cont(this)">
						<div class="inside">
							<div class="b-img"><img src="<?php echo base_url().'uploads/'.$row->img_name;?>"></div>
							<span class="b-head"><?php echo $row->title;?></span>
							<hr>
							<i class="far fa-calendar-alt"></i>&nbsp;<span
								class="b-time"><?php echo date('d/M/Y',strtotime($row->post_date))?></span>
							<input name="title" value="<?php echo $row->title;?>" hidden></input>
						</div>
					</form>
				</div>
				<?php } ?>
			</div>
			<div class="row" id="r_new2" style="display:none">
				<div id="t1"></div>
				<?php foreach($data2 as $row){ ?>
				<div class="col-lg-3 box-content">
					<form class="news_content" onclick="go2_cont(this)">
						<div class="inside">
							<div class="b-img"><img src="<?php echo base_url().'uploads/'.$row->img_name;?>"></div>
							<span class="b-head"><?php echo $row->title;?></span>
							<hr>
							<i class="far fa-calendar-alt"></i>&nbsp;<span
								class="b-time"><?php echo date('d/M/Y',strtotime($row->post_date))?></span>
							<input name="title" value="<?php echo $row->title;?>" hidden></input>
						</div>
					</form>
				</div>
				<?php } ?>
			</div>
			<div class="row" id="r_new3" style="display:none">
				<div id="t1"></div>
				<?php foreach($data3 as $row){ ?>
				<div class="col-lg-3 box-content">
					<form class="news_content" onclick="go2_cont(this)">
						<div class="inside">
							<div class="b-img"><img src="<?php echo base_url().'uploads/'.$row->img_name;?>"></div>
							<span class="b-head"><?php echo $row->title;?></span>
							<hr>
							<i class="far fa-calendar-alt"></i>&nbsp;<span
								class="b-time"><?php echo date('d/M/Y',strtotime($row->post_date))?></span>
							<input name="title" value="<?php echo $row->title;?>" hidden></input>
						</div>
					</form>
				</div>
				<?php } ?>
			</div>
			<div class="row" id="r_new4" style="display:none">
				<div id="t1"></div>
				<?php foreach($data4 as $row){ ?>
				<div class="col-lg-3 box-content">
					<form class="news_content" onclick="go2_cont(this)">
						<div class="inside">
							<div class="b-img"><img src="<?php echo base_url().'uploads/'.$row->img_name;?>"></div>
							<span class="b-head"><?php echo $row->title;?></span>
							<hr>
							<i class="far fa-calendar-alt"></i>&nbsp;<span
								class="b-time"><?php echo date('d/M/Y',strtotime($row->post_date))?></span>
							<input name="title" value="<?php echo $row->title;?>" hidden></input>
						</div>
					</form>
				</div>
				<?php } ?>
			</div>
		</div>
		<!------------------------ More News ------------------------>
		<div class="row justify-content-center btn-moreinfo">
			<form action="<?php echo base_url()?>news/allnews" method="post"><button type="submit"
					class="btn btn-lg">ข่าวสารทั้งหมด</button></form>
		</div>
	</div>
</main>

<?php $this->load->view('user/news/news_footer');?>

<script>
	window.onload = function () {
		/* ---------------------------------- Delete ul-labelx ------------------------------ */
		let win_media = window.matchMedia("(max-width:600px)")
		if (win_media.matches == true) {
			/* --------------------------------- News Category --------------------------------- */
			document.getElementById('ul-labelx').remove()
			$('.news-box-label').append('<select class="form-control z-depth-1" onchange="swap_topic(value)">' +
				'<option value="nlabel0">ข่าวทั้งหมด</option>' +
				'<option value="nlabel1">ข่าวทั่วไป</option>' +
				'<option value="nlabel2">ข่าวมหาวิทยาลัย</option>' +
				'<option value="nlabel3">ข่าวสารสนเทศ</option>' +
				'<option value="nlabel4">อื่น</option>' +
				'</select>')
		}
	}

	function swap_topic(id) {
		let label_count = 5
		let num = id.charAt(id.length - 1)
		const now_row = 'r_new' + num
		//console.log(now_row)
		// let r_ele = document.getElementById(row_id).hidden = true
		for (let i = 0; i <= label_count - 1; i++) {
			let oth_row = 'r_new' + i
			if (now_row == oth_row) {
				$('#' + now_row).css('display', 'flex').fadeIn(1000)
			} else {
				$('#' + oth_row).css('display', 'none')
			}
		}
	}






	/* On click Content */
	function go2_cont(form) {
		form.action = 'news/con'
		form.method = 'GET'
		form.submit()
	}

	//------------------------ on click news-label ---------------------
	function label_active(id) {
		document.getElementById(id).classList.add('news-label-active') // set class active label *CSS class
		let label_count = document.getElementById('ul-labelx').childElementCount // count child label
		let cur_label = id.charAt(id.length - 1) // get last sting 
		for (let i = 0; i <= label_count; i++) {
			if (i == cur_label) {
				i++
			}
			if (i > label_count) {
				return
			}
			$('#nlabel' + i).removeClass('news-label-active')
		}
		//console.log(label_count)
		//console.log(cur_label)
		/* ----------------- Set Active News --------------- */
		let num = id.charAt(id.length - 1)
		const now_row = 'r_new' + num
		//console.log(now_row)
		// let r_ele = document.getElementById(row_id).hidden = true
		for (let i = 0; i <= label_count - 1; i++) {
			let oth_row = 'r_new' + i
			if (now_row == oth_row) {
				$('#' + now_row).css('display', 'flex').fadeIn(1000)
			} else {
				$('#' + oth_row).css('display', 'none')
			}
		}
		// console.log(id)
	}

</script>

</html>
