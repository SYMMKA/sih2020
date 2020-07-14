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
        url: "recommend/sem_branch.php",
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
                            data[branch][sem] +
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
                    // example to load sem-branch modal
                    $(".show-books").click(function () {
                        var id = $(this).attr("id");
                        var formdata = new FormData();
                        formdata.append("sem_branchID", id);
                        console.log(formdata);

                        $.ajax({
                            type: "POST",
                            url: "recommend/getBooks.php",
                            data: formdata,
                            contentType: false, // Dont delete this (jQuery 1.6+)
                            processData: false, // Dont delete this
                            success: function (data) {
                                if (data) {
                                    data = JSON.parse(data);
                                    console.log(data);
                                    html = `<div class="row">
                            <div class="col-md-8 col-lg-10">
                                <div
                                    class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4"
                                    style="height: 500px; overflow-y: scroll;"
                                >`;
                                    data.forEach(function (item, index) {
                                        html +=
                                            `
                                    <div class="col mb-4">
                                    <div class="card">
                                        <img class="card-img-top" src="` +
                                            item.imgLink +
                                            `"
                                        alt="Card image cap" style="height:18vw;" />
                                        <div class="card-body text-center" style="padding: 1rem;">
                                        <h4 class="card-title mb-4 ">` +
                                            item.title +
                                            `</h4>
                                        <h6 class="card-subtitle mb-2 text-muted">` +
                                            item.author +
                                            `</h6>
                                        <p class="card-text"> 
                                        Book ID:                   
                                        ` +
                                            item.bookID +
                                            `                               
                                        </p>
                                            </div>
                                        </div>
                                    </div>`;
                                    });
                                    html += `</div>
                                            </div>
                                            <div class="col-md-4 col-lg-2">
                                                    <div>
                                                        <h3>Add Books</h3>
                                                        <select class="selectpicker mb-3 w-100" title="Select Book" data-style="btn-blue">
                                                        <option>Mustard</option>
                                                        <option>Ketchup</option>
                                                        <option>Relish</option>
                                                        </select>
                                                        <button type="button" class="btn btn-orange btn-block mb-5">
                                                        Add
                                                        </button>
                                                        <h3>Delete Books</h3>
                                                        <select class="selectpicker mb-3 w-100" title="Select Book" data-style="btn-blue">
                                                        `;
                                    data.forEach(function (item, index) {
                                        html +=
                                            `<option>` +
                                            item.title +
                                            `</option>`;
                                    });
                                    html += `
                                                        </select>
                                                        <button type="button" class="btn btn-orange btn-block mb-5">
                                                        Remove
                                                        </button>
                                                    </div>
                                                </div>
                                                </div> `;
                                    $("#modalBodyContent").html(html);
                                    $(".selectpicker").selectpicker({});
                                }
                            },
                            //Other options
                        });
                    });
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
