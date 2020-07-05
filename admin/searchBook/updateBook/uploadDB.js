// Your web app's Firebase configuration
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
	var pageCount = getInputVal('updatepageCount');
	var money = getInputVal('updatemoney');
	var oldID = getInputVal('updateOldID');
	var addQuan = getInputVal('updateaddcopies');
	var files = $('#updateimgFile')[0].files[0];
	if (!files)
		files = null;

	var mainCategory1 = '';
	var mainCategory2 = '';
	var mainCategory3 = '';
	var mainCategory4 = '';
	if (mainCategorySelect1.value)
		mainCategory1 = mainCategorySelect1.options[mainCategorySelect1.selectedIndex].text
	if (mainCategorySelect2.value)
		mainCategory2 = mainCategorySelect2.options[mainCategorySelect2.selectedIndex].text
	if (mainCategorySelect3.value)
		mainCategory3 = mainCategorySelect3.options[mainCategorySelect3.selectedIndex].text
	if (mainCategorySelect4.value)
		mainCategory4 = mainCategorySelect4.options[mainCategorySelect4.selectedIndex].text

	var formData = new FormData();
	formData.append('bookID', bookID);
	formData.append('title', title);
	formData.append('author', author);
	formData.append('mainCategory1', mainCategory1);
	formData.append('mainCategory2', mainCategory2);
	formData.append('mainCategory3', mainCategory3);
	formData.append('mainCategory4', mainCategory4);
	formData.append('publisher', publisher);
	formData.append('publishedDate', publishedDate);
	formData.append('isbn', isbn);
	formData.append('pageCount', pageCount);
	formData.append('money', money);
	formData.append('oldID', oldID);
	formData.append('imgFile', files);
	formData.append('addQuan', addQuan);

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