var semester = "";
var branch = "";

function addnewbook() {
    document.getElementById("addnewbook").hidden = false;
}

function addSemBranch() {
    semester = "";
    branch = "";
    semester = document.getElementById("semesterModal").value;
    branch = document.getElementById("branchModal").value;
    if (branch != "" && semester != "") {
        var formData = new FormData();
        formData.append("semester", semester);
        formData.append("branch", branch);
        $.ajax({
            type: "POST",
            url: "recommend/addNewSemBranch.php",
            data: formData,
            contentType: false, // Dont delete this (jQuery 1.6+)
            processData: false, // Dont delete this
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
            },
            //Other options
        });
    }
}

function deleteSemBranch() {
    semester = "";
    branch = "";
    semester = document.getElementById("semesterModalDelete").value;
    branch = document.getElementById("branchModalDelete").value;
    if (branch != "" && semester != "") {
        var formData = new FormData();
        formData.append("semester", semester);
        formData.append("branch", branch);
        $.ajax({
            type: "POST",
            url: "recommend/deleteSemBranch.php",
            data: formData,
            contentType: false, // Dont delete this (jQuery 1.6+)
            processData: false, // Dont delete this
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
            },
            //Other options
        });
    }
}

function deleteFromSection(bookID, sem_branchID) {
    var formData = new FormData();
    formData.append("bookID", bookID);
    formData.append("sem_branchID", sem_branchID);
    $.ajax({
        type: "POST",
        url: "recommend/deleteBook.php",
        data: formData,
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);
        },
    });
}

window.onload = function () {
    $.ajax({
        type: "POST",
        url: "recommend/getBooks.php",
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function (data) {
            if (data) {
                data = JSON.parse(data);
                html = ``;
                for (branch in data) {
                    html +=
                        ` <h2>` +
                        branch +
                        `<h2>
                    <div class="d-flex flex-row flex-nowrap overflow-auto p-4">`;
                    for (sem in data[branch]) {
                        html +=
                            `<div class="card show-books" id="` +
                            branch +
                            `-` +
                            sem +
                            `" 
							>
                            <div
                                class="d-flex justify-content-center align-items-center card-body btn "
                                data-toggle="modal"
                                data-target="#modelId"
                                href
                            >
                                <h1 class="card-title">` +
                            sem +
                            `</h1>
                            </div>
                        </div>`;
                    }
                    html += `</div>
                </div>`;
                    $("#recommendations").html(html);
                }
            }
        },
        //Other options
    });
};

/* var branch = document.getElementById("branch");
var sem_branch = "";
$.ajax({
  type: "POST",
  url: "recommend/sem_branch.php",
  contentType: false, // Dont delete this (jQuery 1.6+)
  processData: false, // Dont delete this
  success: function (data) {
    sem_branch = JSON.parse(data);
    var i = 1;
    for (var key in sem_branch) {
      branch.options[i] = new Option(key, key);
      i++;
    }
    $(".selectpicker").selectpicker("refresh");
  },
  //Other options
});

var semester = document.getElementById("semester");
branch.onchange = function () {
  semValue = branch.value;
  var i = 1;
  semester.options.length = 1;
  for (var key in sem_branch[semValue]) {
    semester.options[i] = new Option(
      sem_branch[semValue][key],
      sem_branch[semValue][key]
    );
    i++;
  }
  $(".selectpicker").selectpicker("refresh");
};

semester.onchange = function () {
  getBooks();
  addnewbook();
  bookID();
};

function bookID() {
  var bookIDDrop = document.getElementById("bookID");
  $.ajax({
    type: "POST",
    url: "recommend/bookID.php",
    contentType: false, // Dont delete this (jQuery 1.6+)
    processData: false, // Dont delete this
    success: function (data) {
      var bookID = JSON.parse(data);
      var i = 1;
      for (var key in bookID) {
        bookIDDrop.options[i] = new Option(key + " - " + bookID[key], key);
        i++;
      }
      $(".selectpicker").selectpicker("refresh");
    },
    //Other options
  });
} */
