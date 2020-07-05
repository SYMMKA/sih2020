var action = "";
var bookID = "";
var user = "";
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
      console.log(data);

      var doc = new jsPDF();

      doc.text(20, 20, "TEST Message!!");
      doc.addPage();
      doc.text(20, 20, "TEST Page 2!");
      doc.save("Test.pdf");
      /* document.getElementById("pdfView").innerHTML = `<iframe src="report/report.pdf" width="100%" height="500px">`; */
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
