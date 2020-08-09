const username = document.getElementById('uName').attributes[1].value // admin name
// window.onload = () => {
    
    
//     var start = moment().subtract(29, 'days');
//     var end = moment();
//     function cb(start, end) {
//         $('#reportrange').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
//     }
//     cb(start,end);

//     const a1 = document.getElementById('reportrange').value
//     console.log(a1)
// } 

/* -------------------------------------------------- Graph Overall onchange date ---------------------------------------------- */
$(function() {    
    var start = moment().subtract(29, 'days');
    var end = moment();
    // var mstart = start.month()
    // console.log(mstart)



    $('input[name="daterange"]').daterangepicker({
        startDate: start,
        endDate: end,
        opens: 'left',
        locale: {
            format: 'DD/MM/YYYY'
        }        
    }, function(start, end, label) {        
        const newStart = start.format('YYYY-MM-DD');
        const newEnd = end.format('YYYY-MM-DD');
        const diff = end.diff(start,'days');       

        // ------ Month Array For backendLoop -------
        const mStart = start.format('YYYY-MM');
        const mEnd = end.format('YYYY-MM');
        const mDiff = end.diff(start,'month');

        const getMrange = (start) => {                     
            const mArr = Array();       
            for(let i=0;i<=mDiff;i++){
                let mS = start.startOf('month').format('YYYY-MM-DD')
                let mE = start.endOf('month').format('YYYY-MM-DD')
                mArr[i] = [ mS , mE ]
                start.add(1,'M')
            }
            return mArr
            // console.log(mArr)
        }

        if(diff <= 62){
            axios.post('./flexReport',{
                username: username,
                start: newStart,
                end: newEnd,
                diff: diff,
                format: 'date'
            })
            .then((res) => {
                // console.log(res.data)
                overallChange(res,diff)
            })
        }
        if(diff > 62){
            let data = getMrange(start)
            axios.post('./flexReport',{
                username: username,
                mArr: data,
                diff: mDiff,
                format: 'month'
            })
            .then((res) => {
                // console.log(res.data)
                overallChange(res,diff)
            })
        }
        
        

        
        
        
        // a(newStart)
        // console.log(newStart)
        // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
});
const overallChange = (res,diff) => {
    // console.log(diff)
    // ------- 2 Months range ---------
    if(diff <= 62){ 
        const data = res.data;
        var acceptData = Array();
        var closeData = Array();
        var acceptDataColor = Array();
        var closeDataColor = Array();
        
        for(let i in data){
            // ------ accept data ---------
            let a = {
                x:data[i][0],
                y:data[i][1]
            }        
            acceptData.push(a)        
            acceptDataColor.push('rgba(255,0,0,1)')
            // ------ close data ------
            let b = {
                x:data[i][0],
                y:data[i][2]
            }
            closeData.push(b)
            closeDataColor.push('rgba(50,205,50,1)')
        }
        const min = data[0][0]
        const max = data[data.length-1][0]
        // console.log(closeData)
        var overall = {
            type: 'line',
            data: {
                datasets: [{
                        label: 'รับงาน',                
                        data: acceptData,                
                        pointBackgroundColor: acceptDataColor,
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
                        data: closeData,                
                        pointBackgroundColor: closeDataColor,
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
                            format:'YYYY MM DD',               
                            displayFormats:{
                                'day': 'MMM DD',
                            },               
                            tooltipFormat:'DD MMM YYYY',  
                            min:min,    
                            max:max,
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
        }
        window.load = new Chart(document.getElementById('data_overall').getContext('2d'),overall);
    }  
    if(diff > 62){
        const data = res.data;
        var acceptData = Array();
        var closeData = Array();
        var acceptDataColor = Array();
        var closeDataColor = Array();
        console.log(data)
        
        for(let i in data){
            // ------ accept data ---------
            let a = {
                x:data[i][0],
                y:data[i][1]
            }        
            acceptData.push(a)        
            acceptDataColor.push('rgba(255,0,0,1)')
            // ------ close data ------
            let b = {
                x:data[i][0],
                y:data[i][2]
            }
            closeData.push(b)
            closeDataColor.push('rgba(50,205,50,1)')
        }
        const min = data[0][0]
        const max = data[data.length-1][0]

        var overall = {
            type: 'line',
            data: {
                datasets: [{
                        label: 'รับงาน',                
                        data: acceptData,                
                        pointBackgroundColor: acceptDataColor,
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
                        data: closeData,                
                        pointBackgroundColor: closeDataColor,
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
                            unit: 'month',
                            format:'YYYY MM DD',               
                            displayFormats:{
                                'month': 'MMM YY',
                            },               
                            tooltipFormat:'MMM YYYY',  
                            min:min,    
                            max:max,
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
        }
        window.load = new Chart(document.getElementById('data_overall').getContext('2d'),overall);
    }  
}

var overall = {
    type: 'line',
    data: {
        datasets: [{
                label: 'รับงาน',                
                data:
                [                    
                    { x: "13-07-2020", y: 5 },{ x: "14-07-2020", y: 2 },        
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
                // label: 'ปิดงาน',                
                // data:
                // [                 
                //     { x: "14-07-2020", y: 5 },{ x: "13-07-2020", y: 5 },  
                                          
                // ],                
                // pointBackgroundColor: [
                //     'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                //     'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                //     'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                //     'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                //     'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                //     'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                //     'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                //     'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                //     'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                //     'rgba(50,205,50,1)', 'rgba(50,205,50,1)', 'rgba(50,205,50,1)',
                //     'rgba(50,205,50,1)',
                // ],
                // backgroundColor: [
                //     'rgba(50,205,50,0.1)',
                // ],
                // borderColor: [
                //     'rgba(50,205,50,0.4)',
                // ],
                // borderWidth: 3,
                // pointHoverBorderWidth: 1,
                // pointHoverRadius: 3,
                // pointRadius: 3,
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
                    min:"13-07-2020",    
                    max:"08-08-2020",
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
}
window.load = new Chart(document.getElementById('data_overall').getContext('2d'),overall);

    