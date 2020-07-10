function showCategory() {
	var html = `
		<div class="row">
			<div class="col-12">
				<div id="mainCat1">
					<select
						class="custom-select mb-2"
						name="updateCategorySelect1" id="updateCategorySelect1" 
						aria-label="Example select with button addon"
						required
					>
						<option value="">-- Select Category--</option>
					</select>
				</div>
				
				<div id="mainCat2">
					<select
						class="custom-select mb-2"
						name="updateCategorySelect2" id="updateCategorySelect2" 
						aria-label="Example select with button addon"
						required
					>
						<option value="">-- Select Category--</option>
					</select>
				</div>

					<div id="mainCat3">
					<select
						class="custom-select mb-2"
						name="updateCategorySelect3" id="updateCategorySelect3" 
						aria-label="Example select with button addon"
						required
					>
						<option value="">-- Select Category--</option>
					</select>
				</div>

				<div id="mainCat4">
					<select
						class="custom-select mb-2"
						name="updateCategorySelect4" id="updateCategorySelect4" 
						aria-label="Example select with button addon"
						required
					>
						<option value="">-- Select Category--</option>
					</select>
				</div>

				
					<button class="btn btn-info" name="cancelCategory" id="cancelCategory" onclick="hideCategory()">
						Cancel
					</button>

			</div>
		</div>
               `;
	document.getElementById("category").innerHTML = html;
	document.getElementById("catDisplay").value = "true";
	document.getElementById("category").hidden = false;
		
	var updateCategorySelect1 = document.getElementById("updateCategorySelect1");
	var updateCategorySelect2 = document.getElementById("updateCategorySelect2");
	var updateCategorySelect3 = document.getElementById("updateCategorySelect3");
	var updateCategorySelect4 = document.getElementById("updateCategorySelect4");
	loadCategory(updateCategorySelect1, updateCategorySelect2, updateCategorySelect3, updateCategorySelect4);
}

var DDCjson = "";
function loadCategory(mainCategorySelect1, mainCategorySelect2, mainCategorySelect3, mainCategorySelect4) {
	$.getJSON("category.json", function(json){
		DDCjson = json;
		loadCategory1(mainCategorySelect1, mainCategorySelect2, mainCategorySelect3, mainCategorySelect4);
	});
}

function loadCategory1(mainCategorySelect1, mainCategorySelect2, mainCategorySelect3, mainCategorySelect4) {
	//Load main categories
	mainCategorySelect1.length = 1
	for (var mainCategory = 0; mainCategory < DDCjson.length; mainCategory++) {
		mainCategorySelect1.options[
			mainCategorySelect1.options.length
		] = new Option(DDCjson[mainCategory].description, mainCategory);
	}

	//Main Category1 Changed
	mainCategorySelect1.onchange = function () {
		mainCategorySelect2.length = 1; // remove all options bar first
		mainCategorySelect3.length = 1; // remove all options bar first
		mainCategorySelect4.length = 1; // remove all options bar first
		if (this.selectedIndex < 1) {
			return; // done
		}

		if (!DDCjson[this.value].subordinates) {
			// hides sub category if not available
			mainCategorySelect2.disabled = true;
			mainCategorySelect3.disabled = true;
			mainCategorySelect4.disabled = true;
		} else {
			mainCategorySelect2.disabled = false;
			mainCategorySelect3.disabled = false;
			mainCategorySelect4.disabled = false;

			c1(mainCategorySelect1, mainCategorySelect2);
		}
	};
	//Main Category2 Changed
	mainCategorySelect2.onchange = function () {
		mainCategorySelect3.length = 1; // remove all options bar first
		mainCategorySelect4.length = 1; // remove all options bar first
		if (this.selectedIndex < 1) {
			return; // done
		}

		if (
			!DDCjson[mainCategorySelect1.value].subordinates[this.value].subordinates
		) {
			// hides sub category if not available
			mainCategorySelect3.disabled = true;
			mainCategorySelect4.disabled = true;
		} else {
			mainCategorySelect3.disabled = false;
			mainCategorySelect4.disabled = false;
			c2(mainCategorySelect1, mainCategorySelect2, mainCategorySelect3);
		}
	};
	//Main Category3 Changed
	mainCategorySelect3.onchange = function () {
		mainCategorySelect4.length = 1; // remove all options bar first

		if (this.selectedIndex < 1) {
			return; // done
		}

		if (
			!DDCjson[mainCategorySelect1.value].subordinates[mainCategorySelect2.value]
				.subordinates[this.value].subordinates
		) {
			// hides sub category if not available
			mainCategorySelect4.disabled = true;
		} else {
			mainCategorySelect4.disabled = false;
			c3(mainCategorySelect1, mainCategorySelect2, mainCategorySelect3, mainCategorySelect4);
		}
	};

	mainCategorySelect4.onchange = function () { };
}

function hideCategory() {
	document.getElementById("category").innerHTML = "";
	document.getElementById("catDisplay").value = "false";
}

function c1(mainCategorySelect1, mainCategorySelect2) {
	for (
		var mainCategory = 0;
		mainCategory < DDCjson[mainCategorySelect1.value].subordinates.length;
		mainCategory++
	) {
		var description =
			DDCjson[mainCategorySelect1.value].subordinates[mainCategory].description;

		var number =
			DDCjson[mainCategorySelect1.value].subordinates[mainCategory].number;
		number = number[number.length - 2];

		if (description != "") {
			mainCategorySelect2.options[
				mainCategorySelect2.options.length
			] = new Option(description, number);
		}
	}
}

function c2(mainCategorySelect1, mainCategorySelect2, mainCategorySelect3) {
	for (
		var mainCategory = 0;
		mainCategory <
		DDCjson[mainCategorySelect1.value].subordinates[mainCategorySelect2.value]
			.subordinates.length;
		mainCategory++
	) {
		//var index = parseFloat(DDCjson[mainCategorySelect1.value].subordinates[mainCategorySelect2.value].subordinates[mainCategory].number);
		//index = Math.floor(index % 10);
		var description =
			DDCjson[mainCategorySelect1.value].subordinates[mainCategorySelect2.value]
				.subordinates[mainCategory].description;

		var number =
			DDCjson[mainCategorySelect1.value].subordinates[mainCategorySelect2.value]
				.subordinates[mainCategory].number;
		number = number[number.length - 1];

		if (description != "") {
			mainCategorySelect3.options[
				mainCategorySelect3.options.length
			] = new Option(description, number);
		}
	}
}

function c3(mainCategorySelect1, mainCategorySelect2, mainCategorySelect3, mainCategorySelect4) {
	for (
		var mainCategory = 0;
		mainCategory <
		DDCjson[mainCategorySelect1.value].subordinates[mainCategorySelect2.value]
			.subordinates[mainCategorySelect3.value].subordinates.length;
		mainCategory++
	) {
		//var index = parseFloat(DDCjson[mainCategorySelect1.value].subordinates[mainCategorySelect2.value].subordinates[mainCategorySelect3.value].subordinates[mainCategory].number);
		//index = Math.floor((index % 1) / .1);

		var description =
			DDCjson[mainCategorySelect1.value].subordinates[mainCategorySelect2.value]
				.subordinates[mainCategorySelect3.value].subordinates[mainCategory]
				.description;

		var number =
			DDCjson[mainCategorySelect1.value].subordinates[mainCategorySelect2.value]
				.subordinates[mainCategorySelect3.value].subordinates[mainCategory]
				.number;
		number = number[number.length - 1];

		if (description != "") {
			mainCategorySelect4.options[
				mainCategorySelect4.options.length
			] = new Option(description, number);
		}
	}
}
