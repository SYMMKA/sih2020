$(document).ready(function () {
	$("#receipt").on("click", loadSelectBox);
});

function loadSelectBox() {
	html = ` <div class="form-group row justify-content-center pt-5 mb-5">
				<label
					for="receiptBookID"
					class="col-sm-2 col-form-label font-weight-bold"
					>Book ID</label
				>
				<div class="col-sm-6">
					<select
						class="selectpicker w-100"
						name="receiptBookID"
						onchange="loadReceiptBox()"
						id="receiptBookID"
                        data-live-search="true"
                        title="Select Book ID"
					>
					</select>
                </div>
            </div>
            <div id="receiptResult">
            </div>
            `;
	$("#ResultDisplay").html(html);
	var receiptBookID = document.getElementById("receiptBookID");
	$.ajax({
		type: "POST",
		url: "record/receipt/bookID.php",
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function (data) {
			var data = JSON.parse(data);
			var i = 0;
			receiptBookID.options.length = 0;
			for (var key in data) {
				receiptBookID.options[i] = new Option(
					key + " - " + data[key], key
				);
				i++;
			}
			$(".selectpicker").selectpicker("refresh");
		},
		//Other options
	});
	$(".selectpicker").selectpicker("refresh");
}

function loadReceiptBox() {
	var bookID = $('#receiptBookID').val();
	$.ajax({
		type: "POST",
		url: "record/receipt/receipt.php",
		data: {
			bookID: bookID,
		},
		success: function (data) {
			data = JSON.parse(data);
			console.log(data);
			html = `
			<div class="container">
                <div class="mb-4 pt-4">
					<h3>`+ data.book.title + `
                    <a class="btn btn-orange ml-2 float-right" target="_blank" href="` + data.book.receiptLink + `">Download Receipt</a>
                    </h3>                    
                </div>
				<div id="receiptDIV">
					<div class="table-responsive">
						<table class="table table-hover table-bordered">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Copy ID</th>
									<th scope="col">Purchase Time</th>
									<th scope="col">Purchase Source</th>
									<th scope="col">Addition Time</th>
								</tr>
							</thead>
							<tbody>`;
			var index = 1;
			for(var copyID in data.copy) {
				html +=
					`<tr>
								<th scope="row">` +
					index +
					`           </th>
								<td>` +
					copyID +
					`           </td>
								<td>` +
					data.copy[copyID].purchaseTime +
					`           </td>
						        <td>` +
					data.copy[copyID].purchaseSource +
					`           </td>
                                <td>` +
                    data.copy[copyID].addDB +
					`</td>
					</tr>`;
			}
			html += `
							</tbody>
						</table>
					</div>
				</div>
			</div>`;
			$("#receiptResult").html(html);
		},
	});
}
