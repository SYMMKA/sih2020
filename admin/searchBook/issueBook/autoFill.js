function autoFillIssueBook(copyID, oldID, reservedBy, i) {
	document.getElementById("bookFormDiv").innerHTML = "";
	var html =
		`
        <h1 class="text-center mb-4">Issue Book</h1>


    <div class="text-center mb-4">
                <h4 class="d-inline">Copy ID: </h4>
                <h4 class="d-inline" id="displayCopyTitleCopyID">` +
		copyID +
		`</h4></br>
                <h4 class="d-inline">Old ID: </h4>
                <h4 class="d-inline" id="displayCopyTitleOldID">` +
		oldID +
		`</h4>
    </div>      

	<div name="studentDetailsIssue" id="studentDetailsIssue" >
		<div class="form-group row justify-content-center" >
			<label class="col-sm-4 col-form-label  text-right">Student ID</label>
			<div class="col-sm-4"><input class="form-control" type="text" name="stud_IDIssue" id="stud_IDIssue" placeholder="ID" required/></div>
			<div class="col-sm-4">
				<button type="reset" value="Clear" class="btn btn-secondary">
				clear
				</button>
				<button type="submit" form="issueBookForm" value="issue" name="issue" class="btn btn-info">Issue</button>
			</div>
		</div>
	</div>

	</br>
	`;
	document.getElementById("bookFormDiv").innerHTML = html;
	document.getElementById("reservedBy").value = reservedBy;
	document.getElementById("elementID").value = i;
}
