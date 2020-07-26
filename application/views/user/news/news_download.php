<?php include 'news_mainEDIT.php'?>
<!------------------------------------------------------------- Table --------------------------------------------------------------->
<main>
	<div class="f_dwn">
		<div class="t_label">
			<label class="lb_1">ดาวน์โหลดเอกสาร</label>
		</div>
		<div class="filter">
			<label>หมวดหมู่:</label>
			<select class="form-control" id="filter_cate">
				<option value="0">ทั้งหมด</option>
				<?php						
							foreach($group_data as $row){
								echo '<option>'.$row->category.'</option>';
							}
						?>
			</select>
		</div>

		<table class="table table-bordered table-hover text-nowrap mytable z-depth-1">
			<thead class="thead-light z-depth-1">
				<tr>
					<th class="text-center">ชื่อไฟล์</th>
					<th class="text-center">หมวดหมู่</th>
					<th class="text-center">วันที่อัพโหลด (ป/ด/ว)</th>
					<th class="text-center">ดาวน์โหลด</th>
				</tr>
			</thead>
			<tbody>
				<?php  foreach($files as $row){ ?>
				<tr>
					<td class="nf_fname"><?php echo $row->file_name;?></td>
					<td class="nf_grp">
						<?php
                                        $d = $row->category;
                                        $d = explode(',',$d);
                                        $n = count($d);
                                        for($i=0;$i<$n;$i++){
                                            echo '<a>'.$d[$i].'</a><br>';
                                        } 
                                    ?>
					</td>
					<td class="nf_time"><?php echo date('Y-m-d',strtotime($row->date))?></td>
					<td class="text-center font-weight-bolder nf_dwn">
                        <div onclick="dn(f_n = '<?php echo $row->file_name;?>')">
                            <button class="btn red accent-2 news_btn"><i class="fas fa-file-pdf"></i></button>
                        </div>
					</td>
				</tr>
				<?php  } ?>
			</tbody>
		</table>
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
	/* ----------------------------------- Filter Category -------------------------------- */
	const base_url = '<?php echo base_url()?>'
	const fv = document.querySelector('#filter_cate')
	fv.onchange = () => {
		let v = fv.value
		$(location).attr('href', base_url + 'news/files?grp=' + v)
	}
	/* ----------------- Setvalue Filter Option Selected --------------- */
	window.onload = () => {
		const a = window.location.search
		const v_url = new URLSearchParams(a)
		if (v_url.has('grp') == false) {
			return
		} else {
			let v = v_url.get('grp')
			let a = document.getElementById('filter_cate').children
			for (let i of a) {
				if (i.value == v) {
					i.selected = 'true'
				}
			}
		}
	}

	/* --------------------------------- ------------------------------------------------------*/
	function dn(f_n) {
		$(location).attr('href', base_url + '/files_download/' + f_n)
	}




	$('.mytable').dataTable({
		order: [
			[2, 'desc']
		],
		"columnDefs": [
			{ "width": "55%", "targets": 0 },
			// { "width": "15%", "targets": 1 },
			// { "width": "15%", "targets": 2 },
			// { "width": "10%", "targets": 3 }         
		],
		responsive: true,
		responsive: {
			details: false
		}
	});

</script>

</html>
