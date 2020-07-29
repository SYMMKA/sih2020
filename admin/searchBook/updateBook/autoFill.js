function autoFillUpdateBook(i) {
    i = parseInt(i);
    fillUpdateCat();

    function fillUpdateCat() {
        showCategory();
        setTimeout(() => {
            updateCategorySelect1 = document.getElementById(
                "updateCategorySelect1"
            );
            updateCategorySelect2 = document.getElementById(
                "updateCategorySelect2"
            );
            updateCategorySelect3 = document.getElementById(
                "updateCategorySelect3"
            );
            updateCategorySelect4 = document.getElementById(
                "updateCategorySelect4"
            );
            $("#updateCategorySelect1")
                .find("option")
                .each(function () {
                    if ($(this).text() == Category1[i]) {
                        $("#updateCategorySelect1").val($(this).val());
                        mainCategorySelect1Change(
                            updateCategorySelect1,
                            updateCategorySelect2,
                            updateCategorySelect3,
                            updateCategorySelect4
                        );
                    }
                });
            $("#updateCategorySelect2")
                .find("option")
                .each(function () {
                    if ($(this).text() == Category2[i]) {
                        $("#updateCategorySelect2").val($(this).val());
                        mainCategorySelect2Change(
                            updateCategorySelect1,
                            updateCategorySelect2,
                            updateCategorySelect3,
                            updateCategorySelect4
                        );
                    }
                });
            $("#updateCategorySelect3")
                .find("option")
                .each(function () {
                    if ($(this).text() == Category3[i]) {
                        $("#updateCategorySelect3").val($(this).val());
                        mainCategorySelect3Change(
                            updateCategorySelect1,
                            updateCategorySelect2,
                            updateCategorySelect3,
                            updateCategorySelect4
                        );
                    }
                });
            $("#updateCategorySelect4")
                .find("option")
                .each(function () {
                    if ($(this).text() == Category4[i]) {
                        $("#updateCategorySelect4").val($(this).val());
                    }
                });
        }, 200);
    }

    document.getElementById("booktitleUpdate").textContent = title[i];
    document.getElementById("bookauthorUpdate").textContent = author[i];
    document.getElementById("bookisbnUpdate").textContent = isbn[i];
    document.getElementById("bookIDUpdate").textContent = bookID[i];

    document.getElementById("updateTitle").value = title[i];
    document.getElementById("updateAuthor").value = author[i];
    document.getElementById("updatepublisher").value = publisher[i];
    document.getElementById("updatepublishedDate").value =
        date_of_publication[i];
    document.getElementById("updateISBN").value = isbn[i];
    document.getElementById("updatepageCount").value = pages[i];

    if (imgLink[i]) {
        document.getElementById("bookimgLinkUpdate").src = imgLink[i];
        document.getElementById("bookimgLinkUpdate").hidden = false;
    } else {
        document.getElementById("bookimgLinkUpdate").src =
            "https://placehold.co/200x255";
        document.getElementById("bookimgLinkUpdate").hidden = false;
    }

    if (book[i] == 1) document.getElementById("pageCountGroup").hidden = false;
    else document.getElementById("pageCountGroup").hidden = true;

    if (digital[i] == 1) {
        document.getElementById("quantityGroup").hidden = true;
        document.getElementById("mediaGroup").hidden = false;
    } else {
        document.getElementById("quantityGroup").hidden = false;
        document.getElementById("mediaGroup").hidden = true;
    }
}

$("#closeUpdateForm").on("click", resetUpdateForm);

function resetUpdateForm() {
    document.querySelectorAll(".update-form").forEach((element) => {
        element.value = "";
    });
}

$("#updateaddcopies").change(() => {
    var quantity = parseInt($("#updateaddcopies").val());
    // Container <div> where dynamic content will be placed
    var container = document.getElementById("copyInfo");
    // Clear previous contents of the container
    while (container.hasChildNodes()) {
        container.removeChild(container.lastChild);
    }
    if (quantity > 0) {
        html1 = `<div class="form-group row">
					<label for="sourceUpdate" class="col-sm-2 col-form-label">Source</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="sourceUpdate">
					</div>
				</div>
				<div class="form-group row">
					<label for="dopUpdate" class="col-sm-2 col-form-label">Date of purchase</label>
					<div class="col-sm-10">
						<input class="form-control" type="datetime-local" id="dopUpdate" name="dop">
					</div>
				</div>
				<div class="form-group row">
					<label for="updatemoney" class="col-sm-2 col-form-label">Price</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="updatemoney" id="updatemoney" />
					</div>
				</div>
				`;
        $("#copyInfo").append(html1);
        for (i = 1; i <= quantity; i++) {
            var html2 =
                `
			<div class="form-group row">
				<label for="" class="col-sm-2 col-form-label">Old ID of Copy No: ` +
                i +
                `</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="oldID` +
                i +
                `">
				</div>
			</div>`;
            $("#copyInfo").append(html2);
        }
    }
});
