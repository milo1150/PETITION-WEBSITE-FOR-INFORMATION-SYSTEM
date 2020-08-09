const username = document.getElementById('uName').attributes[1].value // admin name

/* -------------------------------------------------- Graph Overall onchange date ---------------------------------------------- */
$(function() {    
    var start = moment().subtract(29, 'days');
    var end = moment();

    $('input[name="daterange"]').daterangepicker({
        startDate: start,
        endDate: end,
        opens: 'left',
        locale: {
            format: 'DD/MM/YYYY'
        }        
    }, function(start, end, label) {       
        dateFunction(start, end)
    });
});

const dateFunction = (start, end) => {
    const newStart = start.format('YYYY-MM-DD');
    const newEnd = end.format('YYYY-MM-DD');
    const diff = end.diff(start,'days');       

    // ------ Month Array For backendLoop -------
    const mDiff = parseInt(end.format('MM')) - parseInt(start.format('MM'))
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
    // -----------------------------------------

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
}
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
                hover: {
                    animationDuration:0,
                    mode: null
                },
                tooltips: {
                    mode: 'index',
                    // enabled: false
                }
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
                hover: {
                    animationDuration:0,
                    mode: null
                },
                tooltips: {
                    mode: 'index',
                    // enabled: false
                }
            }
        }
        window.load = new Chart(document.getElementById('data_overall').getContext('2d'),overall);
    }  
}
window.onload = () => {
    var start = moment().subtract(29, 'days');
    var end = moment();
    dateFunction(start, end);
}


    