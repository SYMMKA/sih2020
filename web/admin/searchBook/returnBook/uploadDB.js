// Listen for form submit
document
    .getElementById("returnBookForm")
    .addEventListener("submit", returnBook);

var due;
// Submit form
function returnBook(e) {
    e.preventDefault();

    // Get values
    var copyID = document.getElementById("copyID").textContent;
    var elementID = document.getElementById("elementID").value;

    var ratio = parseFloat(document.getElementById("ratio").value);
    var fine = parseFloat(document.getElementById("totalFine").textContent);

    var orgPoint = parseFloat(document.getElementById("point").value);
    var points = -fine * ratio;

    if (fine == 0) points = orgPoint;

    var formData = new FormData();
    formData.append("copyID", copyID);
    formData.append("fine", fine);
    formData.append("points", points);
    formData.append("due", due);

    $.ajax({
        type: "POST",
        url: "searchBook/returnBook/returnQuery.php",
        data: formData,
        contentType: false, // Dont delete this (jQuery 1.6+)
        processData: false, // Dont delete this
        success: function (data) {
            
            
            var res = data.substr(data.length - 7, data.length);
            if ((res = "success")) {
                $.ajax({
                    type: "POST",
                    url: "searchBook/returnBook/get_notify.php",
                    data: {
                        copyID: copyID,
                    },
                    success: function (data2) {
                        
                    },
                });
            }
            autoFillBook(elementID);
        },
    });

    // Clear form
    //document.getElementById('issueBookForm').reload();
}
