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

<?php $this->load->view('user/news/news_footer');?>
<script>
</script>
</html>