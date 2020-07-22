$(document).ready(function () {
    $("#due").on("click", showFineTable);
});

function updateDueStatus(id) {
    //alert(id);
    var formData = new FormData();
    formData.append("id", id);
    $.ajax({
        type: "POST",
        url: "record/due/updateDue.php",
        data: formData,
        type: "POST",
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function (data) {
            console.log(data);
            showFineTable();
        },
        //Other options
    });
}

function showFineTable() {
    loadDueBox();
    $.ajax({
        type: "POST",
        url: "record/due/getdata.php",
        type: "POST",
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function (data) {
            console.log(data);
            if (data) {
                data = JSON.parse(data);
                console.log(data);
                var html = `<div class="table-responsive"><table id="issuedTable" class="table table-bordered table-hover">
    <caption>Click pay when payment is recieved</caption>
    <thead>
    <tr>
        <th style="display:none;" scope="col">
            ID</th>
        <th scope="col">
            BookID</th>
        <th scope="col">
            OldID</th>
        <th scope="col">
            CopyID</th>
        <th scope="col">
            StudentID</th>
        <th scope="col">
            Time</th>
        <th scope="col">
            Return Time</th>
        <th scope="col">
            Fine</th>
        <th scope="col">
            Pay</th>
    </tr>
    </thead>
    <tbody>`;
                data.forEach(function (item, index) {
                    html +=
                        `<tr>
        <td>` +
                        item.bookID +
                        `</td>
        <td>` +
                        item.oldID +
                        `</td>
        <td>` +
                        item.copyID +
                        `</td>
        <td>` +
                        item.stud_ID +
                        `</td>
        <td>` +
                        item.time +
                        `</td>
        <td>` +
                        item.returnTime +
                        `</td>
        <td>` +
                        item.fine +
                        `</td>
        <td><button type="button" id="` +
                        item.id +
                        `"class="btn btn-outline-dark" onclick="updateDueStatus(this.id);">Pay</button></td>
        </tr>`;
                });
                html += `</tbody>
	</table></div>`;
            } else {
                var html = "All payments cleared";
            }
            document.getElementById("tableData").innerHTML = html;
        },
        //Other options
    });
}

function loadDueBox() {
    html = `<div class="container">
                <div class="mb-4 pt-4 text-center">
                    <h1>Fine Payment</h1>
                </div>
                <div id="tableData"></div>
            </div>
       `;
    $("#ResultDisplay").html(html);
}
