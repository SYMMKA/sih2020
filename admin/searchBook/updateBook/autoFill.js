function autoFillUpdateBook(i) {
	document.getElementById('booktitleUpdate').textContent = title[i];
	document.getElementById('bookauthorUpdate').textContent = author[i];
	document.getElementById('bookisbnUpdate').textContent = isbn[i];
	document.getElementById('bookIDUpdate').textContent = bookID[i];
	if (imgLink[i]) {
		document.getElementById('bookimgLinkUpdate').src = imgLink[i];
		document.getElementById('bookimgLinkUpdate').hidden = false;
	}

	if(book[i] == 1)
		document.getElementById("pageCountGroup").hidden = false;
	else
		document.getElementById("pageCountGroup").hidden = true;

	if(digital[i] == 1){
		document.getElementById("quantityGroup").hidden = true;
		document.getElementById("mediaGroup").hidden = false;
	}
	else {
		document.getElementById("quantityGroup").hidden = false;
		document.getElementById("mediaGroup").hidden = true;
	}
}