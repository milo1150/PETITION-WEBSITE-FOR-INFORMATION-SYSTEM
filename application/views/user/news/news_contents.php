<?php include 'news_mainEDIT.php'?>
<main>  
        <!-------------------------------- Box to Box --------------------------------->
        <!------------------------ row 1 ------------------------>
        <div class="news-body table-responsive" id="content_info1">
            <div class="form-inline"><p><?php echo $title;?></p></div>       
            <hr> 
            <div class="form-inline"><i class="far fa-calendar-alt"></i>&nbsp;<p1><?php echo date('d/M/Y',strtotime($post_date))?></p1></div>
            <div id="img"><img src="<?php echo base_url().'uploads/'.$img_name;?>"></img></div>
            <div class="news_content"><p><?php echo $content;?></p></div>
        </div>             
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
</script>
</html>