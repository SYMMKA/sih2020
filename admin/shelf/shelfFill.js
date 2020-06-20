function autoFillShelf(shelfID) {
    document.getElementById('displayShelfCopies').innerHTML = '';
    var formData = new FormData();
    formData.append('shelfID', shelfID);
    $.ajax({
        type: "POST",
        url: "shelf/showShelfCopies.php",
        data: formData,
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function (data) {
            var issued = reserved = available = 0;
            var html = '';
            if (data) {
                var data = JSON.parse(data);
                data.forEach(function (item, index) {
                    html += `<div class="col-sm-3">
                <div class="card text-center" style="border:none;">
                    <div class="card-body text-white" style="background-color: #393e46">
                        <h5 class="card-title">` + item.copyno + `</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Copy ID: ` + item.copyID + `</h6>
                        <h6 class="card-subtitle mb-2 text-muted">ISBN: ` + item.isbn + `</h6>
                        <h6 class="card-subtitle mb-2 text-muted">` + item.oldID + `</h6>`;
                    var reservedBy = '';
                    if (item.status == 'reserved' && item.returnTime > item.currentTime) {
                        html += `<p class="card-text">Reserved by: ` + item.stud_ID + `</p>
                            <p class="card-text">Reserved at: ` + item.time + `</p>`;
                        reservedBy = item.stud_ID;
                        reserved++;
                    } else if (item.status == 'issued') {
                        html += `<p class="card-text">Issued by: ` + item.stud_ID + `</p>
                            <p class="card-text">Issued at: ` + item.time + `</p>`;
                        issued++;
                    } else {
                        html += `<p class="card-text">Available`;
                        available++;
                    }
                    html += `</div>
                    <div class="card-footer" style="border:none; background-color: #393e46 ">
                        <div class="col-auto">`;
                    html += `</button>
                    <button type="submit" name="removeCopy" onclick="removeCopy('` + item.copyID + `','` + shelfID + `')">
                        Remove Copy
                    </button>
                        </div>
                    </div>
                </div>
            </div>`;
                });
            }
            html += `<h5>Issued: ` + issued + `</h5>
            <h5>Reserved: ` + reserved + `</h5>
            <h5>Available: ` + available + `</h5>
            <form id="addCopy" method="get" action="shelf/addCopy.php">
                <input type="hidden" name="shelfID" value="` + shelfID + `" />
                <button class="btn btn-primary">
                    Add Copy
                </button>
            </form>
            `;
            document.getElementById("displayShelfCopies").innerHTML = html;
        }
        //Other options
    });
}

function removeCopy(copyID, shelfID) {
    var formData = new FormData();
    formData.append('copyID', copyID);
    $.ajax({
        type: "POST",
        url: "shelf/removeCopy.php",
        data: formData,
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function (data) {
            autoFillShelf(shelfID);
        }
        //Other options
    });
}