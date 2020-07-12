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

function getBooks() {
  semesterValue = semester.value;
  branchValue = branch.value;
  if (branchValue != "" && semesterValue != "") {
    var formData = new FormData();
    formData.append("semester", semesterValue);
    formData.append("branch", branchValue);
    $.ajax({
      type: "POST",
      url: "recommend/getBooks.php",
      data: formData,
      contentType: false, // Dont delete this (jQuery 1.6+)
      processData: false, // Dont delete this
      success: function (data) {
        if (data) {
          data = JSON.parse(data);
          html = ` <div class="col mb-4">`;
          data.forEach(function (item, index) {
            html +=
              `
              <div class="card h-100">
                <img class="card-img-top" src=` +
              item.imgLink +
              `" alt="Card image cap" style="height: 20vw;" />
                <div class="card-body" style="padding: 1rem;">
                  <div class="card-text">
                    <div class="row no-gutters">
                      <div class="col-4">Title:</div>
                      <div class="col-8">
                        ` +
              item.title +
              `
                      </div>
                    </div>
                    <div class="row no-gutters">
                      <div class="col-4">Author:</div>
                      <div class="col-8">
                        ` +
              item.author +
              `
                      </div>
                    </div>
                    <div class="row no-gutters">
                      <div class="col-4">ISBN:</div>
                      <div class="col-8">
                        ` +
              item.isbn +
              `
                      </div>
                    </div>
                    <div class="row no-gutters">
                      <div class="col-4">BookID:</div>
                      <div class="col-8">
                        ` +
              item.bookID +
              `
                      </div>
                    </div>
                    <div class="row no-gutters">
                      <div class="col-4">Rating:</div>
                      <div class="col-8">
                        ` +
              item.star +
              `
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer bg-white">
                  <div class="row text-center">
                    <div class="col-12">
                      <button type="button" id="` +
              item.bookID +
              `" onclick="deleteFromSection(this.id, this.name); location.reload(true);" class="btn btn-info" name="` +
              item.sem_branchID +
              `">
                        Delete
                      </button>
                    </div>
                  </div>
                </div>
              </div>`;
          });
          html += `</div>`;
        } else {
          var html = "No books in this category";
        }
        document.getElementById("bookCards").innerHTML = html;
      },
      //Other options
    });
  }
}

var branch = document.getElementById("branch");
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
}
