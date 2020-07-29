<?php include 'news_mainEDIT.php'?>
<main>  
        <!-------------------------------- Box to Box --------------------------------->
        <!------------------------ row 1 ------------------------>
        <div class="news-body table-responsive" id="allnews_box">
            <div class="top-content">
                <div><i class="fas fa-globe" style="font-size:25px;">&nbsp;</i><p0>ข่าวทั้งหมด</p0></div>
                <form id="fil-search">
                <div class="search-select">
                    <select class="form-control m-select" name="m">																
						<option value="00" selected>เดือน</option>
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
                    <select class="form-control y-select" name="y">																
						<option value="00" selected>ปี</option>
						<option>2020</option>
                        <option>2021</option>	
                        <option>2022</option>
                        <option>2023</option>
                        <option>2024</option>					
                    </select>
                    <input class="form-control s-select" name="t"></input>
                    <button class="btn cyan lighten-3" id="search_btn"><i class="fas fa-search"></i><p id="fil_text" style="display:none;">ค้นหา</p></button>
                </div>											
                </form>            
            </div> 
                						
																				
					
            <hr>
            <div id="news_content_row">
                <?php 
                    // print_r($news_count);
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

<?php $this->load->view('user/news/news_footer');?>
<script>
    /* --------------------------------------------- Search V2.0 -----------------------------------------  */
    document.getElementById('search_btn').addEventListener('click',function(){
        let form = document.getElementById('fil-search')
        form.action = 'n_filter'
        form.method = 'GET'
        form.submit()
    })

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

</script>
</html>