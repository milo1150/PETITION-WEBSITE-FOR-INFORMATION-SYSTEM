<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   
    <title>คำร้องแจ้งเรื่องสารสนเทศ</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>/mdbootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="<?php echo base_url();?>/mdbootstrap/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="<?php echo base_url();?>/mdbootstrap/css/style.css" rel="stylesheet">
    
    <!-------- Sidebar CSS + Custom CSS ------------>
    <link href="<?php echo base_url(); ?>/mdbootstrap/css/utility.css" rel="stylesheet">
  </head>
<style>
</style>
<body class="mrq_body">
      <div class="mrq_header">
          <h3 class="mrq_h">คำร้องแจ้งเรื่องสารสนเทศ</h3>
      </div>
    <div class="table-responsive container text-center mrq_content">      
      <div class="container mrq_box">        
        <div class="row justify-content-center">        
          <form action="<?php echo base_url()?>request_fix" class="mrq_form-style">
            <button type="submit" class="btn mrq_button-style reddy">
              <a class="mrq_a-style font-weight-bold">แบบฟอร์มใบแจ้งซ่อม</a>
            </button>
          </form>
          <form action="<?php echo base_url()?>request_item" class="mrq_form-style">
            <button type="submit" class="btn mrq_button-style blummy">
              <a class="mrq_a-style font-weight-bold">แบบฟอร์มยืมของ</a>
            </button>
          </form>
          <form action="<?php echo base_url()?>request_itemotp" class="mrq_form-style">
            <button type="submit" class="btn mrq_button-style purpy">
              <a class="mrq_a-style font-weight-bold">แบบฟอร์มเบิกของ</a>
            </button>
          </form>
          <form action="<?php echo base_url()?>request_email" class="mrq_form-style">
            <button type="submit" class="btn mrq_button-style yelly">
              <a class="mrq_a-style font-weight-bold">แบบฟอร์มขอเปิดอีเมล์</a>
            </button>
          </form>
          <form action="<?php echo base_url()?>request_finger" class="mrq_form-style">
            <button type="submit" class="btn mrq_button-style greeny">
              <a class="mrq_a-style font-weight-bold">แบบฟอร์มสแกนนิ้ว</a>
            </button>
          </form>          
      </div> 
      <br>      
          <hr class="style11">                   
      </div>
    </div>
    <footer class="req">
      <div class="table-responsive container text-center mrq_btm_content">
          <form action="<?php echo base_url()?>" class="mrq_form-style">
            <button type="submit" class="btn mrq_button-style news">
            <i class="fas fa-globe"></i><a class="mrq_a-style font-weight-bold">ข่าวสาร</a>
            </button>
          </form> 
      </div>
      <div class="table-responsive container text-center mrq_btm_content">
          <form action="<?php echo base_url()?>news/files" class="mrq_form-style">
            <button type="submit" class="btn mrq_button-style dwn">
            <i class="fas fa-file-pdf"></i><a class="mrq_a-style font-weight-bold">ดาวน์โหลด</a>
            </button>
          </form> 
      </div>
    </footer>
</body>
  
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
</html>
