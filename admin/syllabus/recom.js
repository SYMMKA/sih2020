var semester = "";
var branch = "";

$(document).ready(function () {
	loadSemBranch();
});

// add branch
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
			url: "syllabus/addNewSemBranch.php",
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

// delete branch
function deleteBranch(id) {
	branch = "";
	branch = id;
	if (branch != "") {
		var formData = new FormData();
		formData.append("branch", branch);
		$.ajax({
			type: "POST",
			url: "syllabus/deleteBranch.php",
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

// add book to sem-branch
function addBook(sem_branchID, branch, sem) {
	var bookIDs = JSON.stringify($("#addBookID").val());
	console.log(bookIDs);
	var formData = new FormData();
	formData.append('bookIDs', bookIDs);
	formData.append('sem_branchID', sem_branchID);
	$.ajax({
		type: "POST",
		url: "syllabus/addBook.php",
		data: formData,
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function (data) {
			console.log(data);
			sem_branchModal(sem_branchID, branch, sem);
		},
	});
}

// delete book from sem-branch
function deleteFromSection(sem_branchID, branch, sem) {
	var bookIDs = JSON.stringify($("#deleteBookID").val());
	var formData = new FormData();
	formData.append("bookIDs", bookIDs);
	formData.append("sem_branchID", sem_branchID);
	$.ajax({
		type: "POST",
		url: "syllabus/deleteBook.php",
		data: formData,
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function (data) {
			console.log(data);
			sem_branchModal(sem_branchID, branch, sem);
		},
	});
}

function loadSemBranch() {
	$.ajax({
		type: "POST",
		url: "syllabus/sem_branch.php",
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
							`<div class="card show-books"
							>
                            <div
                                class="d-flex justify-content-center align-items-center card-body btn "
                                data-toggle="modal"
                                data-target="#modelForBooks"
								href
								onclick="sem_branchModal(` +
								data[branch][sem] +
								`, '` +
								branch +
								`', ` +
								sem +
								`)" 
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
					$("#syllabusDiv").html(html);
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
	url: "syllabus/sem_branch.php",
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
	$("#syllabusDiv .show-books").filter(function () {
		$(this).toggle($(this).find(".sem").text().indexOf("") > -1);
	});
	// filter branch wise
	$("#syllabusDiv .sem_branch").filter(function () {
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
	$("#syllabusDiv .show-books").filter(function () {
		$(this).toggle($(this).find(".sem").text().indexOf(semVal) > -1);
	});
};

// load book dropdown for adding new books
function bookID() {
	var bookIDDrop = document.getElementById("addBookID");
	$.ajax({
		type: "POST",
		url: "syllabus/bookID.php",
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function (data) {
			var bookID = JSON.parse(data);
			var i = 0;
			for (var key in bookID) {
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

function sem_branchModal(id, branch, sem) {
	// example to load sem-branch modal
	var formdata = new FormData();
	formdata.append("sem_branchID", id);

	$.ajax({
		type: "POST",
		url: "syllabus/getBooks.php",
		data: formdata,
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function (data) {
			html = `
				<div class="modal-header" >
				<h5 class="modal-title">`+branch+` - `+sem+`</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body" >
				<div class="row">
		<div class="col-md-8 col-lg-10">
			<div
				class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4"
				style="height: 500px; overflow-y: scroll;"
			>`;
			if (data) {
				data = JSON.parse(data);
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
			}
			html += `</div>
						</div>
						<div class="col-md-4 col-lg-2">
								<div>
									<h3>Add Books</h3>
									<select class="selectpicker mb-3 w-100" title="Select Book" data-style="btn-blue" id="addBookID" multiple data-live-search="true" data-actions-box="true">                                                      
									</select>
									<button type="button" class="btn btn-orange btn-block mb-5" onclick="addBook(`+id+`, '`+branch+`', `+sem+`)">
									Add
									</button>
									<h3>Delete Books</h3>
									<select class="selectpicker mb-3 w-100" title="Select Book" data-style="btn-blue" id="deleteBookID" multiple data-live-search="true" data-actions-box="true">
									`;
			if (data) {
				data.forEach(function (item, index) {
					html +=
						`<option value="` + item.bookID + `">` +
						item.bookID + " - " + item.title +
						`</option>`;
				});
			}
			html += `
									</select>
									<button type="button" class="btn btn-orange btn-block mb-5" onclick="deleteFromSection(`+id+`, '`+branch+`', `+sem+`)">
									Remove
									</button>
								</div>
							</div>
							</div>
							</div>
							<div class="modal-footer">
							<button type="button" class="btn btn-blue" data-dismiss="modal">
								Close
							</button>
							<button type="button" class="btn btn-orange" data-dismiss="modal">
								Save
							</button> `;
			$("#modalBodyContent").html(html);
			$(".selectpicker").selectpicker({});
			bookID();
		},
		//Other options
	});
}