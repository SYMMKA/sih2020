function autoFill(i) {
    // donot remove the comments in this method if the id isnt predefined in html form

    document.getElementById("title").value = title[i];
    document.getElementById("author").value = author[i];
    document.getElementById("publisher").value = publisher[i];
    document.getElementById("publishedDate").value = publishedDate[i];
    document.getElementById("isbn").value = isbn[i];
    document.getElementById("pageCount").value = pageCount[i];
    document.getElementById("money").value = money[i];
    if (imgLink[i]) {
        document.getElementById("imgLink").src = imgLink[i];
        document.getElementById("imgValue").value = imgLink[i];
        document.getElementById("imgLink").hidden = false;
    }
    searchDDC(); // autoload ddc columns
    hideResult();
}

function hideResult() {
    $("#searchResults").toggle();
    window.scrollTo(0, $("#addForm").offset().top);
}

$("#quantity").change(() => {
    var quantity = parseInt($("#quantity").val());
    // Container <div> where dynamic content will be placed
    var container = document.getElementById("copyInfo");
    // Clear previous contents of the container
    while (container.hasChildNodes()) {
        container.removeChild(container.lastChild);
    }

    for (i = 1; i <= quantity; i++) {
        var html =
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
        $("#copyInfo").append(html);
    }
});
