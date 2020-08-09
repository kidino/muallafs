window.chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(201, 203, 207)'
};

var dynamicColors = function() {
    var r = Math.floor(Math.random() * 255);
    var g = Math.floor(Math.random() * 255);
    var b = Math.floor(Math.random() * 255);
    return "rgb(" + r + "," + g + "," + b + ")";
}

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

var gender_chart = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [],
            backgroundColor: [
                window.chartColors.orange,
                window.chartColors.green,
            ],
            label: 'Jantina'
        }],
        labels: [
            'Lelaki',
            'Perempuan',
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            position: 'right',
        },
        title: {
            display: true,
            text: 'Pecahan Jantina 30 Hari'
        },
        animation: {
            animateScale: true,
            animateRotate: true
        }
    }
};

var race_chart = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [],
            backgroundColor: [],
            label: 'Kaum'
        }],
        labels: []
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            position: 'right',
        },
        title: {
            display: true,
            text: 'Pecahan Kaum 30 Hari'
        },
        animation: {
            animateScale: true,
            animateRotate: true
        }
    }
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
            });

        var ctx2 = document.getElementById('chart_gender').getContext('2d');
        fetch('/admin/muallafs/api/month_gender')
            .then(response => response.json())
            .then(json => {
                gender_chart.data.datasets[0].data = json.data;
                window.myDoughnut = new Chart(ctx2, gender_chart);
            });

        var ctx3 = document.getElementById('chart_race').getContext('2d');
        fetch('/admin/muallafs/api/month_race')
            .then(response => response.json())
            .then(json => {
                race_chart.data.datasets[0].data = json.data;
                race_chart.data.labels = json.labels;

                for (var i in json.labels) {
                    race_chart.data.datasets[0].backgroundColor.push(dynamicColors());
                }

                window.myDoughnut = new Chart(ctx3, race_chart);
            });


    } // -- end if 


};