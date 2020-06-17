function autoFill(i) {
    // donot remove the comments in this method if the id isnt predefined in html form

    document.getElementById('title').value = title[i];
    document.getElementById('author').value = author[i];
    document.getElementById('publisher').value = publisher[i];
    document.getElementById('publishedDate').value = publishedDate[i];
    document.getElementById('isbn').value = isbn[i];
    document.getElementById('pageCount').value = pageCount[i];
    document.getElementById('money').value = money[i];
    if (imgLink[i]) {
        document.getElementById('imgLink').src = imgLink[i];
        document.getElementById('imgValue').value = imgLink[i];
        document.getElementById('imgLink').hidden = false;
    }
}