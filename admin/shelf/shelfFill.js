$(document).ready(function () {
    $("#voiceSearchSubmit").on("click", searchMain);
    $("#qrSearchSubmit").on("click", searchQR);
    $("#addShelfButton").on("click", addShelf);
});

function autoFillShelf(i) {
    document.getElementById("displayShelfCopies").innerHTML = "";
    var formData = new FormData();
    formData.append("shelfID", shelfID[i]);
    $.ajax({
        type: "POST",
        url: "shelf/showShelfCopies.php",
        data: formData,
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function (data) {
            var issued = (reserved = available = 0);
            var html = "";
            html +=
                `
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Shelf - ` +
                shelfID[i] +
                `</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="searchMain()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10 mb-2">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3" style="height: 500px; overflow-y: scroll;">`;
            if (data) {
                var data = JSON.parse(data);
                data.forEach(function (item, index) {
                    html +=
                        `
                        <div class="col mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="` +
                        item.imgLink +
                        `"
                            alt="Card image cap" style="height:20vw;" />
                            <div class="card-body" style="padding: 1rem;">
							<h4 class="card-title text-center">` +
                        item.title +
                        `</h4>
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
                    if (
                        item.status == "reserved" &&
                        item.returnTime > item.currentTime
                    ) {
                        html +=
                            `
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
                        reserved++;
                    } else if (item.status == "issued") {
                        html +=
                            `
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
                    html +=
                        `
                                <button type="submit" class="btn btn-orange" name="removeCopy" onclick="removeCopy('` +
                        item.copyID +
                        `','` +
                        i +
                        `')">
                                Remove Copy
                                </button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>`;
                });
            }
            html +=
                `
                    </div>
                </div>
                <div class="col-md-2 mb-2">
                <div class="row no-gutters justify-content-center text-center h-100 align-items-stretch">
                                    <div class="col-12">
                                        <h4>Issued: ` +
                issued +
                `</h4>
                                    </div>
                                    <div class="col-12">
                                        <h4>Reserved: ` +
                reserved +
                `</h4>
                                    </div>
                                    <div class="col-12">
                                        <h4>Available: ` +
                available +
                `</h4>
                                    </div>
                                     <form id="addCopy" method="get" action="shelf/addCopy.php">
                        <input type="hidden" name="shelfID" value="` +
                shelfID[i] +
                `" />
                        <div class="col-12">
                            <button class="btn btn-blue">
                            Add Copy
                            </button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button
                type="button"
                class="btn btn-blue"
                data-dismiss="modal"
                onclick="searchMain()"
                >
                Close
                </button>
            <button type="button" class="btn btn-orange" data-dismiss="modal" onclick="searchMain()">Save changes</button>
            </div>
        </div>`;
            document.getElementById("displayShelfCopies").innerHTML = html;
        },
        //Other options
    });
}

function removeCopy(copyID, i) {
    var formData = new FormData();
    formData.append("copyID", copyID);
    $.ajax({
        type: "POST",
        url: "shelf/removeCopy.php",
        data: formData,
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function (data) {
            console.log(data);
            autoFillShelf(i);
            searchMain();
        },
        //Other options
    });
}

function addShelf() {
    var shelfID = document.getElementById("shelfName").value;
    var formData = new FormData();
    formData.append("shelfID", shelfID);
    $.ajax({
        type: "POST",
        url: "shelf/addShelf.php",
        data: formData,
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function (data) {
            console.log(data);
            searchMain();
        },
    });
}

function deleteShelf(i) {
    var formData = new FormData();
    formData.append("shelfID", shelfID[i]);
    $.ajax({
        type: "POST",
        url: "shelf/deleteShelf.php",
        data: formData,
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function (data) {
            console.log(data);
            searchMain();
        },
    });
}

function searchQR(qrsearch) {
    loadBox();
    $.ajax({
        type: "POST",
        url: "shelf/showShelf.php",
        data: {
            search: qrsearch,
            qr: 1,
        },
        success: function (data) {
			if(data) {
				data = JSON.parse(data);
				loadShelfs(data);
				autoFillShelf(0);
				$("#shelf").modal();
			} else
				alert("Shelf does not exist!");
        },
    });
}

function searchMain() {
    loadBox();
    var search = $("#searchByVoice").val();
    $.ajax({
        type: "POST",
        url: "shelf/showShelf.php",
        data: {
            search: search,
            main: 1,
        },
        success: function (data) {
            console.log(data);
            data = JSON.parse(data);
            loadShelfs(data);
        },
    });
}

function loadShelfs(data) {
    html = "";
    data.forEach(function (shelf, index) {
        shelfID[index] = shelf.shelfID;
        count[index] = shelf.count;
        html +=
            `<div class="col mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h4 class="card-title">` +
            shelf.shelfID +
            `</h4>
                            <p class="card-text">`;
        if (shelf.count != "") {
            if (shelf.count == 1) html += shelf.count + `book`;
            else html += shelf.count + `books`;
        } else html += `empty`;

        html +=
            `			</p>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="row justify-content-center">
                                <div class="col-8">
                                    <div class="row">
                                        <button type="button" class="btn btn-orange btn-block btn-sm" onclick="autoFillShelf('` +
            index +
            `')" data-toggle="modal" data-target="#shelf">
                                            Open Shelf
											</button>
                                        <button type="button" class="btn btn-blue btn-block btn-sm" onclick="deleteShelf('` +
            index +
            `')">
                                            Delete Shelf
											</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
        </section>`;
        $("#result").html(html);
    });
}

function loadBox() {
    html = `<h1 class="text-center pt-4 mb-5">Your Shelves</h1>
                <div
                    class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4"
                    id="result"
                ></div>`;
    $("#resultBox").html(html);
}
