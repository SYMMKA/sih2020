function autoFillBook(i) {
    i = parseInt(i);
    document.getElementById("displayBookCopies").innerHTML = "";
    var formData = new FormData();
    formData.append("bookID", bookID[i]);
    $.ajax({
        type: "POST",
        url: "searchBook/copies.php",
        data: formData,
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function (data) {
            var html = "";
            html +=
                `<div class="modal-content" style="color:black;"> 
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">` +
                title[i] +
                `</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4" style="height:65vh; overflow-y: scroll;">
                    <input type="hidden" id="elementID">
                    <input type="hidden" id="reservedBy">
                    <input type="hidden" id="copyBookID" value="` +
                bookID[i] +
                `">
                    <input type="hidden" id="copyID">`;

            if (data) {
                var data = JSON.parse(data);
                data.forEach(function (item, index) {
                    html += `
                <div class="col mb-4">
                        <div class="card h-100">`;
                    html +=
                        ` <div class="card-body" style="padding: 1rem;">
                            <h5 class="card-title text-center"><strong>Copy No: </strong>` +
                        item.copyno +
                        `</h4>
                            <p class="card-text">                   
                        <div class="row no-gutters">
                                <div Class="col-4">
                                <strong>Old ID:</strong>
                                </div>
                                <div Class="col-8">
                            ` +
                        item.oldID +
                        `
                                </div>
                            </div>`;
                    var reservedBy = "";
                    // console.log(item.returnTime);
                    // console.log(item.currentTime);
                    // console.log(item.returnTime > item.currentTime);
                    if (
                        item.status == "reserved" &&
                        item.returnTime > item.currentTime
                    ) {
                        html +=
                            `<div class="row no-gutters">
                                <div Class="col-4">
                                <strong>Reserved by:</strong>
                                </div>
                                <div Class="col-8">
                            ` +
                            item.stud_ID +
                            `
                                </div></br>
                            </div>
                            <div class="row no-gutters">
                                <div Class="col-4">
                                <strong>Reserved at:</strong>
                                </div>
                                <div Class="col-8">
                            ` +
                            item.time +
                            `
                                </div></br>
                            </div>`;
                        reservedBy = item.stud_ID;
                    } else if (item.status == "issued") {
                        html +=
                            `<div class="row no-gutters">
                                <div Class="col-4">
                                    <strong>Issued by:</strong>
                                </div>
                                <div Class="col-8">
                            ` +
                            item.stud_ID +
                            `
                                </div></br>
                            </div>
                            <div class="row no-gutters">
                                <div Class="col-4">
                                    <strong>Issued at:</strong>
                                </div>
                                <div Class="col-8">
                            ` +
                            item.time +
                            `
                                </div></br>
                            </div>`;
                    } else {
                        html += `</br>
                            <div class="text-center">
                                <strong>Available</strong></br>
                            </div>`;
                    }
                    html += `   </p>
                            </div>
                            <div class="card-footer bg-white">
                            <div class="row text-center">
                            <div class="col-12">`;
                    if (item.status == "issued") {
                        html +=
                            `<button type="button" class="btn btn-orange btn-block btn-sm" name="issueReturnCopy" onclick="autoFillReturnBook('` +
                            item.copyID +
                            `','` +
                            item.oldID +
                            `','` +
                            i +
                            `')">Return Copy`;
                    } else {
                        html +=
                            `<button type="button" class="btn btn-orange btn-block btn-sm" name="issueBookCopy" id="issueBookCopy" onclick="autoFillIssueBook('` +
                            item.copyID +
                            `','` +
                            item.oldID +
                            `','` +
                            reservedBy +
                            `','` +
                            i +
                            `')">Issue Copy`;
                    }
                    html +=
                        `</button>
                    <button type="submit" form="deleteCopyForm" class="btn btn-blue btn-block btn-sm" name="deleteCopyCopy" onclick="autoFillDeleteCopy('` +
                        item.copyID +
                        `','` +
                        i +
                        `')">
                        Delete Copy
                    </button>
                          </div>
                       </div>
                    </div>
                </div>
            </div>`;
                });
            }
            html += `
       </div>
        </div>
                </div>
            </div>
            <div id='bookFormDiv'></div>
			</div>`;
            document.getElementById("displayBookCopies").innerHTML = html;
        },
        //Other options
    });
}
