$(document).ready(function () {
    getRequest();
});

function getRequest() {
    html = `<div class="container">
                <div class="mb-4 pt-4">
					<h3>Books sugggested by Users<button type="button" class="btn btn-orange ml-2 float-right" id="deleteAllButton">Delete All</button>
                    </h3>                    
                </div>`;
    $.ajax({
        type: "POST",
        url: "request/getData.php",
        success: function (data) {
            if (data == "false") {
                html = ` 
                <div class="container">
                    <div class="mb-4 pt-4">
                        <h3>No Records Found
                        </h3>                    
                    </div>
                </div>;`;
                $("#ResultDisplay").html(html);
            } else {
                data = JSON.parse(data);
                html += `<div class="table-responsive">
                        <table class="table">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">ISBN</th>
                                        <th scope="col">Total Request</th>
                                    </tr>
                                </thead>
                            <tbody>`;
                data.forEach(function (row, index) {
                    html +=
                        `<tr>
                        <th scope="row">` +
                        (index + 1) +
                        `   </th>
                        <td>` +
                        row.title +
                        `   </td>
                        <td>` +
                        row.author +
                        `   </td>
                        <td>` +
                        row.isbn +
                        `   </td>
                         <td>` +
                        row.count +
                        `   </td>
                    </tr>`;
                });
                html += `       </tbody>
                        </table>
                    </table>
                </div>
            </div>;`;
                $("#ResultDisplay").html(html);
                $("#deleteAllButton").on("click", deleteAllRequest);
            }
        },
        error: function (e) {
            alert(e);
        },
    });
}

function deleteAllRequest(data2) {
    $.ajax({
        type: "POST",
        url: "request/deleteAll.php",
        success: function (data2) {
            if (data2 == "success") alert("data deleted successfully");
            else alert(data2);
            getRequest();
        },
        error: function (e) {
            alert(e);
        },
    });
}
