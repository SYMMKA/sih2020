// Listen for form submit
// var searchBookForm = document.getElementById("search_form");
// searchBookForm.addEventListener("submit", searchBook, false);

var addBookForm = document.getElementById("addBookForm");
addBookForm.addEventListener("submit", addBook);

// Validate and Submit form
function addBook(event) {
    event.preventDefault();
    // Get values
    var title = getInputVal("title");
    var author = getInputVal("author");
    var publisher = getInputVal("publisher");
    var publishedDate = getInputVal("publishedDate");
    var isbn = getInputVal("isbn");
    var money = getInputVal("money");
    var imgValue = document.getElementById("imgValue").value;
    var imgFile = $("#imgFile")[0].files[0];
    if (!imgFile) imgFile = null;
    var quantity = getInputVal("quantity"); //physical
    var pageCount = getInputVal("pageCount"); //book
    var mediaFile = $("#mediaFile")[0].files[0]; //digital
    var book_audio = document.querySelector('input[name="book_audio"]:checked')
        .value;
    var physical_digital = document.querySelector(
        'input[name="physical_digital"]:checked'
    ).value;
    var dop = $("#dop").val();
    dop = new Date(dop).valueOf() / 1000;
    var source = document.getElementById("source").value;
    var oldID = [];
    for (var i = 1; i <= quantity; i++) {
        oldID[i - 1] = document.getElementById("oldID" + i).value;
    }
    oldID = JSON.stringify(oldID);
    var receiptFile = $("#receiptFile")[0].files[0]; //receipt

    var mainCategory1 = "";
    var mainCategory2 = "";
    var mainCategory3 = "";
    var mainCategory4 = "";
    if (mainCategorySelect1.value)
        mainCategory1 =
            mainCategorySelect1.options[mainCategorySelect1.selectedIndex].text;
    if (mainCategorySelect2.value)
        mainCategory2 =
            mainCategorySelect2.options[mainCategorySelect2.selectedIndex].text;
    if (mainCategorySelect3.value)
        mainCategory3 =
            mainCategorySelect3.options[mainCategorySelect3.selectedIndex].text;
    if (mainCategorySelect4.value)
        mainCategory4 =
            mainCategorySelect4.options[mainCategorySelect4.selectedIndex].text;

    var formData = new FormData();
    formData.append("title1", title);
    formData.append("author1", author);
    formData.append("mainCategorySelect1", mainCategory1);
    formData.append("mainCategorySelect2", mainCategory2);
    formData.append("mainCategorySelect3", mainCategory3);
    formData.append("mainCategorySelect4", mainCategory4);
    formData.append("publisher1", publisher);
    formData.append("publishedDate1", publishedDate);
    formData.append("isbn1", isbn);
    formData.append("pageCount1", pageCount);
    formData.append("money1", money);
    formData.append("imgValue1", imgValue);
    formData.append("imgFile", imgFile);
    formData.append("quantity1", quantity);
    formData.append("mediaFile", mediaFile);
    formData.append("book_audio", book_audio);
    formData.append("physical_digital", physical_digital);
    formData.append("dop", dop);
    formData.append("source", source);
    formData.append("oldID", oldID);
    formData.append("receiptFile", receiptFile);

    $.ajax({
        type: "POST",
        url: "addBook/addQuery.php",
        data: formData,
        type: "POST",
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function (data) {
            if (data.substring(data.length - 7) != "success") {
                alert(data);
            } else {
                $(".bd-example-modal-xl").modal("hide");
                // Clear form
                document.getElementById("addBookForm").reset();
            }
            console.log(data);
            var formCopyID = new FormData();
            formCopyID.append("title", title);
            formCopyID.append("author", author);
            formCopyID.append("isbn", isbn);
            $.ajax({
                type: "POST",
                url: "addBook/getCopyID.php",
                data: formCopyID,
                type: "POST",
                contentType: false, // Dont delete this (jQuery 1.6+)
                processData: false, // Dont delete this
                success: function (data) {
                    console.log(data);
                    var type = "Book";
                    $("#typeQR").val(type);
                    $("#qrIDs").val(data);
                    $("#qrForm").submit();
                },
                //Other options
            });
        },
        //Other options
    });

    // Show alert
    //document.querySelector('.alert').style.display = 'block';

    // Hide alert after 1.5 seconds
    /* setTimeout(function() {
			document.querySelector('.alert').style.display = 'none';
		}, 1500); */

    // }
    // addBookForm.classList.add("was-validated");
}

// Function to get form values
function getInputVal(id) {
    return document.getElementById(id).value;
}
