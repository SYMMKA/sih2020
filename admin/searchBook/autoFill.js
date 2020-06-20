function autoFillBook(i) {
    document.getElementById('displayBookCopies').innerHTML = '';
    var formData = new FormData();
    formData.append('isbn', isbn[i]);
    $.ajax({
        type: "POST",
        url: "searchBook/copies.php",
        data: formData,
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function (data) {
            var html = '';
            html += `<div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="fields">
                    <div class="field half" style="text-align: center;">
                        <label>Title: </label>
                        <label id="displayCopyTitle">`+title[i]+`</label>
                    </div>
                    <div class="field half" style="text-align: center;">
                        <label>Author: </label>
                        <label id="displayCopyAuthor">`+author[i]+`</label>
                    </div>
                    <div class="field half" style="text-align: center;">
                        <label>ISBN: </label>
                        <label id="displayCopyIsbn">`+isbn[i]+`</label>
                    </div>
                    <div class="field half" style="text-align: center;">
                        <label>Old ID: </label>
                        <label id="displayCopyTitleOldID"></label>
                        <label>CopyID: </label>
                        <label id="displayCopyTitleCopyID"></label>
                    </div>`;
                    if (imgLink[i]) {
                        html += `<div class="field half" style="text-align: center;">
                        <img src="" id="bookimgLinkdisplay">
                    </div>`;
                    }
                    html += `<input type="hidden" id="reservedBy">
                    </br>
                </div>
                <div class="row">`;
            if (data) {
                var data = JSON.parse(data);
                data.forEach(function (item, index) {
                    html += `
                <div class="col-sm-3">
                <div class="card text-center" style="border:none;">
                    <div class="card-body text-white" style="background-color: #393e46">
                        <h5 class="card-title">` + item.copyno + `</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Copy ID: ` + item.copyID + `</h6>
                        <h6 class="card-subtitle mb-2 text-muted">` + item.oldID + `</h6>`;
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
                        <div class="col-auto">`;
                    if (item.status == 'issued') {
                        html += `<button type="submit" form="returnBookForm" class="button scrolly" name="issueReturnCopy" onclick="autoFillReturnBook('` + item.copyID + `','` + item.oldID + `')">Return Copy`;
                    } else {
                        html += `<button type="button" class="button scrolly" name="issueBookCopy" id="issueBookCopy" onclick="autoFillIssueBook('` + item.copyID + `','` + item.oldID + `','` + reservedBy + `')">Issue Copy`;
                    }
                    html += `</button>
                    <button type="submit" form="deleteCopyForm" class="button scrolly" name="deleteCopyCopy" onclick="autoFillDeleteCopy('` + item.copyID + `')">
                        Delete Copy
                    </button>
                        </div>
                    </div>
                </div>
            </div>`;
                });
            }
            html += `
				<div id='issueBookFormDiv'></div>
            </div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Understood</button>
				</div>
			</div>`;
            document.getElementById("displayBookCopies").innerHTML = html;
        }
        //Other options
    });
}