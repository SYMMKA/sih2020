function autoFillIssueBook(i) {
    document.getElementById('updateBook').hidden = true; //hides update book page
    document.getElementById('returnBook').hidden = true; //hides return book page
    document.getElementById('deleteCopy').hidden = true; //hides delete book page
    document.getElementById('issueBook').hidden = false; //shows issue book page
    document.getElementById('booktitleIssue').textContent = title[i];
    document.getElementById('bookauthorIssue').textContent = author[i];
    document.getElementById('bookisbnIssue').textContent = isbn[i];
    if (imgLink[i]) {
        document.getElementById('bookimgLinkIssue').src = imgLink[i];
        document.getElementById('bookimgLinkIssue').hidden = false;
    }
    var formData = new FormData();
    formData.append('isbn', isbn[i]);
    $.ajax({
        type: "POST",
        url: "issueBook/copies.php",
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
                        <h6 class="card-subtitle mb-2 text-muted">` + item.oldID + `</h6>
                        <input type="hidden" id="reservedBy"/>`;
                    var reservedBy = '';
                    if (item.status == 'reserved' && item.returnTime > item.currentTime) {
                        html += `<p class="card-text">Reserved by: ` + item.stud_ID + `</p>
                            <p class="card-text">Reserved at: ` + item.time + `</p>`;
                        reservedBy = item.stud_ID;

                    } else if (item.status == 'issued') {
                        html += `<p class="card-text">Issued by: ` + item.stud_ID + `</p>
                            <p class="card-text">Issued at: ` + item.time + `</p>`;
                    } else {
                        html += `<p class="card-text">Available`;
                    }
                    html += `</div>
                    <div class="card-footer" style="border:none; background-color: #393e46 ">
                        <div class="col-auto">
                            <button type="submit" class="button scrolly" name="issueBookCopy" onclick="autoFillIssueCopy('` + item.copyID + `','` + item.oldID + `','` + reservedBy + `')"`;
                    if (item.status == 'issued') {
                        html += `disabled`;
                    }
                    html += `>
                                Issue Copy
                            </button>
                        </div>
                    </div>
                </div>
            </div>`;
                    document.getElementById("issueBookCopies").innerHTML = html;
                })
            }
            //Other options
    });
}

function autoFillIssueCopy(copyID, oldID, reservedBy) {
    document.getElementById('issueCopyID').textContent = copyID;
    document.getElementById('issueOldID').textContent = oldID;
    document.getElementById('reservedBy').value = reservedBy;
    document.getElementById('studentDetailsIssue').hidden = false;
}