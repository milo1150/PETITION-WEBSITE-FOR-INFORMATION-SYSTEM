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
        const newStart = start.format('DD-MM-YYYY');
        const newEnd = end.format('DD-MM-YYYY');
        a(newStart)
        // console.log(newStart)
        // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
});
const a = (data) => {
    console.log(data)
}