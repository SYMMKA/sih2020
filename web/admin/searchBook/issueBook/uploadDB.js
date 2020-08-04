// Listen for form submit
document.getElementById('issueBookForm').addEventListener('submit', issueBook);

// Submit form
function issueBook(e) {
	e.preventDefault();

	// Get values
	var reservedBy = document.getElementById('reservedBy').value;
	var bookID = document.getElementById('copyBookID').value;
	var stud_ID = document.getElementById('stud_IDIssue').value;
	var copyID = document.getElementById('displayCopyTitleCopyID').textContent;
	var oldID = document.getElementById('displayCopyTitleOldID').textContent;
	var elementID = document.getElementById('elementID').value;

	var formData = new FormData();
	formData.append('bookID', bookID);
	formData.append('stud_ID', stud_ID);
	formData.append('copyID', copyID);
	formData.append('oldID', oldID);

	if ((reservedBy == '') || (reservedBy == stud_ID)) {
		$.ajax({
			type: "POST",
			url: "searchBook/issueBook/issueQuery.php",
			data: formData,
			contentType: false, // Dont delete this (jQuery 1.6+)
			processData: false, // Dont delete this
			success: function (data) {
				console.log(data);
				autoFillBook(elementID);
			}
		},
		);
	} else {
		alert("This book is reserved");
	}

	// Clear form
	//document.getElementById('issueBookForm').reload();

}