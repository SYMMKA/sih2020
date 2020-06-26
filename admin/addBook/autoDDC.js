// To select category
window.onload = function () {

	loadCategory();

	//testDDC
	var testDDC1 = document.getElementById('testDDC');
	var title = document.getElementById('title');
	var author = document.getElementById('author');
	var isbn = document.getElementById('isbn');

	$(".DDC").change(function () {
		console.log(title.value);

		var formData = new FormData();
		formData.append('title', title.value);
		formData.append('author', author.value);
		formData.append('isbn', isbn.value);

		$.ajax({
			type: "POST",
			url: "addBook/autoDDC.php",
			data: formData,
			type: 'POST',
			contentType: false, // Dont delete this (jQuery 1.6+)
			processData: false, // Dont delete this
			success: function (data) {
				console.log(data);
				var ddc = data;
				var d1 = Math.floor(ddc / 100);
				document.getElementById("mainCategorySelect1").value = d1;
				mainCategorySelect2.length = 1; // remove all options bar first
				mainCategorySelect3.length = 1; // remove all options bar first
				mainCategorySelect4.length = 1; // remove all options bar first
				c1();

				var d2 = Math.floor((ddc % 100) / 10);
				document.getElementById("mainCategorySelect2").value = d2;
				mainCategorySelect3.length = 1; // remove all options bar first
				mainCategorySelect4.length = 1; // remove all options bar first
				c2();

				var d3 = Math.floor(ddc % 10);
				document.getElementById("mainCategorySelect3").value = d3;
				mainCategorySelect4.length = 1; // remove all options bar first
				c3();

				var d4 = Math.floor(((ddc % 1) / .1) + 0.5);
				document.getElementById("mainCategorySelect4").value = d4;
			}
			//Other options
		});
	});
	testDDC1.onchange = function () {

		var testDDC = document.getElementById('testDDC').value;

		var d1 = Math.floor(testDDC / 100);
		document.getElementById("mainCategorySelect1").value = d1;
		mainCategorySelect2.length = 1; // remove all options bar first
		mainCategorySelect3.length = 1; // remove all options bar first
		mainCategorySelect4.length = 1; // remove all options bar first
		c1();

		var d2 = Math.floor((testDDC % 100) / 10);
		document.getElementById("mainCategorySelect2").value = d2;
		mainCategorySelect3.length = 1; // remove all options bar first
		mainCategorySelect4.length = 1; // remove all options bar first
		c2();

		var d3 = Math.floor(testDDC % 10);
		document.getElementById("mainCategorySelect3").value = d3;
		mainCategorySelect4.length = 1; // remove all options bar first
		c3();

		var d4 = Math.floor(((testDDC % 1) / .1) + 0.5);
		document.getElementById("mainCategorySelect4").value = d4;
	}
}