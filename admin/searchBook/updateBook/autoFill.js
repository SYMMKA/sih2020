function autoFillUpdateBook(i) {
    document.getElementById('booktitleUpdate').textContent = title[i];
    document.getElementById('bookauthorUpdate').textContent = author[i];
    document.getElementById('bookisbnUpdate').textContent = isbn[i];
    if (imgLink[i]) {
        document.getElementById('bookimgLinkUpdate').src = imgLink[i];
        document.getElementById('bookimgLinkUpdate').hidden = false;
    }
}