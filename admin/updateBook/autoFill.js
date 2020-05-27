function autoFillUpdateBook(i) {
    // donot remove the comments in this method if the id isnt predefined in html form

    document.getElementById('issueBook').hidden = true; //hides issue book page
    document.getElementById('returnBook').hidden = true; //hides return book page
    document.getElementById('deleteCopy').hidden = true; //hides delete book page
    document.getElementById('updateBook').hidden = false; //shows update book page
    document.getElementById('booktitleUpdate').textContent = title[i];
    document.getElementById('bookauthorUpdate').textContent = author[i];
    document.getElementById('bookisbnUpdate').textContent = isbn[i];
    if (imgLink[i]) {
        document.getElementById('bookimgLinkUpdate').src = imgLink[i];
        document.getElementById('bookimgLinkUpdate').hidden = false;
    }
}