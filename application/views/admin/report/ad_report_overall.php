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
	<?php include 'admainEDIT.php'?>
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
								<div class="card-header">
								<a class="float-left font-weight-bolder header-text">ภาพรวม</a>
									<i class="fas fa-angle-down float-right pt-1" data-toggle="dropdown" id="menu1"></i>
									<div class="dropdown-menu dropdown-overall pt-2 z-depth-2" aria-labelledby="menu1">
										<a class="dropdown-item" id="day_latest">30 วันล่าสุด</a>				
                                        <a class="dropdown-item" id="year_latest">ปีล่าสุด</a>
                                        <a class="dropdown-item" data-toggle="dropdown">รายปี</a>
                                            <ul class="dropdown-menu ylist z-depth-2">
                                                <a class="dropdown-item" id="2020">2020</a>
                                                <a class="dropdown-item" id="2021">2021</a>
                                                <a class="dropdown-item" id="2022">2022</a>
                                            </ul>   
                                    </div>	
								</div>
								<div class="card-body">
									<canvas id="data_overall" style="display: block; width: 100%; height: 350px;"></canvas>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col mt-4">

						</div>
					</div>

				</div>

			</div>
		</main>
</div>

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

//----------------------------------------------------- Graph_Overall_30 DAY latest----------------------------------------------//
    var today = moment().format('DD/MM/YYYY');
    var thirty = moment().subtract(30,'days').format('DD/MM/YYYY');
    
    /*create 30 day datas*/
    var day = [];       
    for(i=0;i<=30;i++){
        day[i] = moment().subtract(i,'days').format('DD/MM/YYYY');
    }; 
  
    var day_latest = {
    type: 'line',
    data: {
        datasets: [{
                label: 'งานที่รับ',                
                data:
                [                    
                    { x: day[30], y: '<?php echo $data_accept[30];?>' },{ x: day[29], y: '<?php echo $data_accept[29];?>' },{ x: day[28], y: '<?php echo $data_accept[28];?>' },
                    { x: day[27], y: '<?php echo $data_accept[27];?>' },{ x: day[26], y: '<?php echo $data_accept[26];?>' },{ x: day[25], y: '<?php echo $data_accept[25];?>' },
                    { x: day[24], y: '<?php echo $data_accept[24];?>' },{ x: day[23], y: '<?php echo $data_accept[23];?>' },{ x: day[22], y: '<?php echo $data_accept[22];?>' },
                    { x: day[21], y: '<?php echo $data_accept[21];?>' },{ x: day[20], y: '<?php echo $data_accept[20];?>' },{ x: day[19], y: '<?php echo $data_accept[19];?>' },
                    { x: day[18], y: '<?php echo $data_accept[18];?>' },{ x: day[17], y: '<?php echo $data_accept[17];?>' },{ x: day[16], y: '<?php echo $data_accept[16];?>' },
                    { x: day[15], y: '<?php echo $data_accept[15];?>' },{ x: day[14], y: '<?php echo $data_accept[14];?>' },{ x: day[13], y: '<?php echo $data_accept[13];?>' },
                    { x: day[12], y: '<?php echo $data_accept[12];?>' },{ x: day[11], y: '<?php echo $data_accept[11];?>' },{ x: day[10], y: '<?php echo $data_accept[10];?>' },
                    { x: day[9], y: '<?php echo $data_accept[9];?>' },{ x: day[8], y: '<?php echo $data_accept[8];?>' },{ x: day[7], y: '<?php echo $data_accept[7];?>' },
                    { x: day[6], y: '<?php echo $data_accept[6];?>' },{ x: day[5], y: '<?php echo $data_accept[5];?>' },{ x: day[4], y: '<?php echo $data_accept[4];?>' },
                    { x: day[3], y: '<?php echo $data_accept[3];?>' },{ x: day[2], y: '<?php echo $data_accept[2];?>' },{ x: day[1], y: '<?php echo $data_accept[1];?>' },
                    { x: day[0], y: '<?php echo $data_accept[0];?>' }                       
                ],                
                pointBackgroundColor: [
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)',
                ],
                backgroundColor: [
                    'rgba(255,0,0,0.1)',
                ],
                borderColor: [
                    'rgba(255,0,0,0.4)',
                ],
                borderWidth: 3,
                pointHoverBorderWidth: 1,
                pointHoverRadius: 3,
                pointRadius: 3,
            },
            {
                label: 'งานที่ปิด',                
                data:
                [                    
                    { x: day[30], y: '<?php echo $data_close[30];?>' },{ x: day[29], y: '<?php echo $data_close[29];?>' },{ x: day[28], y: '<?php echo $data_close[28];?>' },
                    { x: day[27], y: '<?php echo $data_close[27];?>' },{ x: day[26], y: '<?php echo $data_close[26];?>' },{ x: day[25], y: '<?php echo $data_close[25];?>' },
                    { x: day[24], y: '<?php echo $data_close[24];?>' },{ x: day[23], y: '<?php echo $data_close[23];?>' },{ x: day[22], y: '<?php echo $data_close[22];?>' },
                    { x: day[21], y: '<?php echo $data_close[21];?>' },{ x: day[20], y: '<?php echo $data_close[20];?>' },{ x: day[19], y: '<?php echo $data_close[19];?>' },
                    { x: day[18], y: '<?php echo $data_close[18];?>' },{ x: day[17], y: '<?php echo $data_close[17];?>' },{ x: day[16], y: '<?php echo $data_close[16];?>' },
                    { x: day[15], y: '<?php echo $data_close[15];?>' },{ x: day[14], y: '<?php echo $data_close[14];?>' },{ x: day[13], y: '<?php echo $data_close[13];?>' },
                    { x: day[12], y: '<?php echo $data_close[12];?>' },{ x: day[11], y: '<?php echo $data_close[11];?>' },{ x: day[10], y: '<?php echo $data_close[10];?>' },
                    { x: day[9], y: '<?php echo $data_close[9];?>' },{ x: day[8], y: '<?php echo $data_close[8];?>' },{ x: day[7], y: '<?php echo $data_close[7];?>' },
                    { x: day[6], y: '<?php echo $data_close[6];?>' },{ x: day[5], y: '<?php echo $data_close[5];?>' },{ x: day[4], y: '<?php echo $data_close[4];?>' },
                    { x: day[3], y: '<?php echo $data_close[3];?>' },{ x: day[2], y: '<?php echo $data_close[2];?>' },{ x: day[1], y: '<?php echo $data_close[1];?>' },
                    { x: day[0], y: '<?php echo $data_close[0];?>' }                       
                ],                
                pointBackgroundColor: [
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)',
                ],
                backgroundColor: [
                    'rgba(50,205,50,0.1)',
                ],
                borderColor: [
                    'rgba(50,205,50,0.4)',
                ],
                borderWidth: 3,
                pointHoverBorderWidth: 1,
                pointHoverRadius: 3,
                pointRadius: 3,
            },           
        ]
    },

    options: {
        responsive: true,
        scales: {
            xAxes: [{                
                type: 'time',                           
                time:{    
                    unit: 'day',
                    format:'DD MM YYYY',               
                    displayFormats:{
                        'day': 'DD MMM',
                    },               
                    tooltipFormat:'DD MMM YYYY',  
                    min:thirty,    
                    max:today,
                    stepSize:1, 
                },
            }
            ],
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    precision:0,
                }
            }],
        },
    }
    };
    //----------------------------------------------------- Graph_Overall_YEAR latest----------------------------------------------//
    var year_latest = {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
                label: 'งานที่แจ้ง',
                data: 
                [
                    <?php echo $latestyear_data_accept[1]?>,<?php echo $latestyear_data_accept[2]?>,<?php echo $latestyear_data_accept[3]?>,
                    <?php echo $latestyear_data_accept[4]?>,<?php echo $latestyear_data_accept[5]?>,<?php echo $latestyear_data_accept[6]?>,
                    <?php echo $latestyear_data_accept[7]?>,<?php echo $latestyear_data_accept[8]?>,<?php echo $latestyear_data_accept[9]?>,
                    <?php echo $latestyear_data_accept[10]?>,<?php echo $latestyear_data_accept[11]?>,<?php echo $latestyear_data_accept[12]?>
                ],
                pointBackgroundColor: [
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                ],
                backgroundColor: [
                    'rgba(255,0,0,0.1)',
                ],
                borderColor: [
                    'rgba(255,0,0,0.4)',
                ],
                borderWidth: 3,
                pointHoverBorderWidth: 1,
                pointHoverRadius: 3,
                pointRadius: 3,
            },

            {
                label: 'งานที่ปิด',
                data:
                [
                    <?php echo $latestyear_data_close[1]?>,<?php echo $latestyear_data_close[2]?>,<?php echo $latestyear_data_close[3]?>,
                    <?php echo $latestyear_data_close[4]?>,<?php echo $latestyear_data_close[5]?>,<?php echo $latestyear_data_close[6]?>,
                    <?php echo $latestyear_data_close[7]?>,<?php echo $latestyear_data_close[8]?>,<?php echo $latestyear_data_close[9]?>,
                    <?php echo $latestyear_data_close[10]?>,<?php echo $latestyear_data_close[11]?>,<?php echo $latestyear_data_close[12]?>
                ],
                pointBackgroundColor: [
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                ],
                backgroundColor: [
                    'rgba(50,205,50,0.1)',
                ],
                borderColor: [
                    'rgba(50,205,50,0.4)',
                ],
                borderWidth: 3,
                pointHoverBorderWidth: 1,
                pointHoverRadius: 3,
                pointRadius: 3,
            }
        ]
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    precision:0,
                }
            }]
        },
    }
    };
//----------------------------------------------------------------2020--------------------------------------------------------------------//
var year_2020 = {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
                label: 'งานที่แจ้ง',
                data: 
                [                    
                    <?php echo $year_data_accept[2020][1];?>,<?php echo $year_data_accept[2020][2];?>,<?php echo $year_data_accept[2020][3];?>,
                    <?php echo $year_data_accept[2020][4];?>,<?php echo $year_data_accept[2020][5];?>,<?php echo $year_data_accept[2020][6];?>,
                    <?php echo $year_data_accept[2020][7];?>,<?php echo $year_data_accept[2020][8];?>,<?php echo $year_data_accept[2020][9];?>,
                    <?php echo $year_data_accept[2020][10];?>,<?php echo $year_data_accept[2020][11];?>,<?php echo $year_data_accept[2020][12];?>,
                ],
                pointBackgroundColor: [
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                ],
                backgroundColor: [
                    'rgba(255,0,0,0.1)',
                ],
                borderColor: [
                    'rgba(255,0,0,0.4)',
                ],
                borderWidth: 3,
                pointHoverBorderWidth: 1,
                pointHoverRadius: 3,
                pointRadius: 3,
            },

            {
                label: 'งานที่ปิด',
                data:
                [                    
                    <?php echo $year_data_close[2020][1];?>,<?php echo $year_data_close[2020][2];?>,<?php echo $year_data_close[2020][3];?>,
                    <?php echo $year_data_close[2020][4];?>,<?php echo $year_data_close[2020][5];?>,<?php echo $year_data_close[2020][6];?>,
                    <?php echo $year_data_close[2020][7];?>,<?php echo $year_data_close[2020][8];?>,<?php echo $year_data_close[2020][9];?>,
                    <?php echo $year_data_close[2020][10];?>,<?php echo $year_data_close[2020][11];?>,<?php echo $year_data_close[2020][12];?>,
                ],
                pointBackgroundColor: [
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                ],
                backgroundColor: [
                    'rgba(50,205,50,0.1)',
                ],
                borderColor: [
                    'rgba(50,205,50,0.4)',
                ],
                borderWidth: 3,
                pointHoverBorderWidth: 1,
                pointHoverRadius: 3,
                pointRadius: 3,
            }
        ]
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
    }
};
//----------------------------------------------------------------2021--------------------------------------------------------------------//
var year_2021 = {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
                label: 'งานที่แจ้ง',
                data: 
                [                    
                    <?php echo $year_data_accept[2021][1];?>,<?php echo $year_data_accept[2021][2];?>,<?php echo $year_data_accept[2021][3];?>,
                    <?php echo $year_data_accept[2021][4];?>,<?php echo $year_data_accept[2021][5];?>,<?php echo $year_data_accept[2021][6];?>,
                    <?php echo $year_data_accept[2021][7];?>,<?php echo $year_data_accept[2021][8];?>,<?php echo $year_data_accept[2021][9];?>,
                    <?php echo $year_data_accept[2021][10];?>,<?php echo $year_data_accept[2021][11];?>,<?php echo $year_data_accept[2021][12];?>,
                ],
                pointBackgroundColor: [
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                ],
                backgroundColor: [
                    'rgba(255,0,0,0.1)',
                ],
                borderColor: [
                    'rgba(255,0,0,0.4)',
                ],
                borderWidth: 3,
                pointHoverBorderWidth: 1,
                pointHoverRadius: 3,
                pointRadius: 3,
            },

            {
                label: 'งานที่ปิด',
                data:
                [                    
                    <?php echo $year_data_close[2021][1];?>,<?php echo $year_data_close[2021][2];?>,<?php echo $year_data_close[2021][3];?>,
                    <?php echo $year_data_close[2021][4];?>,<?php echo $year_data_close[2021][5];?>,<?php echo $year_data_close[2021][6];?>,
                    <?php echo $year_data_close[2021][7];?>,<?php echo $year_data_close[2021][8];?>,<?php echo $year_data_close[2021][9];?>,
                    <?php echo $year_data_close[2021][10];?>,<?php echo $year_data_close[2021][11];?>,<?php echo $year_data_close[2021][12];?>,
                ],
                pointBackgroundColor: [
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                ],
                backgroundColor: [
                    'rgba(50,205,50,0.1)',
                ],
                borderColor: [
                    'rgba(50,205,50,0.4)',
                ],
                borderWidth: 3,
                pointHoverBorderWidth: 1,
                pointHoverRadius: 3,
                pointRadius: 3,
            }
        ]
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
    }
};          
//----------------------------------------------------------------2022--------------------------------------------------------------------//
var year_2022 = {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
                label: 'งานที่แจ้ง',
                data: 
                [                    
                    <?php echo $year_data_accept[2022][1];?>,<?php echo $year_data_accept[2022][2];?>,<?php echo $year_data_accept[2022][3];?>,
                    <?php echo $year_data_accept[2022][4];?>,<?php echo $year_data_accept[2022][5];?>,<?php echo $year_data_accept[2022][6];?>,
                    <?php echo $year_data_accept[2022][7];?>,<?php echo $year_data_accept[2022][8];?>,<?php echo $year_data_accept[2022][9];?>,
                    <?php echo $year_data_accept[2022][10];?>,<?php echo $year_data_accept[2022][11];?>,<?php echo $year_data_accept[2022][12];?>,
                ],
                pointBackgroundColor: [
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                    'rgba(255,0,0,1)', 'rgba(255,0,0,1)', 'rgba(255,0,0,1)',
                ],
                backgroundColor: [
                    'rgba(255,0,0,0.1)',
                ],
                borderColor: [
                    'rgba(255,0,0,0.4)',
                ],
                borderWidth: 3,
                pointHoverBorderWidth: 1,
                pointHoverRadius: 3,
                pointRadius: 3,
            },

            {
                label: 'งานที่ปิด',
                data:
                [                    
                    <?php echo $year_data_close[2022][1];?>,<?php echo $year_data_close[2022][2];?>,<?php echo $year_data_close[2022][3];?>,
                    <?php echo $year_data_close[2022][4];?>,<?php echo $year_data_close[2022][5];?>,<?php echo $year_data_close[2022][6];?>,
                    <?php echo $year_data_close[2022][7];?>,<?php echo $year_data_close[2022][8];?>,<?php echo $year_data_close[2022][9];?>,
                    <?php echo $year_data_close[2022][10];?>,<?php echo $year_data_close[2022][11];?>,<?php echo $year_data_close[2022][12];?>,
                ],
                pointBackgroundColor: [
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                    'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                ],
                backgroundColor: [
                    'rgba(50,205,50,0.1)',
                ],
                borderColor: [
                    'rgba(50,205,50,0.4)',
                ],
                borderWidth: 3,
                pointHoverBorderWidth: 1,
                pointHoverRadius: 3,
                pointRadius: 3,
            }
        ]
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
    }
};  
//------------------------------------------------------------------MAIN--------------------------------------------------------------------//  
$(document).ready(function(){
    var graph_overall = document.getElementById('data_overall').getContext('2d');
    window.load = new Chart(graph_overall,day_latest);
    var accept_graph = document.getElementById('accept').getContext('2d');
    window.load = new Chart(accept_graph,accept_chart);
    var close_graph = document.getElementById('close').getContext('2d');
    window.load = new Chart(close_graph,close_chart);
    var rating_graph = document.getElementById('rating').getContext('2d');
    window.load = new Chart(rating_graph,rating_chart);

    $('#day_latest').on('click',function(){
        window.load = new Chart(graph_overall,day_latest);
    });
    $('#year_latest').on('click',function(){
        window.load = new Chart(graph_overall,year_latest);
    });
    $('#2020').on('click',function(){
        window.load = new Chart(graph_overall,year_2020);
    })
    $('#2021').on('click',function(){
        window.load = new Chart(graph_overall,year_2021);
    })
    $('#2022').on('click',function(){
        window.load = new Chart(graph_overall,year_2022);
    })
});




//-------------------BUG JS & PHP can't send value------------------------//
/*
function years(id){
    var $y = id;
    $ydata = Array();
    $x = '<?php echo $year_data_accept[$y][1];?>';
    var year_single = {
    type: 'line',
    data: {
        labels: [y, 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
                label: 'งานที่แจ้ง',
                data: 
                [                    
                    <?php echo 5;?>,<?php echo $year_data_accept[2020][2]?>,<?php echo $latestyear_data_close[3]?>,
                    <?php echo $latestyear_data_close[4]?>,<?php echo $latestyear_data_close[5]?>,<?php echo $latestyear_data_close[6]?>,
              
}
*/
</script>


</body>


</html>


