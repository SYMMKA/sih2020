function autoFillUpdateBook(i) {
    i = parseInt(i);

    $("#updateCategory").on("click", fillUpdateCat);

    function fillUpdateCat() {
        showCategory();
        document.getElementById("updateCategorySelect1").options[
            updateCategorySelect1.selectedIndex
        ].text = Category1[i];
        document.getElementById("updateCategorySelect2").options[
            updateCategorySelect1.selectedIndex
        ].text = Category2[i];
        document.getElementById("updateCategorySelect3").options[
            updateCategorySelect1.selectedIndex
        ].text = Category3[i];
        document.getElementById("updateCategorySelect4").options[
            updateCategorySelect1.selectedIndex
        ].text = Category4[i];
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
    document.getElementById("updatemoney").value = price[i];
    document.getElementById("updatepageCount").value = pages[i];

    if (imgLink[i]) {
        document.getElementById("bookimgLinkUpdate").src = imgLink[i];
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
    console.log(quantity);
    // Container <div> where dynamic content will be placed
    var container = document.getElementById("copyInfo");
    // Clear previous contents of the container
    while (container.hasChildNodes()) {
        container.removeChild(container.lastChild);
    }
    html1 = `<div class="form-group row">
								<label for="" class="col-sm-2 col-form-label">Source</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="sourceUpdate">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-2 col-form-label">Date of purchase</label>
								<div class="col-sm-10">
									<input class="form-control" type="datetime-local" id="dopUpdate" name="dop">
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
});
