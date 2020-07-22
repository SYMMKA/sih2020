$(document).ready(function () {
    $("#currentlyIssued").on("click", loadNotReturned);
});

function loadNotReturned() {
    loadCurrentlyIssuedBox();
    $.ajax({
        type: "POST",
        url: "record/currentlyIssued/currentlyIssued.php",
        data: {
            currentlyIssued: 1,
        },
        success: function (data) {
            console.log(data);
            data = JSON.parse(data);
            html = `<div class="table-responsive">
                        <table class="table">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Book ID</th>
                                        <th scope="col">Copy ID</th>
                                        <th scope="col">User ID</th>
                                        <th scope="col">Issue Date</th>
                                        <th scope="col">Return Date</th>
                                    </tr>
                                </thead>
                            <tbody>`;
            data.forEach(function (row, index) {
                html +=
                    `<tr>
                            <th scope="row">` +
                    (index + 1) +
                    `</th>
                            <td>` +
                    row.bookID +
                    `</td>
                            <td>` +
                    row.copyNO +
                    `</td>
                     <td>` +
                    row.stud_ID +
                    `</td>
                            <td>` +
                    row.time +
                    `</td>
                            <td>` +
                    row.returnTime +
                    `</td>
                        </tr>`;
            });
            html += `       </tbody>
                        </table>
                    </table>
                </div>;`;
            $("#reportDIV").html(html);
        },
    });
}

function loadCurrentlyIssuedBox() {
    html = `
           <div class="container">
                <div class="mb-4 pt-4 text-center">
                    <h1>Books issued but not returned</h1>
                </div>
                <div id="reportDIV"></div>
            </div>`;
    $("#ResultDisplay").html(html);
}
