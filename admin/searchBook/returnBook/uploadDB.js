// Listen for form submit
document.getElementById('returnBookForm').addEventListener('submit', returnBook);

var due;
// Submit form
function returnBook(e) {
	e.preventDefault();

	// Get values
	var copyID = document.getElementById('copyID').textContent;
	var elementID = document.getElementById('elementID').value;
	
	var orgFine = parseInt(document.getElementById('fine').textContent);
	var fine = parseInt(document.getElementById('totalFine').textContent);

	var orgPoint = parseInt(document.getElementById('point').value);
	var points = fine * (orgPoint/orgFine);

	var formData = new FormData();
	formData.append('copyID', copyID);
	formData.append('fine', fine);
	formData.append('points', points);
	formData.append('due', due);

	$.ajax({
		type: "POST",
		url: "searchBook/returnBook/returnQuery.php",
		data: formData,
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function (data) {
			console.log(data);
			autoFillBook(elementID);
		}
	});

	// Clear form
	//document.getElementById('issueBookForm').reload();

}