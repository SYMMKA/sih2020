function autoFillUpdateBook(i) {
    document.getElementById('displayCopy').hidden = true; //hides displayCopy page
    document.getElementById('updateBook').hidden = false; //shows update book page
    document.getElementById('booktitleUpdate').textContent = title[i];
    document.getElementById('bookauthorUpdate').textContent = author[i];
    document.getElementById('bookisbnUpdate').textContent = isbn[i];
    if (imgLink[i]) {
        document.getElementById('bookimgLinkUpdate').src = imgLink[i];
        document.getElementById('bookimgLinkUpdate').hidden = false;
    }
}