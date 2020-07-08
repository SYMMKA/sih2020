var action = "";
var bookID = "";
var user = "";
var html = "";
function changeAccess() {
	if (document.getElementById("student").selected == true) {
		document.getElementById("checkAdd").checked = false;
		document.getElementById("checkDelete").checked = false;
		document.getElementById("checkUpdate").checked = false;
		document.getElementById("checkAdd").disabled = true;
		document.getElementById("checkDelete").disabled = true;
		document.getElementById("checkUpdate").disabled = true;
	}
	if (
		document.getElementById("admin").selected == true ||
		document.getElementById("all").selected == true
	) {
		document.getElementById("checkAdd").disabled = false;
		document.getElementById("checkDelete").disabled = false;
		document.getElementById("checkUpdate").disabled = false;
	}
}

/* function generateReport() {
  action = "";
  bookID = "";
  user = "";
  if (document.getElementById("checkAdd").checked == true) {
    action = " add";
  }
  if (document.getElementById("checkIssue").checked == true) {
    action = action + " issue";
  }
  if (document.getElementById("checkReturn").checked == true) {
    action = action + " return";
  }
  if (document.getElementById("checkDelete").checked == true) {
    action = action + " delete";
  }
  if (document.getElementById("checkUpdate").checked == true) {
    action = action + " update";
  }
  if (document.getElementById("bookID").value == null) {
  } else {
    bookID = document.getElementById("bookID").value;
  }
  if (document.getElementById("student").selected == true) {
    user = "student";
  }
  if (document.getElementById("admin").selected == true) {
    user = "admin";
  }
  generateQuery();
} */
function generateReport() {
	var add = 0;
	var issue = 0;
	var bookreturn = 0;
	var bookdelete = 0;
	var update = 0;
	var bookID = "";
	var student = 0;
	var admin = 0;
	if (document.getElementById("checkAdd").checked == true) {
		add = 1;
	}
	if (document.getElementById("checkIssue").checked == true) {
		issue = 1;
	}
	if (document.getElementById("checkReturn").checked == true) {
		bookreturn = 1;
	}
	if (document.getElementById("checkDelete").checked == true) {
		bookdelete = 1;
	}
	if (document.getElementById("checkUpdate").checked == true) {
		update = 1;
	}
	if (document.getElementById("bookID").value == null) {
	} else {
		bookID = document.getElementById("bookID").value;
	}
	if (document.getElementById("student").selected == true) {
		student = 1;
	}
	if (document.getElementById("admin").selected == true) {
		admin = 1;
	}
	console.log("add - " + add);
	console.log("issue - " + issue);
	console.log("bookreturn - " + bookreturn);
	console.log("bookdelete - " + bookdelete);
	console.log("update - " + update);
	console.log("bookID - " + bookID);
	console.log("student - " + student);
	console.log("admin - " + admin);

	var formData = new FormData();
	formData.append("add", add);
	formData.append("issue", issue);
	formData.append("bookreturn", bookreturn);
	formData.append("bookdelete", bookdelete);
	formData.append("update", update);
	formData.append("bookID", bookID);
	formData.append("student", student);
	formData.append("admin", admin);
	$.ajax({
		type: "POST",
		url: "report/generateReport.php",
		data: formData,
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function (data) {
			console.log(data);
			if (data) {
				html = `
			<div class="table-responsive">
				<table id="reportTable" class="table table-bordered table-hover">
					<thead>
						<tr>
						<th scope="col">BookID</th>
						<th scope="col">CopyID</th>
						<th scope="col">AdminID</th>
						<th scope="col">StudentID</th>
						<th scope="col">Action</th>
						<th scope="col">Time</th>
						<th scope="col">OldID</th>
						</tr>
					</thead>
					<tbody>`;
				var table = JSON.parse(data);
				console.log(table);
				var count = Object.keys(table).length;
				table.forEach(function (item, index) {
					html +=
						`<tr> 
							<th  scope="row">` + item.bookID + `</th>
							<td>` + item.copyID + `</td>
							<td>` + item.adminID + `</td>
							<td>` + item.studentID + `</td>
							<td>` + item.action + `</td>
							<td>` + item.time + `</td>
							<td>` + item.oldID + `</td>
						</tr>`;
				});

				html += `
					</tbody>
				</table>
			</div>
			<div>
				<button type="button" id="downloadPdf" class="btn btn-bot btn-info col-3 ml-4 mr-4" onclick="downloadPdf()">
					DownLoad PDF
				</button>
			</div> `;
				document.getElementById("pdfView").innerHTML = html;

				/* document.getElementById("pdfView").innerHTML = `<iframe src="report/report.pdf" width="100%" height="500px">`; */
			}
		},
		//Other options
	});
}

function downloadPdf() {
	// It can parse html:
	// <table id="my-table"><!-- ... --></table>
	const doc = new jsPDF();
	doc.autoTable({ html: "#reportTable" });
	doc.save("report.pdf");
}
