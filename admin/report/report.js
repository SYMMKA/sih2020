var action = "";
var bookID = "";
var user = "";
var html = "";
var table;
function changeAccess() {
	document.getElementById("adminIDGroup").hidden = false;
	document.getElementById("studentIDGroup").hidden = false;
	document.getElementById("checkAdd").disabled = false;
	document.getElementById("checkDelete").disabled = false;
	document.getElementById("checkUpdate").disabled = false;

	if (document.getElementById("student").selected == true) {
		document.getElementById("checkAdd").checked = false;
		document.getElementById("checkDelete").checked = false;
		document.getElementById("checkUpdate").checked = false;
		document.getElementById("checkAdd").disabled = true;
		document.getElementById("checkDelete").disabled = true;
		document.getElementById("checkUpdate").disabled = true;
		document.getElementById("adminIDGroup").hidden = true;
	}
	if (document.getElementById("admin").selected == true) {
		document.getElementById("studentIDGroup").hidden = true;
	}
}

function generateReport() {
	var add = 0;
	var issue = 0;
	var bookreturn = 0;
	var bookdelete = 0;
	var update = 0;
	var bookID = "";
	var studentID = "";
	var adminID = "";
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
	if (document.getElementById("bookID").value == "") {
	} else {
		bookID = JSON.stringify($('#bookID').val());
		console.log("hi");
	}
	if (document.getElementById("student").selected == true) {
		studentID = JSON.stringify($('#studentID').val());
		if (studentID == "") // to show where studentID is not NULL
			studentID = "show";
	}
	if (document.getElementById("admin").selected == true) {
		adminID = JSON.stringify($('#adminID').val());
	}
	if (document.getElementById("all").selected == true) {
		studentID = JSON.stringify($('#studentID').val());
		adminID = JSON.stringify($('#adminID').val());
	}
	console.log("add - " + add);
	console.log("issue - " + issue);
	console.log("bookreturn - " + bookreturn);
	console.log("bookdelete - " + bookdelete);
	console.log("update - " + update);
	console.log("bookID - " + bookID);
	console.log("student - " + studentID);
	console.log("admin - " + adminID);

	var formData = new FormData();
	formData.append("add", add);
	formData.append("issue", issue);
	formData.append("bookreturn", bookreturn);
	formData.append("bookdelete", bookdelete);
	formData.append("update", update);
	formData.append("bookID", bookID);
	formData.append("studentID", studentID);
	formData.append("adminID", adminID);
	$.ajax({
		type: "POST",
		url: "report/generateReport.php",
		data: formData,
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function (data) {
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
				table = JSON.parse(data);
				console.log(table);
				table.forEach(function (item, index) {
					html +=
						`<tr> 
							<th  scope="row">` +
						item.bookID +
						`</th>
							<td>` +
						item.copyID +
						`</td>
							<td>` +
						item.adminID +
						`</td>`;
					if (item.studentID) html += `<td>` + item.studentID + `</td>`;
					else html += `<td> --- </td>`;
					html +=
						`
							<td>` +
						item.action +
						`</td>
							<td>` +
						item.time +
						`</td>
							<td>` +
						item.oldID +
						`</td>
						</tr>`;
				});

				html += `
					</tbody>
				</table>
			</div>
			<div>
				<button type="button" id="downloadPdf" class="btn btn-info float-left m-2" onclick="downloadPdf()">
					DownLoad PDF
				</button>
			</div> `;
			} else {
				html = "";
			}
			document.getElementById("reportDIV").innerHTML = html;
		},
		//Other options
	});
}

function downloadPdf() {
	// It can parse html:
	// <table id="my-table"><!-- ... --></table>
	var today = new Date();
	var date =
		today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
	var time =
		today.getHours() + "-" + today.getMinutes() + "-" + today.getSeconds();
	var dateTime = date + "--" + time;
	const doc = new jsPDF();
	doc.autoTable({ html: "#reportTable" });
	doc.save(dateTime + ".pdf");
}

function loadBookID() {
	var bookIDoption = document.getElementById("bookID");
	$.ajax({
		type: "POST",
		url: "report/bookID.php",
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function (data) {
			var data = JSON.parse(data);
			var i = 0;
			for (var key in data) {
				bookIDoption.options[i] = new Option(key + " - " + data[key], key);
				i++;
			}
			$('#bookID option').attr("selected","selected");
			$(".selectpicker").selectpicker("refresh");
		},
		//Other options
	});
}

function loadStudentID() {
	var studentIDoption = document.getElementById("studentID");
	$.ajax({
		type: "POST",
		url: "report/studentID.php",
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function (data) {
			var data = JSON.parse(data);
			var i = 0;
			for (var key in data) {
				studentIDoption.options[i] = new Option(data[key], data[key]);
				i++;
			}
			$('#studentID option').attr("selected","selected");
			$(".selectpicker").selectpicker("refresh");
		},
		//Other options
	});
}

function loadAdminID() {
	var adminIDoption = document.getElementById("adminID");
	$.ajax({
		type: "POST",
		url: "report/adminID.php",
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function (data) {
			var data = JSON.parse(data);
			var i = 0;
			for (var key in data) {
				adminIDoption.options[i] = new Option(data[key], data[key]);
				i++;
			}
			$('#adminID option').attr("selected","selected");
			$(".selectpicker").selectpicker("refresh");
		},
		//Other options
	});
}

function loadDropDowns() {
	loadBookID();
	loadStudentID();
	loadAdminID();
}
