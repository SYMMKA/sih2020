$(document).ready(function () {
    $("#voiceSearchSubmit").on("click", searchMain);
});

function searchQR(qrsearch) {
    $.ajax({
        type: "POST",
        url: "manageBooks/manageBooks.php",
        data: {
            search: qrsearch,
            qr: 1,
        },
        success: function (data) {
            if (data) {
                data = JSON.parse(data);
                loadBooks(data);
                autoFillBook(0);
                $("#displayCopy").modal();
            } else alert("Book does not exist!");
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
            if (data) {
                data = JSON.parse(data);
                loadBooks(data);
            } else console.log("Empty");
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
        html += ` <div class="img-overlay">
                            
                            <img class="image" src="`;
        if (book.imgLink != "") html += book.imgLink + ` "`;
        else html += `https://placehold.co/200x255" `;
        html +=
            `alt="" style="height:200px; width:100%" />
                <div class="middle">
                                <button
                                    type="button"
                                    class="btn btn-outline-primary mb-2 mr-0 mr-xl-2"
                                    name="info-book" id=" ` +
            index +
            `" onclick="autoFillInfo(this.id)" data-toggle="modal" data-target="#moreInfo"
                                >
                                    <i
                                        class="fa fa-info-circle fa-cus"
                                        aria-hidden="true"
                                    ></i>
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-outline-danger mb-2"
                                    data-toggle="modal" data-target="#deleteBookModal"
                                    onclick="deleteBookConfirm(` +
            book.bookID +
            `)"
                                >
                                    <i
                                        class="fa fa-trash fa-cus"
                                        aria-hidden="true"
                                    ></i>
                                </button>
                            </div>
                        </div>
                `;
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
                            <div class="col-12">`;

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

function deleteBookConfirm(bookID) {
    $.ajax({
        type: "POST",
        url: "manageBooks/deleteBookConfirm.php",
        data: {
            bookID: bookID,
        },
        success: function (data) {
            if (data) {
                data = JSON.parse(data);
                console.log(data.issueCount);
                console.log(data.reserveCount);
                html =
                    ` <h6>` +
                    data.issueCount +
                    ` users have issued this book</h6>
                        <h6>` +
                    data.reserveCount +
                    ` users have reserved this book</h6>
                        <h6>Are you sure you want to delete this book ?</h6>`;
                $("#deleteModalText").html(html);
                $("#deleteBookButton").on("click", function () {
                    $.ajax({
                        type: "POST",
                        url: "manageBooks/deleteBook.php",
                        data: {
                            bookID: bookID,
                        },
                        success: function (data) {
                            if (data != "success") {
                                alert(data);
                            }
                            searchMain();
                        },
                    });
                });
            }
        },
    });
}
