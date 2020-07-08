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

function generateQuery() {
  var studentIDquery = "";
  var actionquery = "";
  var bookIDquery = "";
  var query = "SELECT * from `history` WHERE ";
  if (user == "student") {
    studentIDquery = "(`studentID` is NOT NULL)";
  }

  if (action != "") {
    var q1 = action.split(" ");
    if (q1.length > -1) {
      actionquery = " (`action`='" + q1[1] + "'";
      if (q1.length > 1)
        for (let index = 2; index < q1.length; index++) {
          actionquery = actionquery + " OR `action`='" + q1[index] + "'";
        }
      actionquery = actionquery + ")";
    }
  }

  if (bookID != "") {
    bookIDquery = "(`bookID`='" + bookID + "')";
  }

  if (user != "") {
    query += studentIDquery;
  }

  if (user != "") {
    if (actionquery != "") {
      query += actionquery;
    }
  } else {
    if (actionquery != "") {
      query += "AND" + actionquery;
    }
  }

  if (bookID != "") {
    query += "AND" + bookIDquery;
  }

  console.log(query);
  var formData = new FormData();
  formData.append("query", query);

  $.ajax({
    type: "POST",
    url: "report/generateReport.php",
    data: formData,
    type: "POST",
    contentType: false, // Dont delete this (jQuery 1.6+)
    processData: false, // Dont delete this
    success: function (data) {
      if (data) {
        html = `<div class="table-responsive"><table id="reportTable" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">CopyID</th>
          <th scope="col">AdminID</th>
          <th scope="col">StudentID</th>
          <th scope="col">Action</th>
          <th scope="col">Time</th>
          <th scope="col">BookID</th>
          <th scope="col">OldID</th>
        </tr>
        </thead>
        <tbody>`;
        var table = JSON.parse(data);
        //console.log(table[0].id);
        var count = Object.keys(table).length;
        table.forEach(function (item, index) {
          html +=
            `<tr> 
            <th  scope="row">` +
            item.id +
            `</th>
            <td>` +
            item.copyID +
            `</td>
            <td>` +
            item.adminID +
            `</td>
            <td>` +
            item.studentID +
            `</td>
            <td>` +
            item.action +
            `</td>
            <td>` +
            item.time +
            `</td>
            <td>` +
            item.bookID +
            `</td>
            <td>` +
            item.oldID +
            `</td>
        </tr>`;
        });

        html += `</tbody></table></div>
        <div> <button type="button" id="downloadPdf" class="btn btn-bot btn-info col-3 ml-4 mr-4" onclick="downloadPdf()">DownLoad PDF</button>
        </> `;
        document.getElementById("pdfView").innerHTML = html;

        /* document.getElementById("pdfView").innerHTML = `<iframe src="report/report.pdf" width="100%" height="500px">`; */
      }
    },
    //Other options
  });
}

function generateReport() {
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
}

function downloadPdf() {
  // It can parse html:
  // <table id="my-table"><!-- ... --></table>
  const doc = new jsPDF();
  doc.autoTable({ html: "#reportTable" });
  doc.save("report.pdf");
}
