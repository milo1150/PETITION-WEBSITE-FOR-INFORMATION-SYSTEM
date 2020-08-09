<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>    
	<link src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css" rel="stylesheet"></link>
<style type="text/css">
</style>
</head>
<div class="wrapper">
<?php $this->load->view('admin/admainEDIT');?>
    <?php

    ?>
	<body>
		<main>
			<div class="table-responsive container-fluid">
				<p class="text-center text-dark" style="margin-top: 15px; font-size: 35px; font-weight: bold;">
					ภาพรวม </p>
					<div class="row">
						<div class="col-md-4 mt-4">
							<div class="card shadow" style="height:100%;">
								<div class="card-header">
								    <a class="float-left font-weight-bolder header-text">งานที่รับ</a>																	
								</div>
								<div class="card-body text-center">
									<canvas id="accept" width="80" height="80"></canvas>									
								</div>

							</div>
						</div>
						<div class="col-md-4 mt-4">
							<div class="card shadow" style="height:100%;">
								<div class="card-header">
									<a class="float-left font-weight-bolder header-text">งานที่ปิด</a>
								</div>
								<div class="card-body">
									<canvas id="close" width="80" height="80"></canvas>
								</div>
							</div>
						</div>
						<div class="col-md-4 mt-4">							
							<div class="card shadow" style="height:100%;">
								<div class="card-header">
									<a class="float-left font-weight-bolder header-text">ผลประเมินความพึงพอใจ</a> 
								</div>
								<div class="card-body">
									<canvas id="rating" width="80" height="80"></canvas>
								</div>
							</div>																									
						</div>
					</div>

					<div class="row">
						<div class="col mt-4 w-100 h-50">
							<div class="card shadow">
                                <div class="card-header overall-header">
                                    <div class="overall-header-text"><a class="float-left font-weight-bolder header-text">ภาพรวม</a></div>
                                    <div class="md-form md-outline overall-header-date">
                                        <i class="fas fa-calendar-check prefix"></i>
                                        <input class="form-control" type="text" name="daterange" id="reportrange" />
                                    </div> 
                                </div>    								
								<div class="card-body">
									<canvas id="data_overall" style="display: block; width: 100%; height: 350px;"></canvas>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col mt-4"></div>
					</div>

				</div>

			</div>
		</main>
</div>
<style>
.overall-header {
    padding-bottom: 4px;
    display: flex;
    justify-content: space-between;
}
.overall-header-text{
    padding-top: 6px;
}
.overall-header-date{
    margin-top: 0px !important;
    margin-bottom: 0px !important;
}
.overall-header-date input{
    padding-right: 24px !important;
}
</style>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="<?php echo base_url().'miscit-js/reportAll.js';?>"></script>
<script>





//---------------------------------------------------- ACCEPT ORDER --------------------------------------------------//
var fix_accept = '<?php echo $fix_accept;?>' , item_accept = '<?php echo $item_accept;?>';
    
var accept_chart = {
    type: 'bar',
    data: {
        labels: ['แจ้งซ่อม', 'ยืมของ'],
        datasets: [{
            data: [fix_accept,item_accept],
            backgroundColor: [
                'rgba(255, 99, 132, 0.4)',
                'rgba(54, 162, 235, 0.4)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,   
                    precision:0,
                },  
            }],
            xAxes: [{
                barPercentage: 0.5,  
            }]
        },
        legend: {
            display: false
        }
    }
}

//--------------------------------------------------------------- CLOSE ORDER --------------------------------------------------//
var fix_close = '<?php echo $fix_close;?>' , item_close = '<?php echo $item_close;?>',
    email_close = '<?php echo $email_close;?>' , finger_close = '<?php echo $finger_close;?>' , itemotp_close = '<?php echo $itemotp_close;?>';
var close_chart = {
    type: 'bar',
    data: {
        labels: ['แจ้งซ่อม', 'ยืมของ','เบิกของ', 'อีเมล', 'สแกนนิ้ว'],
        datasets: [{
            data: [fix_close,item_close,itemotp_close,email_close,finger_close],
            backgroundColor: [
                'rgba(255, 99, 132, 0.4)',
                'rgba(54, 162, 235, 0.4)',
                'rgba(255, 0, 158, 0.3)',
                'rgba(255, 206, 86, 0.4)',
                'rgba(75, 192, 192, 0.4)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(247, 128, 202, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
            ],
            borderWidth: 1,
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    precision:0,
                }
            }]
        },
        legend: {
            display: false
        }
    }
}
//--------------------------------------------------------------- RATING --------------------------------------------------//
var rate_five = '<?php echo $rating[5];?>'; rate_four = '<?php echo $rating[4];?>'; rate_three = '<?php echo $rating[3];?>';
    rate_two = '<?php echo $rating[2];?>'; rate_one = '<?php echo $rating[1];?>';
var rating_chart = {
    type: 'horizontalBar',
    data: {
        labels: ['5★','4★','3★','2★','1★'],
        datasets: [{
            data: [rate_five,rate_four,rate_three,rate_two,rate_one],
            backgroundColor: [
                'rgba(0, 255, 0, 0.3)',
                'rgba(0, 255, 0, 0.3)',
                'rgba(0, 255, 0, 0.3)',
                'rgba(0, 255, 0, 0.3)',
                'rgba(0, 255, 0, 0.3)',
            ],
            borderColor: [
                'rgba(0, 255, 0, 0.6)',
                'rgba(0, 255, 0, 0.6)',
                'rgba(0, 255, 0, 0.6)',
                'rgba(0, 255, 0, 0.6)',
                'rgba(0, 255, 0, 0.6)',
            ],
            borderWidth: 1,
        }]
    },
    options: {        
        scales: {
            xAxes: [{
                ticks: {
                    beginAtZero: true,
                    precision:0,
                }
            }]
        },
        legend: {
            display: false
        }
    }
}


//------------------------------------------------------------------MAIN--------------------------------------------------------------------//  
$(document).ready(function(){
    window.load = new Chart(document.getElementById('accept').getContext('2d'),accept_chart);
    window.load = new Chart(document.getElementById('close').getContext('2d'),close_chart);
    window.load = new Chart(document.getElementById('rating').getContext('2d'),rating_chart);
});
</script>
</body>


</html>


