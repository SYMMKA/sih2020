function autoFillShelf(shelfID) {
    document.getElementById("displayShelfCopies").innerHTML = "";
    var formData = new FormData();
    formData.append("shelfID", shelfID);
    $.ajax({
        type: "POST",
        url: "shelf/showShelfCopies.php",
        data: formData,
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function (data) {
            var issued = (reserved = available = 0);
            var html = "";
            html += `
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="location.reload()"aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-10">
                    <div class="row row-cols-1 row-cols-md-3" style="height: 500px; overflow-y: scroll;">`;
            if (data) {
                var data = JSON.parse(data);
                data.forEach(function (item, index) {
                    html += `
                        <div class="col mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="` +
                        item.imgLink + `"
                            alt="Card image cap" style="height:20vw;" />
                            <div class="card-body" style="padding: 1rem;">
                            <h4 class="card-title text-center">Book Name</h4>
                            <p class="card-text">                   
                            <div class="row no-gutters">
                                <div Class="col-4">
                                <strong>Copy No:</strong>
                                </div>
                                <div Class="col-8">
                            ` +
                        item.copyno +
                        `
                                </div>
                            </div>

                            <div class="row no-gutters">
                                <div Class="col-4">
                                <strong>Copy ID: </strong>
                                </div>
                                <div Class="col-8">
                            ` +
                        item.copyID +
                        `
                                </div></br>
                            </div>

                            <div class="row no-gutters">
                                <div Class="col-4">
                                <strong>ISBN: </strong>
                                </div>
                                <div Class="col-8">
                            ` +
                        item.isbn +
                        `
                                </div></br>
                            </div>

                            <div class="row no-gutters">
                                <div Class="col-4">
                                <strong>Old ID: </strong>
                                </div>
                                <div Class="col-8">
                            ` +
                        item.oldID +
                        `
                                </div></br>
                            </div>`;
                    var reservedBy = "";
                    if (item.status == "reserved" && item.returnTime > item.currentTime) {
                        html += `
                            <div class="row no-gutters">
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
                        reserved++;
                    } else if (item.status == "issued") {
                        html += `
                            <div class="row no-gutters">
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
                        issued++;
                    } else {
                        html += `</br>
                            <div class="text-center">
                                <strong>Available</strong></br>
                            </div>`;
                        available++;
                    }
                    html += `
                            </p>
                            </div>
                            <div class="card-footer bg-white">
                            <div class="row text-center">
                            <div class="col-12">`;
                    html += `
                                <button type="submit" class="btn btn-info" name="removeCopy" onclick="removeCopy('` + item.copyID + `','` + shelfID + `')">
                                Remove Copy
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
                <div class="col-2">
                    <div class="row no-gutters justify-content-center text-center h-100 align-items-center">
                    <div class="col-12">
                        <h4>
                        Issued:</br></br>` +
                issued + `
                        </br></br>Reserved:</br></br>` +
                reserved + `
                        </br></br>Available:</br></br>` +
                available + `
                        </h4></br>
                    </div>
                
                    <form id="addCopy" method="get" action="shelf/addCopy.php">
                        <input type="hidden" name="shelfID" value="` +
                shelfID + `" />
                        <div class="col-12">
                            <button class="btn btn-primary">
                            Add Copy
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
                onclick="location.reload()"
                >
                Close
                </button>
            <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>`;
            document.getElementById("displayShelfCopies").innerHTML = html;
        },
        //Other options
    });
}

function removeCopy(copyID, shelfID) {
    var formData = new FormData();
    formData.append("copyID", copyID);
    $.ajax({
        type: "POST",
        url: "shelf/removeCopy.php",
        data: formData,
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function (data) {
            autoFillShelf(shelfID);
        },
        //Other options
    });
}
