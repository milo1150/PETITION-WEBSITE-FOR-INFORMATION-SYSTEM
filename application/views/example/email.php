<!doctype html>
<html lang="en">

<head>
   <meta http-equiv=Content-Type content="text/html; charset=utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">
   <title>ส่งอีเมล</title>
   <!-- Bootstrap core CSS -->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
   <!-- Bootstrap core CSS -->
   <link href="<?php echo base_url();?>/mdbootstrap/css/bootstrap.min.css" rel="stylesheet">
   <!-- Material Design Bootstrap -->
   <link href="<?php echo base_url();?>/mdbootstrap/css/mdb.min.css" rel="stylesheet">
   <!-- Your custom styles (optional) -->
   <link href="<?php echo base_url();?>/mdbootstrap/css/style.css" rel="stylesheet">

   <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

   <?php date_default_timezone_set("Asia/Bangkok");?>
</head>
<body>
   <style>  
   div div h3{
      font-size:40px;
      padding-top:50px;
      padding-bottom:50px;
      font-weight:bold; 
      text-shadow:1px 1px 2px;
   }
   </style>

<div class="table-responsive text-center">
      <div class="container-fluid" style="width:100%,height:250px; font-family: 'Kanit', sans-serif;">
         <h3>ส่งอีเมล</h3>
      </div>
   </div>

   
    <form method="POST" action="<?php echo base_url('test_email/send');?>" id="fix_form" style="font-family: 'Kanit', sans-serif;"> 
      <div class="table-responsive-md pb-4 pt-4" style="background: #f5f3f3;">
         <div class="container" style="max-width:400px;">
            

            <div class="text-center pb-4">
               <div class="row justify-content-center pt-2">
                  <div class="col-sm-6 pb-2">
                     <button type="submit" name="insert" value="Insert" class="btn btn-lg btn-success btn-block"
                        style="font-size:20px;">ยืนยัน</button>
                  </div>
                  <div class="col-sm-6">
                     <a href="<?php echo base_url()?>request">
                        <button type="button" class="btn btn-lg btn-danger btn-block" style="font-size:20px;">ย้อนกลับ</button>
                     </a>
                  </div>               
               </div>
            </div>
         </div>
      </div>
   </form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>

</script>
</body>
</html>