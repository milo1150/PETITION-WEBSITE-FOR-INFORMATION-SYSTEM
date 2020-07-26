<!DOCTYPE html>
<html lang="th">    
<head>
    <meta charset="utf-8">
    <!---------- Font Awesome ----------->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">		
   

	<!-------- JS + Bootstrap JS ---------->	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		
	<!------- Bootstrap + MDBootstrap------>		
	<link href="<?php echo base_url(); ?>/mdbootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/mdbootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/mdbootstrap/css/mdb.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.15.0/js/mdb.min.js"></script>
    
    <!-------- Sidebar CSS + Custom CSS ------------>
	<link href="<?php echo base_url(); ?>/mdbootstrap/css/mis-mainpage.css" rel="stylesheet">
    
    <!-------- VueJS --------->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/16.13.1/umd/react.production.min.js"></script>
    
</head>
<header>
    <!------------------------------------------------ TopBanner ---------------------------------------------------->
    <div class="banner-box">
        <img src="https://sv1.picz.in.th/images/2019/06/19/1UDsvS.png" class="img-fluid" alt="Responsive image">
        <div class="banner-text">
            <p class="p1">หน่วยสารสนเทศและประชาสัมพันธ์ วิทยาลัยเทคโนโลยีอุตสาหกรรม</p>
            <p class="p2">Institute of Computer and Information Technology</p>
        </div>
    </div>
    <!------------------------------------------------ TopNavbar ---------------------------------------------------->
    <div class="navbar-box">
        <div class="navbar-content">
            <ul class="crop-box">
                <li class="content-item"><a href="<?php echo base_url();?>">หน้าแรก</a></li>                
                <li class="content-item" id="ct1""><a>แนะนำสำนัก</a>
                    <ul class="content-item-row" id="content-item-1">
                        <li><a href="http://icit.kmutnb.ac.th/main/about/">เกี่ยวกับสำนัก</a><hr></li>
                        <li><a>โครงสร้างองค์กร</a><hr></li>
                        <li><a>นโยบาย</a><hr></li>
                        <li><a>บุคลากร</a></li>
                    </ul>
                </li>
                <li class="content-item" id="ct2"><a>งานบริการ</a>
                    <ul class="content-item-row" id="content-item-2">
                        <li><a>หัวข้อการให้บริการ</a><hr></li>
                        <li><a>แบบฟอร์มขอใช้บริการ</a><hr></li>
                        <li><a>เอกสารและคู่มือการใช้งาน</a><hr></li>
                        <li><a>รายงานประจำปี</a></li>
                    </ul>
                </li>
                <li class="content-item" id="ct3"><a>FAQ</a>
                    <ul class="content-item-row" id="content-item-3">
                        <li><a>สำหรับนักศึกษา</a><hr></li>
                        <li><a>สำหรับบุคลากร</a><hr></li>
                        <li><a>สำหรับบุคลากรภายใน</a></li>
                    </ul>
                </li>
                <li class="content-item"><a href="<?php echo base_url();?>request">คำร้องแจ้งเรื่องสารสนเทศ</a></li>
            </ul>
        </div>
    </div>      
</header>


    
<main>  
        <!-------------------------------- Box to Box --------------------------------->
        <!------------------------ row 1 ------------------------>
        <div class="news-body table-responsive" id="allnews_box">
            <div class="top-content">
                <div><i class="fas fa-globe" style="font-size:25px;">&nbsp;</i><p0>ข่าวทั้งหมด</p0></div>
                <div class="search-select">
                    <select class="form-control m-select" id="m_se">																
						<option value="00" selected>กรุณาเลือก</option>
						<option value="01">มกราคม</option>
                        <option value="02">กุมภาพันธ์</option>		
                        <option value="03">มีนาคม</option>	
                        <option value="04">เมษายน</option>	
                        <option value="05">พฤษภาคม</option>	
                        <option value="06">มิถุนายน</option>	
                        <option value="07">กรกฎาคม</option>	
                        <option value="08">สิงหาคม</option>	
                        <option value="09">กันยายน</option>	
                        <option value="10">ตุลาคม</option>	
                        <option value="11">พฤศจิกายน</option>	
                        <option value="12">ธันวาคม</option>
                    </select>
                    <select class="form-control y-select" id="y_se">																
						<option value="00" selected>กรุณาเลือก</option>
						<option>2020</option>
                        <option>2021</option>	
                        <option>2022</option>
                        <option>2023</option>
                        <option>2024</option>					
                    </select>
                    <input class="form-control s-select" id="t_se"></input>

                </div>
                            
            </div> 
                						
																				
					
            <hr>
            <div id="news_content_row">
                <?php 
                    $news_count = $news_count; // $data['news_count'] from controller 
                    $news_show = 5; // set limit news for show in one page  // *** 1 INPUT FOR ALL OUTPUT <-- This line
                    $paginav = ceil($news_count/$news_show);  // มีเศษปัดขึ้น                  
                    $j=0;                     
                    foreach($data as $row) { 
                      
                ?>                                       
                        <div class="row row_cus">   
                            <form class="content_div" onclick="go_c(this)">
                                <input name="title" value="<?php echo $row->title;?>"hidden></input>                     
                                <div class="col">
                                    <img src="<?php echo base_url().'uploads/'.$row->img_name;?>"></img>
                                </div>
                                <div class="container-fluid">
                                    <div class="h_content">
                                        <?php echo $row->title;?>
                                    </div>
                                    <div class="b_content">
                                        <p1><?php echo $row->content;?></p1>
                                    </div>
                                    <div class="f_content">
                                        <i class="far fa-calendar-alt"></i>&nbsp;<p1><?php echo date('d/M/Y',strtotime($row->post_date))?></p1>
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
                        echo '<li class="page-item" id="pag'.$i.'"><a class="page-link" href="'.base_url().'news/allnews?page='.$i.'">'.$i.'</a></li>';                    
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
    /*
    window.onload = function(){
        document.getElementById('m_se').value = '00'
        document.getElementById('y_se').value = '00'
        document.getElementById('t_se')
    }      */
            
    const month_se = document.getElementById('m_se')
    const year_se = document.getElementById('y_se')
    const text_se = document.getElementById('t_se')
    month_se.onchange = function(){
        let v_month = month_se.value
        let v_year = year_se.value
        let v_text = text_se.value
        $.ajax({
            url:'<?php echo base_url()?>News/news_search',
            method:'get',
            dataType:'json',
            data:{'month':v_month,'year':v_year,'text':v_text},
            success:function(data){
                let d_length = data.length
                let max_news = 0
                $('#news_content_row').html('')            
                data.forEach(element => {  
                    let time = element.post_date.split('-') // split time string to array
                    let new_time = time[2]+'/'+time[1]+'/'+time[0]   // เรียกเวลาใหม่
                    
                    $('#news_content_row').append(
                        '<div class="row row_cus">'+ 
                            '<form class="content_div" onclick="go_c(this)">'+
                                '<input name="title" value="'+element.title+'"hidden></input>'+                     
                                '<div class="col">'+
                                    '<img src="<?php echo base_url().'uploads/';?>'+element.img_name+'"></img>'+
                                '</div>'+
                                '<div class="container-fluid">'+
                                    '<div class="h_content">'+
                                        element.title+
                                    '</div>'+
                                    '<div class="b_content">'+
                                        '<p1>'+element.content+'</p1>'+
                                    '</div>'+
                                    '<div class="f_content">'+
                                        '<i class="far fa-calendar-alt"></i>&nbsp;<p1>'+new_time+'</p1>'+
                                    '</div>'+
                                '</div>'+  
                            '</form>'+
                        '</div>')

                    max_news++
                    console.log(max_news)
                })


                /* -------- Pagination -------- */
                
                let page_limit = 5 
                let paginav = Math.ceil(d_length/page_limit)               
                $('.pagination').html('')
                for(let k=1;k<d_length;k++){
                    $('.pagination').append(
                        paginav
                    //'<li class="page-item" id="pag'.$i.'"><a class="page-link" href="'.base_url().'news/allnews?page='.$i.'">'.$i.'</a></li>'
                )
                }
                

                
            }
        })



        //$('#news_content_row').html('')
        // console.log(v_month)
        // console.log(v_year)
        // console.log(v_text)

    }

    
    











    /* ------ Set Active Pagination On Load ------  */
    $(document).ready(function(){
        let x = <?php echo $pagi_active?>;
        let y = $('#pag'+x)[0].classList.add('active')
    })


    /* ------- Onclick content -> FORM.SUBIT ------- */
    function go_c(form){
        form.action = 'con'
        form.method = 'get'
        form.submit()
        //console.log(form)
    }

   
    //------------------------ on click news-label ---------------------
    function label_active(id){
        document.getElementById(id).classList.add('news-label-active') // set class active label *CSS class
        let label_count = document.getElementById('ul-labelx').childElementCount // count child label
        let cur_label = id.charAt(id.length-1) // get last sting 
        for(let i=1;i<=label_count;i++){
            if(i == cur_label){ i++ }
            if(i > label_count){ return }
            $('#nlabel'+i).removeClass('news-label-active')
        }
        //console.log(label_count)
        //console.log(cur_label)
        //console.log(id)
    }
    //----------------------- content 1 ------------------------
    const ct1 = document.getElementById('ct1');
    ct1.onmouseenter = function(){
        //$('#content-item-1').fadeIn(400)   // BUG 
        $('#content-item-1').css("display","block")          
    }
    ct1.onmouseleave = function(){
        $('#content-item-1').css("display","none")
    }
    //----------------------- content 2 ------------------------
    const ct2 = document.getElementById('ct2');
    ct2.onmouseenter = function(){
        $('#content-item-2').css("display","block")            
    }
    ct2.onmouseleave = function(){
        $('#content-item-2').css("display","none")
    }
    //----------------------- content 3 ------------------------
    const ct3 = document.getElementById('ct3');
    ct3.onmouseenter = function(){
        $('#content-item-3').css("display","block")            
    }
    ct3.onmouseleave = function(){
        $('#content-item-3').css("display","none")
    }


    /*--------------- on hover function (no complete) [little gap when mouve leave alphabet]--------------*/
    /*
    function m_over(id){
        const ct = document.getElementById(id);
        const ct_child = document.getElementById(id).childNodes[2].id;
        $('#'+ct_child).fadeIn(250)
        console.log(ct_child)          
        console.log(0)  
    }
    function m_leave(id){
        //const ct = document.getElementById(id);
        //const ct_child = document.getElementById(id).childNodes[2].id;
        //$('#'+ct_child).css("display","none")
        //console.log(ct_child)    

        console.log(1)         
    }*/
</script>
</html>