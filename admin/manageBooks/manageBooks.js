$(document).ready(function () {
    $("#voiceSearchSubmit").on("click", searchMain);
});

$(document).ready(function () {
    $("#qrSearchSubmit").on("click", searchQR);
});

function searchQR() {
    var qrsearch = $("#searchByVoice").val();
    $.ajax({
        type: "POST",
        url: "manageBooks/manageBooks.php",
        data: {
            search: qrsearch,
            qr: 1,
        },
        success: function (data) {
            data = JSON.parse(data);
            loadBooks(data);
            autoFillBook(0);
            $("#displayCopy").modal();
        },
    });
}

function searchMain() {
    var search = $("#searchByVoice").val();
    $.ajax({
        type: "POST",
        url: "manageBooks/manageBooks.php",
        data: {
            search: search,
            main: 1,
        },
        success: function (data) {
            data = JSON.parse(data);
            loadBooks(data);
        },
    });
}

$("#mediaFile").on("change", uploadFile);
$("#updateimgFile").on("change", uploadImage);

function uploadFile(e) {
    var fileName = document.getElementById("mediaFile").files[0].name;
    var nextSibling = e.target.nextElementSibling;
    nextSibling.innerText = fileName;
}

function uploadImage(e) {
    document.getElementById("updateimgLink").src = window.URL.createObjectURL(
        this.files[0]
    );
    document.getElementById("updateimgLink").hidden = false;
    var fileName = document.getElementById("updateimgFile").files[0].name;
    var nextSibling = e.target.nextElementSibling;
    nextSibling.innerText = fileName;
}

function loadBooks(data) {
    html = "";
    data.forEach(function (book, index) {
        bookID[index] = book.bookID;
        title[index] = book.title;
        author[index] = book.author;
        isbn[index] = book.isbn;
        star[index] = book.star;
        quantity[index] = book.quantity;
        Category1[index] = book.Category1;
        Category2[index] = book.Category2;
        Category3[index] = book.Category3;
        Category4[index] = book.Category4;
        publisher[index] = book.publisher;
        pages[index] = book.pages;
        imgLink[index] = book.imgLink;
        date_of_publication[index] = book.date_of_publication;
        book[index] = book.book;
        digital[index] = book.digital;
        html += `<div class="col mb-4 search-card">
                <div class="card h-100">`;
        if (book.imgLink != "") {
            html +=
                `<img class="card-img-top" src="` +
                book.imgLink +
                ` " alt="" style="height:200px;" />`;
        } else {
            html += `<img class="card-img-top" src="https://placehold.co/200x255" alt="" style="height:200px;" />`;
        }
        html +=
            `		
                    <div class="card-body">
                        <div class="row no-gutters">
                            <div class="col-4 font-weight-bold">Title:</div>
                            <div class="col-8 font-weight-bolder">
                                ` +
            book.title +
            `
                            </div>
                        </div>
                        <div class="row no-gutters">
                            <div class="col-4 font-weight-bold">Author:</div>
                            <div class="col-8 font-weight-bolder">
                                 ` +
            book.author +
            `
                            </div>
                        </div>
                        <div class="row no-gutters">
                            <div class="col-4 font-weight-bold">ISBN:</div>
                            <div class="col-8 font-weight-bolder">
                                 ` +
            book.isbn +
            `
                            </div>
                        </div>
                        <div class="row no-gutters">
                            <div class="col-4 font-weight-bold">Rating:</div>
                            <div class="col-8 font-weight-bolder">
                                 ` +
            book.star +
            `
                            </div>
                        </div>
                        <input type="hidden" class="Category1" value=" ` +
            book.Category1 +
            `" />
                        <input type="hidden" class="Category2" value=" ` +
            book.Category2 +
            `" />
                        <input type="hidden" class="Category3" value=" ` +
            book.Category3 +
            `" />
                        <input type="hidden" class="Category4" value=" ` +
            book.Category4 +
            `" />
                        <input type="hidden" class="digital" value=" ` +
            book.digital +
            `" />
                        <input type="hidden" class="book" value=" ` +
            book.book +
            `" />
                    </div>
                    <div class="card-footer bg-white">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <button type="button" class="btn btn-info btn-block btn-sm" name="info-book" id=" ` +
            index +
            `" onclick="autoFillInfo(this.id)" data-toggle="modal" data-target="#moreInfo">
                                    Info
                                </button>`;

        if (book.digital != 0) {
            html +=
                `			<a type="button" class="btn btn-orange btn-block btn-sm" name="download" href=" ` +
                book.digitalLink +
                `;" download>
                                        Download
                                    </a>`;
        } else {
            html +=
                `			<button type="button" class="btn btn-orange btn-block btn-sm" id=" ` +
                index +
                `" onclick="autoFillBook(this.id)" data-toggle="modal" data-target="#displayCopy">
                                        Issue/Return Delete
                                    </button>`;
        }
        html +=
            `			<button type="button" class="btn btn-blue btn-block btn-sm" id=" ` +
            index +
            `" onclick="autoFillUpdateBook(this.id)" data-toggle="modal" data-target="#updateBook">
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
            `;

        $("#result").html(html);
    });
}
