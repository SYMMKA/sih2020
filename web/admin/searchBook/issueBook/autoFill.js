function autoFillIssueBook(copyID, oldID, reservedBy, i) {
    document.getElementById("bookFormDiv").innerHTML = "";
    var html =
        `
        <div class="container pt-4 mb-4">
            <div class="mb-5 pb-3">
                <h3 class="text-white float-left">Issue Form</h3>
                <h3 class="text-white float-right" id="displayCopyTitleOldID">Old ID: ` +
        oldID +
        `<h3 class="text-white float-right mr-5" id="displayCopyTitleCopyID">` +
			copyID +
		`</h3>
		</h3>
                <h3 class="text-white float-right mr-5">Copy ID: </h3>
		</h3>
		    </div>

            <div class="form-group row mb-4" id="studentDetailsIssue" name="studentDetailsIssue" >
                <label for="" class="col-sm-3 col-form-label text-white"
                    >Student ID</label
                >
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="stud_IDIssue" id="stud_IDIssue"  required/>
                </div>
            </div>

            <div class="pb-5">
                <button type="submit" form="issueBookForm" value="issue" name="issue" class="btn btn-orange float-right">
                    Issue Book
                </button>
            </div>
        </div>
	`;
    document.getElementById("bookFormDiv").innerHTML = html;
    document.getElementById("reservedBy").value = reservedBy;
    document.getElementById("elementID").value = i;
}
