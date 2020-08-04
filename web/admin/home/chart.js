var data;
var arrIssued;
var arrNotifyMe;
var arrRequest;
google.charts.load("current", {
    packages: ["corechart"],
});
google.charts.setOnLoadCallback(drawIssueChart);
google.charts.setOnLoadCallback(notifyMeChart);
google.charts.setOnLoadCallback(requestChart);

function drawIssueChart() {
    var formData = new FormData();
    $.ajax({
        type: "POST",
        url: "home/issuedChartData.php",
        data: formData,
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);
            //making array
            arrIssued = [["Title", "Count"]]; // Define an array and assign columns for the chart.
            for (i in data) {
                console.log(data[i].count);
                console.log(data[i].title);
                arrIssued.push([data[i].title, parseInt(data[i].count)]);
            }

            var data = google.visualization.arrayToDataTable(arrIssued);

            var options = {
                title: "Most Issued Books",
                // is3D: true,
            };

            var chart = new google.visualization.PieChart(
                document.getElementById("issueDiv")
            );
            chart.draw(data, options);
        },
        //Other options
    });
}

function notifyMeChart() {
    var formData = new FormData();
    $.ajax({
        type: "POST",
        url: "home/notifyMeChartData.php",
        data: formData,
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);
            //making array
            arrNotifyMe = [["Title", "Count"]]; // Define an array and assign columns for the chart.
            for (i in data) {
                console.log(data[i].count);
                console.log(data[i].title);
                arrNotifyMe.push([data[i].title, parseInt(data[i].count)]);
            }

            var data = google.visualization.arrayToDataTable(arrNotifyMe);

            var options = {
                title: "Books in Demand",
                /* is3D: true, */
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(
                document.getElementById("notifyDiv")
            );
            chart.draw(data, options);
        },
        //Other options
    });
}

function requestChart() {
    var formData = new FormData();
    $.ajax({
        type: "POST",
        url: "home/requestChartData.php",
        data: formData,
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);
            //making array
            arrRequest = [["Title", "Count"]]; // Define an array and assign columns for the chart.
            for (i in data) {
                console.log(data[i].count);
                console.log(data[i].title);
                arrRequest.push([data[i].title, parseInt(data[i].count)]);
            }

            var data = google.visualization.arrayToDataTable(arrRequest);

            var options = {
                title: "Most Requested Books",
                // is3D: true,
            };

            var chart = new google.visualization.PieChart(
                document.getElementById("requestDiv")
            );
            chart.draw(data, options);
        },
        //Other options
    });
}

$(window).resize(function () {
    drawIssueChart();
    notifyMeChart();
    requestChart();
});
