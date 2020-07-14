// Listen for form submit
document.getElementById('updateBookForm').addEventListener('submit', updateBook);
// Submit form
function updateBook(e) {
	e.preventDefault();

	// Get values
	var bookID = document.getElementById('bookIDUpdate').textContent;
	var title = getInputVal('updateTitle');
	var author = getInputVal('updateAuthor');
	var publisher = getInputVal('updatepublisher');
	var publishedDate = getInputVal('updatepublishedDate');
	var isbn = getInputVal('updateISBN');
	var money = getInputVal('updatemoney');
	var oldID = getInputVal('updateOldID');
	var imgFile = $('#updateimgFile')[0].files[0];
	if (!imgFile)
		imgFile = null;
	var addQuan = getInputVal('updateaddcopies');
	var pageCount = getInputVal('updatepageCount');
	var mediaFile = $('#mediaFile')[0].files[0]; //digital

	var updateCategory1 = '';
	var updateCategory2 = '';
	var updateCategory3 = '';
	var updateCategory4 = '';
	if (getInputVal('catDisplay') == "true") {
		if (updateCategorySelect1.value)
			updateCategory1 = updateCategorySelect1.options[updateCategorySelect1.selectedIndex].text
		if (updateCategorySelect2.value)
			updateCategory2 = updateCategorySelect2.options[updateCategorySelect2.selectedIndex].text
		if (updateCategorySelect3.value)
			updateCategory3 = updateCategorySelect3.options[updateCategorySelect3.selectedIndex].text
		if (updateCategorySelect4.value)
			updateCategory4 = updateCategorySelect4.options[updateCategorySelect4.selectedIndex].text
	}
	//console.log(updateCategory4);

	var formData = new FormData();
	formData.append('bookID', bookID);
	formData.append('title', title);
	formData.append('author', author);
	formData.append('mainCategory1', updateCategory1);
	formData.append('mainCategory2', updateCategory2);
	formData.append('mainCategory3', updateCategory3);
	formData.append('mainCategory4', updateCategory4);
	formData.append('publisher', publisher);
	formData.append('publishedDate', publishedDate);
	formData.append('isbn', isbn);
	formData.append('pageCount', pageCount);
	formData.append('money', money);
	formData.append('oldID', oldID);
	formData.append('imgFile', imgFile);
	formData.append('addQuan', addQuan);
	formData.append('mediaFile', mediaFile);

	$.ajax({
		type: "POST",
		url: "searchBook/updateBook/updateBookQuery.php",
		data: formData,
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		processData: false, // Dont delete this
		success: function (data) {
			console.log(data);
			window.location.reload();
		}
		//Other options
	});
}

// Function to get form values
function getInputVal(id) {
	return document.getElementById(id).value;
}