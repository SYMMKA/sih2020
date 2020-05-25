// Listen for form submit
document.getElementById('returnBookForm').addEventListener('submit', returnBook);

// Submit form
function returnBook(e) {
    e.preventDefault();

    // Get values
    var isbn = document.getElementById('bookisbnReturn').textContent;
    var copyID = document.getElementById('returnCopyID').textContent;

    var formData = new FormData();
    formData.append('isbn', isbn);
    formData.append('copyID', copyID);

    $.ajax({
            type: "POST",
            url: "returnBook/returnQuery.php",
            data: formData,
            contentType: false, // Dont delete this (jQuery 1.6+)
            processData: false, // Dont delete this
            //Other options
        },

        window.location.reload(),
    );

    // Clear form
    //document.getElementById('issueBookForm').reload();

}