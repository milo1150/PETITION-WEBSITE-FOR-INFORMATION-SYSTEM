<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.js"></script>         	
</head>
<style>

</style>
<body>
<div class="wrapper">	
<?php $this->load->view('admin/admainEDIT');?>

    <div class="table-responsive main-table-size">
        <!----------------------------------------------------- ROW 1 --------------------------------------------------->
		<div class="row">
			<div class="col-md-4 mt-4">
				<div class="card z-depth-1" style="height:100%;">
					<div class="card-header">
						<a class="float-left font-weight-bolder header-text">งานที่แจ้ง / วัน <?php //echo date('d M Y',strtotime('today'))?></a>						
					</div>
										 
					<div class="card-body text-center">					
						<canvas id="order" height="250"></canvas>
					</div>			
				</div>
			</div>
			<div class="col-md-4 mt-4">
				<div class="card z-depth-1" style="height:100%;">
					<div class="card-header">
						<a class="float-left font-weight-bolder header-text">งานที่แจ้ง / วัน</a>
					</div>
					<div class="card-body box_noti" id="box_noti">					
                       <!--<div class="col text-center z-depth-1 mt-2 noti_box_fix">
                            <h>แจ้งซ่อม #500 | 20-04-2020 14:36</h>
                       </div>-->
                       
                       
					</div>				
				</div>
            </div>
            <div class="col-md-4 mt-4">
                <div class="card-body banner-box">
                    <div class="boxtobox-1">					
                        <div class="col-10 banner1 z-depth-1">
                            <div class="dot1 z-depth-1-half"><i class="fas fa-file-alt"></i></div>        
                            <div class="text-center"><h class="h1-text-banner1">งานทั้งหมด</h></div>  <!-- div ครอบ เมื่อ responsive จะไม่ขยับ -->    
                            <div class="text-center"><h class="h2-text-banner1"><?php echo $data_banner['order_all'];?></h></div>   <!-- div ครอบ เพื่อให้ตัวเลขที่เพิ่ม เพิ่มจากตรงกลางไม่ใช่จากขอบซ้าย -->         
                        </div>
                    </div>
                    <div class="boxtobox-2">					
                        <div class="col-10 banner2 z-depth-1">
                            <div class="dot2 z-depth-1-half"><i class="fas fa-check-circle"></i></div>     
                            <div class="text-center"><h class="h1-text-banner2">ปิดงาน</h></div>     
                            <div class="text-center"><h class="h2-text-banner2"><?php echo $data_banner['order_done'];?></h></div>          
                        </div>
                    </div>
                    <div class="boxtobox-3">					
                        <div class="col-10 banner3 z-depth-1">
                            <div class="dot3 z-depth-1-half"><i class="fas fa-times-circle"></i></div>        
                            <div class="text-center"><h class="h1-text-banner3">ยกเลิก</h></div>        
                            <div class="text-center"><h class="h2-text-banner3"><?php echo $data_banner['order_cancle'];?></h></div>          
                        </div>
                    </div>
                    <div class="boxtobox-4">					
                        <div class="col-10 banner4 z-depth-1">
                            <div class="dot4 z-depth-1-half"><i class="far fa-clock"></i></div>        
                            <div class="text-center"><h class="h1-text-banner4">ตกค้าง</h></div>        
                            <div class="text-center"><h class="h2-text-banner4"><?php echo $data_banner['order_remain'];?></h></div>          
                        </div>
                    </div>
                    



                    
				</div>
			</div>
		</div>


        <!----------------------------------------------------- ROW 2 --------------------------------------------------->
		<div class="row">
			<div class="col-md-8 mt-4">
				<div class="card z-depth-1">
					<div class="card-header">
						<a class=" font-weight-bolder header-text">ภาพรวม</a>
					</div>
					<div class="card-body">					
						<canvas id="overall_7day" style="display: block; width: 100%; height: 350px;"></canvas>					
					</div>				
				</div>
            </div>
            <div class="col-md-4 mt-4">
				<div class="card z-depth-1">
					<div class="card-header">
						<a class=" font-weight-bolder header-text">กิจกรรม</a>
					</div>
                    <div class="card-body box_event" id="box_event">					
                       <!--<div class="col text-center z-depth-1 mt-2 noti_box_fix">
                            <h>แจ้งซ่อม #500 | 20-04-2020 14:36</h>
                       </div>-->
                      
                       
                       
					</div>				
				</div>
			</div>
		</div>



	</div>




</div>	








</body>

<script>
/*------------------------------------------------------- Realtime (Event Box) ----------------------------------------------------*/
var box_event_info = Array();
function box_event(){
    $.ajax({
        url:"<?php echo base_url();?>ad_main/rt_box_event",
        dataType:"JSON",
        success:function(data){
            // console.log(data)
            for(let i=0;i<data.length;i++){
                if(data[i].request_type == 'แจ้งซ่อม'){
                    let new_dateF = data[i].date.split("-"); // split date format because project owner need date format like this                    
                    box_event_info[i] = '<div class="col text-center z-depth-1 mt-2 noti_box_fix">'+
                                            '<h>'+data[i].status+data[i].request_type+' #'+data[i].request_id+' โดย '+data[i].accept_by+'</h><br>'+
                                            '<h>'+new_dateF[2]+'-'+new_dateF[1]+'-'+new_dateF[0]+' เวลา '+data[i].time+'</h>'+
                                        '</div>'; 
                }
                if(data[i].request_type == 'ยืมของ'){
                    let new_dateF = data[i].date.split("-"); // split date format because project owner need date format like this                    
                    box_event_info[i] = '<div class="col text-center z-depth-1 mt-2 noti_box_item">'+
                                            '<h>'+data[i].status+data[i].request_type+' #'+data[i].request_id+' โดย '+data[i].accept_by+'</h><br>'+
                                            '<h>'+new_dateF[2]+'-'+new_dateF[1]+'-'+new_dateF[0]+' เวลา '+data[i].time+'</h>'+
                                        '</div>'; 
                }
                if(data[i].request_type == 'เบิกของ'){
                    let new_dateF = data[i].date.split("-"); // split date format because project owner need date format like this                    
                    box_event_info[i] = '<div class="col text-center z-depth-1 mt-2 noti_box_itemotp">'+
                                            '<h>'+data[i].status+data[i].request_type+' #'+data[i].request_id+' โดย '+data[i].accept_by+'</h><br>'+
                                            '<h>'+new_dateF[2]+'-'+new_dateF[1]+'-'+new_dateF[0]+' เวลา '+data[i].time+'</h>'+
                                        '</div>'; 
                }
                if(data[i].request_type == 'ขอเปิดอีเมล์'){
                    let new_dateF = data[i].date.split("-"); // split date format because project owner need date format like this                    
                    box_event_info[i] = '<div class="col text-center z-depth-1 mt-2 noti_box_email">'+
                                            '<h>'+data[i].status+data[i].request_type+' #'+data[i].request_id+' โดย '+data[i].accept_by+'</h><br>'+
                                            '<h>'+new_dateF[2]+'-'+new_dateF[1]+'-'+new_dateF[0]+' เวลา '+data[i].time+'</h>'+
                                        '</div>'; 
                }
                if(data[i].request_type == 'สแกนนิ้ว'){
                    let new_dateF = data[i].date.split("-"); // split date format because project owner need date format like this                    
                    box_event_info[i] = '<div class="col text-center z-depth-1 mt-2 noti_box_finger">'+
                                            '<h>'+data[i].status+data[i].request_type+' #'+data[i].request_id+' โดย '+data[i].accept_by+'</h><br>'+
                                            '<h>'+new_dateF[2]+'-'+new_dateF[1]+'-'+new_dateF[0]+' เวลา '+data[i].time+'</h>'+
                                        '</div>'; 
                }                 
            };                                                      
            $('#box_event').html(box_event_info)                                                      
        }       
    })
}
box_event();






/*------------------------------------------------------- Realtime (Noti Box) ----------------------------------------------------*/
//id = int_new_order

//$('#box_new_order').click(function(){
//var box_noti_check = Array(); // 4 array for check
//var box_noti_data = Array(); // 10 array for output
var box_noti_info = Array();
function box_noti(){      
    $.ajax({
        url:"<?php echo base_url();?>ad_main/rt_noti_order",
        dataType:"JSON",
        success:function(data){
            //let y = data[0].date_request
            //toString('dd-MM-yyyy');
            // console.log(data)

            for(let i=data.length-1;i>=0;i--){ // j เพื่อกลับตำแหน่ง
                if(data[i].type == 'แจ้งซ่อม'){
                    box_noti_info[i] = '<div class="col text-center z-depth-1 mt-2 noti_box_fix">'+
                                        '<h>'+data[i].time_request+' | '+data[i].type+' #'+data[i].id+' '+'</h>'
                                    '</div>'
                }
                if(data[i].type == 'ยืมของ'){
                    box_noti_info[i] = '<div class="col text-center z-depth-1 mt-2 noti_box_item">'+
                                        '<h>'+data[i].time_request+' | '+data[i].type+' #'+data[i].id+' '+'</h>'
                                    '</div>'
                }
                if(data[i].type == 'เบิกของ'){
                    box_noti_info[i] = '<div class="col text-center z-depth-1 mt-2 noti_box_itemotp">'+
                                        '<h>'+data[i].time_request+' | '+data[i].type+' #'+data[i].id+' '+'</h>'
                                    '</div>'
                }
                if(data[i].type == 'ขอเปิดอีเมล์'){
                    box_noti_info[i] = '<div class="col text-center z-depth-1 mt-2 noti_box_email">'+
                                        '<h>'+data[i].time_request+' | '+data[i].type+' #'+data[i].id+' '+'</h>'
                                    '</div>'
                }
                if(data[i].type == 'สแกนนิ้ว'){
                    box_noti_info[i] = '<div class="col text-center z-depth-1 mt-2 noti_box_finger">'+
                                        '<h>'+data[i].time_request+' | '+data[i].type+' #'+data[i].id+' '+'</h>'
                                    '</div>'
                }
            }
            //console.log(box_noti_info)
            $('#box_noti').html(box_noti_info)

        }
    })
}
box_noti();

setInterval(function(){
    box_event();
    box_noti();
},10000);

    
















/*------------------------------------------------------- Request Order Graph ----------------------------------------------------*/
var order_chart = {
    type: 'bar',
    data: {
        labels: ['แจ้งซ่อม', 'ยืมของ','เบิกของ','อีเมล์','สแกนนิ้ว'],
        datasets: [{
            data: [<?php echo $fix_order;?>,<?php echo $item_order;?>,<?php echo $itemotp_order;?>,<?php echo $email_order;?>,<?php echo $finger_order;?>],
            backgroundColor: [
                'rgba(249, 19, 19, 0.4)',
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
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                gridLines:{
                    display:false,
                    lineWidth: 0,
                    drawOnChartArea: false,
                },
                ticks: {
                    display:false,
                    beginAtZero: true,   
                    precision:0, 
                    //tickMarkLength: 0
                                       
                },  
            }]
        },
        legend: {
            display: false
        }
    }
}
/*--------------------- attr --------------------*/
const today = moment().format('DD/MM/YYYY');
const seven = moment().subtract(13,'days').format('DD/MM/YYYY');
/*--- create 7 day datas ---*/
const day = Array();       
for(i=0;i<15;i++){
    day[i] = moment().subtract(i,'days').format('DD/MM/YYYY');
}; 
//console.log(day)
//------------------------------------------------------------Latest 7 Days ------------------------------------------------------------//        
    var overall_7day_chart = {
    type: 'line',
    data: {
        datasets: [{
                label: 'งานที่แจ้ง',                
                data:
                [                  
                    { x: day[0], y: '<?php echo $data_accept[0];?>' },{ x: day[1], y: '<?php echo $data_accept[1];?>' },{ x: day[2], y: '<?php echo $data_accept[2];?>' },
                    { x: day[3], y: '<?php echo $data_accept[3];?>' },{ x: day[4], y: '<?php echo $data_accept[4];?>' },{ x: day[5], y: '<?php echo $data_accept[5];?>' },
                    { x: day[6], y: '<?php echo $data_accept[6];?>' },{ x: day[7], y: '<?php echo $data_accept[7];?>' },{ x: day[8], y: '<?php echo $data_accept[8];?>' },
                    { x: day[9], y: '<?php echo $data_accept[9];?>' },{ x: day[10], y: '<?php echo $data_accept[10];?>' },{ x: day[11], y: '<?php echo $data_accept[11];?>' },
                    { x: day[12], y: '<?php echo $data_accept[12];?>' },{ x: day[13], y: '<?php echo $data_accept[13];?>' },    					           
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
                label: 'ปิดงาน',                
                data:
                [                    
					{ x: day[0], y: '<?php echo $data_close[0];?>' },{ x: day[1], y: '<?php echo $data_close[1];?>' },{ x: day[2], y: '<?php echo $data_close[2];?>' },
                    { x: day[3], y: '<?php echo $data_close[3];?>' },{ x: day[4], y: '<?php echo $data_close[4];?>' },{ x: day[5], y: '<?php echo $data_close[5];?>' },
                    { x: day[6], y: '<?php echo $data_close[6];?>' },{ x: day[7], y: '<?php echo $data_close[7];?>' },{ x: day[8], y: '<?php echo $data_close[8];?>' },
                    { x: day[9], y: '<?php echo $data_close[9];?>' },{ x: day[10], y: '<?php echo $data_close[10];?>' },{ x: day[11], y: '<?php echo $data_close[11];?>' },
                    { x: day[12], y: '<?php echo $data_close[12];?>' },{ x: day[13], y: '<?php echo $data_close[13];?>' },
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
                    max:today,
                    min:seven,                       
                    stepSize:1, 
                },
            }],
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    precision:0,
                }
            }],
        },
        hover: {
            animationDuration:0,
            mode: null
        },
        tooltips: {
            mode: 'index',
            // enabled: false
        }
    }
    };



$(document).ready(function(){
	var order_graph = document.getElementById('order').getContext('2d');
    window.load = new Chart(order_graph,order_chart); 
    var graph_overall = document.getElementById('overall_7day').getContext('2d');
    window.load = new Chart(graph_overall,overall_7day_chart);   
});
</script>
</html>