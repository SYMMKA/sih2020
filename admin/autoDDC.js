// To select category

window.onload = function () {
	/* fetch("category.json")
		.then(response => response.json())
		.then(json => DDCjson = json); */
	loadCategory();
	//ddc
	var ddcNO = document.getElementById('ddcNO');

	$(".DDC").change(function () {
		searchDDC();
	});

	ddcNO.onchange = function () {
		var ddc = ddcNO.value;
		fillDDC(ddc);
	}
}

function searchDDC() {
	var title = document.getElementById('title');
	var isbn = document.getElementById('isbn');
	console.log(title.value);

	var formData = new FormData();
	formData.append('title', title.value);
	formData.append('isbn', isbn.value);

	$.ajax({
		type: "POST",
		url: "autoDDC.php",
		data: formData,
		type: 'POST',
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function (data) {
			console.log(data);
			var ddc = data;
			fillDDC(ddc);
		}
		//Other options
	});
}

function fillDDC(ddc) {
	if (ddc == "No DDC")
		return
	var d1 = Math.floor(ddc / 100);
	document.getElementById("mainCategorySelect1").value = d1;
	mainCategorySelect2.length = 1; // remove all options bar first
	mainCategorySelect3.length = 1; // remove all options bar first
	mainCategorySelect4.length = 1; // remove all options bar first

	if (!DDCjson[d1].subordinates) {
		// hides sub category if not available
		document.getElementById("mainCategorySelect2").disabled = true;
		document.getElementById("mainCategorySelect3").disabled = true;
		document.getElementById("mainCategorySelect4").disabled = true;
		return
	} else {
		document.getElementById("mainCategorySelect2").disabled = false;
		document.getElementById("mainCategorySelect3").disabled = false;
		document.getElementById("mainCategorySelect4").disabled = false;
		c1();
	}

	var d2 = Math.floor((ddc % 100) / 10);
	document.getElementById("mainCategorySelect2").value = d2;
	mainCategorySelect3.length = 1; // remove all options bar first
	mainCategorySelect4.length = 1; // remove all options bar first
	if (!DDCjson[d1].subordinates[d2].subordinates) {
		// hides sub category if not available
		document.getElementById("mainCategorySelect3").disabled = true;
		document.getElementById("mainCategorySelect4").disabled = true;
		return
	} else {
		document.getElementById("mainCategorySelect3").disabled = false;
		document.getElementById("mainCategorySelect4").disabled = false;
		c2();
	}

	var d3 = Math.floor(ddc % 10);
	document.getElementById("mainCategorySelect3").value = d3;
	mainCategorySelect4.length = 1; // remove all options bar first
	if (!DDCjson[d1].subordinates[d2].subordinates[d3].subordinates) {
		// hides sub category if not available
		document.getElementById("mainCategorySelect4").disabled = true;
		return
	} else {
		document.getElementById("mainCategorySelect4").disabled = false;
		c3();
	}

	var d4 = Math.floor(((ddc % 1) / .1) + 0.5);
	document.getElementById("mainCategorySelect4").value = d4;
}