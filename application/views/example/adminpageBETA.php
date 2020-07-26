<!DOCTYPE html>
<html lang="en">
<head>
	<title>ICIT TEST</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Material Design Bootstrap</title>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url();?>/mdbootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="<?php echo base_url();?>/mdbootstrap/css/mdb.min.css" rel="stylesheet">
	<!-- Your custom styles (optional) -->
	<link href="<?php echo base_url();?>/mdbootstrap/css/style.css" rel="stylesheet">


	<?php date_default_timezone_set("Asia/Bangkok");?>  



	<!------------------------------------------------- SIDEBAR----------------------------------------------------->
	<!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->    
    <link href="<?php echo base_url();?>/mdbootstrap/css/adminpage.css" rel="stylesheet">



	<style type="text/css">
  
		
	</style>
</head>



<body>
	
		<div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <img src="https://www.sccpre.cat/mypng/full/175-1755005_hard-repair-fix-svg-png-icon-free-gear.png" style="width: 50px; height: 50px;">
            </div>

            <ul class="list-unstyled components">
            	<li>
                    <a href="#">หน้าหลัก</a>
                </li>                
                <li>
                    <a href="#">แจ้งเตือน</a>
                </li>                

                <li>
                    <a href="dashfix">แจ้งซ่อม</a>
                </li>
                <li>
                    <a href="dashfix">ขอเปิดอีเมล์</a>
                </li>
                <li>
                    <a href="dashfix">สแกนนิ้ว</a>
                </li>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">รีพอร์ตแอดมิน</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">รายบุคคล</a>
                        </li>
                        <li>
                            <a href="#">ทั้งหมด</a>
                        </li>                                            
                    </ul>
                </li>
                <li>
                    <a href="#">อัพเดทหน้าข่าว</a>
                </li>
            </ul>
            <!--
            <ul class="list-unstyled CTAs">
                <li>
                    <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>
                </li>
                <li>
                    <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>
                </li>
            </ul>
        	-->
        </nav>

        <!-- Navbar  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg aqua-gradient rounded mb-0 z-depth-2">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-dark">
                        <i class="fas fa-align-left"></i>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <form class="form-inline mr-auto">
						      <input class="form-control" type="text" placeholder="Search" aria-label="Search">
						      <!-- <button class="btn btn-mdb-color btn-rounded btn-sm my-0 ml-sm-2" type="submit">Search</button> -->
						    </form>
						    <li class="nav-item">
                                <a class="nav-link" href="#">LogIn</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Logout</a>
                            </li>	                            
                        </ul>
                    </div>
                </div>
            </nav>
<main>
	<div class="table-responsive">
	<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">ประวัติแจ้งเตือน</p>
	<table class="table table-bordered table-hover text-nowrap" style="margin-top: 10px;">
		<thead>
			<tr>
				<th scope="col">ประเภท</th>
				<th scope="col">วันที่</th>
				<th scope="col">เวลา</th>
			</tr>			
		</thead>
		<tbody>
						<tr>
				<td>แจ้งซ่อม</td>
				<td><?php echo "".date("d/m/Y")?></td>
				<td><?php echo "".date("H:i:s")?></td>
			</tr>
			<tr>
				<td>ขอเปิดอีเมล์</td>
				<td><?php echo "".date("d/m/Y")?></td>
				<td><?php echo "".date("H:i:s")?></td>
			</tr>
			<tr>
				<td>แจ้งซ่อม</td>
				<td><?php echo "".date("d/m/Y")?></td>
				<td><?php echo "".date("H:i:s")?></td>
			</tr>
			<tr>
				<td>สแกนนิ้ว</td>
				<td><?php echo "".date("d/m/Y")?></td>
				<td><?php echo "".date("H:i:s")?></td>
			</tr>
			
			
		</tbody>
		
	</table>
	</div>


	<div class="table-responsive">
	<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">รายการแจ้งซ่อม</p>
	<table class="table table-bordered table-hover text-nowrap" style="margin-top: 10px;">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">สถานที่</th>
				<th scope="col">แจ้งซ่อม</th>
				<th scope="col">วันที่</th>
				<th scope="col">เวลา</th>
				

			</tr>			
		</thead>
		<tbody>
			<tr>
				<td>1</td>
				<td>-</td>
				<td>-</td>
				<td><?php echo "".date("d/m/Y")?></td>
				<td><?php echo "".date("H:i:s")?></td>
			</tr>
			<tr>
				<td>2</td>
				<td>-</td>
				<td>-</td>
				<td><?php echo "".date("d/m/Y")?></td>
				<td><?php echo "".date("H:i:s")?></td>
			</tr>
			<tr>
				<td>3</td>
				<td>-</td>
				<td>-</td>
				<td><?php echo "".date("d/m/Y")?></td>
				<td><?php echo "".date("H:i:s")?></td>
			</tr>
			<tr>
				<td>4</td>
				<td>-</td>
				<td>-</td>
				<td><?php echo "".date("d/m/Y")?></td>
				<td><?php echo "".date("H:i:s")?></td>
			</tr>
			<tr>
				<td>5</td>
				<td>-</td>
				<td>-</td>
				<td><?php echo "".date("d/m/Y")?></td>
				<td><?php echo "".date("H:i:s")?></td>
			</tr>					
		</tbody>		
	</table>
	</div>



	<div class="table-responsive">
	<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">รายการขอเปิดอีเมล์</p>
	<table class="table table-bordered table-hover text-nowrap" style="margin-top: 10px;">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">ชื่อ-นามสกุล</th>
				<th scope="col">สังกัด/แผนก</th>
				<th scope="col">วันที่</th>
				<th scope="col">เวลา</th>
				

			</tr>			
		</thead>
		<tbody>
			<tr>
				<td>1</td>
				<td>-</td>
				<td>-</td>
				<td><?php echo "".date("d/m/Y")?></td>
				<td><?php echo "".date("H:i:s")?></td>
			</tr>
			<tr>
				<td>2</td>
				<td>-</td>
				<td>-</td>
				<td><?php echo "".date("d/m/Y")?></td>
				<td><?php echo "".date("H:i:s")?></td>
			</tr>
			<tr>
				<td>3</td>
				<td>-</td>
				<td>-</td>
				<td><?php echo "".date("d/m/Y")?></td>
				<td><?php echo "".date("H:i:s")?></td>
			</tr>
			<tr>
				<td>4</td>
				<td>-</td>
				<td>-</td>
				<td><?php echo "".date("d/m/Y")?></td>
				<td><?php echo "".date("H:i:s")?></td>
			</tr>
			<tr>
				<td>5</td>
				<td>-</td>
				<td>-</td>
				<td><?php echo "".date("d/m/Y")?></td>
				<td><?php echo "".date("H:i:s")?></td>
			</tr>					
		</tbody>		
	</table>
	</div>



	<div class="table-responsive">
	<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">รายการสแกนนิ้ว</p>
	<table class="table table-bordered table-hover text-nowrap" style="margin-top: 10px;">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">ชื่อ-นามสกุล</th>
				<th scope="col">สังกัด/แผนก</th>
				<th scope="col">ID SCAN</th>
				<th scope="col">วันที่</th>
				<th scope="col">เวลา</th>
				

			</tr>			
		</thead>
		<tbody>
			<tr>
				<td>1</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td><?php echo "".date("d/m/Y")?></td>
				<td><?php echo "".date("H:i:s")?></td>
			</tr>
			<tr>
				<td>2</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td><?php echo "".date("d/m/Y")?></td>
				<td><?php echo "".date("H:i:s")?></td>
			</tr>
			<tr>
				<td>3</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td><?php echo "".date("d/m/Y")?></td>
				<td><?php echo "".date("H:i:s")?></td>
			</tr>
			<tr>
				<td>4</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td><?php echo "".date("d/m/Y")?></td>
				<td><?php echo "".date("H:i:s")?></td>
			</tr>
			<tr>
				<td>5</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td><?php echo "".date("d/m/Y")?></td>
				<td><?php echo "".date("H:i:s")?></td>
			</tr>					
		</tbody>		
	</table>
	</div>



	<div class="table-responsive">
	<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">รีพอร์ตทุกคน</p>
	<table class="table table-bordered table-hover text-nowrap" style="margin-top: 10px;">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Codename</th>
				<th scope="col">งานที่รับ</th>
				<th scope="col">วันที่รับงาน</th>
				<th scope="col">วันที่ส่งงาน</th>

				

			</tr>			
		</thead>
		<tbody>
			<tr>
				<td>01</td>
				<td>Kortoei</td>
				<td>งานแจ้งซ่อม</td>
				<td><?php echo "".date("d/m/Y")?> | <?php echo "".date("H:i:s")?></td>
				<td><?php echo "".date("d/m/Y")?> | <?php echo "".date("H:i:s")?></td>
			</tr>
			<tr>
				<td>02</td>
				<td>Saksorn</td>
				<td>งานแจ้มซ่อม</td>
				<td><?php echo "".date("d/m/Y")?> | <?php echo "".date("H:i:s")?></td>
				<td><?php echo "".date("d/m/Y")?> | <?php echo "".date("H:i:s")?></td>
			</tr>
			<tr>
				<td>02</td>
				<td>Saksorn</td>
				<td>สแกนนิ้ว</td>
				<td><?php echo "".date("d/m/Y")?> | <?php echo "".date("H:i:s")?></td>
				<td><?php echo "".date("d/m/Y")?> | <?php echo "".date("H:i:s")?></td>
			</tr>
			<tr>
				<td>01</td>
				<td>Kortoei</td>
				<td>งานแจ้งซ่อม</td>
				<td><?php echo "".date("d/m/Y")?> | <?php echo "".date("H:i:s")?></td>
				<td><?php echo "".date("d/m/Y")?> | <?php echo "".date("H:i:s")?></td>
			</tr>
			<tr>
				<td>02</td>
				<td>Saksorn</td>
				<td>ขอเปิดอีเมล์</td>
				<td><?php echo "".date("d/m/Y")?> | <?php echo "".date("H:i:s")?></td>
				<td><?php echo "".date("d/m/Y")?> | <?php echo "".date("H:i:s")?></td>
			</tr>					
		</tbody>		
	</table>
	</div>



	<div class="table-responsive">
	<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">รีพอร์ตรายบุคคล</p>
	<table class="table table-bordered table-hover text-nowrap" style="margin-top: 10px;">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Codename</th>		

			</tr>			
		</thead>
		<tbody>
			<tr>
				<td>01</td>
				<td>Kortoei</td>
				
			</tr>
			<tr>
				<td>02</td>
				<td>Saksorn</td>				
			</tr>
			<tr>
				<td>03</td>
				<td>ธารตะวัน</td>				
			</tr>
		</tbody>		
	</table>
	</div>
	<div class="table-responsive">
	<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">รีพอร์ตรายบุคคล</p>
	<table class="table table-bordered table-hover text-nowrap" style="margin-top: 10px;">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Codename</th>
				<th scope="col">งานที่รับ</th>
				<th scope="col">วันที่รับงาน</th>
				<th scope="col">วันที่ส่งงาน</th>

				

			</tr>			
		</thead>
		<tbody>
			<tr>
				<td>01</td>
				<td>Kortoei</td>
				<td>งานแจ้งซ่อม</td>
				<td><?php echo "".date("d/m/Y")?> | <?php echo "".date("H:i:s")?></td>
				<td><?php echo "".date("d/m/Y")?> | <?php echo "".date("H:i:s")?></td>
			</tr>
			<tr>
				<td>01</td>
				<td>Kortoei</td>
				<td>งานแจ้งซ่อม</td>
				<td><?php echo "".date("d/m/Y")?> | <?php echo "".date("H:i:s")?></td>
				<td><?php echo "".date("d/m/Y")?> | <?php echo "".date("H:i:s")?></td>
			</tr>								
		</tbody>		
	</table>
	</div>



</main>





</div>		
	
	




  <!-- SCRIPTS -->
  <!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>











<script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>

</body>


</html>