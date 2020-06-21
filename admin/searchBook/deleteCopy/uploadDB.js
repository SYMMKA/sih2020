// Your web app's Firebase configuration
// Listen for form submit
document.getElementById('deleteCopyForm').addEventListener('submit', removeCopy);
// Submit form
function removeCopy(e) {
	e.preventDefault();

	// Get values
	var copyID = document.getElementById('deleteCopyID').textContent;
	var elementID = document.getElementById('elementID').value;

	var formData = new FormData();
	formData.append('copyID', copyID);

	$.ajax({
		type: "POST",
		url: "searchBook/deleteCopy/deleteCopyQuery.php",
		data: formData,
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function () {
			autoFillBook(elementID);
		}
	});

}