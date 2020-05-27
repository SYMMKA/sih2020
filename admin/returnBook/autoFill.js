function autoFillReturnBook(i) {
    // donot remove the comments in this method if the id isnt predefined in html form

    document.getElementById('issueBook').hidden = true; //hides issue book page
    document.getElementById('updateBook').hidden = true; //hides update book page
    document.getElementById('deleteCopy').hidden = true; //hides delete book page
    document.getElementById('returnBook').hidden = false; //shows return book page
    document.getElementById('booktitleReturn').textContent = title[i];
    document.getElementById('bookauthorReturn').textContent = author[i];
    document.getElementById('bookisbnReturn').textContent = isbn[i];
    if (imgLink[i]) {
        document.getElementById('bookimgLinkReturn').src = imgLink[i];
        document.getElementById('bookimgLinkReturn').hidden = false;
    }
    var formData = new FormData();
    formData.append('isbn', isbn[i]);
    $.ajax({
        type: "POST",
        url: "returnBook/copies.php",
        data: formData,
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function(data) {
                var data = JSON.parse(data);
                var html = '';
                data.forEach(function(item, index) {
                    html += `<div class="col-sm-3">
        <div class="card text-center" style="border:none;">
            <div class="card-body text-white" style="background-color: #393e46">
                <h5 class="card-title">` + item.copyno + `</h5>
                <h6 class="card-subtitle mb-2 text-muted">ISBN: ` + item.copyID + `</h6>
                <h6 class="card-subtitle mb-2 text-muted">` + item.oldID + `</h6>`;
                    if (item.status == 'reserved' && item.returnTime > item.currentTime) {
                        html += `<p class="card-text">Reserved by: ` + item.stud_ID + `</p>
                    <p class="card-text">Reserved at: ` + item.time + `</p>`;

                    } else if (item.status == 'issued') {
                        html += `<p class="card-text">Issued by: ` + item.stud_ID + `</p>
                    <p class="card-text">Issued at: ` + item.time + `</p>`;
                    } else {
                        html += `<p class="card-text">Available`;
                    }
                    html += `</div>
            <div class="card-footer" style="border:none; background-color: #393e46 ">
                <div class="col-auto">
                <button type="submit" class="button scrolly" name="returnBookCopy" onclick="autoFillReturnCopy('` + item.copyID + `','` + item.oldID + `')"`;
                    if (item.status != 'issued') {
                        html += `disabled`;
                    }
                    html += `>
                        Return Copy
                    </button>
                </div>
            </div>
        </div>
    </div>`;
                    document.getElementById("returnBookCopies").innerHTML = html;
                })
            }
            //Other options
    });
}

function autoFillReturnCopy(copyID, oldID) {
    document.getElementById('returnCopyID').textContent = copyID;
    document.getElementById('returnOldID').textContent = oldID;
}