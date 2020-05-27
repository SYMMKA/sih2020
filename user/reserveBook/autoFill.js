function autoFill(i) {
    // donot remove the comments in this method if the id isnt predefined in html form

    document.getElementById('reserveBook').hidden = false; //shows reserve book page
    document.getElementById('booktitle').textContent = title[i];
    document.getElementById('bookauthor').textContent = author[i];
    document.getElementById('bookisbn').textContent = isbn[i];
    if (imgLink[i]) {
        document.getElementById('bookimgLink').src = imgLink[i];
        document.getElementById('bookimgLink').hidden = false;
    }
    var formData = new FormData();
    formData.append('isbn', isbn[i]);
    $.ajax({
        type: "POST",
        url: "reserveBook/copies.php",
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
                            <button type="submit" class="button scrolly" name="issue-bookCopy" id="` + index + `" onclick="autoFillReserveCopy('` + item.copyID + `','` + item.oldID + `')"`;
                    if (item.status == 'issued' || (item.status == 'reserved' && item.returnTime > item.currentTime)) {
                        html += `disabled`;
                    }
                    html += `>
                                Reserve Copy
                            </button>
                        </div>
                    </div>
                </div>
            </div>`;
                    document.getElementById("copies").innerHTML = html;
                })
            }
            //Other options
    });
}

function autoFillReserveCopy(copyID, oldID) {
    document.getElementById('copyID').textContent = copyID;
    document.getElementById('oldID').textContent = oldID;
}