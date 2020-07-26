<?php include 'news_mainEDIT.php'?>
<main>
	<!-------------------------------- Box to Box --------------------------------->
	<!------------------------ row 1 ------------------------>
	<div class="news-body table-responsive" id="allnews_box">
		<div class="top-content">
			<div><i class="fas fa-globe" style="font-size:25px;">&nbsp;</i>
				<p0>ข่าวทั้งหมด</p0>
			</div>
			<form id="fil-search">
				<div class="search-select">
					<select class="form-control m-select" name="m">
						<option value="00" <?php if($m == '00'){ echo 'selected';}?>>กรุณาเลือก</option>
						<option value="01" <?php if($m == '01'){ echo 'selected';}?>>มกราคม</option>
						<option value="02" <?php if($m == '02'){ echo 'selected';}?>>กุมภาพันธ์</option>
						<option value="03" <?php if($m == '03'){ echo 'selected';}?>>มีนาคม</option>
						<option value="04" <?php if($m == '04'){ echo 'selected';}?>>เมษายน</option>
						<option value="05" <?php if($m == '05'){ echo 'selected';}?>>พฤษภาคม</option>
						<option value="06" <?php if($m == '06'){ echo 'selected';}?>>มิถุนายน</option>
						<option value="07" <?php if($m == '07'){ echo 'selected';}?>>กรกฎาคม</option>
						<option value="08" <?php if($m == '08'){ echo 'selected';}?>>สิงหาคม</option>
						<option value="09" <?php if($m == '09'){ echo 'selected';}?>>กันยายน</option>
						<option value="10" <?php if($m == '10'){ echo 'selected';}?>>ตุลาคม</option>
						<option value="11" <?php if($m == '11'){ echo 'selected';}?>>พฤศจิกายน</option>
						<option value="12" <?php if($m == '12'){ echo 'selected';}?>>ธันวาคม</option>
					</select>
					<select class="form-control y-select" name="y">
						<option value="00" selected>กรุณาเลือก</option>
						<option <?php if($y == '2020'){ echo 'selected';}?>>2020</option>
						<option <?php if($y == '2021'){ echo 'selected';}?>>2021</option>
						<option <?php if($y == '2022'){ echo 'selected';}?>>2022</option>
						<option <?php if($y == '2023'){ echo 'selected';}?>>2023</option>
						<option <?php if($y == '2024'){ echo 'selected';}?>>2024</option>
					</select>
					<input class="form-control s-select" name="t" value="<?php echo $t;?>"></input>
					<button class="btn cyan lighten-3" id="search_btn"><i class="fas fa-search"></i>
						<p id="fil_text" style="display:none;">ค้นหา</p>
					</button>
				</div>
			</form>
		</div>
		<hr>
		<div id="news_content_row">
			<?php 
                    $news_count = $news_count; // $data['news_count'] from controller 
                    $news_show = 2; // set limit news for show in one page  // *** 1 INPUT FOR ALL OUTPUT <-- This line
                    $paginav = ceil($news_count/$news_show);  // มีเศษปัดขึ้น                  
                    $j=0;                     
                    foreach($data as $row) { 
                      
                ?>
			<div class="row row_cus">
				<form class="content_div" onclick="go_c(this)">
					<input name="title" value="<?php echo $row->title;?>" hidden></input>
					<div class="col">
						<img id="imgz" src="<?php echo base_url().'uploads/'.$row->img_name;?>"></img>
					</div>
					<div class="container-fluid">
						<div class="h_content">
							<?php echo $row->title;?>
						</div>
						<div class="b_content">
							<p1><?php echo $row->content;?></p1>
						</div>
						<div class="f_content">
							<i class="far fa-calendar-alt"></i>&nbsp;<p1>
								<?php echo date('d/M/Y',strtotime($row->post_date))?></p1>
						</div>
					</div>
				</form>
			</div>
			<?php $j++; if($j >= $news_show){break;}} ?>
		</div>
		<!----------------------------------- Pagination -------------------------------------->
		<nav aria-label="Page navigation example" id="navigation">
			<ul class="pagination pg-red">
				<?php for($i=1;$i<=$paginav;$i++){ 
                        echo '<li class="page-item" id="pag'.$i.'"><a class="page-link" href="'.base_url().'news/n_filter?m='.$m.'&y='.$y.'&t='.$t.'&page='.$i.'">'.$i.'</a></li>';                    
                    }?>
			</ul>
		</nav>
	</div>
</main>



<!------------------------ Footer ------------------------>
<footer>
	<div class="row">
		<div class="col-sm-4 footer-box">
			<p>Link อื่นๆ</p>
			<ul>
				<li><a href="">ระบบสารสนเทศเพื่อฐานข้อมูลศิลปวัฒนธรรม</a></li>
				<li><a href="">ระบบฐานข้อมูลทรัพยากรด้านเทคโนโลยีสารสนเทศ</a></li>
				<li><a href="">จรรยาบรรณบุคลากร</a></li>
				<li><a href="">ข้อบังคับว่าด้วยการบริหารงานบุคคลพนักงานมหาวิทยาลัย</a></li>
				<li><a href="">มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ</a></li>
			</ul>
		</div>
		<div class="col-sm-4 footer-box">
			<p>ติดต่อสำนักคอมพิวเตอร์ฯ มจพ. กรุงเทพฯ</p>
			<p1>สำนักคอมพิวเตอร์และเทคโนโลยีสารสนเทศ</p1><br>
			<p1>มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ</p1><br>
			<p1>ชั้น 5 อาคารอเนกประสงค์ ถนนประชาราษฎร์ 1 <br> แขวงวงศ์สว่าง เขตบางซื่อ กรุงเทพมหานคร 10800</p1><br>
			<hr>
			<p1><i class="fas fa-phone"></i> (+662) 555 2000 ต่อ 2205</p1><br>
			<p1><i class="fas fa-fax"></i> (+662) 555 2000 ต่อ 2205</p1><br>
			<p1><i class="fas fa-envelope"></i> icit_admin@kmutnb.ac.th</p1><br>
			<p1><i class="fas fa-user"></i> สายตรง ผอ. choopan.r@cit.kmutnb.ac.th</p1>


		</div>
		<div class="col-sm-4 footer-box">
			<p style="text-align: center">ติดตามเราได้ที่</p>
			<div class="contact-icon">
				<p2><i class="fab fa-facebook-square facebook"></i></p2>
				<p2><i class="fab fa-line line"></i></p2>
			</div>
		</div>
	</div>
</footer>
<script>
	/* --------------------------------------------- Search V2.0 -----------------------------------------  */
	document.getElementById('search_btn').addEventListener('click', function (e) {
		let form = document.getElementById('fil-search')
		form.action = 'n_filter'
		form.method = 'GET'
		form.submit()
	})
	// --------- If search no result ----------
	window.onload = function () {
		let con = document.getElementById('news_content_row').childElementCount
		if (con == 0) {
			$('#news_content_row').append('<p class="p-noData">ไม่มีข้อมูล<p>')
		}
	}

	/* ------ Set Active Pagination On Load ------  */
	$(document).ready(function () {
		let x = <?php echo $pagi_active;?>;
		let y = $('#pag' + x)[0].classList.add('active')
	})


	/* ------- Onclick content -> FORM.SUBIT ------- */
	function go_c(form) {
		form.action = 'con'
		form.method = 'get'
		form.submit()
		//console.log(form)
	}
</script>

</html>
