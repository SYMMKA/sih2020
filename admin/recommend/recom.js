var semester = "";
var branch = "";

$(document).ready(function () {
    loadSemBranch();
});

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
                console.log(data);
                data = JSON.parse(data);
                console.log(data);
                loadSemBranch();
            },
            //Other options
        });
    }
}

function deleteBranch(id) {
    branch = "";
    branch = id;
    if (branch != "") {
        var formData = new FormData();
        formData.append("branch", branch);
        $.ajax({
            type: "POST",
            url: "recommend/deleteBranch.php",
            data: formData,
            contentType: false, // Dont delete this (jQuery 1.6+)
            processData: false, // Dont delete this
            success: function (data) {
                console.log(data);
                loadSemBranch();
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

function loadSemBranch() {
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
                        `
				<div class="sem_branch mb-4">
				<div class="d-flex justify-content-between bg-light pt-4 pl-4 pr-4 pb-2 rounded">
				<h2 class="branch font-weight-bold">` +
                        branch +
                        `<h2>
        <button class="btn btn-outline-danger" onclick="deleteBranch('` +
                        branch +
                        `')"><i class="fa fa-trash"></i></button>
      </div>
					
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
                                data-target="#modelForBooks"
                                href
                            >
                                <h1 class="card-title sem">` +
                            sem +
                            `</h1>
                            </div>
                        </div>`;
                    }
                    html += `</div>
					</div>
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
                                                        <select class="selectpicker mb-3 w-100" title="Select Book" data-style="btn-blue" id="bookID" multiple data-live-search="true" data-actions-box="true">                                                      
                                                        </select>
                                                        <button type="button" class="btn btn-orange btn-block mb-5" onclick="addBook()">
                                                        Add
                                                        </button>
                                                        <h3>Delete Books</h3>
                                                        <select class="selectpicker mb-3 w-100" title="Select Book" data-style="btn-blue" multiple data-live-search="true" data-actions-box="true">
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
                                    bookID();
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
}

// load branch dropdown
var branchDrop = document.getElementById("branch");
var sem_branch = "";
$.ajax({
    type: "POST",
    url: "recommend/sem_branch.php",
    contentType: false, // Dont delete this (jQuery 1.6+)
    processData: false, // Dont delete this
    success: function (data) {
        sem_branch = JSON.parse(data);
        branchDrop.options[0] = new Option("All", "");
        var i = 1;
        for (var key in sem_branch) {
            branchDrop.options[i] = new Option(key, key);
            i++;
        }
        $(".selectpicker").selectpicker("refresh");
    },
    //Other options
});

// branch dropdown on change and load sem dropdown
var semesterDrop = document.getElementById("semester");
branchDrop.onchange = function () {
    branchVal = branchDrop.value;

    // remove sem wise filter
    $("#recommendations .show-books").filter(function () {
        $(this).toggle($(this).find(".sem").text().indexOf("") > -1);
    });
    // filter branch wise
    $("#recommendations .sem_branch").filter(function () {
        $(this).toggle($(this).find(".branch").text().indexOf(branchVal) > -1);
    });

    // load sem dropdown
    semesterDrop.options[0] = new Option("All", "");
    var i = 1;
    semesterDrop.options.length = 1;
    for (var key in sem_branch[branchVal]) {
        semesterDrop.options[i] = new Option(key, key);
        i++;
    }
    $(".selectpicker").selectpicker("refresh");
};

// sem dropdown on change
semesterDrop.onchange = function () {
    branchVal = branchDrop.value;
    semVal = semesterDrop.value;

    // filter sem wise
    $("#recommendations .show-books").filter(function () {
        $(this).toggle($(this).find(".sem").text().indexOf(semVal) > -1);
    });
};

// load book dropdown for adding new books
function bookID() {
    var bookIDDrop = document.getElementById("bookID");
    $.ajax({
        type: "POST",
        url: "recommend/bookID.php",
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function (data) {
            var bookID = JSON.parse(data);
            var i = 0;
            for (var key in bookID) {
                console.log(bookID[key]);
                bookIDDrop.options[i] = new Option(
                    key + " - " + bookID[key],
                    key
                );
                i++;
            }
            $(".selectpicker").selectpicker("refresh");
        },
        //Other options
    });
}

function addBook() {
    console.log(JSON.stringify($("#bookID").val()));
}
