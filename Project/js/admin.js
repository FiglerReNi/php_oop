$(document).ready(function () {
    tinymce.init({
        selector: '#mytextarea'
    });

    google.charts.load('current',  {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Count'],
            // ['New Views', parseInt($('#views').text())],
            ['Photos',  parseInt($('#photos').text())],
            ['Users',  parseInt($('#users').text())],
            ['Comments', parseInt($('#comments').text())]
        ]);

        var options = {
            legend: 'none',
            pieSliceText: 'label',
            title: 'My Daily Activities',
            backgroundColor: 'transparent'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
})


