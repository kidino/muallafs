window.chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(201, 203, 207)'
};

var color = Chart.helpers.color;
var barChartData = {
    labels: [],
    datasets: [{
        label: 'Jumlah',
        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
        borderColor: window.chartColors.blue,
        borderWidth: 1,
        data: []
    }]

};
window.onload = function() {

    var myEle = document.getElementById("chart_30_days");
    if (myEle) {
        var ctx = myEle.getContext('2d');

        fetch('/admin/muallafs/api/days_month_count')
            .then(response => response.json())
            .then(json => {

                barChartData.labels = json.labels;
                barChartData.datasets[0].data = json.data;

                window.myBar = new Chart(ctx, {
                    type: 'bar',
                    data: barChartData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Kemasukan Islam 30 Hari'
                        }
                    }
                });
            })
    } // if 


};