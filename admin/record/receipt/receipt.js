$(document).ready(function () {
    $("#receipt").on("click", loadReceipt);
});

function loadReceipt() {
    loadReceiptBox();
    $.ajax({
        type: "POST",
        url: "record/receipt/receipt.php",
        data: {
            receipt: 1,
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
                                        <th scope="col">Title</th>
                                        <th scope="col">Receipt Link</th>
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
                    row.title +
                    `</td>
                     <td>` +
                    row.receiptLink +
                    `</td>
                        </tr>`;
            });
            html += `       </tbody>
                        </table>
                    </table>
                </div>;`;
            $("#receiptDIV").html(html);
        },
    });
}

function loadReceiptBox() {
    html = `
           <div class="container">
                <div class="mb-4 pt-4 text-center">
                    <h1>Added Books Receipt</h1>
                </div>
                <div id="receiptDIV"></div>
            </div>`;
    $("#ResultDisplay").html(html);
}
