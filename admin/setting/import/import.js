$(document).ready(function () {

	// import Books
	$("#bookImport").on("click", function () {
		var bookCSV = $('#bookCSV')[0].files[0];

		var formData = new FormData();
		formData.append('bookCSV', bookCSV);
		$.ajax({
			url: "setting/import/importBooks.php",
			method: "POST",
			data: formData,
			contentType: false, // Dont delete this (jQuery 1.6+)
			processData: false, // Dont delete this
			success: function (data) {
				console.log(data);
			},
			error: function (error) {
				alert(error);
			},
		});
	});

	// import Students
	$("#studentsImport").on("click", function () {
		var studentsCSV = $('#studentsCSV')[0].files[0];

		var formData = new FormData();
		formData.append('studentsCSV', studentsCSV);
		$.ajax({
			url: "setting/import/importStudents.php",
			method: "POST",
			data: formData,
			contentType: false, // Dont delete this (jQuery 1.6+)
			processData: false, // Dont delete this
			success: function (data) {
				console.log(data);
			},
			error: function (error) {
				alert(error);
			},
		});
	});

	// import Teachers
	$("#teachersImport").on("click", function () {
		var teachersCSV = $('#teachersCSV')[0].files[0];

		var formData = new FormData();
		formData.append('teachersCSV', teachersCSV);
		$.ajax({
			url: "setting/import/importTeachers.php",
			method: "POST",
			data: formData,
			contentType: false, // Dont delete this (jQuery 1.6+)
			processData: false, // Dont delete this
			success: function (data) {
				console.log(data);
			},
			error: function (error) {
				alert(error);
			},
		});
	});
});