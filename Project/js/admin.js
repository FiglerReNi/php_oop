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

    var photoId;
    var filename;
    var newPhotoId;

    $(".modal_thumbnails").click(function () {
        $("#set_user_image").prop('disabled', false);
        photoId = $("#photoId").text();
        filename = $(this).prop("id");
        newPhotoId =  $(this).attr("data");
        $.ajax({
            url: "../ajax/photo_library_modal.php",
            data: {newId: newPhotoId},
            type: "POST",
            success:function (data) {
                if(!data.error){
                    $("#modal_sidebar").text(data);
                }
            }
        })
    });

    $("#set_user_image").click(function () {
        $.ajax({
            url: "../ajax/photo_library_modal.php",
            data: {filename: filename, id: photoId},
            type: "POST",
            success:function (data) {
                if(!data.error){
                    $("#photoBox").prop("src", data);
                }
            }
        })
    })
});


