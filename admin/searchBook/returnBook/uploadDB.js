function autoFillReturnBook(copyID, i) {
	document.getElementById('copyID').textContent = copyID;
	document.getElementById('elementID').value = i;
}

// Listen for form submit
document.getElementById('returnBookForm').addEventListener('submit', returnBook);

// Submit form
function returnBook(e) {
	e.preventDefault();

	// Get values
	var isbn = document.getElementById('copyIsbn').textContent;
	var copyID = document.getElementById('copyID').textContent;
	var elementID = document.getElementById('elementID').value;

	var formData = new FormData();
	formData.append('isbn', isbn);
	formData.append('copyID', copyID);

	$.ajax({
		type: "POST",
		url: "searchBook/returnBook/returnQuery.php",
		data: formData,
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function () {
			autoFillBook(elementID);
		}
	});

	// Clear form
	//document.getElementById('issueBookForm').reload();

}